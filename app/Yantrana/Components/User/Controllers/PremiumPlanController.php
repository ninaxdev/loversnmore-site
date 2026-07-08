<?php
/**
* PremiumPlanController.php - Controller file
*
* This file is part of the Premium Plan User component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\User\Controllers;

use App\Yantrana\Base\BaseController;
use App\Yantrana\Components\User\PremiumPlanEngine;
use App\Yantrana\Support\CommonUnsecuredPostRequest;

// form Requests

class PremiumPlanController extends BaseController
{
    /**
     * @var  PremiumPlanEngine - PremiumPlan Engine
     */
    protected $premiumPlanEngine;

    /**
     * Constructor
     *
     * @param  PremiumPlanEngine  $premiumPlanEngine - PremiumPlan Engine
     * @return  void
     *-----------------------------------------------------------------------*/
    public function __construct(PremiumPlanEngine $premiumPlanEngine)
    {
        $this->premiumPlanEngine = $premiumPlanEngine;
    }

    /**
     * User Premium Plan View.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getPremiumPlanView()
    {
        $processReaction = $this->premiumPlanEngine->preparePremiumPlanUserData();

        return $this->loadPublicView('user.premium-plan.premium', $processReaction['data']);
    }

    /**
     * Handle buy premium plan by user request.
     *
     * @param object CommonUnsecuredPostRequest $request
     * @param  string  $reminderToken
     * @return json object
     *---------------------------------------------------------------- */
    public function buyPremiumPlans(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->premiumPlanEngine->processBuyPremiumPlan($request->all());

        //if reaction code is 1 then redirect to success page
        if ($processReaction['reaction_code'] == 1) {
            return $this->responseAction(
                $this->processResponse($processReaction, [], [], true),
                $this->redirectTo('user.premium_plan.read.success_view')
            );
        }

        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }

    /**
     * User Premium Plan Selection View.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getPremiumPlanSelectionView()
    {
        $processReaction = $this->premiumPlanEngine->preparePremiumPlanUserData();

        return $this->loadPublicView('user.premium-plan.premium-plan-select', $processReaction['data']);
    }

    /**
     * User Premium Plan Success View.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getPremiumPlanSuccessView()
    {
        return $this->loadPublicView('user.premium-plan.premium-plan-success');
    }

    // ─────────────────────────────────────────────────────────────
    // Stripe Checkout & Subscription Management
    // ─────────────────────────────────────────────────────────────

    public function checkout(\Illuminate\Http\Request $request)
    {
        $processReaction = $this->premiumPlanEngine->processStripeCheckout(
            $request->input('plan_key'),
            $request->input('interval')
        );

        if ($processReaction['reaction_code'] == 1 && isset($processReaction['data']['checkout_url'])) {
            return redirect($processReaction['data']['checkout_url']);
        }

        // Upgrade/downgrade handled inline — redirect to membership page
        if ($processReaction['reaction_code'] == 1) {
            return redirect()->route('user.settings.membership')
                ->with('success', $processReaction['message']);
        }

        return back()->with('error', $processReaction['message']);
    }

    public function checkoutSuccess(\Illuminate\Http\Request $request)
    {
        return $this->loadPublicView('user.premium-plan.premium-plan-success');
    }

    public function cancelSubscription()
    {
        $processReaction = $this->premiumPlanEngine->processCancelSubscription();
        $key = $processReaction['reaction_code'] == 1 ? 'success' : 'error';
        return redirect()->route('user.settings.membership')->with($key, $processReaction['message']);
    }

    public function resumeSubscription()
    {
        $processReaction = $this->premiumPlanEngine->processResumeSubscription();
        $key = $processReaction['reaction_code'] == 1 ? 'success' : 'error';
        return redirect()->route('user.settings.membership')->with($key, $processReaction['message']);
    }

    public function customerPortal()
    {
        $processReaction = $this->premiumPlanEngine->processCustomerPortal();
        if ($processReaction['reaction_code'] == 1 && isset($processReaction['data']['portal_url'])) {
            return redirect($processReaction['data']['portal_url']);
        }
        return back()->with('error', $processReaction['message']);
    }

    public function getInvoicesView()
    {
        $processReaction = $this->premiumPlanEngine->prepareStripeInvoices();
        return $this->loadPublicView('user.premium-plan.invoices', $processReaction['data']);
    }
}
