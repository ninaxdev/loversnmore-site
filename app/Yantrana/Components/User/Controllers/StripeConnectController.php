<?php

/**
 * StripeConnectController.php - Controller file
 *
 * This file is part of the User component for Stripe Connect functionality.
 *-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\User\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Yantrana\Base\BaseController;
use App\Yantrana\Components\User\StripeConnectEngine;

class StripeConnectController extends BaseController
{
    /**
     * @var StripeConnectEngine - Stripe Connect Engine
     */
    protected $stripeConnectEngine;

    /**
     * Constructor.
     *
     * @param  StripeConnectEngine  $stripeConnectEngine - Stripe Connect Engine
     *-----------------------------------------------------------------------*/
    public function __construct(StripeConnectEngine $stripeConnectEngine)
    {
        $this->stripeConnectEngine = $stripeConnectEngine;
    }

    /**
     * Show Stripe Connect onboarding page
     *
     * @return view
     *---------------------------------------------------------------- */
    public function showOnboarding()
    {
        return $this->loadPublicView('user.stripe-connect.onboarding');
    }

    /**
     * Start Stripe Connect onboarding process
     *
     * @param Request $request
     * @return json object
     *---------------------------------------------------------------- */
    public function startOnboarding(Request $request)
    {
        $processReaction = $this->stripeConnectEngine->processOnboarding();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Handle return from Stripe onboarding
     *
     * @param Request $request
     * @return view
     *---------------------------------------------------------------- */
    public function onboardingReturn(Request $request)
    {
        $processReaction = $this->stripeConnectEngine->handleOnboardingReturn();

        // Redirect to earnings dashboard
        return redirect()->route('user.stripe_connect.earnings')
            ->with([
                'success' => $processReaction['reaction_code'] === 1,
                'message' => $processReaction['message'] ?? '',
            ]);
    }

    /**
     * Handle refresh from Stripe onboarding (when link expires)
     *
     * @param Request $request
     * @return redirect
     *---------------------------------------------------------------- */
    public function onboardingRefresh(Request $request)
    {
        $processReaction = $this->stripeConnectEngine->processOnboarding();

        if ($processReaction['reaction_code'] === 1) {
            return redirect($processReaction['data']['onboarding_url']);
        }

        return redirect()->route('user.stripe_connect.onboarding')
            ->with('error', $processReaction['message']);
    }

    /**
     * Show earnings dashboard
     *
     * @return view
     *---------------------------------------------------------------- */
    public function showEarnings()
    {
        $user = Auth::user();

        // If user hasn't completed onboarding, redirect to onboarding page
        if (!$user || !$user->stripe_onboarding_completed) {
            return redirect()->route('user.stripe_connect.onboarding');
        }

        return $this->loadPublicView('user.stripe-connect.earnings');
    }

    /**
     * Get earnings data
     *
     * @param Request $request
     * @return json object
     *---------------------------------------------------------------- */
    public function getEarningsData(Request $request)
    {
        $processReaction = $this->stripeConnectEngine->getEarningsData();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Get Stripe Connect account status
     *
     * @param Request $request
     * @return json object
     *---------------------------------------------------------------- */
    public function getAccountStatus(Request $request)
    {
        $processReaction = $this->stripeConnectEngine->getConnectAccountStatus();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Create Stripe Express Dashboard login link
     *
     * @param Request $request
     * @return json object
     *---------------------------------------------------------------- */
    public function getDashboardLink(Request $request)
    {
        $processReaction = $this->stripeConnectEngine->generateDashboardLink();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Show settings page for Stripe Connect
     *
     * @return view
     *---------------------------------------------------------------- */
    public function showSettings()
    {
        return $this->loadPublicView('user.stripe-connect.settings');
    }
}
