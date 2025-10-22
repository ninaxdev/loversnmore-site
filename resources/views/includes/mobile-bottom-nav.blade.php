<!-- Mobile Bottom Navigation - Only visible on mobile when enable_new_navigation is true -->
@if(env('ENABLE_NEW_NAVIGATION') == 'true')
<nav class="fixed bottom-0 left-0 right-0 bg-gradient-to-r from-pink-600 to-purple-600 shadow-lg md:hidden" style="z-index: 99999 !important;">
    <div class="flex justify-around items-center h-16 px-2">
        <!-- Home -->
        <a href="<?= route('home_page') ?>"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 <?= makeLinkActive('home_page') ? 'text-white' : '' ?>">
            <i class="fas fa-home text-lg mb-1 <?= makeLinkActive('home_page') ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Home') ?></span>
        </a>

        <!-- Discover (Swipe) -->
        <a href="<?= route('user.read.discovery') ?>"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 <?= makeLinkActive('user.read.discovery') ? 'text-white' : '' ?>">
            <i class="fas fa-heart text-lg mb-1 <?= makeLinkActive('user.read.discovery') ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Discover') ?></span>
        </a>

        <!-- Messenger -->
        <a href="#"
           onclick="getChatMessenger('<?= route('user.read.all_conversation') ?>', true)"
           id="lwMobileMessengerButton"
           data-chat-loaded="false"
           data-toggle="modal"
           data-target="#messengerDialog"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 relative">
            <span class="absolute -top-1 right-1/2 transform translate-x-1/2 bg-pink-500 rounded-full w-3 h-3 lw-new-message-badge"></span>
            <i class="far fa-comments text-lg mb-1"></i>
            <span class="text-xs font-medium"><?= __tr('Chat') ?></span>
        </a>

        <!-- Notifications -->
        <a href="<?= route('user.notification.read.view') ?>"
           x-data="{totalNotificationCount:'<?= (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' ?>'}"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 relative <?= makeLinkActive('user.notification.read.view') ? 'text-white' : '' ?>">
            <span x-show="totalNotificationCount"
                  x-text="totalNotificationCount"
                  class="absolute -top-1 right-1/4 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center font-bold"></span>
            <i class="fa fa-bell text-lg mb-1 <?= makeLinkActive('user.notification.read.view') ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Alerts') ?></span>
        </a>

        <!-- Profile -->
        <a href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 <?= makeLinkActive('user.profile_view') ? 'text-white' : '' ?>">
            <i class="fas fa-user text-lg mb-1 <?= makeLinkActive('user.profile_view') ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Profile') ?></span>
        </a>
    </div>
</nav>

<!-- Add bottom padding to body content to prevent content from being hidden behind fixed nav -->
<style>
    @media (max-width: 768px) {
        @if(env('ENABLE_NEW_NAVIGATION') == 'true')
        .lw-page-content {
            padding-bottom: 80px !important;
        }
        @endif
    }
</style>
@endif
