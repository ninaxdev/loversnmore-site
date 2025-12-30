<?php

namespace App\Yantrana\Components\User;

use App\Yantrana\Base\BaseEngine;
use App\Services\StripeConnectService;
use App\Yantrana\Components\User\Models\User;
use Auth;

/**
 * This StripeConnectEngine class for managing Stripe Connect functionality
 *---------------------------------------------------------------- */
class StripeConnectEngine extends BaseEngine
{
    /**
     * @var StripeConnectService
     */
    protected $stripeConnectService;

    /**
     * Constructor
     *-----------------------------------------------------------------------*/
    public function __construct(StripeConnectService $stripeConnectService)
    {
        $this->stripeConnectService = $stripeConnectService;
    }

    /**
     * Process Stripe Connect onboarding
     *
     * @return array
     *---------------------------------------------------------------- */
    public function processOnboarding()
    {
        $user = Auth::user();

        if (!$user) {
            return $this->engineReaction(2, null, __tr('User not authenticated'));
        }

        $returnUrl = route('user.stripe_connect.onboarding_return');
        $refreshUrl = route('user.stripe_connect.onboarding_refresh');

        $result = $this->stripeConnectService->startOnboarding($user, $returnUrl, $refreshUrl);

        if (!$result['success']) {
            return $this->engineReaction(2, null, __tr('Failed to start onboarding: ') . $result['error']);
        }

        return $this->engineReaction(1, [
            'onboarding_url' => $result['onboarding_url'],
            'account_id' => $result['account_id'],
            'is_new_account' => $result['is_new_account'],
        ], __tr('Onboarding link created successfully'));
    }

    /**
     * Handle return from Stripe onboarding
     *
     * @return array
     *---------------------------------------------------------------- */
    public function handleOnboardingReturn()
    {
        $user = Auth::user();

        if (!$user) {
            return $this->engineReaction(2, null, __tr('User not authenticated'));
        }

        // Update account status from Stripe
        $result = $this->stripeConnectService->updateUserAccountStatus($user);

        if (!$result['success']) {
            return $this->engineReaction(2, null, __tr('Failed to update account status'));
        }

        $user = $result['user'];

        if ($user->stripe_onboarding_completed) {
            return $this->engineReaction(1, [
                'status' => $result['status'],
                'user' => $user,
            ], __tr('Stripe Connect setup completed successfully! You can now receive gifts.'));
        }

        return $this->engineReaction(2, [
            'status' => $result['status'],
            'user' => $user,
        ], __tr('Onboarding not yet complete. Please finish all required steps.'));
    }

    /**
     * Get Connect account status
     *
     * @return array
     *---------------------------------------------------------------- */
    public function getConnectAccountStatus()
    {
        $user = Auth::user();

        if (!$user) {
            return $this->engineReaction(2, null, __tr('User not authenticated'));
        }

        if (!$user->stripe_connect_account_id) {
            return $this->engineReaction(1, [
                'has_account' => false,
                'status' => 'none',
                'can_receive_gifts' => false,
            ], __tr('No Stripe Connect account found'));
        }

        // Get latest status from Stripe
        $result = $this->stripeConnectService->updateUserAccountStatus($user);

        if (!$result['success']) {
            return $this->engineReaction(2, null, __tr('Failed to check account status'));
        }

        $user = $result['user'];

        $eligibility = $this->stripeConnectService->canReceiveGifts($user);

        return $this->engineReaction(1, [
            'has_account' => true,
            'status' => $user->stripe_connect_status,
            'onboarding_completed' => $user->stripe_onboarding_completed,
            'charges_enabled' => $user->stripe_charges_enabled,
            'payouts_enabled' => $user->stripe_payouts_enabled,
            'can_receive_gifts' => $eligibility['can_receive'],
            'eligibility_message' => $eligibility['message'],
        ], __tr('Account status retrieved'));
    }

    /**
     * Get earnings data for the user
     *
     * @return array
     *---------------------------------------------------------------- */
    public function getEarningsData()
    {
        $user = Auth::user();

        if (!$user) {
            return $this->engineReaction(2, null, __tr('User not authenticated'));
        }

        // Get gifts received by this user
        $giftsReceived = \App\Yantrana\Components\User\Models\UserGiftModel::where('to_users__id', $user->_id)
            ->where('stripe_payment_status', 'succeeded')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalEarnings = $giftsReceived->sum('recipient_amount');
        $totalGiftsReceived = $giftsReceived->count();

        // Get recent gifts (last 10)
        $recentGifts = $giftsReceived->take(10)->map(function ($gift) {
            return [
                'id' => $gift->_id,
                'gift_name' => $gift->items_name ?? 'Gift',
                'amount' => $gift->recipient_amount,
                'total_amount' => $gift->stripe_amount,
                'from_user' => $gift->fromUser ? [
                    'name' => $gift->fromUser->first_name . ' ' . $gift->fromUser->last_name,
                    'username' => $gift->fromUser->username,
                ] : null,
                'received_at' => $gift->created_at->format('M d, Y h:i A'),
                'status' => $gift->stripe_payment_status,
            ];
        });

        // Get Stripe balance if account exists
        $stripeBalance = [
            'available' => 0,
            'pending' => 0,
        ];

        if ($user->stripe_connect_account_id) {
            $balanceResult = $this->stripeConnectService->getAccountBalance($user->stripe_connect_account_id);
            if ($balanceResult['success']) {
                $stripeBalance = [
                    'available' => $balanceResult['available'],
                    'pending' => $balanceResult['pending'],
                ];
            }
        }

        return $this->engineReaction(1, [
            'total_earnings' => number_format($totalEarnings, 2),
            'total_gifts_received' => $totalGiftsReceived,
            'recent_gifts' => $recentGifts,
            'stripe_balance' => $stripeBalance,
            'connect_status' => $user->stripe_connect_status,
            'onboarding_completed' => $user->stripe_onboarding_completed,
        ], __tr('Earnings data retrieved'));
    }

    /**
     * Generate Stripe Express Dashboard login link
     *
     * @return array
     *---------------------------------------------------------------- */
    public function generateDashboardLink()
    {
        $user = Auth::user();

        if (!$user) {
            return $this->engineReaction(2, null, __tr('User not authenticated'));
        }

        if (!$user->stripe_connect_account_id) {
            return $this->engineReaction(2, null, __tr('No Stripe Connect account found'));
        }

        $result = $this->stripeConnectService->createLoginLink($user->stripe_connect_account_id);

        if (!$result['success']) {
            return $this->engineReaction(2, null, __tr('Failed to create dashboard link'));
        }

        return $this->engineReaction(1, [
            'dashboard_url' => $result['url'],
        ], __tr('Dashboard link created'));
    }
}
