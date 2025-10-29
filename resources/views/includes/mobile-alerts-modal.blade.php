<!-- Mobile Alerts Modal - Only visible on mobile when enable_new_navigation is true -->
@if(env('ENABLE_NEW_NAVIGATION') === 'true' || env('ENABLE_NEW_NAVIGATION') === true)
<div x-data="{ showAlertsModal: false, notificationList: [] }"
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
        <div class="flex items-center px-4 py-4 border-b border-gray-200 bg-white">
            <!-- Back Button -->
            <button @click="showAlertsModal = false"
                    class="mr-4 w-10 h-10 rounded-full flex items-center justify-center transition-colors"
                    style="border: 2px solid #ec9cae; background: transparent;">
                <i class="fas fa-chevron-left" style="color: #ec9cae;"></i>
            </button>

            <!-- Title -->
            <h2 class="text-2xl font-bold" style="color: #222222;">
                <?= __tr('Alerts') ?>
            </h2>
        </div>

        <!-- Notifications List -->
        <div id="lwMobileNotificationContent" class="flex-1 overflow-y-auto px-4 py-4" style="background: #f9f9f9;">
            <!-- Loading State -->
            <div x-show="notificationList.length === 0" class="flex items-center justify-center py-8">
                <div class="text-center">
                    <i class="fas fa-bell text-6xl mb-4" style="color: #d1d5db;"></i>
                    <p class="text-gray-500"><?= __tr('Loading notifications...') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/_template" id="lwMobileNotificationListTemplate">
    <% if(!_.isEmpty(__tData.notificationList)) { %>
        <% _.forEach(__tData.notificationList, function(notification) { %>
            <a class="lw-mobile-notification-item lw-ajax-link-action lw-action-with-url block mb-4"
               href="<%- notification['actionUrl'] %>"
               style="background: white; border: 2px solid #ec9cae; border-radius: 12px; padding: 16px; text-decoration: none; transition: all 0.2s;">
                <div class="flex items-start gap-3">
                    <div class="lw-notification-icon flex-shrink-0">
                        <% if(notification['message'].toLowerCase().includes('liked')) { %>
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: #FDE4EC;">
                                <i class="fas fa-heart" style="color: #ec9cae; font-size: 18px;"></i>
                            </div>
                        <% } else if(notification['message'].toLowerCase().includes('message')) { %>
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: #E9E4F5;">
                                <i class="fas fa-comment" style="color: #A88BEB; font-size: 18px;"></i>
                            </div>
                        <% } else if(notification['message'].toLowerCase().includes('visit')) { %>
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: #E9E4F5;">
                                <i class="fas fa-user" style="color: #A88BEB; font-size: 18px;"></i>
                            </div>
                        <% } else { %>
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: #FDE4EC;">
                                <i class="fas fa-bell" style="color: #ec9cae; font-size: 18px;"></i>
                            </div>
                        <% } %>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="lw-mobile-notification-message font-medium mb-1" style="color: #222222; font-size: 15px;">
                            <%- notification['message'] %>
                        </p>
                        <p class="lw-mobile-notification-time text-sm" style="color: #888888;">
                            <%- notification['created_at'] %>
                        </p>
                    </div>
                </div>
            </a>
        <% }); %>
    <% } else { %>
        <div class="flex items-center justify-center py-12">
            <div class="text-center">
                <i class="fas fa-bell-slash text-6xl mb-4" style="color: #d1d5db;"></i>
                <p class="text-gray-500 text-lg"><?= __tr('No new notifications') ?></p>
            </div>
        </div>
    <% } %>
</script>

<script>
    function loadNotifications() {
        // Use __Utils for AJAX call with proper CSRF token handling
        __DataRequest.post('<?= route('user.notification.write.read_all_notification') ?>', {}, function(responseData) {
            if (responseData.reaction == 1 && responseData.data) {
                var notificationData = responseData.data;

                // Render notifications using template
                var template = _.template($('#lwMobileNotificationListTemplate').html());
                var renderedHtml = template({ __tData: notificationData });

                $('#lwMobileNotificationContent').html(renderedHtml);

                // Update notification count badge
                __DataRequest.updateModels({
                    'totalNotificationCount': ''
                });
            } else {
                $('#lwMobileNotificationContent').html(
                    '<div class="flex items-center justify-center py-12">' +
                    '<div class="text-center">' +
                    '<i class="fas fa-bell-slash text-6xl mb-4" style="color: #d1d5db;"></i>' +
                    '<p class="text-gray-500"><?= __tr('No notifications available') ?></p>' +
                    '</div>' +
                    '</div>'
                );
            }
        }, function(errorResponse) {
            $('#lwMobileNotificationContent').html(
                '<div class="flex items-center justify-center py-12">' +
                '<div class="text-center">' +
                '<i class="fas fa-exclamation-circle text-6xl mb-4" style="color: #ef4444;"></i>' +
                '<p class="text-gray-500"><?= __tr('Failed to load notifications') ?></p>' +
                '</div>' +
                '</div>'
            );
        });
    }

    // Add hover effect to notification items
    $(document).on('mouseenter', '.lw-mobile-notification-item', function() {
        $(this).css({
            'transform': 'scale(1.02)',
            'box-shadow': '0 4px 12px rgba(236, 156, 174, 0.3)'
        });
    });

    $(document).on('mouseleave', '.lw-mobile-notification-item', function() {
        $(this).css({
            'transform': 'scale(1)',
            'box-shadow': 'none'
        });
    });
</script>

<style>
/* Additional mobile alerts styles */
.lw-mobile-notification-item {
    display: block;
    transition: all 0.2s ease;
}

.lw-mobile-notification-item:active {
    transform: scale(0.98) !important;
}

[x-cloak] {
    display: none !important;
}
</style>
@endif
