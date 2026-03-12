<?php

namespace App\Services;

use App\Yantrana\Components\User\Models\User;
use App\Yantrana\Components\User\Repositories\UserRepository;

class GiftValidationService
{
    protected $userRepository;
    protected $rateLimitService;

    public function __construct(UserRepository $userRepository, GiftRateLimitService $rateLimitService)
    {
        $this->userRepository = $userRepository;
        $this->rateLimitService = $rateLimitService;
    }

    /**
     * Validate if user has accepted the gift agreement
     *
     * @param int $userId
     * @return bool
     */
    public function validateGiftAgreement($userId)
    {
        return $this->userRepository->hasAcceptedGiftAgreement($userId);
    }

    /**
     * Validate block status between sender and recipient
     *
     * @param int $senderId
     * @param int $recipientId
     * @return bool
     */
    public function validateBlockStatus($senderId, $recipientId)
    {
        // Check if either user has blocked the other
        $isBlocked = \DB::table('user_block_users')
            ->where(function ($query) use ($senderId, $recipientId) {
                $query->where('by_users__id', $senderId)
                    ->where('to_users__id', $recipientId);
            })
            ->orWhere(function ($query) use ($senderId, $recipientId) {
                $query->where('by_users__id', $recipientId)
                    ->where('to_users__id', $senderId);
            })
            ->exists();

        return !$isBlocked; // Return true if NOT blocked
    }

    /**
     * Validate recipient's gift preferences
     *
     * @param int $recipientId
     * @param int $senderId
     * @return array
     */
    public function validateRecipientPreferences($recipientId, $senderId)
    {
        $recipient = User::find($recipientId);

        if (!$recipient) {
            return [
                'valid' => false,
                'message' => 'User not found.'
            ];
        }

        // Check if users are matched
        $areMatched = $this->rateLimitService->areUsersMatched($senderId, $recipientId);

        // Get recipient's settings using global helper function
        $receiveFromNonMatches = getUserSettings('receive_gifts_from_non_matches', $recipientId);
        $maxGiftsPerDay = getUserSettings('max_gifts_per_day', $recipientId);

        // Default to true if setting doesn't exist (allow gifts from non-matches by default)
        $receiveFromNonMatches = $receiveFromNonMatches ?? true;

        // If not matched and recipient doesn't accept gifts from non-matches
        if (!$areMatched && !$receiveFromNonMatches) {
            return [
                'valid' => false,
                'message' => 'This user only accepts gifts from matches.'
            ];
        }

        // Check if recipient has reached their daily limit
        if ($maxGiftsPerDay !== null) {
            $giftsReceivedToday = \DB::table('user_gifts')
                ->where('to_users__id', $recipientId)
                ->whereDate('created_at', today())
                ->count();

            if ($giftsReceivedToday >= $maxGiftsPerDay) {
                return [
                    'valid' => false,
                    'message' => 'This user has reached their daily gift limit.'
                ];
            }
        }

        return ['valid' => true];
    }

    /**
     * Validate rate limits for sender
     *
     * @param int $senderId
     * @param int $recipientId
     * @return array
     */
    public function validateRateLimits($senderId, $recipientId)
    {
        $canSend = $this->rateLimitService->canSendToRecipient($senderId, $recipientId);

        if (!$canSend['can_send']) {
            return [
                'valid' => false,
                'message' => $canSend['message']
            ];
        }

        return ['valid' => true];
    }

    /**
     * Validate all gift sending requirements
     *
     * @param int $senderId
     * @param int $recipientId
     * @param string|null $giftTitle
     * @return array
     */
    public function validateAll($senderId, $recipientId, $giftTitle = null)
    {
        // 1. Check gift agreement
        if (!$this->validateGiftAgreement($senderId)) {
            return [
                'valid' => false,
                'message' => 'Please accept the gift agreement first.',
                'code' => 'AGREEMENT_REQUIRED'
            ];
        }

        // 2. Check block status
        if (!$this->validateBlockStatus($senderId, $recipientId)) {
            return [
                'valid' => false,
                'message' => 'Unable to send gift to this user.',
                'code' => 'BLOCKED'
            ];
        }

        // 3. Check recipient preferences
        $recipientValidation = $this->validateRecipientPreferences($recipientId, $senderId);
        if (!$recipientValidation['valid']) {
            return [
                'valid' => false,
                'message' => $recipientValidation['message'],
                'code' => 'RECIPIENT_PREFERENCE'
            ];
        }

        // 4. Check rate limits
        $rateLimitValidation = $this->validateRateLimits($senderId, $recipientId);
        if (!$rateLimitValidation['valid']) {
            return [
                'valid' => false,
                'message' => $rateLimitValidation['message'],
                'code' => 'RATE_LIMIT'
            ];
        }

        // 5. Check surprise gift limit (if applicable)
        if ($giftTitle) {
            $surpriseValidation = $this->rateLimitService->canSendSurpriseGift($senderId, $giftTitle);
            if (!$surpriseValidation['can_send']) {
                return [
                    'valid' => false,
                    'message' => $surpriseValidation['message'],
                    'code' => $surpriseValidation['code']
                ];
            }
        }

        return ['valid' => true];
    }
}
