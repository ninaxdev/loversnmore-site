<?php
/**
* PremiumPlanEngine.php - Main component file
*
* This file is part of the Premium Plan User component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\User;

use App\Yantrana\Base\BaseEngine;
use App\Yantrana\Components\User\Repositories\{UserRepository};
use App\Yantrana\Components\User\Models\Plan;
use App\Yantrana\Support\CommonTrait;
use Carbon\Carbon;
use Stripe\Stripe as StripeClient;

class PremiumPlanEngine extends BaseEngine
{
    /**
     * @var UserRepository - User Repository
     */
    protected $userRepository;

    /**
     * @var CommonTrait - Common Trait
     */
    use CommonTrait;

    /**
     * Constructor
     *
     * @param  UserRepository  $userRepository  - User Repository
     * @return  void
     *-----------------------------------------------------------------------*/
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Prepare Buy Premium Plan User Data.
     *
     *
     *---------------------------------------------------------------- */
    public function preparePremiumPlanUserData()
    {
        $premiumPlanCollection = getStoreSettings('plan_duration');
        $premiumFeaturesCollection = getStoreSettings('feature_plans');
        $premiumPlans = $premiumPlanData = $premiumFeatureData = [];

        // check if user premium plan exists
        if (! __isEmpty($premiumPlanCollection)) {
            $premiumPlans = is_array($premiumPlanCollection) ? $premiumPlanCollection : json_decode($premiumPlanCollection, true);
            $planDurationConfig = config('__settings.items.premium-plans');
            $defaultPlanDuration = $planDurationConfig['plan_duration']['default'];
            $premiumPlanData = combineArray($defaultPlanDuration, $premiumPlans);
        }

        // check if user premium features exists
        if (! __isEmpty($premiumFeaturesCollection)) {
            $premiumFeature = is_array($premiumFeaturesCollection) ? $premiumFeaturesCollection : json_decode($premiumFeaturesCollection, true);
            // Get settings from config
            $featurePlanConfig = config('__settings.items.premium-feature');
            $defaultFeaturePlans = $featurePlanConfig['feature_plans']['default'];
            $premiumFeatureData = combineArray($defaultFeaturePlans, $premiumFeature);
        }

        $userSubscription = $this->userRepository->fetchUserSubscription();

        $userSubscriptionData = [];
        if (! __isEmpty($userSubscription)) {
            $expiryAt = isset($userSubscription->expiry_at) ? formatDate($userSubscription->expiry_at, 'l jS F Y H:i:s') : 'N/A';

            // Stripe subscription — build from new columns
            if (!empty($userSubscription->plan_key)) {
                $userSubscriptionData = [
                    '_id'                            => $userSubscription->_id,
                    '_uid'                           => $userSubscription->_uid,
                    'created_at'                     => formatDate($userSubscription->created_at, 'l jS F Y H:i:s'),
                    'users__id'                      => $userSubscription->users__id,
                    'expiry_at'                      => $expiryAt,
                    'credit_wallet_transactions__id' => $userSubscription->credit_wallet_transactions__id,
                    'debitedCredits'                 => 0,
                    'plan_id'                        => $userSubscription->plan_id,
                    'plan_key'                       => $userSubscription->plan_key,
                    'plan_interval'                  => $userSubscription->plan_interval,
                    'planTitle'                      => ucfirst($userSubscription->plan_key),
                    'planPrice'                      => $userSubscription->plan_price,
                    'long_expiry'                    => false,
                ];
            } elseif (! __isEmpty($premiumPlans) and ! __isEmpty($premiumPlanData) and isset($premiumPlanData[$userSubscription->plan_id])) {
                // Legacy credit-based subscription
                $planData = $premiumPlanData[$userSubscription->plan_id];
                $userSubscriptionData = [
                    '_id'                            => $userSubscription->_id,
                    '_uid'                           => $userSubscription->_uid,
                    'created_at'                     => formatDate($userSubscription->created_at, 'l jS F Y H:i:s'),
                    'users__id'                      => $userSubscription->users__id,
                    'expiry_at'                      => $expiryAt,
                    'credit_wallet_transactions__id' => $userSubscription->credit_wallet_transactions__id,
                    'debitedCredits'                 => $userSubscription->credits,
                    'plan_id'                        => $userSubscription->plan_id,
                    'plan_key'                       => null,
                    'plan_interval'                  => null,
                    'planTitle'                      => $planData['title'],
                    'planPrice'                      => $planData['price'],
                    'long_expiry'                    => false,
                ];
            }

            if (!empty($userSubscriptionData) && $userSubscription->expiry_at > Carbon::now()->addYears(10)) {
                $userSubscriptionData['is_long_expiry'] = true;
            }
        }

        return $this->engineReaction(1, [
            'premiumPlanData' => [
                'isPremiumUser' => isPremiumUser(),
                'userSubscriptionData' => $userSubscriptionData,
                'premiumPlans' => $premiumPlanData,
                'premiumFeature' => $premiumFeatureData,
            ],
        ]);
    }

    /**
     * Get or create a Stripe customer for the given user.
     */
    public function getOrCreateStripeCustomer($user): string
    {
        StripeClient::setApiKey(config('services.stripe.secret'));

        if ($user->stripe_customer_id) {
            return $user->stripe_customer_id;
        }

        $customer = \Stripe\Customer::create([
            'email'    => $user->email,
            'name'     => trim($user->first_name . ' ' . $user->last_name),
            'metadata' => ['user_id' => $user->_id],
        ]);

        $user->stripe_customer_id = $customer->id;
        $user->save();

        return $customer->id;
    }

    /**
     * Initiate Stripe Checkout session for a new subscription.
     */
    public function processStripeCheckout($planKey, $interval)
    {
        StripeClient::setApiKey(config('services.stripe.secret'));

        $user = auth()->user();
        $plan = Plan::active()->where('key', $planKey)->where('interval', $interval)->first();

        if (!$plan || !$plan->stripe_price_id) {
            return $this->engineReaction(2, ['show_message' => true], __tr('Plan not available.'));
        }

        // If user already has an active Stripe subscription — change plan instead
        $activeSub = $this->userRepository->fetchUserSubscription();
        if ($activeSub && !empty($activeSub->stripe_subscription_id)) {
            return $this->processChangePlan($activeSub, $plan);
        }

        $customerId = $this->getOrCreateStripeCustomer($user);

        $session = \Stripe\Checkout\Session::create([
            'customer'             => $customerId,
            'payment_method_types' => ['card'],
            'mode'                 => 'subscription',
            'line_items'           => [['price' => $plan->stripe_price_id, 'quantity' => 1]],
            'success_url'          => route('user.premium_plan.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => route('user.premium_plan.read.select_plan'),
            'metadata'             => [
                'user_id' => $user->_id,
                'plan_id' => $plan->_id,
            ],
        ]);

        return $this->engineReaction(1, ['checkout_url' => $session->url]);
    }

    /**
     * Upgrade (immediate + proration) or downgrade (scheduled at renewal).
     */
    public function processChangePlan($activeSub, $newPlan)
    {
        StripeClient::setApiKey(config('services.stripe.secret'));

        $isUpgrade = $newPlan->price > (float) $activeSub->plan_price;
        $stripeSub = \Stripe\Subscription::retrieve($activeSub->stripe_subscription_id);

        if ($isUpgrade) {
            $updatedSub = \Stripe\Subscription::update($activeSub->stripe_subscription_id, [
                'items' => [[
                    'id'    => $stripeSub->items->data[0]->id,
                    'price' => $newPlan->stripe_price_id,
                ]],
                'proration_behavior' => 'always_invoice',
                'expand'             => ['latest_invoice'],
            ]);

            \DB::table('user_subscriptions')->where('_id', $activeSub->_id)->update([
                'plan_key'        => $newPlan->key,
                'plan_interval'   => $newPlan->interval,
                'plan_price'      => $newPlan->price,
                'stripe_price_id' => $newPlan->stripe_price_id,
                'expiry_at'       => Carbon::createFromTimestamp($this->getSubPeriodEnd($updatedSub)),
                'pending_plan_id' => null,
                'updated_at'      => now(),
            ]);

            return $this->engineReaction(1, ['show_message' => true], __tr('Plan upgraded successfully.'));
        }

        // Downgrade — schedule for next renewal
        \DB::table('user_subscriptions')->where('_id', $activeSub->_id)->update([
            'pending_plan_id' => $newPlan->_id,
            'updated_at'      => now(),
        ]);

        return $this->engineReaction(1, ['show_message' => true],
            __tr('Plan will change to ') . $newPlan->name . __tr(' at next renewal.'));
    }

    /**
     * Cancel subscription at period end (user retains access until expiry).
     */
    public function processCancelSubscription()
    {
        StripeClient::setApiKey(config('services.stripe.secret'));

        $activeSub = $this->userRepository->fetchUserSubscription();

        if (!$activeSub || empty($activeSub->stripe_subscription_id)) {
            return $this->engineReaction(2, ['show_message' => true], __tr('No active subscription found.'));
        }

        \Stripe\Subscription::update($activeSub->stripe_subscription_id, [
            'cancel_at_period_end' => true,
        ]);

        \DB::table('user_subscriptions')->where('_id', $activeSub->_id)->update([
            'cancel_at_period_end' => true,
            'canceled_at'          => now(),
            'updated_at'           => now(),
        ]);

        return $this->engineReaction(1, ['show_message' => true],
            __tr('Subscription cancelled. You have access until ') . formatDate($activeSub->expiry_at, 'd M Y') . '.');
    }

    /**
     * Resume a cancelled subscription (still within the billing period).
     */
    public function processResumeSubscription()
    {
        StripeClient::setApiKey(config('services.stripe.secret'));

        $activeSub = $this->userRepository->fetchUserSubscription();

        if (!$activeSub || empty($activeSub->stripe_subscription_id)) {
            return $this->engineReaction(2, ['show_message' => true], __tr('No subscription found.'));
        }

        \Stripe\Subscription::update($activeSub->stripe_subscription_id, [
            'cancel_at_period_end' => false,
        ]);

        \DB::table('user_subscriptions')->where('_id', $activeSub->_id)->update([
            'cancel_at_period_end' => false,
            'canceled_at'          => null,
            'updated_at'           => now(),
        ]);

        return $this->engineReaction(1, ['show_message' => true], __tr('Subscription resumed.'));
    }

    /**
     * Prepare subscription data for the membership settings page.
     */
    public function prepareSubscriptionData()
    {
        $sub  = $this->userRepository->fetchUserSubscription();
        $user = auth()->user();

        $subscriptionData = null;
        if ($sub && $sub->plan_key) {
            $subscriptionData = [
                'planName'              => ucfirst($sub->plan_key),
                'planInterval'          => $sub->plan_interval,
                'planPrice'             => $sub->plan_price,
                'expiryAt'              => $sub->expiry_at
                                            ? formatDate($sub->expiry_at, 'd M Y')
                                            : null,
                'cancelAtPeriodEnd'     => (bool) ($sub->cancel_at_period_end ?? false),
                'hasStripeSubscription' => !empty($sub->stripe_subscription_id),
            ];
        }

        return $this->engineReaction(1, [
            'isPremiumUser'     => isPremiumUser(),
            'subscription'      => $subscriptionData,
            'hasStripeCustomer' => (bool) $user->stripe_customer_id,
        ]);
    }

    /**
     * Open Stripe Customer Portal for card/billing management.
     */
    public function processCustomerPortal()
    {
        StripeClient::setApiKey(config('services.stripe.secret'));

        $user = auth()->user();

        if (!$user->stripe_customer_id) {
            return $this->engineReaction(2, ['show_message' => true], __tr('No billing account found.'));
        }

        $session = \Stripe\BillingPortal\Session::create([
            'customer'   => $user->stripe_customer_id,
            'return_url' => route('user.settings.membership'),
        ]);

        return $this->engineReaction(1, ['portal_url' => $session->url]);
    }

    /**
     * Fetch invoices for the logged-in user directly from Stripe.
     */
    public function prepareStripeInvoices()
    {
        StripeClient::setApiKey(config('services.stripe.secret'));

        $user = auth()->user();

        if (!$user->stripe_customer_id) {
            return $this->engineReaction(1, ['invoices' => []]);
        }

        $stripeInvoices = \Stripe\Invoice::all([
            'customer' => $user->stripe_customer_id,
            'limit'    => 24,
        ]);

        $invoices = collect($stripeInvoices->data)->map(function ($inv) {
            return [
                'id'          => $inv->id,
                'number'      => $inv->number,
                'amount'      => number_format($inv->amount_paid / 100, 2),
                'currency'    => strtoupper($inv->currency),
                'status'      => $inv->status,
                'date'        => Carbon::createFromTimestamp($inv->created)->format('d M Y'),
                'pdf_url'     => $inv->invoice_pdf,
                'hosted_url'  => $inv->hosted_invoice_url,
            ];
        })->toArray();

        return $this->engineReaction(1, ['invoices' => $invoices]);
    }

    /**
     * Process buy user premium plan.
     *
     *-----------------------------------------------------------------------*/
    public function processBuyPremiumPlan($inputData)
    {
        //buy premium plan request
        $buyPremiumPlanRequest = $this->userRepository->processTransaction(function () use ($inputData) {
            $premiumPlanCollection = getStoreSettings('plan_duration');
            //if user already a premium user then throw error
            $isPremiumUser = isPremiumUser(null, true);
            // if (!__isEmpty($isPremiumUser)) {
                // return $this->userRepository->transactionResponse(2, ['show_message' => true], __tr('You are already Premium user'));
            // }

            // check if user premium plan exists
            if (! __isEmpty($inputData['select_plan'])) {
                $premiumPlans = is_array($premiumPlanCollection) ? $premiumPlanCollection : json_decode($premiumPlanCollection, true);
                $selectedPlan = $premiumPlans[$inputData['select_plan']];
                //check if plan exist
                if (! __isEmpty($selectedPlan)) {
                    //fetch user credits data
                    $totalUserCredits = totalUserCredits();

                    //if premium plan credit price greater then total user credits then show error message
                    if ($selectedPlan['price'] > $totalUserCredits) {
                        return $this->userRepository->transactionResponse(2, ['show_message' => true], __tr('Your credit balance is too low, please purchase credits.'));
                    }

                    $expiryTime = null;
                    $messageForSuccess = __tr('You are now Premium User');
                    if (!__isEmpty($isPremiumUser)) {
                        $currentDateTime = Carbon::parse($isPremiumUser->expiry_at);
                        if($isPremiumUser->expiry_at > Carbon::now()->addYears(10)) {
                            return $this->userRepository->transactionResponse(2, ['show_message' => true], __tr('your premium user expiry is long enough'));
                        }
                        $messageForSuccess = __tr('Premium plan expiry has been extended');
                    } else {
                        $currentDateTime = Carbon::now();
                    }
                    // get expiry time on current selected plan
                    switch ($inputData['select_plan']) {
                        case 'one_day':
                            $expiryTime = $currentDateTime->addDay();
                            break;
                        case 'one_week':
                            $expiryTime = $currentDateTime->addWeek();
                            break;
                        case 'one_month':
                            $expiryTime = $currentDateTime->addMonth();
                            break;
                        case 'half_year':
                            $expiryTime = $currentDateTime->addMonths(6);
                            break;
                        case 'year':
                            $expiryTime = $currentDateTime->addYear();
                            break;
                        case 'life_time':
                            $expiryTime = $currentDateTime->addYears(100);
                            break;
                    }

                    //credit wallet store data
                    $creditWalletStoreData = [
                        'status' => 1,
                        'users__id' => getUserID(),
                        'credits' => '-'.''.$selectedPlan['price'],
                    ];

                    //store credit wallet data and user subscription data
                    if ($creditWalledId = $this->userRepository->storeCreditWalletTransaction($creditWalletStoreData)) {
                        //user subscription store data
                        $storeSubscriptionData = [
                            'status' => 1,
                            'users__id' => getUserID(),
                            'expiry_at' => $expiryTime,
                            'plan_id' => $inputData['select_plan'],
                            'credit_wallet_transactions__id' => $creditWalledId,
                        ];
                        //store user subscription data
                        if ($this->userRepository->storeUserSubscription($storeSubscriptionData)) {
                            return $this->userRepository->transactionResponse(1, ['show_message' => true], $messageForSuccess);
                        }
                    }
                    //error response
                    return $this->userRepository->transactionResponse(1, ['show_message' => true], __tr('Something went wrong, please contact to administrator.'));
                } else {
                    //error response
                    return $this->userRepository->transactionResponse(2, ['show_message' => true], __tr('Selected plan not exists.'));
                }
            } else {
                //error response
                return $this->userRepository->transactionResponse(2, ['show_message' => true], __tr('Please select plan first.'));
            }
        });

        //response
        return $this->engineReaction($buyPremiumPlanRequest);
    }

    /**
     * Read current_period_end from a Stripe Subscription object.
     * Some SDK versions expose it on the item rather than the subscription root.
     */
    private function getSubPeriodEnd(\Stripe\Subscription $sub): int
    {
        // Try subscription root first, then fall back to first item
        $ts = $sub->current_period_end
            ?? ($sub->items->data[0]->current_period_end ?? null);

        return (int) $ts;
    }
}
