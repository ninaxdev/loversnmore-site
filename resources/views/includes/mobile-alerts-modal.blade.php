<!-- Mobile Alerts Modal - Only visible on mobile when enable_new_navigation is true -->
@if(env('ENABLE_NEW_NAVIGATION') === 'true' || env('ENABLE_NEW_NAVIGATION') === true)
<div x-data="{ showAlertsModal: false }"
     @open-alerts-modal.window="showAlertsModal = true; loadNotifications()"
     @close-alerts-modal.window="showAlertsModal = false"
     x-show="showAlertsModal"
     x-cloak
     class="fixed inset-0 z-[100000] md:hidden"
     style="display: none;">

    <!-- Modal Overlay -->
    <div x-show="showAlertsModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="absolute inset-0 bg-black bg-opacity-50"
         @click="showAlertsModal = false">
    </div>

    <!-- Modal Content -->
    <div x-show="showAlertsModal"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="absolute inset-0 bg-white flex flex-col"
         @click.stop>

        <!-- Header -->
        <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200 bg-white">
            <div class="flex items-center">
                <button @click="showAlertsModal = false"
                        class="mr-4 w-10 h-10 rounded-full flex items-center justify-center transition-colors"
                        style="border: 2px solid #ec9cae; background: transparent;">
                    <i class="fas fa-chevron-left" style="color: #ec9cae;"></i>
                </button>
                <h2 class="text-2xl font-bold" style="color: #222222;">
                    <?= __tr('Alerts') ?>
                </h2>
            </div>
            <button onclick="markAllNotificationsRead()"
                    id="lwMarkAllReadBtn"
                    style="display:none; color: #ec9cae; border: 1px solid #ec9cae; background: transparent; font-size: 13px; font-weight: 500; padding: 4px 12px; border-radius: 999px; cursor: pointer;">
                <?= __tr('Mark all read') ?>
            </button>
        </div>

        <!-- Notifications List -->
        <div id="lwMobileNotificationContent" class="flex-1 overflow-y-auto px-4 py-4" style="background: #f9f9f9;">
            <div class="flex items-center justify-center py-8">
                <div class="text-center">
                    <i class="fas fa-bell text-6xl mb-4" style="color: #d1d5db;"></i>
                    <p class="text-gray-500"><?= __tr('Loading notifications...') ?></p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="padding: 12px 16px; border-top: 1px solid #f0f0f0; background: white; text-align: center; flex-shrink: 0;">
            <a href="<?= route('user.notification.read.view') ?>"
               style="color: #ec9cae; font-size: 14px; font-weight: 600; text-decoration: none;">
                <i class="fas fa-list mr-1"></i><?= __tr('View All Notifications') ?>
            </a>
        </div>
    </div>
</div>

<script>
    function lwGetNotificationIcon(message) {
        var msg = (message || '').toLowerCase();
        if (msg.indexOf('liked') !== -1) {
            return '<div style="width:40px;height:40px;border-radius:50%;background:#FDE4EC;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-heart" style="color:#ec9cae;font-size:18px;"></i></div>';
        } else if (msg.indexOf('gift') !== -1) {
            return '<div style="width:40px;height:40px;border-radius:50%;background:#FDE4EC;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-gift" style="color:#ec9cae;font-size:18px;"></i></div>';
        } else if (msg.indexOf('message') !== -1 || msg.indexOf('chat') !== -1) {
            return '<div style="width:40px;height:40px;border-radius:50%;background:#E9E4F5;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-comment" style="color:#A88BEB;font-size:18px;"></i></div>';
        } else if (msg.indexOf('visit') !== -1) {
            return '<div style="width:40px;height:40px;border-radius:50%;background:#E9E4F5;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-user" style="color:#A88BEB;font-size:18px;"></i></div>';
        } else {
            return '<div style="width:40px;height:40px;border-radius:50%;background:#FDE4EC;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="fas fa-bell" style="color:#ec9cae;font-size:18px;"></i></div>';
        }
    }

    function lwRenderNotifications(list) {
        if (!list || list.length === 0) {
            return '<div style="display:flex;align-items:center;justify-content:center;padding:48px 0;">' +
                   '<div style="text-align:center;">' +
                   '<i class="fas fa-bell-slash" style="font-size:60px;color:#d1d5db;margin-bottom:16px;display:block;"></i>' +
                   '<p style="color:#6b7280;font-size:18px;"><?= __tr('No notifications yet') ?></p>' +
                   '</div></div>';
        }

        var html = '';
        for (var i = 0; i < list.length; i++) {
            var n = list[i];
            var isUnread = !n.is_read;
            var borderColor = isUnread ? '#ec9cae' : '#e5e7eb';
            var fontWeight = isUnread ? '600' : '400';
            var dotHtml = isUnread
                ? '<div style="width:8px;height:8px;border-radius:50%;background:#ec9cae;flex-shrink:0;margin-top:6px;"></div>'
                : '';
            var href = n.actionUrl || '#';

            html += '<a class="lw-mobile-notification-item" href="' + href + '" data-uid="' + (n._uid || '') + '" style="display:block;margin-bottom:12px;background:white;border-radius:12px;padding:16px;text-decoration:none;border-left:4px solid ' + borderColor + ';box-shadow:0 1px 4px rgba(0,0,0,0.06);">';
            html += '<div style="display:flex;align-items:flex-start;gap:12px;">';
            html += lwGetNotificationIcon(n.message);
            html += '<div style="flex:1;min-width:0;">';
            html += '<p style="color:#222222;font-size:15px;font-weight:' + fontWeight + ';margin:0 0 4px;">' + (n.message || '') + '</p>';
            html += '<p style="color:#888888;font-size:13px;margin:0;">' + (n.created_at || '') + '</p>';
            html += '</div>';
            html += dotHtml;
            html += '</div></a>';
        }
        return html;
    }

    function loadNotifications() {
        $.ajax({
            url: '<?= route('user.notification.read.simple_list') ?>',
            type: 'GET',
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(responseData) {
                var list = [];
                if (responseData && responseData.data && responseData.data.notificationData) {
                    list = responseData.data.notificationData;
                } else if (responseData && responseData.notificationData) {
                    list = responseData.notificationData;
                }

                $('#lwMobileNotificationContent').html(lwRenderNotifications(list));

                var hasUnread = false;
                for (var i = 0; i < list.length; i++) {
                    if (!list[i].is_read) { hasUnread = true; break; }
                }
                document.getElementById('lwMarkAllReadBtn').style.display = hasUnread ? 'inline-block' : 'none';
            },
            error: function(xhr) {
                $('#lwMobileNotificationContent').html(
                    '<div style="display:flex;align-items:center;justify-content:center;padding:48px 0;">' +
                    '<div style="text-align:center;">' +
                    '<i class="fas fa-exclamation-circle" style="font-size:60px;color:#ef4444;margin-bottom:16px;display:block;"></i>' +
                    '<p style="color:#6b7280;"><?= __tr('Failed to load notifications') ?> (' + xhr.status + ')</p>' +
                    '</div></div>'
                );
            }
        });
    }

    // Click a notification — mark as read then navigate
    $(document).on('click', '.lw-mobile-notification-item', function(e) {
        e.preventDefault();
        var uid = $(this).data('uid');
        var url = $(this).attr('href');

        if (uid) {
            $.post(
                '<?= url("/user/notifications/mark-notification-read") ?>/' + uid,
                { _token: '<?= csrf_token() ?>' },
                function() {
                    __DataRequest.updateModels({ 'totalNotificationCount': '' });
                }
            );
        }

        if (url && url !== '#') {
            window.location.href = url;
        }
    });

    function markAllNotificationsRead() {
        var $btn = $('#lwMarkAllReadBtn');
        $btn.prop('disabled', true).css('opacity', '0.5');

        $.ajax({
            url: '<?= route("user.notification.write.read_all_notification") ?>',
            type: 'POST',
            data: { _token: '<?= csrf_token() ?>' },
            success: function() {
                loadNotifications();
                __DataRequest.updateModels({ 'totalNotificationCount': '' });
                $btn.prop('disabled', false).css('opacity', '1');
            },
            error: function() {
                $btn.prop('disabled', false).css('opacity', '1');
            }
        });
    }

    $(document).on('mouseenter', '.lw-mobile-notification-item', function() {
        $(this).css('box-shadow', '0 4px 12px rgba(236,156,174,0.25)');
    });
    $(document).on('mouseleave', '.lw-mobile-notification-item', function() {
        $(this).css('box-shadow', '0 1px 4px rgba(0,0,0,0.06)');
    });
</script>

<style>
.lw-mobile-notification-item { transition: all 0.2s ease; }
.lw-mobile-notification-item:active { transform: scale(0.98); }
[x-cloak] { display: none !important; }
</style>
@endif
