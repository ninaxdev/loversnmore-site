<?php

namespace App\Services;

use App\Yantrana\Components\User\Repositories\UserRepository;

class GiftRateLimitService
{
    protected $userRepository;

    // Rate limit constants
    const NON_MATCH_LIMIT_24H = 3;      // 3 gifts per 24h to non-matches
    const TOTAL_DAILY_LIMIT = 10;        // 10 total gifts per day
    const SURPRISE_GIFT_LIMIT_24H = 1;   // 1 surprise gift per 24h

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Check if users are matched (mutual likes)
     *
     * @param int $userId1
     * @param int $userId2
     * @return bool
     */
    public function areUsersMatched($userId1, $userId2)
    {
        return $this->userRepository->areUsersMatched($userId1, $userId2);
    }

    /**
     * Get remaining daily gifts for a user
     *
     * @param int $senderId
     * @return int
     */
    public function getRemainingDailyGifts($senderId)
    {
        $giftsSentToday = $this->userRepository->countGiftsSentToday($senderId);
        $remaining = self::TOTAL_DAILY_LIMIT - $giftsSentToday;

        return max(0, $remaining);
    }

    /**
     * Get remaining gifts to a specific non-match recipient (24h window)
     *
     * @param int $senderId
     * @param int $recipientId
     * @return int
     */
    public function getRemainingGiftsToNonMatch($senderId, $recipientId)
    {
        $giftsSentToRecipient = $this->userRepository->countGiftsSentToRecipient($senderId, $recipientId, 24);
        $remaining = self::NON_MATCH_LIMIT_24H - $giftsSentToRecipient;

        return max(0, $remaining);
    }

    /**
     * Check if sender can send a gift to recipient
     *
     * @param int $senderId
     * @param int $recipientId
     * @return array
     */
    public function canSendToRecipient($senderId, $recipientId)
    {
        // Check total daily limit first
        $giftsSentToday = $this->userRepository->countGiftsSentToday($senderId);

        if ($giftsSentToday >= self::TOTAL_DAILY_LIMIT) {
            return [
                'can_send' => false,
                'message' => "You've reached your daily gift limit. Try again tomorrow!",
                'code' => 'DAILY_LIMIT_REACHED'
            ];
        }

        // Check if users are matched
        $areMatched = $this->areUsersMatched($senderId, $recipientId);

        // If matched, no additional limits
        if ($areMatched) {
            return [
                'can_send' => true,
                'remaining_today' => self::TOTAL_DAILY_LIMIT - $giftsSentToday,
                'is_match' => true
            ];
        }

        // For non-matches, check 24h limit to this specific recipient
        $giftsSentToRecipient = $this->userRepository->countGiftsSentToRecipient($senderId, $recipientId, 24);

        if ($giftsSentToRecipient >= self::NON_MATCH_LIMIT_24H) {
            return [
                'can_send' => false,
                'message' => "You've already sent a few thoughtful gestures today. Try again tomorrow.",
                'code' => 'NON_MATCH_LIMIT_REACHED'
            ];
        }

        return [
            'can_send' => true,
            'remaining_today' => self::TOTAL_DAILY_LIMIT - $giftsSentToday,
            'remaining_to_recipient' => self::NON_MATCH_LIMIT_24H - $giftsSentToRecipient,
            'is_match' => false
        ];
    }

    /**
     * Check if sender can send a surprise gift
     *
     * @param int $senderId
     * @param string $giftTitle
     * @return array
     */
    public function canSendSurpriseGift($senderId, $giftTitle)
    {
        // Check if the gift is a surprise gift
        if (stripos($giftTitle, 'surprise') === false) {
            return [
                'can_send' => true,
                'is_surprise' => false
            ];
        }

        // Count surprise gifts sent in last 24h
        $surpriseGiftsSent = $this->userRepository->countSurpriseGiftsSent24h($senderId);

        if ($surpriseGiftsSent >= self::SURPRISE_GIFT_LIMIT_24H) {
            return [
                'can_send' => false,
                'message' => "You can only send 1 Surprise gift per 24 hours. Try again tomorrow!",
                'code' => 'SURPRISE_LIMIT_REACHED',
                'is_surprise' => true
            ];
        }

        return [
            'can_send' => true,
            'remaining_surprise_gifts' => self::SURPRISE_GIFT_LIMIT_24H - $surpriseGiftsSent,
            'is_surprise' => true
        ];
    }

    /**
     * Get rate limit info for a sender
     *
     * @param int $senderId
     * @return array
     */
    public function getRateLimitInfo($senderId)
    {
        $giftsSentToday = $this->userRepository->countGiftsSentToday($senderId);

        return [
            'gifts_sent_today' => $giftsSentToday,
            'remaining_today' => max(0, self::TOTAL_DAILY_LIMIT - $giftsSentToday),
            'daily_limit' => self::TOTAL_DAILY_LIMIT,
            'non_match_limit_24h' => self::NON_MATCH_LIMIT_24H
        ];
    }
}
