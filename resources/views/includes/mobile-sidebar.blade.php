<!-- Mobile Sidebar Overlay -->
<div id="mobileSidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 lg:hidden" onclick="closeMobileSidebar()"></div>

<!-- Mobile Sidebar -->
<div id="mobileSidebar" class="fixed top-0 left-0 h-full w-80 max-w-[85vw] z-50 transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden overflow-y-auto shadow-2xl lw-mobile-sidebar-light" style="background: white;">

    <!-- Sidebar - Brand -->
    <a class="flex items-center justify-center" href="<?= url('/home') ?>" style="padding: 1.5rem 1rem; border-bottom: 1px solid rgba(236, 156, 174, 0.2); background: #ec9cae;">
        <div class="flex items-center">
            <img class="lw-logo-img" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>" style="height: 80px; max-width: 60vw;">
        </div>
    </a>

    <!-- Close Button - Mobile Only -->
    <button onclick="closeMobileSidebar()" class="absolute top-4 right-4 rounded-full p-2 transition-all duration-200 z-20" style="background: white; border: 2px solid white; width: 36px; height: 36px;">
        <i class="fas fa-times text-lg" style="color: #5B3E96;"></i>
    </button>

    <!-- Quick Actions (Mobile Only) -->
    <div class="mt-2">
        <a href="#" onclick="getChatMessenger('<?= route('user.read.all_conversation') ?>', true); closeMobileSidebar();" id="lwAllMessageChatButtonMobile" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog" class="lw-mobile-sidebar-nav-item" style="position: relative;">
            <span class="badge lw-new-message-badge" style="background: #ec9cae; border-radius: 50%; width: 12px; height: 12px; position: absolute; top: 8px; right: 8px;"></span>
            <i class="far fa-comments"></i>
            <span><?= __tr('Messenger') ?></span>
        </a>
    </div>

    <!-- Credit Wallet -->
    <div class="nav-item">
        <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url" href="<?= route('user.credit_wallet.read.view') ?>" onclick="closeMobileSidebar()">
            <i class="fas fa-coins fa-fw"></i>
            <span style="flex: 1;"><?= __tr('Credit Wallet') ?></span>
            <span class="badge badge-success badge-counter" style="background: #10b981; border-radius: 12px; padding: 2px 8px; font-size: 0.75rem;"><?= totalUserCredits() ?></span>
        </a>
    </div>

    <!-- Profile Booster -->
    <div class="nav-item">
        <a href="#" data-toggle="modal" onclick="showBoosterAlert(); closeMobileSidebar();" class="lw-mobile-sidebar-nav-item">
            <i class="fas fa-bolt fa-fw"></i>
            <span style="flex: 1;"><?= __tr('Profile Booster') ?></span>
            <span id="lwBoosterTimerCountDownMobile" style="color: #ec9cae; font-size: 0.75rem; font-family: monospace;"></span>
        </a>
    </div>

    <hr class="sidebar-divider mt-2 mb-2" style="border-color: rgba(236, 156, 174, 0.2); margin-left: 8px; margin-right: 8px;">

    <!-- Main Navigation -->
    <div class="mt-4">
        <!-- Home -->
        <div class="nav-item <?= makeLinkActive('home_page') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('home_page') ? 'active' : '' ?>" href="<?= route('home_page') ?>" onclick="closeMobileSidebar()">
                <i class="fas fa-home"></i>
                <span><?= __tr('Home') ?></span>
            </a>
        </div>

        <!-- Find Matches -->
        <div class="nav-item <?= makeLinkActive('user.read.find_matches') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.read.find_matches') ? 'active' : '' ?>" href="<?= route('user.read.find_matches') ?>" onclick="closeMobileSidebar()">
                <i class="fas fa-search"></i>
                <span><?= __tr('Find Matches') ?></span>
            </a>
        </div>

        <!-- My Profile -->
        <div class="nav-item <?= makeLinkActive('user.profile_view') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.profile_view') ? 'active' : '' ?>" data-event-callback="lwPrepareUploadPlugIn" href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>" onclick="closeMobileSidebar()">
                <i class="fas fa-user"></i>
                <span><?= __tr('My Profile') ?></span>
            </a>
        </div>

        <!-- My Photos -->
        <div class="nav-item <?= makeLinkActive('user.photos_setting') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.photos_setting') ? 'active' : '' ?>" data-event-callback="lwPrepareUploadPlugIn" href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>" onclick="closeMobileSidebar()">
                <i class="far fa-images"></i>
                <span><?= __tr('My Photos') ?></span>
            </a>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider mt-2 mb-2" style="border-color: rgba(236, 156, 174, 0.2); margin-left: 8px; margin-right: 8px;">

        <!-- Who likes me -->
        <div class="nav-item <?= makeLinkActive('user.who_liked_me_view') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.who_liked_me_view') ? 'active' : '' ?>" href="<?= route('user.who_liked_me_view') ?>" onclick="closeMobileSidebar()">
                <i class="fa fa-heart" aria-hidden="true"></i>
                <span style="flex: 1;"><?= __tr('Who likes me') ?></span>
                <?php
                $featurePlans = getStoreSettings('feature_plans');
                $showLike = $featurePlans['show_like']['select_user'];
                ?>
                @if($showLike == 2)
                <span class="lw-premium-feature-badge lw-premium-feature-width" title="{{ __tr('This is Premium feature') }}" style="background: #5B3E96; border-radius: 50%; width: 16px; height: 16px; display: inline-flex; align-items: center; justify-content: center; margin-left: 4px;"><i class="fas fa-crown" style="font-size: 8px; color: white;"></i></span>
                @endif
            </a>
        </div>

        <!-- Mutual Likes -->
        <div class="nav-item <?= makeLinkActive('user.mutual_like_view') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.mutual_like_view') ? 'active' : '' ?>" href="<?= route('user.mutual_like_view') ?>" onclick="closeMobileSidebar()">
                <i class="fa fa-users"></i>
                <span><?= __tr('Mutual Likes') ?></span>
            </a>
        </div>

        <!-- My Likes -->
        <div class="nav-item <?= makeLinkActive('user.my_liked_view') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.my_liked_view') ? 'active' : '' ?>" href="<?= route('user.my_liked_view') ?>" onclick="closeMobileSidebar()">
                <i class="fas fa-fw fa-heart"></i>
                <span><?= __tr('My Likes') ?></span>
            </a>
        </div>

        <!-- My Dislikes -->
        <div class="nav-item <?= makeLinkActive('user.my_disliked_view') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.my_disliked_view') ? 'active' : '' ?>" href="<?= route('user.my_disliked_view') ?>" onclick="closeMobileSidebar()">
                <i class="fas fa-fw fa-heart-broken"></i>
                <span><?= __tr('My Dislikes') ?></span>
            </a>
        </div>

        <!-- Visitors -->
        <div class="nav-item <?= makeLinkActive('user.profile_visitors_view') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.profile_visitors_view') ? 'active' : '' ?>" href="<?= route('user.profile_visitors_view') ?>" onclick="closeMobileSidebar()">
                <i class="fa fa-user-friends" aria-hidden="true"></i>
                <span><?= __tr('Visitors') ?></span>
            </a>
        </div>

        <!-- Notifications -->
        <div x-data="{totalNotificationCount:'<?= (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' ?>'}" class="nav-item <?= makeLinkActive('user.notification.read.view') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.notification.read.view') ? 'active' : '' ?>" href="<?= route('user.notification.read.view') ?>" onclick="closeMobileSidebar()">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span style="flex: 1;"><?= __tr('Notifications') ?></span>
                <small class="badge" style="background: #ec9cae; border-radius: 12px; font-size: 0.75rem; padding: 2px 6px;" x-text="totalNotificationCount" x-show="totalNotificationCount"></small>
            </a>
        </div>

        <!-- Blocked Users -->
        <div class="nav-item <?= makeLinkActive('user.read.block_user_list') ?>">
            <a class="lw-mobile-sidebar-nav-item lw-ajax-link-action lw-action-with-url <?= makeLinkActive('user.read.block_user_list') ? 'active' : '' ?>" href="<?= route('user.read.block_user_list') ?>" onclick="closeMobileSidebar()">
                <i class="fas fa-ban"></i>
                <span><?= __tr('Blocked Users') ?></span>
            </a>
        </div>
    </div>

    <!-- Featured Users Card -->
    <div class="card mt-3 lw-featured-users-block" style="background: white; border: 2px solid #ec9cae; border-radius: 12px; margin: 16px;">
        <h5 class="card-header" style="background: rgba(236, 156, 174, 0.1); color: #222222; font-family: var(--lw-font-family); font-weight: 600; border-bottom: 2px solid #ec9cae; border-radius: 12px 12px 0 0; padding: 12px 16px; font-size: 16px;">
            <?= __tr('Featured Users') ?>
        </h5>
        <div class="card-body lw-featured-users" style="padding: 16px;">
            <button type="button" class="btn btn-icon mb-3" id="lw-mobile-featured-users" title="{{ __tr('Get yourself in Featured Users') }}" onclick="closeMobileSidebar()" style="background: #5B3E96; color: white; border: none; border-radius: 8px; padding: 12px 16px; font-family: var(--lw-font-family); font-weight: 600; width: 100%; transition: all 0.3s ease; transform: translateY(0);">
                <i class="fa fa-user-plus mr-2"></i><span><?= __tr('Be Featured') ?></span>
            </button>
            @if(!__isEmpty(getFeatureUserList()))
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                @foreach(getFeatureUserList() as $users)
                <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_view', ['username' => $users['username']]) ?>" onclick="closeMobileSidebar()" style="display: block; transition: all 0.3s ease;">
                    <img class="img-fluid img-thumbnail lw-sidebar-thumbnail lw-lazy-img" data-src="<?= $users['userImageUrl'] ?>" style="border: 2px solid #ec9cae; border-radius: 8px; width: 100%; height: 60px; object-fit: cover; transition: all 0.3s ease;">
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <!-- Spacer for bottom navigation -->
    <div style="height: 80px;"></div>
</div>

<style>
/* Mobile Sidebar Light Theme */
.lw-mobile-sidebar-light {
    background: white !important;
}

/* Mobile Sidebar Nav Item Styling */
.lw-mobile-sidebar-nav-item {
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

.lw-mobile-sidebar-nav-item i {
    color: #ec9cae !important;
    width: 20px;
    margin-right: 12px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.lw-mobile-sidebar-nav-item span {
    color: #222222 !important;
    transition: all 0.3s ease;
}

/* Hover Effect */
.lw-mobile-sidebar-nav-item:hover {
    background: #5B3E96 !important;
    border-color: #ec9cae !important;
    transform: translateX(4px);
}

.lw-mobile-sidebar-nav-item:hover i {
    color: white !important;
}

.lw-mobile-sidebar-nav-item:hover span {
    color: white !important;
}

.lw-mobile-sidebar-nav-item:hover .badge {
    background: white !important;
    color: #5B3E96 !important;
}

/* Active State */
.lw-mobile-sidebar-nav-item.active {
    /* background: #5B3E96 !important; */
    border-color: #ec9cae !important;
}



.lw-mobile-sidebar-nav-item.active .badge {
    background: white !important;
    color: #5B3E96 !important;
}

/* Mobile Featured Users Button Hover */
#lw-mobile-featured-users:hover {
    background: #4a2f7a !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(91, 62, 150, 0.3);
}

/* Mobile Sidebar Thumbnail Hover */
.lw-mobile-sidebar-light .lw-sidebar-thumbnail:hover {
    transform: scale(1.05);
    border-color: #5B3E96 !important;
}

/* Update mobile sidebar scrollbar for white background */
.lw-mobile-sidebar-light::-webkit-scrollbar {
    width: 8px;
}

.lw-mobile-sidebar-light::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.lw-mobile-sidebar-light::-webkit-scrollbar-thumb {
    background: #ec9cae;
    border-radius: 4px;
}

.lw-mobile-sidebar-light::-webkit-scrollbar-thumb:hover {
    background: #5B3E96;
}
</style>

<script>
    // Open mobile sidebar
    function openMobileSidebar() {
        document.getElementById('mobileSidebar').classList.remove('-translate-x-full');
        document.getElementById('mobileSidebarOverlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Close mobile sidebar
    function closeMobileSidebar() {
        document.getElementById('mobileSidebar').classList.add('-translate-x-full');
        document.getElementById('mobileSidebarOverlay').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Handle hamburger click
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggleTop');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();
                openMobileSidebar();
            });
        }

        // Mobile featured users button
        $('#lw-mobile-featured-users').on('click', function(){
            showConfirmation('', function() {
                showBoosterAlert();
            }, {
                title:"<?= __tr('✨ Become Featured') ?>",
                confirmBtnColor: '#c53e8d',
                confirmButtonText: "<i class='fas fa-bolt fa-fw mr-2'></i><?= __tr('Boost Profile') ?>",
                cancelButtonText: '<?= __tr("Maybe Later") ?>',
                type: "question",
                background: 'var(--lw-white)',
                showDenyButton: @if(isPremiumUser()) false @else true @endif,
                denyButtonText: '<div onclick="premiumView()" style="color: var(--lw-gradient-start); font-weight: 600;"><i class="fas fa-crown mr-1"></i><?= __tr("Go Premium") ?></div>',
                customClass: {
                    popup: 'lw-swal-popup',
                    title: 'lw-swal-title',
                    content: 'lw-swal-content'
                }
            });
        });

        // Sync booster timer with mobile
        setInterval(function() {
            const desktopTimer = document.getElementById('lwBoosterTimerCountDown');
            const mobileTimer = document.getElementById('lwBoosterTimerCountDownMobile');
            if (desktopTimer && mobileTimer) {
                mobileTimer.textContent = desktopTimer.textContent;
            }
        }, 1000);
    });
</script>
