<?php
/**
* WaitlistRepository.php - Repository file
*
* This file is part of the Waitlist component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Waitlist\Repositories;

use App\Yantrana\Base\BaseRepository;
use App\Yantrana\Components\Waitlist\Blueprints\WaitlistRepositoryBlueprint;
use App\Yantrana\Components\Waitlist\Models\WaitlistSignup;

class WaitlistRepository extends BaseRepository implements WaitlistRepositoryBlueprint
{
    /**
     * Constructor.
     *-----------------------------------------------------------------------*/
    public function __construct()
    {
    }

    /**
     * Store new waitlist signup
     *
     * @param array $inputData
     * @return mixed
     *---------------------------------------------------------------- */
    public function storeSignup($inputData)
    {
        // Get the maximum priority score and increment
        $maxPriorityScore = WaitlistSignup::max('priority_score') ?? 0;

        $waitlistSignup = new WaitlistSignup;

        $keyValues = [
            'full_name',
            'email',
            'city',
            'interest',
        ];

        // Add default values
        $inputData['status'] = WaitlistSignup::STATUS_PENDING;
        $inputData['priority_score'] = $maxPriorityScore + 1;

        // Store new signup
        if ($waitlistSignup->assignInputsAndSave($inputData, $keyValues)) {
            activityLog('New waitlist signup: ' . $inputData['email']);
            return $waitlistSignup;
        }

        return false;
    }

    /**
     * Fetch signup by email
     *
     * @param string $email
     * @return mixed
     *---------------------------------------------------------------- */
    public function fetchByEmail($email)
    {
        return WaitlistSignup::where('email', $email)->first();
    }

    /**
     * Fetch signup by ID or UID
     *
     * @param mixed $idOrUid
     * @return mixed
     *---------------------------------------------------------------- */
    public function fetchById($idOrUid)
    {
        if (is_numeric($idOrUid)) {
            return WaitlistSignup::where('_id', $idOrUid)->first();
        } else {
            return WaitlistSignup::where('_uid', $idOrUid)->first();
        }
    }

    /**
     * Fetch signup by invitation token
     *
     * @param string $token
     * @return mixed
     *---------------------------------------------------------------- */
    public function fetchByToken($token)
    {
        return WaitlistSignup::where('invitation_token', $token)->first();
    }

    /**
     * Get statistics count by status
     *
     * @return array
     *---------------------------------------------------------------- */
    public function getStatistics()
    {
        return [
            'pending' => WaitlistSignup::where('status', WaitlistSignup::STATUS_PENDING)->count(),
            'invited' => WaitlistSignup::where('status', WaitlistSignup::STATUS_INVITED)->count(),
            'activated' => WaitlistSignup::where('status', WaitlistSignup::STATUS_ACTIVATED)->count(),
            'total' => WaitlistSignup::count(),
        ];
    }
}
