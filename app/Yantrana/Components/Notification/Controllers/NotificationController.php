<?php
/**
* NotificationController.php - Controller file
*
* This file is part of the Notification component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Notification\Controllers;

use App\Yantrana\Base\BaseController;
use App\Yantrana\Components\Notification\NotificationEngine;

class NotificationController extends BaseController
{
    /**
     * @var NotificationEngine - Notification Engine
     */
    protected $notificationEngine;

    /**
     * Constructor.
     *
     * @param  NotificationEngine  $notificationEngine - Notification Engine
     *-----------------------------------------------------------------------*/
    public function __construct(NotificationEngine $notificationEngine)
    {
        $this->notificationEngine = $notificationEngine;
    }

    /**
     * Get notification view.
     *
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getNotificationView()
    {
        return $this->loadPublicView('notification.notification-list');
    }

    /**
     * Get Notification DataTable data.
     *
     *-----------------------------------------------------------------------*/
    public function getNotificationList()
    {
        $this->readAllNotification();
        updateClientModels([
            'totalNotificationCount' => ''
        ]);
        return $this->notificationEngine->prepareNotificationList();
    }

    /**
     * Get simple notification list (for mobile alerts modal).
     *
     *-----------------------------------------------------------------------*/
    public function getSimpleNotificationList()
    {
        return $this->responseAction(
            $this->processResponse(
                $this->notificationEngine->prepareSimpleNotificationList(), [], [], true
            )
        );
    }

    /**
     * Mark a single notification as read.
     *
     *-----------------------------------------------------------------------*/
    public function markNotificationRead($notificationUid)
    {
        \App\Yantrana\Components\Notification\Models\NotificationModel
            ::where('_uid', $notificationUid)
            ->where('users__id', getUserID())
            ->update(['is_read' => 1]);

        return $this->responseAction(
            $this->processResponse($this->engineReaction(1), [], [], true)
        );
    }

    /**
     * Handle read all notification request.
     *
     * @param object read notification $request
     * @param  string  $reminderToken
     * @return json object
     *---------------------------------------------------------------- */
    public function readAllNotification()
    {
        $processReaction = $this->notificationEngine->processReadAllNotification();

        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }
}
