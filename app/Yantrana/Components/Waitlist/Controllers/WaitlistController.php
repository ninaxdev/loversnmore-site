<?php

/**
 * WaitlistController.php - Controller file
 *
 * This file is part of the Waitlist component.
 *-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Waitlist\Controllers;

use App\Yantrana\Base\BaseController;
use App\Yantrana\Components\Waitlist\WaitlistEngine;
use App\Yantrana\Components\Waitlist\Requests\WaitlistSignupRequest;

class WaitlistController extends BaseController
{
    /**
     * @var WaitlistEngine - Waitlist Engine
     */
    protected $waitlistEngine;

    /**
     * Constructor.
     *-----------------------------------------------------------------------*/
    public function __construct(WaitlistEngine $waitlistEngine)
    {
        $this->waitlistEngine = $waitlistEngine;
    }

    /**
     * Show landing page.
     *---------------------------------------------------------------- */
    public function showLandingPage()
    {
        return $this->loadView('waitlist.landing');
    }

    /**
     * Show success page after signup.
     *---------------------------------------------------------------- */
    public function showSuccessPage()
    {
        // If user hits /beta/success directly without a signup, redirect to landing
        if (!session()->has('waitlist_signup_email')) {
            return redirect()->route('waitlist.landing');
        }

        return $this->loadView('waitlist.success', [
            'signupEmail'     => session('waitlist_signup_email'),
            'signupFirstName' => session('waitlist_signup_first_name'),
        ]);
    }

    /**
     * Process waitlist signup.
     *---------------------------------------------------------------- */
    public function processSignup(WaitlistSignupRequest $request)
    {
        $processReaction = $this->waitlistEngine->processSignup($request);

        if ($processReaction['reaction_code'] === 1) {
            return redirect()
                ->route('waitlist.success')
                ->with('waitlist_signup_email',      $request->input('email'))
                ->with('waitlist_signup_first_name', $request->input('first_name', ''));
        }

        return redirect()
            ->route('waitlist.landing')
            ->withErrors([$processReaction['data']['message']])
            ->withInput()
            ->withFragment('waitlist');
    }
}
