<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Yantrana\Components\User\UserEngine;
use App\Services\StripeConnectService;
use App\Yantrana\Components\User\Models\User;

class StripeWebhookController extends Controller
{
    protected $userEngine;
    protected $stripeConnectService;

    public function __construct(UserEngine $userEngine, StripeConnectService $stripeConnectService)
    {
        $this->userEngine = $userEngine;
        $this->stripeConnectService = $stripeConnectService;
    }

    /**
     * Handle Stripe webhook events
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function handleWebhook(Request $request)
    {
        // Set Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Get webhook secret from config
        $webhookSecret = config('services.stripe.webhook_secret');

        // Get the raw body and signature
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');

        try {
            // Verify webhook signature
            $event = Webhook::constructEvent(
                $payload,
                $signature,
                $webhookSecret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;

            case 'payment_intent.payment_failed':
                $this->handlePaymentIntentFailed($event->data->object);
                break;

            case 'payment_intent.canceled':
                $this->handlePaymentIntentCanceled($event->data->object);
                break;

            // Stripe Connect account events
            case 'account.updated':
                $this->handleAccountUpdated($event->data->object);
                break;

            case 'account.application.authorized':
                $this->handleAccountAuthorized($event->data->object);
                break;

            case 'account.application.deauthorized':
                $this->handleAccountDeauthorized($event->data->object);
                break;

            case 'capability.updated':
                $this->handleCapabilityUpdated($event->data->object);
                break;

            default:
                // Log unexpected event type but don't error
                \Log::info('Unhandled webhook event type: ' . $event->type);
        }

        // Return a 200 response to acknowledge receipt of the event
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Handle successful payment intent
     *
     * @param \Stripe\PaymentIntent $paymentIntent
     * @return void
     */
    protected function handlePaymentIntentSucceeded($paymentIntent)
    {
        // Check if this is a gift payment
        if (isset($paymentIntent->metadata->type) && $paymentIntent->metadata->type === 'gift_purchase') {
            // Complete the gift purchase
            $result = $this->userEngine->completeStripeGiftPurchase($paymentIntent->id);

            // Log the result
            if ($result['success']) {
                \Log::info('Gift purchase completed successfully', [
                    'payment_intent_id' => $paymentIntent->id,
                    'amount' => $paymentIntent->amount / 100,
                ]);
            } else {
                \Log::error('Failed to complete gift purchase', [
                    'payment_intent_id' => $paymentIntent->id,
                    'error' => $result['message'],
                ]);
            }
        }
    }

    /**
     * Handle failed payment intent
     *
     * @param \Stripe\PaymentIntent $paymentIntent
     * @return void
     */
    protected function handlePaymentIntentFailed($paymentIntent)
    {
        // Log the failed payment
        \Log::warning('Payment intent failed', [
            'payment_intent_id' => $paymentIntent->id,
            'amount' => $paymentIntent->amount / 100,
            'error' => $paymentIntent->last_payment_error ? $paymentIntent->last_payment_error->message : 'Unknown error',
        ]);

        // You could update the gift record status to 'failed' here if needed
        // For now, we'll just log it
    }

    /**
     * Handle canceled payment intent
     *
     * @param \Stripe\PaymentIntent $paymentIntent
     * @return void
     */
    protected function handlePaymentIntentCanceled($paymentIntent)
    {
        // Log the canceled payment
        \Log::info('Payment intent canceled', [
            'payment_intent_id' => $paymentIntent->id,
            'amount' => $paymentIntent->amount / 100,
        ]);

        // You could update the gift record status to 'canceled' here if needed
    }

    /**
     * Handle Stripe Connect account updated event
     *
     * @param \Stripe\Account $account
     * @return void
     */
    protected function handleAccountUpdated($account)
    {
        // Find user with this Connect account
        $user = User::where('stripe_connect_account_id', $account->id)->first();

        if (!$user) {
            \Log::warning('Connect account updated but no user found', [
                'account_id' => $account->id,
            ]);
            return;
        }

        // Update user's account status
        $result = $this->stripeConnectService->updateUserAccountStatus($user);

        if ($result['success']) {
            \Log::info('Connect account status updated', [
                'user_id' => $user->_id,
                'account_id' => $account->id,
                'status' => $result['status'],
            ]);
        } else {
            \Log::error('Failed to update Connect account status', [
                'user_id' => $user->_id,
                'account_id' => $account->id,
                'error' => $result['message'] ?? 'Unknown error',
            ]);
        }
    }

    /**
     * Handle account authorized event
     *
     * @param object $data
     * @return void
     */
    protected function handleAccountAuthorized($data)
    {
        \Log::info('Connect account authorized', [
            'account_id' => $data->id ?? 'unknown',
        ]);
    }

    /**
     * Handle account deauthorized event
     *
     * @param object $data
     * @return void
     */
    protected function handleAccountDeauthorized($data)
    {
        // Find user and mark Connect account as deauthorized
        if (isset($data->account)) {
            $user = User::where('stripe_connect_account_id', $data->account)->first();

            if ($user) {
                $user->update([
                    'stripe_connect_status' => 'disabled',
                    'stripe_charges_enabled' => false,
                    'stripe_payouts_enabled' => false,
                ]);

                \Log::info('Connect account deauthorized', [
                    'user_id' => $user->_id,
                    'account_id' => $data->account,
                ]);
            }
        }
    }

    /**
     * Handle capability updated event
     *
     * @param \Stripe\Capability $capability
     * @return void
     */
    protected function handleCapabilityUpdated($capability)
    {
        // Find user with this Connect account
        $user = User::where('stripe_connect_account_id', $capability->account)->first();

        if (!$user) {
            return;
        }

        // Update user's capabilities
        $this->stripeConnectService->updateUserAccountStatus($user);

        \Log::info('Connect account capability updated', [
            'user_id' => $user->_id,
            'account_id' => $capability->account,
            'capability' => $capability->id,
            'status' => $capability->status,
        ]);
    }
}

