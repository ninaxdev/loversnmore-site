<!-- Sidebar -->
<ul class="navbar-nav sidebar accordion d-none d-lg-block lw-sidebar-light" id="accordionSidebar" style="background: white !important; box-shadow: 0 0 20px rgba(0,0,0,0.05);">
    <!-- Sidebar - Brand -->
    <li>
        <a class="sidebar-brand d-flex align-items-center" href="<?= url('/home') ?>" style="border-bottom: 1px solid rgba(236, 156, 174, 0.2); padding: 1.5rem 1rem; background:#ec9cae;">
            <div class="sidebar-brand-icon">
                <img class="lw-logo-img" src="<?= getStoreSettings('small_logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
            </div>
            <img class="lw-logo-img d-sm-none d-none d-md-block" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
            <img class="lw-logo-img d-sm-block d-md-none" src="<?= getStoreSettings('small_logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
        </a>
    </li>
    <li class="nav-item mt-2 d-sm-block d-md-none">
        <a href class="nav-link lw-sidebar-nav-item" onclick="getChatMessenger('<?= route('user.read.all_conversation') ?>', true)" id="lwAllMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog">
            <span class="badge lw-new-message-badge" style="background: #ec9cae; border-radius: 50%; width: 12px; height: 12px; position: absolute; top: 8px; right: 8px;"></span>
            <i class="far fa-comments"></i>
            <span><?= __tr('Messenger') ?></span>
        </a>
    </li>
    <!-- Nav Item - Messages -->
    <li class="nav-item d-sm-block d-md-none">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url" href="<?= route('user.credit_wallet.read.view') ?>">
            <i class="fas fa-coins fa-fw mr-2"></i>
            <span><?= __tr('Credit Wallet') ?></span>
            <span class="badge badge-success badge-counter" style="background: #10b981; border-radius: 12px;"><?= totalUserCredits() ?></span>
        </a>
    </li>

    <!-- Nav Item - Messages -->
    <li class="nav-item d-sm-block d-md-none">
        <a class="nav-link lw-sidebar-nav-item" href data-toggle="modal" onclick="showBoosterAlert()">
            <i class="fas fa-bolt fa-fw mr-2"></i>
            <span><?= __tr('Profile Booster') ?></span>
            <span id="lwBoosterTimerCountDownOnSB" style="color: #ec9cae; font-size: 0.75rem; font-family: monospace;"></span>
        </a>
    </li>
    <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none" style="border-color: rgba(236, 156, 174, 0.2);">
    
    <!-- Heading -->
    <li class="mt-4 nav-item <?= makeLinkActive('home_page') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('home_page') ? 'active' : '' ?>" href="<?= route('home_page') ?>">
            <i class="fas fa-home"></i>
            <span><?= __tr('Home') ?></span>
        </a>
    </li>

    <li class="nav-item <?= makeLinkActive('user.read.find_matches') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.read.find_matches') ? 'active' : '' ?>" href="<?= route('user.read.find_matches') ?>">
            <i class="fas fa-search"></i>
            <span><?= __tr('Find Matches') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.profile_view') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.profile_view') ? 'active' : '' ?>" data-event-callback="lwPrepareUploadPlugIn" href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>">
            <i class="fas fa-user"></i>
            <span><?= __tr('My Profile') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.photos_setting') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.photos_setting') ? 'active' : '' ?>" data-event-callback="lwPrepareUploadPlugIn" href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>">
            <i class="far fa-images"></i>
            <span><?= __tr('My Photos') ?></span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider mt-2 mb-2" style="border-color: rgba(236, 156, 174, 0.2);">
    <li class="nav-item <?= makeLinkActive('user.who_liked_me_view') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.who_liked_me_view') ? 'active' : '' ?>" href="<?= route('user.who_liked_me_view') ?>">
            <i class="fa fa-heart" aria-hidden="true"></i>
            <span><?= __tr('Who likes me') ?>
                <?php
                $featurePlans = getStoreSettings('feature_plans');
                $showLike = $featurePlans['show_like']['select_user'];
                ?>
                @if($showLike == 2)
                <span class="lw-premium-feature-badge lw-premium-feature-width" title="{{ __tr('This is Premium feature') }}" style="background: #5B3E96; border-radius: 50%; width: 16px; height: 16px; display: inline-flex; align-items: center; justify-content: center; margin-left: 4px;"><i class="fas fa-crown" style="font-size: 8px; color: white;"></i></span></span>
            @endif
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.mutual_like_view') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.mutual_like_view') ? 'active' : '' ?>" href="<?= route('user.mutual_like_view') ?>">
            <i class="fa fa-users"></i>
            <span><?= __tr('Mutual Likes') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.my_liked_view') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.my_liked_view') ? 'active' : '' ?>" href="<?= route('user.my_liked_view') ?>">
            <i class="fas fa-fw fa-heart"></i>
            <span><?= __tr('My Likes') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.my_disliked_view') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.my_disliked_view') ? 'active' : '' ?>" href="<?= route('user.my_disliked_view') ?>">
            <i class="fas fa-fw fa-heart-broken"></i>
            <span><?= __tr('My Dislikes') ?></span>
        </a>
    </li>
    <li class="nav-item  <?= makeLinkActive('user.profile_visitors_view') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.profile_visitors_view') ? 'active' : '' ?>" href="<?= route('user.profile_visitors_view') ?>">
            <i class="fa fa-user-friends" aria-hidden="true"></i>
            <span><?= __tr('Visitors') ?></span>
        </a>
    </li>
    <li x-data="{totalNotificationCount:'<?= (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' ?>'}" class="nav-item  <?= makeLinkActive('user.notification.read.view') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.notification.read.view') ? 'active' : '' ?>" href="<?= route('user.notification.read.view') ?>">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <span><?= __tr('Notifications') ?> <small class="badge" style="background: #ec9cae; border-radius: 12px; font-size: 0.75rem;" x-text="totalNotificationCount" x-show="totalNotificationCount"></small></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.read.block_user_list') ?>">
        <a class="nav-link lw-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.read.block_user_list') ? 'active' : '' ?>" href="<?= route('user.read.block_user_list') ?>">
            <i class="fas fa-ban"></i>
            <span><?= __tr('Blocked Users') ?></span>
        </a>
    </li>
    
    <!-- Featured Users Card -->
    <div class="card mt-3 lw-featured-users-block" style="background: white; border: 2px solid #ec9cae; border-radius: 12px; margin: 16px;">
        <h5 class="card-header" style="background: rgba(236, 156, 174, 0.1); color: #222222; font-family: var(--lw-font-family); font-weight: 600; border-bottom: 2px solid #ec9cae; border-radius: 12px 12px 0 0;">
            <?= __tr('Featured Users') ?>
        </h5>
        <div class="card-body lw-featured-users" style="padding: 16px;">
            <button type="button" class="btn btn-icon mb-3" id="lw-default-featured-users" title="{{ __tr('Get yourself in Featured Users') }}" style="background: #5B3E96; color: white; border: none; border-radius: 8px; padding: 12px 16px; font-family: var(--lw-font-family); font-weight: 600; width: 100%; transition: all 0.3s ease; transform: translateY(0);">
                <i class="fa fa-user-plus mr-2"></i><span class="hidden md:inline"><?= __tr('Be Featured') ?></span>
            </button>
            @if(!__isEmpty(getFeatureUserList()))
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                @foreach(getFeatureUserList() as $users)
                <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_view', ['username' => $users['username']]) ?>" style="display: block; transition: all 0.3s ease;">
                    <img class="img-fluid img-thumbnail lw-sidebar-thumbnail lw-lazy-img" data-src="<?= $users['userImageUrl'] ?>" style="border: 2px solid #ec9cae; border-radius: 8px; width: 100%; height: 60px; object-fit: cover; transition: all 0.3s ease;">
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <!-- sidebar advertisement -->
    @if(!getFeatureSettings('no_adds') and getStoreSettings('user_sidebar_advertisement')['status'] == 'true')
    <li class="nav-item lw-sidebar-ads-container d-none d-md-block" style="margin: 16px; padding: 0;">
        <!-- sidebar advertisement content -->
        <div style="background: white; border: 2px solid #ec9cae; border-radius: 12px; padding: 16px;">
            <?= getStoreSettings('user_sidebar_advertisement')['content'] ?>
        </div>
        <!-- /sidebar advertisement content -->
    </li>
    <!-- sidebar advertisement -->
    @endif
</ul>
<!-- End of Sidebar -->

<style>
/* Light Sidebar Styling */
.lw-sidebar-light {
    background: white !important;
}

/* Sidebar Nav Item Styling */
.lw-sidebar-nav-item {
    display: flex;
    align-items: center;
    padding: 12px 16px !important;
    margin: 8px 12px !important;
    border: 2px solid #ec9cae !important;
    border-radius: 12px !important;
    color: #222222 !important;
    font-family: var(--lw-font-family);
    font-weight: 500;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
}

.lw-sidebar-nav-item i {
    color: #ec9cae !important;
    width: 20px;
    margin-right: 12px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.lw-sidebar-nav-item span {
    color: #222222 !important;
    transition: all 0.3s ease;
}

/* Hover Effect */
.lw-sidebar-nav-item:hover {
    background: #5B3E96 !important;
    border-color: #ec9cae !important;
    transform: translateX(4px);
}

.lw-sidebar-nav-item:hover i {
    color: white !important;
}

.lw-sidebar-nav-item:hover span {
    color: white !important;
}

.lw-sidebar-nav-item:hover .badge {
    background: white !important;
    color: #5B3E96 !important;
}

/* Active State */



.lw-sidebar-nav-item.active .badge {
    background: white !important;
    color: #5B3E96 !important;
}

/* Featured Users Button Hover */
#lw-default-featured-users:hover {
    background: #4a2f7a !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(91, 62, 150, 0.3);
}

/* Sidebar Thumbnail Hover */
.lw-sidebar-thumbnail:hover {
    transform: scale(1.05);
    border-color: #5B3E96 !important;
}

/* Update sidebar scrollbar for white background */
.lw-sidebar-light::-webkit-scrollbar {
    width: 8px;
}

.lw-sidebar-light::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.lw-sidebar-light::-webkit-scrollbar-thumb {
    background: #ec9cae;
    border-radius: 4px;
}

.lw-sidebar-light::-webkit-scrollbar-thumb:hover {
    background: #5B3E96;
}
</style>