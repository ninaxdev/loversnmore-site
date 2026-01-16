<?php
/**
* WaitlistRepositoryBlueprint.php - Interface file
*
* This file is part of the Waitlist component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Waitlist\Blueprints;

interface WaitlistRepositoryBlueprint
{
    /**
     * Store new waitlist signup
     *
     * @param array $inputData
     * @return mixed
     */
    public function storeSignup($inputData);

    /**
     * Fetch signup by email
     *
     * @param string $email
     * @return mixed
     */
    public function fetchByEmail($email);

    /**
     * Fetch signup by ID or UID
     *
     * @param mixed $idOrUid
     * @return mixed
     */
    public function fetchById($idOrUid);
}
