<?php

/**
 * NotificationEngine.php - Main component file
 *
 * This file is part of the Notification component.
 *-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Notification;

use App\Yantrana\Base\BaseEngine;
use App\Yantrana\Components\Notification\Repositories\NotificationRepository;

class NotificationEngine extends BaseEngine
{
    /**
     * @var NotificationRepository - Notification Repository
     */
    protected $notificationRepository;

    /**
     * Constructor.
     *
     * @param  NotificationRepository  $notificationRepository - ManagePages Repository
     *-----------------------------------------------------------------------*/
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * get notification list data.
     *
     *
     * @return object
     *---------------------------------------------------------------- */
    public function prepareNotificationList()
    {
        $notificationCollection = $this->notificationRepository->fetchNotificationListData();

        $requireColumns = [
            '_id',
            '_uid',
            'created_at' => function ($pageData) {
                return formatDate($pageData['created_at']);
            },
            'formattedCreatedAt' => function ($pageData) {
                return formatDiffForHumans($pageData['created_at']);
            },
            'is_read',
            'action',
            'formattedIsRead' => function ($key) {
                return (isset($key['is_read']) and $key['is_read'] == 1) ? __tr('Yes') : __tr('No');
            },
            'formattedMessage' => function ($key) {
                return $key['message'];
            },
            'message',
        ];

        return $this->dataTableResponse($notificationCollection, $requireColumns);
    }

    /**
     * get Api notification list data.
     *
     *
     * @return object
     *---------------------------------------------------------------- */
    public function prepareApiNotificationList()
    {
        $notificationCollection = $this->notificationRepository->fetchApiNotificationListData();

        $requireColumns = [
            '_id',
            '_uid',
            'created_at' => function ($pageData) {
                return formatDate($pageData['created_at']);
            },
            'userUID'=> function ($key) { //manage for api request
                return $key['user_uid'];
            },
            'type',
            'userId'=> function ($key) { //manage for api request
                return $key['user_id'];
            },
            'userImageUrl' => function ($notificationItem) use (&$noThumbImageAvailableUrl) {
                if (! __isEmpty($notificationItem['profile_picture'])) {
                    $profileImageFolderPath = getPathByKey('profile_photo', ['{_uid}' => $notificationItem['user_uid']]);
                    return getMediaUrl($profileImageFolderPath, $notificationItem['profile_picture']);
                }
                return $noThumbImageAvailableUrl;
            },
            'userCoverUrl' => function ($notificationItem) use (&$noCoverImageURL) {
                if (! __isEmpty($notificationItem['cover_picture'])) {
                    $profileCoverImageFolderPath = getPathByKey('cover_photo', ['{_uid}' => $notificationItem['user_uid']]);
                    return getMediaUrl($profileCoverImageFolderPath, $notificationItem['cover_picture']);
                }
                return $noCoverImageURL;
            },
            'formattedCreatedAt' => function ($pageData) {
                return formatDiffForHumans($pageData['created_at']);
            },
            'is_read',
            'action',
            'formattedIsRead' => function ($key) {
                return (isset($key['is_read']) and $key['is_read'] == 1) ? 'Yes' : 'No';
            },
            'formattedMessage' => function ($key) {
                return $key['message'];
            },

            'message',
        ];

        return $this->customTableResponse($notificationCollection, $requireColumns);
    }

    /**
     * Process Read All Notification.
     *
     *-----------------------------------------------------------------------*/
    public function processReadAllNotification()
    {
        $notification = $this->notificationRepository->fetchAllUnReadNotification();

        //if notification not exists
        if (__isEmpty($notification)) {
            return $this->engineReaction(2, null, __tr('Notification does not exists.'));
        }

        //all notification ids
        //$notificationIds = $notification->pluck('_id')->toArray();
        $notificationData = [];
        if (! __isEmpty($notification)) {
            foreach ($notification as $key => $notify) {
                $notificationData[] = [
                    '_id' => $notify->_id,
                    'is_read' => 1,
                ];
            }
        }

        //update notification
        if ($this->notificationRepository->updateAllNotification($notificationData)) {
            return $this->engineReaction(1, null, __tr('Notification read successfully.'));
        }
        //error response
        return $this->engineReaction(2, null, __tr('Notification not read.'));
    }

    /**
     * Prepare Notification data.
     *
     *-----------------------------------------------------------------------*/
    public function prepareNotificationData()
    {
        return $this->engineReaction(1, getNotificationList());
    }

    /**
     * Prepare simple notification list (read + unread) for mobile alerts modal.
     *
     *-----------------------------------------------------------------------*/
    public function prepareSimpleNotificationList()
    {
        $notifications = \App\Yantrana\Components\Notification\Models\NotificationModel
            ::where('users__id', getUserID())
            ->orderByDesc('created_at')
            ->take(20)
            ->get(['_uid', 'message', 'action', 'is_read', 'created_at']);

        $list = $notifications->map(function ($n) {
            return [
                '_uid'      => $n->_uid,
                'message'   => $n->message,
                'actionUrl' => $n->action,
                'is_read'   => $n->is_read,
                'created_at'=> $n->created_at->diffForHumans(),
            ];
        })->values()->toArray();

        return $this->engineReaction(1, [
            'notificationData'  => $list,
            'notificationCount' => $notifications->whereNull('is_read')->count(),
        ]);
    }
}
