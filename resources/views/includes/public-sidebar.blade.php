<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <li>
        <a class="sidebar-brand d-flex align-items-center" href="<?= url('/home') ?>" style=" border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="sidebar-brand-icon">
                <img class="lw-logo-img" src="<?= getStoreSettings('small_logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>" style="filter: brightness(0) invert(1);">
            </div>
            <img class="lw-logo-img d-sm-none d-none d-md-block" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>" style="filter: brightness(0) invert(1);">
            <img class="lw-logo-img d-sm-block d-md-none" src="<?= getStoreSettings('small_logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>" style="filter: brightness(0) invert(1);">
        </a>
    </li>
    <li class="nav-item mt-2 d-sm-block d-md-none">
        <a href class="nav-link" onclick="getChatMessenger('<?= route('user.read.all_conversation') ?>', true)" id="lwAllMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <span class="badge lw-new-message-badge" style="background: #e91e63; border-radius: 50%; width: 12px; height: 12px; position: absolute; top: 8px; right: 8px;"></span>
            <i class="far fa-comments" style="color: white;"></i>
            <span><?= __tr('Messenger') ?></span>
        </a>
    </li>
    <!-- Nav Item - Messages -->
    <li class="nav-item d-sm-block d-md-none">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.credit_wallet.read.view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-coins fa-fw mr-2" style="color: #fbbf24;"></i>
            <span><?= __tr('Credit Wallet') ?></span>
            <span class="badge badge-success badge-counter" style="background: #10b981; border-radius: 12px;"><?= totalUserCredits() ?></span>
        </a>
    </li>

    <!-- Nav Item - Messages -->
    <li class="nav-item d-sm-block d-md-none">
        <a class="nav-link" href data-toggle="modal" onclick="showBoosterAlert()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-bolt fa-fw mr-2" style="color: white;"></i>
            <span><?= __tr('Profile Booster') ?></span>
            <span id="lwBoosterTimerCountDownOnSB" style="color: #e91e63; font-size: 0.75rem; font-family: monospace;"></span>
        </a>
    </li>
    <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none" style="border-color: rgba(255,255,255,0.1);">
    
    <!-- Heading -->
    <li class="mt-4 nav-item <?= makeLinkActive('home_page') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('home_page') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-home" style="color: <?= makeLinkActive('home_page') ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Home') ?></span>
        </a>
    </li>

    <li class="nav-item <?= makeLinkActive('user.read.find_matches') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.read.find_matches') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-search" style="color: <?= makeLinkActive('user.read.find_matches') ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Find Matches') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.profile_view') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" data-event-callback="lwPrepareUploadPlugIn" href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-user" style="color: <?= makeLinkActive('user.profile_view') ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('My Profile') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.photos_setting') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" data-event-callback="lwPrepareUploadPlugIn" href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="far fa-images" style="color: <?= makeLinkActive('user.photos_setting') ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('My Photos') ?></span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider mt-2 mb-2" style="border-color: rgba(255,255,255,0.1);">
    <li class="nav-item <?= makeLinkActive('user.who_liked_me_view') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.who_liked_me_view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fa fa-thumbs-up" style="color: #fbbf24; width: 18px;" aria-hidden="true"></i>
            <span><?= __tr('Who likes me') ?>
                <?php
                $featurePlans = getStoreSettings('feature_plans');
                $showLike = $featurePlans['show_like']['select_user'];
                ?>
                @if($showLike == 2)
                <span class="lw-premium-feature-badge lw-premium-feature-width" title="{{ __tr('This is Premium feature') }}" style="background: linear-gradient(135deg, #e91e63, #8b5cf6); border-radius: 50%; width: 16px; height: 16px; display: inline-flex; align-items: center; justify-content: center; margin-left: 4px;"><i class="fas fa-crown" style="font-size: 8px; color: white;"></i></span></span>
            @endif
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.mutual_like_view') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.mutual_like_view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fa fa-users" style="color: white; width: 18px;"></i>
            <span><?= __tr('Mutual Likes') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.my_liked_view') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.my_liked_view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-fw fa-heart" style="color: white; width: 18px;"></i>
            <span><?= __tr('My Likes') ?></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.my_disliked_view') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.my_disliked_view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-fw fa-heart-broken" style="color: white; width: 18px;"></i>
            <span><?= __tr('My Dislikes') ?></span>
        </a>
    </li>
    <li class="nav-item  <?= makeLinkActive('user.profile_visitors_view') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_visitors_view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fa fa-user" style="color: <?= makeLinkActive('user.profile_visitors_view') ? '#e91e63' : 'white' ?>; width: 18px;" aria-hidden="true"></i>
            <span><?= __tr('Visitors') ?></span>
        </a>
    </li>
    <li x-data="{totalNotificationCount:'<?= (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' ?>'}" class="nav-item  <?= makeLinkActive('user.notification.read.view') ?>">
        <a class="nav-link  lw-ajax-link-action lw-action-with-url" href="<?= route('user.notification.read.view') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fa fa-bell" style="color: <?= makeLinkActive('user.notification.read.view') ? '#e91e63' : 'white' ?>; width: 18px;" aria-hidden="true"></i>
            <span><?= __tr('Notifications') ?> <small class="badge" style="background: #ef4444; border-radius: 12px; font-size: 0.75rem;" x-text="totalNotificationCount" x-show="totalNotificationCount"></small></span>
        </a>
    </li>
    <li class="nav-item <?= makeLinkActive('user.read.block_user_list') ?>">
        <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.read.block_user_list') ?>" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px;">
            <i class="fas fa-ban" style="color: <?= makeLinkActive('user.read.block_user_list') ? '#e91e63' : 'white' ?>; width: 18px;"></i>
            <span><?= __tr('Blocked Users') ?></span>
        </a>
    </li>
    
    <!-- Featured Users Card -->
    <div class="card mt-3 lw-featured-users-block" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; margin: 16px;">
        <h5 class="card-header" style="background: rgba(255,255,255,0.05); color: white; font-family: var(--lw-font-family); font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.1); border-radius: 12px 12px 0 0;">
            <?= __tr('Featured Users') ?>
        </h5>
        <div class="card-body lw-featured-users" style="padding: 16px;">
            <button type="button" class="btn btn-icon mb-3" id="lw-default-featured-users" title="{{ __tr('Get yourself in Featured Users') }}" style="background: linear-gradient(135deg, #e91e63, #8b5cf6); color: white; border: none; border-radius: 8px; padding: 12px 16px; font-family: var(--lw-font-family); font-weight: 600; width: 100%; transition: all 0.3s ease; transform: translateY(0);"> 
                <i class="fa fa-user-plus mr-2"></i><span class="hidden md:inline" ><?= __tr('Be Featured') ?></span>
            </button>
            @if(!__isEmpty(getFeatureUserList()))
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                @foreach(getFeatureUserList() as $users)
                <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_view', ['username' => $users['username']]) ?>" style="display: block; transition: all 0.3s ease;">
                    <img class="img-fluid img-thumbnail lw-sidebar-thumbnail lw-lazy-img" data-src="<?= $users['userImageUrl'] ?>" style="border: 2px solid rgba(255,255,255,0.2); border-radius: 8px; width: 100%; height: 60px; object-fit: cover; transition: all 0.3s ease;">
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
        <div style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 16px;">
            <?= getStoreSettings('user_sidebar_advertisement')['content'] ?>
        </div>
        <!-- /sidebar advertisement content -->
    </li>
    <!-- sidebar advertisement -->
    @endif
</ul>
<!-- End of Sidebar -->