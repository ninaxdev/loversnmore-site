<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Yantrana\Components\User\UserEngine;

class StripeWebhookController extends Controller
{
    protected $userEngine;

    public function __construct(UserEngine $userEngine)
    {
        $this->userEngine = $userEngine;
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

            default:
                // Unexpected event type
                return response()->json(['error' => 'Unexpected event type'], 400);
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
}
