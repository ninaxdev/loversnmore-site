<!-- Admin Mobile Bottom Navigation - Only visible on mobile when enable_new_navigation is true -->
@if(env('ENABLE_NEW_NAVIGATION') == 'true')
<?php
$pageType = request()->pageType;
$currentRouteName = Route::getCurrentRoute()->getName();
?>
<nav class="fixed bottom-0 left-0 right-0 bg-brandPurple shadow-lg md:hidden" style="z-index: 99999 !important;">
    <div class="flex justify-around items-center h-16 px-2">
        <!-- Dashboard -->
        <a href="<?= route('manage.dashboard') ?>"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 <?= makeLinkActive('manage.dashboard', $currentRouteName) ? 'text-white' : '' ?>">
            <i class="fas fa-tachometer-alt text-lg mb-1 <?= makeLinkActive('manage.dashboard', $currentRouteName) ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Dashboard') ?></span>
        </a>

        <!-- Users -->
        <a href="<?= route('manage.user.view_list', ['status' => 1]) ?>"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 <?= makeLinkActive('manage.user.view_list', $currentRouteName) ? 'text-white' : '' ?>">
            <i class="fas fa-users text-lg mb-1 <?= makeLinkActive('manage.user.view_list', $currentRouteName) ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Users') ?></span>
        </a>

        <!-- Settings -->
        <a href="<?= route('manage.configuration.read', ['pageType' => 'general']) ?>"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 <?= makeLinkActive('manage.configuration.read', $currentRouteName) ? 'text-white' : '' ?>">
            <i class="fas fa-cogs text-lg mb-1 <?= makeLinkActive('manage.configuration.read', $currentRouteName) ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Settings') ?></span>
        </a>

        <!-- Abuse Reports -->
        <a href="<?= route('manage.abuse_report.read.list', ['status' => 1]) ?>"
           x-data="{ isShowing: false, reportCount: '' }"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 relative <?= makeLinkActive('manage.abuse_report.read.list', $currentRouteName) ? 'text-white' : '' ?>">
            <span x-show="isShowing"
                  x-text="reportCount"
                  class="absolute -top-1 right-1/4 bg-green-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center font-bold"></span>
            <i class="fas fa-flag text-lg mb-1 <?= makeLinkActive('manage.abuse_report.read.list', $currentRouteName) ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Reports') ?></span>
        </a>

        <!-- Financial -->
        <a href="<?= route('manage.financial_transaction.read.view_list', ['transactionType' => 'live']) ?>"
           class="flex flex-col items-center justify-center flex-1 text-white/90 hover:text-white transition-all duration-300 <?= makeLinkActive('manage.financial_transaction.read.view_list', $currentRouteName) ? 'text-white' : '' ?>">
            <i class="fas fa-university text-lg mb-1 <?= makeLinkActive('manage.financial_transaction.read.view_list', $currentRouteName) ? 'text-white' : '' ?>"></i>
            <span class="text-xs font-medium"><?= __tr('Finance') ?></span>
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
