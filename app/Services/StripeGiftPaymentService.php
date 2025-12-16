<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;

class StripeGiftPaymentService
{
    public function __construct()
    {
        // Set Stripe API key from config
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Get or create a Stripe Customer for a user
     *
     * @param int $userId User's database ID
     * @param string $email User's email
     * @param string $name User's full name
     * @return array Customer data
     */
    public function getOrCreateCustomer($userId, $email, $name)
    {
        try {
            // Check if user already has a Stripe customer ID in database
            $user = \App\Yantrana\Components\User\Models\User::find($userId);

            if ($user && $user->stripe_customer_id) {
                // Retrieve existing customer from Stripe
                try {
                    $customer = Customer::retrieve($user->stripe_customer_id);
                    return [
                        'success' => true,
                        'customer_id' => $customer->id,
                        'customer' => $customer,
                        'is_new' => false,
                    ];
                } catch (ApiErrorException $e) {
                    // Customer ID in DB is invalid, create new one
                    // Fall through to create new customer
                }
            }

            // Create new Stripe Customer
            $customer = Customer::create([
                'email' => $email,
                'name' => $name,
                'metadata' => [
                    'user_id' => $userId,
                    'platform' => 'loversnmore',
                ],
            ]);

            // Save customer ID to database
            if ($user) {
                $user->stripe_customer_id = $customer->id;
                $user->save();
            }

            return [
                'success' => true,
                'customer_id' => $customer->id,
                'customer' => $customer,
                'is_new' => true,
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
     * Create a Payment Intent for gift purchase
     *
     * @param float $amount Amount in USD
     * @param array $metadata Additional data to store with payment
     * @param string|null $customerId Stripe Customer ID (optional)
     * @return array Payment Intent data
     */
    public function createGiftPaymentIntent($amount, $metadata = [], $customerId = null)
    {
        try {
            // Convert amount to cents (Stripe uses smallest currency unit)
            $amountInCents = (int) ($amount * 100);

            $paymentIntentData = [
                'amount' => $amountInCents,
                'currency' => 'usd',
                'description' => 'Gift purchase: ' . ($metadata['gift_name'] ?? 'Gift'),
                'receipt_email' => $metadata['sender_email'] ?? null,
                'metadata' => array_merge([
                    'type' => 'gift_purchase',
                    'platform' => 'loversnmore'
                ], $metadata),
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ];

            // Attach customer if provided
            if ($customerId) {
                $paymentIntentData['customer'] = $customerId;
            }

            $paymentIntent = PaymentIntent::create($paymentIntentData);

            return [
                'success' => true,
                'payment_intent_id' => $paymentIntent->id,
                'client_secret' => $paymentIntent->client_secret,
                'amount' => $amount,
                'status' => $paymentIntent->status,
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
     * Retrieve a Payment Intent
     *
     * @param string $paymentIntentId
     * @return array
     */
    public function getPaymentIntent($paymentIntentId)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            return [
                'success' => true,
                'payment_intent' => $paymentIntent,
                'status' => $paymentIntent->status,
                'amount' => $paymentIntent->amount / 100, // Convert back to dollars
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Calculate payment splits for gift
     *
     * @param float $amount Gift amount in USD
     * @return array Breakdown of payment distribution
     */
    public function calculateGiftSplits($amount)
    {
        // Stripe fee: 2.9% + $0.30
        $stripeFee = ($amount * 0.029) + 0.30;

        // Net amount after Stripe fee
        $netAmount = $amount - $stripeFee;

        // Recipient: ~60% of net amount
        $recipientAmount = $netAmount * 0.60;

        // Affiliate: ~20% of net amount
        $affiliateCommission = $netAmount * 0.20;

        // Platform: ~20% of net amount
        $platformFee = $netAmount * 0.20;

        return [
            'gross_amount' => round($amount, 2),
            'stripe_fee' => round($stripeFee, 2),
            'net_amount' => round($netAmount, 2),
            'recipient_amount' => round($recipientAmount, 2),
            'affiliate_commission' => round($affiliateCommission, 2),
            'platform_fee' => round($platformFee, 2),
        ];
    }

    /**
     * Get gift tier pricing
     *
     * @return array
     */
    public function getGiftTiers()
    {
        return [
            'tier_1' => [
                'price' => 4.99,
                'name' => 'Virtual Coffee',
                'emoji' => '☕',
            ],
            'tier_2' => [
                'price' => 9.99,
                'name' => 'Digital Flowers',
                'emoji' => '💐',
            ],
            'tier_3' => [
                'price' => 14.99,
                'name' => 'Sweet Teddy Bear',
                'emoji' => '🧸',
            ],
            'tier_4' => [
                'price' => 19.99,
                'name' => 'Super Spotlight',
                'emoji' => '🌟',
            ],
        ];
    }

    /**
     * Confirm a payment intent
     *
     * @param string $paymentIntentId
     * @return array
     */
    public function confirmPayment($paymentIntentId)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status === 'requires_confirmation') {
                $paymentIntent->confirm();
            }

            return [
                'success' => true,
                'status' => $paymentIntent->status,
                'payment_intent' => $paymentIntent,
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Cancel a payment intent
     *
     * @param string $paymentIntentId
     * @return array
     */
    public function cancelPayment($paymentIntentId)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status === 'requires_payment_method' ||
                $paymentIntent->status === 'requires_confirmation') {
                $paymentIntent->cancel();
            }

            return [
                'success' => true,
                'status' => $paymentIntent->status,
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
