<?php 
$pageType = request()->pageType;
$currentRouteName = Route::getCurrentRoute()->getName();
?>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <li>
        <a class="sidebar-brand d-flex align-items-center" href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="sidebar-brand-icon">
                <img class="lw-logo-img" src="<?= asset('images/heart-outline.svg') ?>" alt="<?= getStoreSettings('name') ?>" style="width: 40px; height: 40px;">
            </div>
            <img class="lw-logo-img d-sm-none d-none d-md-block" src="<?= asset('images/wordmark-loversnmore.svg') ?>" alt="<?= getStoreSettings('name') ?>" style="height: 32px;">
            <img class="lw-logo-img d-sm-block d-md-none" src="<?= asset('images/heart-outline.svg') ?>" alt="<?= getStoreSettings('name') ?>" style="width: 40px; height: 40px;">
        </a>
    </li>

    <!-- Heading -->
    <li class="mt-4 nav-item <?= makeLinkActive('manage.dashboard', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.dashboard') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-fw fa-tachometer-alt" style="color: <?= makeLinkActive('manage.dashboard', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Dashboard') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.page.view', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.page.view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-file" style="color: <?= makeLinkActive('manage.page.view', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Pages') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.item.gift.view', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.item.gift.view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa fa-gift" style="color: <?= makeLinkActive('manage.item.gift.view', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Gifts') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.item.sticker.view', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.item.sticker.view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa fa-sticky-note" style="color: <?= makeLinkActive('manage.item.sticker.view', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Stickers') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.credit_package.read.list', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.credit_package.read.list') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-box" style="color: <?= makeLinkActive('manage.credit_package.read.list', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Credit Packages') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.abuse_report.read.list', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.abuse_report.read.list', ['status' => 1]) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-flag" style="color: <?= makeLinkActive('manage.abuse_report.read.list', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Abuse Reports') ?>
                <div class="d-inline" x-data="{ isShowing: false, reportCount: '' }">
                    <span x-show="isShowing">
                        <div class="badge badge-pill badge-success" x-text="reportCount" style="font-size: 10px;"></div>
                    </span>
                </div>
            </span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.user.view_list', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.user.view_list', ['status' => 1]) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-users" style="color: <?= makeLinkActive('manage.user.view_list', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Users') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.user.photos_list', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.user.photos_list') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-upload" style="color: <?= makeLinkActive('manage.user.photos_list', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('User Uploads') ?></span>
        </a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider mt-2 mb-2" style="border-color: rgba(255,255,255,0.1);">
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item lw-settings-sub-menu-items">
        <a class="nav-link <?= makeLinkActive('manage.configuration.read', $currentRouteName,'', 'collapsed') ?>" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="<?= trim(makeLinkActive('manage.configuration.read', $currentRouteName,'true', 'false')) ?>" aria-controls="collapseUtilities" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-fw fa-cogs" style="color: <?= makeLinkActive('manage.configuration.read', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span>{{  __tr('Settings') }}</span>
        </a>
        <div id="collapseUtilities" class="collapse <?= makeLinkActive('manage.configuration.read', $currentRouteName, 'show') ?>" data-parent="#accordionSidebar" style="transition: all 0.3s ease;">
            <div class="collapse-inner rounded" style="background: #5B3E96; border-radius: 12px; margin: 8px;">
                <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'general' ? 'active' : '' }}" href="<?= route('manage.configuration.read', ['pageType' => 'general']) ?>" data-event-callback="lwPrepareUploadPlugIn" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                    <i class="fas fa-wrench" style="color: {{ $pageType == 'general' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                    <span><?= __tr('General') ?></span>
                </a>
                <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'user' ? 'active' : '' }}" href="<?= route('manage.configuration.read', ['pageType' => 'user']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                    <i class="fas fa-user" style="color: {{ $pageType == 'user' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                    <span><?= __tr('Users') ?></span>
                </a>
                 <!-- Currency & Credit Packages -->
                <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'currency' ? 'active' : '' }}" href="<?= route('manage.configuration.read', ['pageType' => 'currency']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="fas fa-money-bill-alt" style="color: {{ $pageType == 'currency' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span> <?= __tr('Currency') ?></span>
                </a>
                <!-- /Currency & Credit Packages -->
                  <!-- Payment Settings -->
               <a class="nav-link lw-ajax-link-action lw-action-with-url {{$pageType == 'payment' ? 'active' : '' }}" href="<?= route('manage.configuration.read', ['pageType' => 'payment']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="fas fa-credit-card" style="color: {{$pageType == 'payment' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span> <?= __tr('Payment Gateways') ?></span>
              </a>
            <!-- /Payment Settings -->
             <!-- Social Login Settings -->
             <a class="nav-link lw-ajax-link-action lw-action-with-url {{$pageType == 'social-login' ? 'active' : '' }}"  href="<?= route('manage.configuration.read', ['pageType' => 'social-login']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="fas fa-share-alt" style="color: {{$pageType == 'social-login' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span><?= __tr('Social Logins') ?></span>
            </a>
             <!-- /Social Login Settings -->
               <!-- Integration Settings -->
            <a class="nav-link lw-ajax-link-action lw-action-with-url {{$pageType == 'integration' ? 'active' : '' }}"  href="<?= route('manage.configuration.read', ['pageType' => 'integration']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="far fa-sun" style="color: {{$pageType == 'integration' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span><?= __tr('Integrations') ?></span>
            </a>
            <!-- /Integration Settings -->
               <!-- Misc Settings -->
               <a class="nav-link lw-ajax-link-action lw-action-with-url {{$pageType == 'misc' ? 'active' : '' }}"  href="<?= route('manage.configuration.read', ['pageType' => 'misc']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class=" fa fa-cogs" style="color: {{$pageType == 'misc' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span><?= __tr('Misc') ?></span>

            </a>
            <!-- /Misc Settings -->
              <!-- Premium Plans Settings -->
              <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'premium-plans' ? 'active' : '' }}"  href="<?= route('manage.configuration.read', ['pageType' => 'premium-plans']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="far fa-gem" style="color: {{ $pageType == 'premium-plans' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span><?= __tr('Premium Plans') ?></span>
            </a>
              <!-- /Premium Plans Settings -->
                <!-- Premium Features Settings -->
            <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'premium-feature' ? 'active' : '' }}"  href="<?= route('manage.configuration.read', ['pageType' => 'premium-feature']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="fas fa-database" style="color: {{ $pageType == 'premium-feature' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span> <?= __tr('Features') ?></span>
            </a>
            <!-- /Premium Features Settings -->
             <!-- Email Settings -->
             <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'email' ? 'active' : ''}}"  href="<?= route('manage.configuration.read', ['pageType' => 'email']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="fas fa-envelope-open" style="color: {{ $pageType == 'email' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span><?= __tr('Email & SMS') ?></span>
            </a>
             <!-- /Email Settings -->
               <!-- Booster Settings -->
            <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'booster' ? 'active' : ''}}"  href="<?= route('manage.configuration.read', ['pageType' => 'booster']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="far fa-paper-plane" style="color: {{ $pageType == 'booster' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span><?= __tr('Booster') ?></span>
            </a>
            <!-- /Booster Settings -->
             <!-- Advertisement Settings -->
             <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'advertisement' ? 'active' : ''}}"  href="<?= route('manage.configuration.read', ['pageType' => 'advertisement']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="far fa-newspaper" style="color: {{ $pageType == 'advertisement' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span><?= __tr('Advertisement') ?></span>
            </a>
             <!-- /Advertisement Settings -->
             <!-- color settings Settings -->
             <a class="nav-link lw-ajax-link-action lw-action-with-url {{ $pageType == 'custom-profile-fields' ? 'active' : ''}}"  href="<?= route('manage.configuration.read', ['pageType' => 'custom-profile-fields']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 4px;">
                <i class="fas fa-indent" style="color: {{ $pageType == 'custom-profile-fields' ? '#e91e63' : 'rgba(255,255,255,0.9)' }}; width: 18px;"></i>
                <span><?= __tr('Custom Profile Fields') ?></span>
            </a>
             <!-- /color settings Settings -->
            </div>
        </div>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.financial_transaction.read.view_list', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.financial_transaction.read.view_list', ['transactionType' => 'live']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-university" style="color: <?= makeLinkActive('manage.financial_transaction.read.view_list', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Financial Transactions') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.translations.languages', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.translations.languages') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-language" style="color: <?= makeLinkActive('manage.translations.languages', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Languages') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.fake_users.read.generator_options', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.fake_users.read.generator_options') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-user-plus" style="color: <?= makeLinkActive('manage.fake_users.read.generator_options', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Generate Fake Users') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.fake_users.read.messenger', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.fake_users.read.messenger') ?>" onclick="getChatMessenger('<?= route('user.read.all_conversation') ?>', true)" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="far fa-comments" style="color: <?= makeLinkActive('manage.fake_users.read.messenger', $currentRouteName) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Fake User Messenger') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.help.read', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.help.read') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fa fa-question" style="color: <?= makeLinkActive('manage.help.read', $currentRouteName) ? '#e91e63' : '#3b82f6' ?>; width: 18px;"></i>
            <span><?= __tr('Help References - Emails') ?></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" title="<?= __tr("If you have made changes which doesn't reflecting this link may help to clear all the cache.") ?>" href="<?= route('manage.configuration.clear_cache', []) . '?redirectTo=' . base64_encode(Request::fullUrl()); ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-broom" style="color: white; width: 18px;"></i>
            <span><?= __tr('Clear System Cache') ?></span>
        </a>
    </li>
    <li class="nav-item <?= Request::fullUrl() == route('manage.configuration.read', ['pageType' => 'licence-information']) ? 'active' : '' ?>">
        <a class="nav-link"  href="<?= route('manage.configuration.read', ['pageType' => 'licence-information']) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-certificate" style="color: <?= Request::fullUrl() == route('manage.configuration.read', ['pageType' => 'licence-information']) ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('License') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('manage.configuration.mobile_app', $currentRouteName) ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('manage.configuration.mobile_app') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-mobile" style="color: <?= makeLinkActive('manage.configuration.mobile_app', $currentRouteName) ? '#e91e63' : '#3b82f6' ?>; width: 18px;"></i>
            <span><?= __tr('Mobile App') ?></span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="border-color: rgba(255,255,255,0.1);">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" style="background: rgba(255,255,255,0.1); color: white; transition: all 0.3s ease;"></button>
    </div>
</ul>
<!-- End of Sidebar -->
@push('appScripts')
<style>
/* Ensure submenu is visible when expanded */
#collapseUtilities.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    max-height: none !important;
}

#collapseUtilities {
    display: none;
    overflow: hidden;
}

#collapseUtilities.collapsing {
    display: block;
}

/* Smooth transition for submenu */
#collapseUtilities.collapse {
    transition: height 0.35s ease, opacity 0.35s ease;
}

/* Ensure submenu items are clickable */
#collapseUtilities .nav-link {
    display: block !important;
    padding: 8px 16px !important;
    text-decoration: none !important;
}

#collapseUtilities .nav-link:hover {
    background-color: rgba(255,255,255,0.1) !important;
    border-radius: 8px !important;
}

/* Remove border by default */
.sidebar-dark .collapse-inner {
    border: none !important;
}

/* Desktop view: Show border only when expanded */
@media (min-width: 769px) {
    .sidebar-dark #collapseUtilities.show .collapse-inner {
        border: 1px solid #2f2f2f !important;
    }
}

/* Mobile view: Match sidebar dark theme */
@media (max-width: 768px) {
    /* Ensure dropdown follows dark theme */
    .sidebar .collapse-inner .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
    }
}
</style>
<script>
    //fetch abuse report counts
    __DataRequest.get("<?= route('abuse_report.get.count') ?>", {}, function(response) {
        if(response.reaction == 1){
            __DataRequest.updateModels({
                'reportCount' : response.data.reportsCount,
                'isShowing' : true
            });
        }
    });

    // Ensure Bootstrap collapse functionality works correctly
    $(document).ready(function() {
        // Initialize Bootstrap collapse if not already initialized
        if (typeof $.fn.collapse !== 'undefined') {
            $('#collapseUtilities').collapse({
                toggle: false
            });
        }

        // Handle collapse events
        $('#collapseUtilities').on('show.bs.collapse', function () {
            $('[data-target="#collapseUtilities"]').removeClass('collapsed').attr('aria-expanded', 'true');
        }).on('hide.bs.collapse', function () {
            $('[data-target="#collapseUtilities"]').addClass('collapsed').attr('aria-expanded', 'false');
        });

        // Manual click handler for settings menu (in case Bootstrap isn't working)
        $('[data-target="#collapseUtilities"]').on('click', function(e) {
            e.preventDefault();
            $('#collapseUtilities').collapse('toggle');
        });

        // Auto-collapse settings dropdown when clicking other menu items (all screen sizes)
        // Collapse settings dropdown when clicking any other nav-link that's not in the settings dropdown
        $('.sidebar .nav-item:not(.lw-settings-sub-menu-items) .nav-link').on('click', function() {
            // Check if settings dropdown is open
            if ($('#collapseUtilities').hasClass('show')) {
                $('#collapseUtilities').collapse('hide');
            }
        });

        // Close sidebar in mobile view when clicking dropdown menu items
        $('#collapseUtilities .nav-link').on('click', function() {
            if ($(window).width() <= 768) {
                // Close the sidebar
                $("body").addClass("sidebar-toggled");
                $(".sidebar").addClass("toggled");
                // Also collapse the settings dropdown
                $('#collapseUtilities').collapse('hide');
            }
        });
    });
</script>
@endPush