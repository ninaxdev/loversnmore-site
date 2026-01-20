<?php

/**
 * WaitlistEngine.php - Main component file
 *
 * This file is part of the Waitlist component.
 *-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Waitlist;

use App\Yantrana\Base\BaseEngine;
use App\Yantrana\Base\BaseMailer;
use App\Yantrana\Components\Waitlist\Repositories\WaitlistRepository;

class WaitlistEngine extends BaseEngine
{
    /**
     * @var WaitlistRepository - Waitlist Repository
     */
    protected $waitlistRepository;

    /**
     * @var BaseMailer - Base Mailer
     */
    protected $baseMailer;

    /**
     * Constructor.
     *
     * @param WaitlistRepository $waitlistRepository - Waitlist Repository
     * @param BaseMailer $baseMailer - Base Mailer
     *-----------------------------------------------------------------------*/
    public function __construct(
        WaitlistRepository $waitlistRepository,
        BaseMailer $baseMailer
    ) {
        $this->waitlistRepository = $waitlistRepository;
        $this->baseMailer = $baseMailer;
    }

    /**
     * Process waitlist signup
     *
     * @param Request $request
     * @return array
     *---------------------------------------------------------------- */
    public function processSignup($request)
    {
        $email = $request->input('email');
        $city = $request->input('city', '');
        $fullName = $request->input('full_name', '');

        // Check if email already exists in waitlist
        if ($this->waitlistRepository->fetchByEmail($email)) {
            return $this->engineReaction(2, [
                'message' => __tr('This email is already on the waitlist.')
            ]);
        }

        // Check if email already exists in users table
        $userExists = \DB::table('users')->where('email', $email)->exists();
        if ($userExists) {
            return $this->engineReaction(2, [
                'message' => __tr('This email is already registered.')
            ]);
        }

        // Prepare signup data
        $signupData = [
            'full_name' => $fullName,
            'email' => $email,
            'city' => $city,
            'interest' => [], // Will be added when we have interest checkboxes
        ];

        // Store the signup
        $signup = $this->waitlistRepository->storeSignup($signupData);

        if (!$signup) {
            return $this->engineReaction(2, [
                'message' => __tr('Failed to join waitlist. Please try again.')
            ]);
        }

        // Send admin notification email
        $this->sendAdminNotification($signup);

        return $this->engineReaction(1, [
            'message' => __tr('Successfully joined the waitlist! We will notify you when we launch.'),
            'signup' => $signup
        ]);
    }

    /**
     * Send admin notification about new signup
     *
     * @param WaitlistSignup $signup
     * @return void
     *---------------------------------------------------------------- */
    protected function sendAdminNotification($signup)
    {
        try {
            $adminEmail = getStoreSettings('contact_email') ?: config('mail.from.address');

            if ($adminEmail) {
                $this->baseMailer->notifyAdmin(
                    'waitlist.new-signup-admin',
                    [
                        'fullName' => $signup->full_name,
                        'email' => $signup->email,
                        'city' => $signup->city,
                        'priorityScore' => $signup->priority_score,
                        'signupDate' => $signup->created_at->format('M d, Y H:i'),
                    ],
                    __tr('New Beta Waitlist Signup'),
                    $adminEmail
                );
            }
        } catch (\Exception $e) {
            // Log error but don't fail the signup
            \Log::error('Failed to send admin notification for waitlist signup: ' . $e->getMessage());
        }
    }

    /**
     * Get waitlist statistics
     *
     * @return array
     *---------------------------------------------------------------- */
    public function getStatistics()
    {
        return $this->waitlistRepository->getStatistics();
    }
}
