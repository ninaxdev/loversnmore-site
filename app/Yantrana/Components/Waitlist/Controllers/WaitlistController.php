<?php

/**
 * WaitlistController.php - Controller file
 *
 * This file is part of the Waitlist component.
 *-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Waitlist\Controllers;

use Illuminate\Http\Request;
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
     *
     * @param WaitlistEngine $waitlistEngine - Waitlist Engine
     *-----------------------------------------------------------------------*/
    public function __construct(WaitlistEngine $waitlistEngine)
    {
        $this->waitlistEngine = $waitlistEngine;
    }

    /**
     * Show landing page.
     *
     * @return view
     *---------------------------------------------------------------- */
    public function showLandingPage()
    {
        return $this->loadView('waitlist.landing');
    }

    /**
     * Process waitlist signup.
     *
     * @param WaitlistSignupRequest $request
     * @return redirect
     *---------------------------------------------------------------- */
    public function processSignup(WaitlistSignupRequest $request)
    {
        $processReaction = $this->waitlistEngine->processSignup($request);

        // Check reaction code
        if ($processReaction['reaction_code'] === 1) {
            // Success - redirect back with success message
            return redirect()->route('waitlist.landing')
                ->with('success', $processReaction['data']['message']);
        } else {
            // Error - redirect back with error message
            return redirect()->route('waitlist.landing')
                ->withErrors([$processReaction['data']['message']])
                ->withInput();
        }
    }
}
