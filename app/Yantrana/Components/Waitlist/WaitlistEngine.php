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
     * Accepts fields from Nina's landing form:
     *   first_name, email, city
     *
     * Also accepts legacy `full_name` for backwards compatibility.
     *
     * @param  Request  $request
     * @return array
     *---------------------------------------------------------------- */
    public function processSignup($request)
    {
        $email     = trim(strtolower($request->input('email')));
        $firstName = trim($request->input('first_name', $request->input('full_name', '')));
        $city      = trim($request->input('city', ''));

        // Check if email already exists in waitlist
        if ($this->waitlistRepository->fetchByEmail($email)) {
            return $this->engineReaction(2, [
                'message' => __tr('This email is already on the waitlist.'),
            ]);
        }

        // Check if email already registered as a user
        if (\DB::table('users')->where('email', $email)->exists()) {
            return $this->engineReaction(2, [
                'message' => __tr('This email is already registered.'),
            ]);
        }

        // Prepare and store the signup
        $signupData = [
            'full_name' => $firstName,
            'email'     => $email,
            'city'      => $city,
            'interest'  => [],
        ];

        $signup = $this->waitlistRepository->storeSignup($signupData);

        if (!$signup) {
            return $this->engineReaction(2, [
                'message' => __tr('Failed to join waitlist. Please try again.'),
            ]);
        }

        // Fire off both emails (failures logged but do not block success)
        $this->sendUserConfirmation($signup);
        $this->sendAdminNotification($signup);

        return $this->engineReaction(1, [
            'message' => __tr("You're on the list! Check your inbox for a confirmation email."),
            'signup'  => $signup,
        ]);
    }

    /**
     * Send confirmation email to the person who just signed up
     *
     * @param  \App\Yantrana\Components\Waitlist\Models\WaitlistSignup  $signup
     * @return void
     *---------------------------------------------------------------- */
    protected function sendUserConfirmation($signup)
    {
        try {
            $this->baseMailer->notifyToUser(
                "You're on the LoversNmore waitlist!",
                'waitlist.signup-confirmation',
                [
                    'firstName' => $signup->full_name ?: 'there',
                    'city'      => $signup->city,
                    'name'      => $signup->full_name ?: $signup->email,
                ],
                $signup->email
            );
        } catch (\Exception $e) {
            \Log::error('Waitlist confirmation email failed: ' . $e->getMessage(), [
                'signup_id' => $signup->_id ?? null,
                'email'     => $signup->email,
            ]);
        }
    }

    /**
     * Send admin notification about new signup.
     *
     * Recipient resolution:
     *   1. .env WAITLIST_ADMIN_EMAIL (via config/mail.php) — preferred, easy to change
     *   2. Falls back to admin store setting `business_email` if env is unset
     *   3. If neither is configured, the notification is skipped (with a log entry).
     *
     * @param  \App\Yantrana\Components\Waitlist\Models\WaitlistSignup  $signup
     * @return void
     *---------------------------------------------------------------- */
    protected function sendAdminNotification($signup)
    {
        $adminEmail = config('mail.waitlist_admin_email') ?: getStoreSettings('business_email');

        if (empty($adminEmail)) {
            \Log::warning('Waitlist admin notification skipped: no recipient configured', [
                'signup_id' => $signup->_id ?? null,
            ]);
            return;
        }

        try {
            // Use notifyToUser to send to an explicit recipient (functionally identical
            // to notifyAdmin — both render through emails.index — but lets us route to
            // an env-configured address instead of the DB store setting).
            $this->baseMailer->notifyToUser(
                __tr('New Beta Waitlist Signup'),
                'waitlist.new-signup-admin',
                [
                    'fullName'      => $signup->full_name,
                    'email'         => $signup->email,
                    'city'          => $signup->city,
                    'priorityScore' => $signup->priority_score,
                    'signupDate'    => optional($signup->created_at)->format('M d, Y H:i'),
                    'name'          => 'Admin',
                ],
                $adminEmail
            );
        } catch (\Exception $e) {
            \Log::error('Waitlist admin notification failed: ' . $e->getMessage(), [
                'signup_id' => $signup->_id ?? null,
                'recipient' => $adminEmail,
            ]);
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
