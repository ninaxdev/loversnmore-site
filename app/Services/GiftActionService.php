<?php

namespace App\Services;

use App\Yantrana\Components\User\Models\UserGiftModel;
use App\Yantrana\Components\User\Models\User;
use App\Yantrana\Components\Messenger\Repositories\MessengerRepository;

class GiftActionService
{
    protected $messengerRepository;

    public function __construct(MessengerRepository $messengerRepository)
    {
        $this->messengerRepository = $messengerRepository;
    }

    /**
     * Process Thank You action
     *
     * @param string $giftUId
     * @param int $userId
     * @return array
     */
    public function processThankYou($giftUId, $userId)
    {
        $gift = UserGiftModel::where('_uid', $giftUId)
            ->where('to_users__id', $userId)
            ->first();

        if (!$gift) {
            return [
                'success' => false,
                'message' => 'Gift not found.'
            ];
        }

        // Check if already actioned
        if ($gift->recipient_action !== 'pending') {
            return [
                'success' => false,
                'message' => 'Gift has already been actioned.'
            ];
        }

        // Update gift action
        $gift->recipient_action = 'thanked';
        $gift->save();

        // Send notification to sender
        $recipient = User::find($userId);
        $sender = User::find($gift->from_users__id);

        if ($sender && $recipient) {
            $this->sendNotificationToSender($sender, $recipient, 'thanked');
        }

        return [
            'success' => true,
            'message' => 'Thank you sent successfully!'
        ];
    }

    /**
     * Process Start Chat action
     *
     * @param string $giftUId
     * @param int $userId
     * @return array
     */
    public function processStartChat($giftUId, $userId)
    {
        $gift = UserGiftModel::where('_uid', $giftUId)
            ->where('to_users__id', $userId)
            ->first();

        if (!$gift) {
            return [
                'success' => false,
                'message' => 'Gift not found.'
            ];
        }

        // Check if already actioned
        if ($gift->recipient_action !== 'pending') {
            return [
                'success' => false,
                'message' => 'Gift has already been actioned.'
            ];
        }

        // Update gift action
        $gift->recipient_action = 'chatted';
        $gift->save();

        // Create or get existing conversation
        $senderId = $gift->from_users__id;
        $recipientId = $userId;

        // Check if conversation already exists
        $conversation = \DB::table('user_encounters')
            ->where(function ($query) use ($senderId, $recipientId) {
                $query->where('user_id', $senderId)
                    ->where('to_user_id', $recipientId);
            })
            ->orWhere(function ($query) use ($senderId, $recipientId) {
                $query->where('user_id', $recipientId)
                    ->where('to_user_id', $senderId);
            })
            ->first();

        if (!$conversation) {
            // Create new conversation
            $conversationUId = generateUid();
            \DB::table('user_encounters')->insert([
                '_id' => generateUid(),
                '_uid' => $conversationUId,
                'user_id' => $senderId,
                'to_user_id' => $recipientId,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $conversation = (object) ['_uid' => $conversationUId];
        }

        // Send notification to sender
        $recipient = User::find($userId);
        $sender = User::find($senderId);

        if ($sender && $recipient) {
            $this->sendNotificationToSender($sender, $recipient, 'chatted');
        }

        return [
            'success' => true,
            'message' => 'Chat started successfully!',
            'conversation_uid' => $conversation->_uid
        ];
    }

    /**
     * Process Ignore action
     *
     * @param string $giftUId
     * @param int $userId
     * @return array
     */
    public function processIgnore($giftUId, $userId)
    {
        $gift = UserGiftModel::where('_uid', $giftUId)
            ->where('to_users__id', $userId)
            ->first();

        if (!$gift) {
            return [
                'success' => false,
                'message' => 'Gift not found.'
            ];
        }

        // Check if already actioned
        if ($gift->recipient_action !== 'pending') {
            return [
                'success' => false,
                'message' => 'Gift has already been actioned.'
            ];
        }

        // Update gift action
        $gift->recipient_action = 'ignored';
        $gift->save();

        // No notification sent to sender for privacy

        return [
            'success' => true,
            'message' => 'Gift ignored.'
        ];
    }

    /**
     * Send notification to gift sender
     *
     * @param User $sender
     * @param User $recipient
     * @param string $action
     * @return void
     */
    protected function sendNotificationToSender($sender, $recipient, $action)
    {
        $messages = [
            'thanked' => "{$recipient->username} thanked you for your gift!",
            'chatted' => "{$recipient->username} wants to chat!",
        ];

        $message = $messages[$action] ?? 'You have a notification.';

        // Create notification record
        \DB::table('notifications')->insert([
            '_id' => generateUid(),
            '_uid' => generateUid(),
            'to_user_id' => $sender->_id,
            'from_user_id' => $recipient->_id,
            'type' => 12, // Gift action notification type
            'message' => $message,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Send push notification via Pusher (if available)
        try {
            if (config('broadcasting.connections.pusher.key')) {
                event(new \App\Events\UserNotification([
                    'userId' => $sender->_id,
                    'message' => $message,
                    'type' => 'gift_action'
                ]));
            }
        } catch (\Exception $e) {
            // Log error but don't fail the action
            \Log::error('Failed to send push notification: ' . $e->getMessage());
        }
    }

    /**
     * Get gift details for recipient
     *
     * @param string $giftUId
     * @param int $userId
     * @return array
     */
    public function getGiftDetails($giftUId, $userId)
    {
        $gift = UserGiftModel::with(['fromUser', 'toUser'])
            ->where('_uid', $giftUId)
            ->where('to_users__id', $userId)
            ->first();

        if (!$gift) {
            return [
                'success' => false,
                'message' => 'Gift not found.'
            ];
        }

        return [
            'success' => true,
            'gift' => $gift
        ];
    }
}
