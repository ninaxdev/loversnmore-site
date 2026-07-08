<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Yantrana\Components\User\UserEngine;
use App\Yantrana\Components\User\PremiumPlanEngine;
use App\Services\StripeConnectService;
use App\Yantrana\Components\User\Models\User;
use App\Yantrana\Components\User\Models\UserSubscription;
use App\Yantrana\Components\User\Models\Plan;
use Carbon\Carbon;

class StripeWebhookController extends Controller
{
    protected $userEngine;
    protected $stripeConnectService;
    protected $premiumPlanEngine;

    public function __construct(UserEngine $userEngine, StripeConnectService $stripeConnectService, PremiumPlanEngine $premiumPlanEngine)
    {
        $this->userEngine = $userEngine;
        $this->stripeConnectService = $stripeConnectService;
        $this->premiumPlanEngine = $premiumPlanEngine;
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

            // Subscription events
            case 'checkout.session.completed':
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;

            case 'invoice.paid':
                $this->handleInvoicePaid($event->data->object);
                break;

            case 'invoice.payment_failed':
                $this->handleInvoicePaymentFailed($event->data->object);
                break;

            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($event->data->object);
                break;

            case 'customer.subscription.updated':
                $this->handleSubscriptionUpdated($event->data->object);
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
                'user_id'    => $user->_id,
                'account_id' => $account->id,
                'status'     => $result['status'],
            ]);

            // If user just completed onboarding, sweep any pending gift earnings
            $freshUser = $result['user'];
            if ($freshUser->stripe_onboarding_completed && $freshUser->pending_earnings > 0) {
                $sweepResult = $this->stripeConnectService->sweepPendingEarnings($freshUser);

                if ($sweepResult['success'] && $sweepResult['swept'] > 0) {
                    \Log::info('Pending earnings swept after Connect onboarding', [
                        'user_id'     => $freshUser->_id,
                        'swept'       => $sweepResult['swept'],
                        'transfer_id' => $sweepResult['transfer_id'],
                    ]);
                }
            }
        } else {
            \Log::error('Failed to update Connect account status', [
                'user_id'    => $user->_id,
                'account_id' => $account->id,
                'error'      => $result['message'] ?? 'Unknown error',
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

    // ─────────────────────────────────────────────────────────────
    // Subscription webhook handlers
    // ─────────────────────────────────────────────────────────────

    protected function handleCheckoutSessionCompleted($session)
    {
        // Only handle subscription mode — gift payments use payment_intent.succeeded
        if ($session->mode !== 'subscription') return;

        $userId = $session->metadata->user_id ?? null;
        $planId = $session->metadata->plan_id ?? null;

        $user = User::where('_id', $userId)->first();
        $plan = Plan::where('_id', $planId)->first();

        if (!$user || !$plan) {
            \Log::error('Checkout completed: user or plan not found', compact('userId', 'planId'));
            return;
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $sub = \Stripe\Subscription::retrieve($session->subscription);

        // Cancel any pre-existing active Stripe subscription to avoid double billing
        $existingSub = UserSubscription::where('users__id', $user->_id)
            ->where('status', 1)
            ->whereNotNull('stripe_subscription_id')
            ->first();

        if ($existingSub && $existingSub->stripe_subscription_id !== $sub->id) {
            try {
                \Stripe\Subscription::cancel($existingSub->stripe_subscription_id);
            } catch (\Exception $e) {
                \Log::warning('Could not cancel old subscription', ['error' => $e->getMessage()]);
            }
        }

        // Deactivate all existing subscription rows for this user
        UserSubscription::where('users__id', $user->_id)
            ->where('status', 1)
            ->update(['status' => 0, 'updated_at' => now()]);

        // Insert new subscription row
        UserSubscription::create([
            '_uid'                           => (string) \Illuminate\Support\Str::uuid(),
            'status'                         => 1,
            'users__id'                      => $user->_id,
            'plan_id'                        => $plan->key . '_' . $plan->interval,
            'plan_key'                       => $plan->key,
            'plan_interval'                  => $plan->interval,
            'plan_price'                     => $plan->price,
            'stripe_subscription_id'         => $sub->id,
            'stripe_price_id'                => $plan->stripe_price_id,
            'expiry_at'                      => Carbon::createFromTimestamp($this->getSubPeriodEnd($sub)),
            'cancel_at_period_end'           => false,
            'credit_wallet_transactions__id' => null,
        ]);

        if (!$user->stripe_customer_id) {
            $user->stripe_customer_id = $session->customer;
            $user->save();
        }

        // Clear premium cache
        $this->clearPremiumCache($user->_id);

        \Log::info('Subscription created via checkout', ['user_id' => $user->_id, 'plan' => $plan->name]);
    }

    protected function handleInvoicePaid($invoice)
    {
        if (!$invoice->subscription) return;

        $userSub = UserSubscription::where('stripe_subscription_id', $invoice->subscription)
            ->where('status', 1)
            ->first();

        if (!$userSub) return;

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $stripeSub = \Stripe\Subscription::retrieve($invoice->subscription);

        // Apply pending downgrade at renewal
        if ($userSub->pending_plan_id) {
            $pendingPlan = Plan::where('_id', $userSub->pending_plan_id)->first();
            if ($pendingPlan && $pendingPlan->stripe_price_id) {
                \Stripe\Subscription::update($invoice->subscription, [
                    'items' => [[
                        'id'    => $stripeSub->items->data[0]->id,
                        'price' => $pendingPlan->stripe_price_id,
                    ]],
                    'proration_behavior' => 'none',
                ]);
                $userSub->update([
                    'plan_key'        => $pendingPlan->key,
                    'plan_interval'   => $pendingPlan->interval,
                    'plan_price'      => $pendingPlan->price,
                    'stripe_price_id' => $pendingPlan->stripe_price_id,
                    'pending_plan_id' => null,
                ]);
                $userSub->refresh();
            }
        }

        // Extend expiry on every renewal
        $userSub->update([
            'expiry_at' => Carbon::createFromTimestamp($this->getSubPeriodEnd($stripeSub)),
        ]);

        // Invoices are fetched on-demand from Stripe — no local invoice storage
    }

    protected function handleInvoicePaymentFailed($invoice)
    {
        \Log::warning('Subscription invoice payment failed', [
            'invoice_id'      => $invoice->id,
            'subscription_id' => $invoice->subscription,
            'amount'          => ($invoice->amount_due ?? 0) / 100,
        ]);
        // Stripe retries automatically; subscription.deleted fires after all retries exhausted
    }

    protected function handleSubscriptionDeleted($subscription)
    {
        $userSub = UserSubscription::where('stripe_subscription_id', $subscription->id)->first();

        if ($userSub) {
            $userSub->update(['status' => 0]);
            $this->clearPremiumCache($userSub->users__id);
        }

        \Log::info('Subscription deleted', ['stripe_sub_id' => $subscription->id]);
    }

    protected function handleSubscriptionUpdated($subscription)
    {
        $userSub = UserSubscription::where('stripe_subscription_id', $subscription->id)->first();

        if ($userSub) {
            $userSub->update([
                'cancel_at_period_end' => $subscription->cancel_at_period_end,
                'expiry_at'            => Carbon::createFromTimestamp($this->getSubPeriodEnd($subscription)),
            ]);
        }
    }

    private function getSubPeriodEnd(\Stripe\Subscription $sub): int
    {
        $ts = $sub->current_period_end
            ?? ($sub->items->data[0]->current_period_end ?? null);

        return (int) $ts;
    }

    private function clearPremiumCache($userId)
    {
        $currentTime = now()->format('Y-m-d H:i');
        \Cache::forget("user_subscription_of_{$userId}_user_id_at_{$currentTime}");
    }
}

