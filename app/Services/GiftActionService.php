<?php

namespace App\Services;

use App\Yantrana\Components\User\Models\UserGiftModel;
use App\Yantrana\Components\User\Models\User;
use App\Yantrana\Components\Messenger\Repositories\MessengerRepository;
use App\Yantrana\Components\Messenger\Models\ChatModel;
use YesSecurity;

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

        // Open a chat conversation between recipient and gift sender
        $senderId = $gift->from_users__id;
        $recipientId = $userId;

        // Check if a chat request/accepted record already exists
        $existingRequest = ChatModel::whereIn('type', [9, 10])
            ->where('users__id', $recipientId)
            ->where(function ($q) use ($senderId) {
                $q->where('to_users__id', $senderId)
                  ->orWhere('from_users__id', $senderId);
            })
            ->first();

        if (!$existingRequest) {
            $integrityId = YesSecurity::generateUid();
            ChatModel::insert([
                [
                    '_uid'           => YesSecurity::generateUid(),
                    'status'         => 2,
                    'message'        => 'Gift conversation started',
                    'type'           => 10, // accepted — bypass request flow
                    'from_users__id' => $senderId,
                    'to_users__id'   => $recipientId,
                    'users__id'      => $senderId,
                    'integrity_id'   => $integrityId,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ],
                [
                    '_uid'           => YesSecurity::generateUid(),
                    'status'         => 2,
                    'message'        => 'Gift conversation started',
                    'type'           => 10,
                    'from_users__id' => $senderId,
                    'to_users__id'   => $recipientId,
                    'users__id'      => $recipientId,
                    'integrity_id'   => $integrityId,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ],
            ]);
        }

        // Send notification to sender
        $recipient = User::find($userId);
        $sender = User::find($senderId);

        if ($sender && $recipient) {
            $this->sendNotificationToSender($sender, $recipient, 'chatted');
        }

        return [
            'success'          => true,
            'message'          => 'Chat started successfully!',
            'sender_uid'       => $sender->_uid ?? null,
            'sender_id'        => $sender->_id ?? null,
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

        // Create notification record using app helper
        notificationLog([
            'message'        => $message,
            'action'         => route('user.profile_view', ['username' => $recipient->username]),
            'isRead'         => null,
            'userId'         => $sender->_id,
            'type'           => 4, // Gift notification type
            'from_users__id' => $recipient->_id,
        ]);

        // Send push notification via Pusher
        \PushBroadcast::notifyViaPusher('event.user.notification', [
            'type'                => 'user-gift',
            'userUid'             => $sender->_uid,
            'subject'             => __tr('Gift Notification'),
            'message'             => $message,
            'messageType'         => 'success',
            'showNotification'    => getUserSettings('show_gift_notification', $sender->_id),
            'getNotificationList' => getNotificationList($sender->_id),
        ]);
    }

    /**
     * Send notification to gift recipient (when gift is sent)
     *
     * @param UserGiftModel $gift
     * @return void
     */
    public function sendNotificationToRecipient(UserGiftModel $gift)
    {
        $recipient = $gift->toUser ?? \App\Yantrana\Components\User\Models\User::find($gift->to_users__id);
        $sender    = $gift->fromUser ?? \App\Yantrana\Components\User\Models\User::find($gift->from_users__id);

        if (!$recipient || !$sender) {
            return;
        }

        $message = $sender->first_name . ' sent you a gift!';

        notificationLog([
            'message'        => $message,
            'action'         => route('user.read.gift_detail', ['giftUId' => $gift->_uid]),
            'isRead'         => null,
            'userId'         => $recipient->_id,
            'type'           => 4,
            'from_users__id' => $sender->_id,
        ]);

        \PushBroadcast::notifyViaPusher('event.user.notification', [
            'type'                => 'user-gift',
            'userUid'             => $recipient->_uid,
            'subject'             => __tr('You received a gift!'),
            'message'             => $message,
            'messageType'         => 'success',
            'showNotification'    => getUserSettings('show_gift_notification', $recipient->_id),
            'getNotificationList' => getNotificationList($recipient->_id),
            'actionUrl'           => route('user.read.gift_detail', ['giftUId' => $gift->_uid]),
        ]);
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
        $gift = UserGiftModel::with(['fromUser', 'toUser', 'icebreaker', 'item'])
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
