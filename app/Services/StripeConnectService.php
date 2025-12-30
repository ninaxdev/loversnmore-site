<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Account;
use Stripe\AccountLink;
use Stripe\Transfer;
use Stripe\Exception\ApiErrorException;
use App\Yantrana\Components\User\Models\User;
use Carbon\Carbon;

class StripeConnectService
{
    public function __construct()
    {
        // Set Stripe API key from config
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Connect Express account for a user
     *
     * @param User $user The user to create account for
     * @return array Account creation result
     */
    public function createConnectAccount(User $user)
    {
        try {
            // Check if user already has a Connect account
            if ($user->stripe_connect_account_id) {
                // Verify if it still exists on Stripe
                try {
                    $account = Account::retrieve($user->stripe_connect_account_id);
                    return [
                        'success' => true,
                        'account_id' => $account->id,
                        'account' => $account,
                        'is_new' => false,
                        'message' => 'Existing account found',
                    ];
                } catch (ApiErrorException $e) {
                    // Account ID in DB is invalid, create new one
                    // Fall through to create new account
                }
            }

            // Create new Stripe Connect Express account
            $account = Account::create([
                'type' => 'express',
                'country' => 'US',
                'email' => $user->email,
                'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                ],
                'business_type' => 'individual',
                'metadata' => [
                    'user_id' => $user->_id,
                    'username' => $user->username,
                    'platform' => 'loversnmore',
                ],
            ]);

            // Save account ID to database
            $user->update([
                'stripe_connect_account_id' => $account->id,
                'stripe_connect_status' => 'pending',
                'stripe_onboarding_started_at' => Carbon::now(),
            ]);

            return [
                'success' => true,
                'account_id' => $account->id,
                'account' => $account,
                'is_new' => true,
                'message' => 'Connect account created successfully',
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'error_code' => $e->getCode(),
            ];
        }
    }

    /**
     * Generate an Account Link for onboarding
     *
     * @param string $accountId Stripe Connect account ID
     * @param string $returnUrl URL to return to after onboarding
     * @param string $refreshUrl URL to return to if link expires
     * @return array Account link data
     */
    public function createAccountLink($accountId, $returnUrl, $refreshUrl)
    {
        try {
            $accountLink = AccountLink::create([
                'account' => $accountId,
                'refresh_url' => $refreshUrl,
                'return_url' => $returnUrl,
                'type' => 'account_onboarding',
            ]);

            return [
                'success' => true,
                'url' => $accountLink->url,
                'created' => $accountLink->created,
                'expires_at' => $accountLink->expires_at,
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get the current status of a Connect account
     *
     * @param string $accountId Stripe Connect account ID
     * @return array Account status data
     */
    public function getAccountStatus($accountId)
    {
        try {
            $account = Account::retrieve($accountId);

            $chargesEnabled = $account->charges_enabled ?? false;
            $payoutsEnabled = $account->payouts_enabled ?? false;
            $detailsSubmitted = $account->details_submitted ?? false;

            // Determine overall status
            $status = 'pending';
            if ($chargesEnabled && $payoutsEnabled && $detailsSubmitted) {
                $status = 'active';
            } elseif ($detailsSubmitted && !$chargesEnabled) {
                $status = 'restricted';
            }

            return [
                'success' => true,
                'account' => $account,
                'status' => $status,
                'charges_enabled' => $chargesEnabled,
                'payouts_enabled' => $payoutsEnabled,
                'details_submitted' => $detailsSubmitted,
                'requirements' => [
                    'currently_due' => $account->requirements->currently_due ?? [],
                    'eventually_due' => $account->requirements->eventually_due ?? [],
                    'past_due' => $account->requirements->past_due ?? [],
                ],
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Update user's Connect account status in database
     *
     * @param User $user
     * @return array Update result
     */
    public function updateUserAccountStatus(User $user)
    {
        if (!$user->stripe_connect_account_id) {
            return [
                'success' => false,
                'message' => 'No Connect account found for user',
            ];
        }

        $statusResult = $this->getAccountStatus($user->stripe_connect_account_id);

        if (!$statusResult['success']) {
            return $statusResult;
        }

        $updateData = [
            'stripe_connect_status' => $statusResult['status'],
            'stripe_charges_enabled' => $statusResult['charges_enabled'],
            'stripe_payouts_enabled' => $statusResult['payouts_enabled'],
            'stripe_details_submitted' => $statusResult['details_submitted'],
        ];

        // Mark onboarding as completed if fully active
        if ($statusResult['status'] === 'active' && !$user->stripe_onboarding_completed) {
            $updateData['stripe_onboarding_completed'] = true;
            $updateData['stripe_onboarding_completed_at'] = Carbon::now();
        }

        $user->update($updateData);

        return [
            'success' => true,
            'status' => $statusResult['status'],
            'user' => $user->fresh(),
        ];
    }

    /**
     * Check if a user can receive gifts
     *
     * @param User $user
     * @return array Eligibility result
     */
    public function canReceiveGifts(User $user)
    {
        if (!$user->stripe_connect_account_id) {
            return [
                'can_receive' => false,
                'reason' => 'no_connect_account',
                'message' => 'User has not set up a Stripe Connect account',
            ];
        }

        if (!$user->stripe_onboarding_completed) {
            return [
                'can_receive' => false,
                'reason' => 'onboarding_incomplete',
                'message' => 'User has not completed Stripe onboarding',
            ];
        }

        if (!$user->stripe_charges_enabled) {
            return [
                'can_receive' => false,
                'reason' => 'charges_disabled',
                'message' => 'User account cannot accept charges',
            ];
        }

        return [
            'can_receive' => true,
            'message' => 'User can receive gifts',
        ];
    }

    /**
     * Transfer funds to a recipient's Connect account
     *
     * @param string $accountId Recipient's Stripe Connect account ID
     * @param float $amount Amount to transfer (in USD)
     * @param array $metadata Additional metadata
     * @return array Transfer result
     */
    public function transferToRecipient($accountId, $amount, $metadata = [])
    {
        try {
            // Convert amount to cents
            $amountInCents = (int) ($amount * 100);

            $transfer = Transfer::create([
                'amount' => $amountInCents,
                'currency' => 'usd',
                'destination' => $accountId,
                'description' => 'Gift payment: ' . ($metadata['gift_name'] ?? 'Gift'),
                'metadata' => array_merge([
                    'type' => 'gift_recipient_payment',
                    'platform' => 'loversnmore',
                ], $metadata),
            ]);

            return [
                'success' => true,
                'transfer_id' => $transfer->id,
                'amount' => $amount,
                'destination' => $accountId,
                'status' => $transfer->status ?? 'pending',
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'error_code' => $e->getCode(),
            ];
        }
    }

    /**
     * Get account balance for a Connect account
     *
     * @param string $accountId Stripe Connect account ID
     * @return array Balance data
     */
    public function getAccountBalance($accountId)
    {
        try {
            $account = Account::retrieve($accountId);

            // Get balance from Stripe
            $balance = \Stripe\Balance::retrieve([
                'stripe_account' => $accountId,
            ]);

            $available = 0;
            $pending = 0;

            if (isset($balance->available) && count($balance->available) > 0) {
                $available = $balance->available[0]->amount / 100;
            }

            if (isset($balance->pending) && count($balance->pending) > 0) {
                $pending = $balance->pending[0]->amount / 100;
            }

            return [
                'success' => true,
                'available' => $available,
                'pending' => $pending,
                'currency' => 'usd',
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Create a login link for Express Dashboard
     *
     * @param string $accountId Stripe Connect account ID
     * @return array Login link data
     */
    public function createLoginLink($accountId)
    {
        try {
            $loginLink = Account::createLoginLink($accountId);

            return [
                'success' => true,
                'url' => $loginLink->url,
                'created' => $loginLink->created,
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Start onboarding process for a user
     *
     * @param User $user
     * @param string $returnUrl
     * @param string $refreshUrl
     * @return array Onboarding result with URL
     */
    public function startOnboarding(User $user, $returnUrl, $refreshUrl)
    {
        // Step 1: Create Connect account if doesn't exist
        $accountResult = $this->createConnectAccount($user);

        if (!$accountResult['success']) {
            return $accountResult;
        }

        // Step 2: Generate onboarding link
        $linkResult = $this->createAccountLink(
            $accountResult['account_id'],
            $returnUrl,
            $refreshUrl
        );

        if (!$linkResult['success']) {
            return $linkResult;
        }

        return [
            'success' => true,
            'onboarding_url' => $linkResult['url'],
            'account_id' => $accountResult['account_id'],
            'is_new_account' => $accountResult['is_new'],
        ];
    }
}
