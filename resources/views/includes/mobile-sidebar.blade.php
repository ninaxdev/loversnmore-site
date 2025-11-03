<!-- Mobile Sidebar Overlay -->
<div id="mobileSidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 lg:hidden" onclick="closeMobileSidebar()"></div>

<!-- Mobile Sidebar - Loversnmore Gradient -->
<div id="mobileSidebar" class="fixed top-0 left-0 h-full w-80 max-w-[85vw] z-50 transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden overflow-y-auto shadow-2xl" style="background: linear-gradient(180deg, #4F1DA1, #E78AB0);">
    
    <!-- Sidebar - Brand -->
    <a class="flex items-center justify-center" href="<?= url('/home') ?>" style="padding: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
        <div class="flex items-center">
            <img class="lw-logo-img" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>" style="filter: brightness(0) invert(1); height: 80px; max-width: 60vw;">
        </div>
    </a>

    <!-- Close Button - Mobile Only -->
    <button onclick="closeMobileSidebar()" class="absolute top-4 right-4 text-white hover:bg-white hover:bg-opacity-20 rounded-lg p-2 transition-all duration-200 z-20">
        <i class="fas fa-times text-xl"></i>
    </button>

    <!-- Quick Actions (Mobile Only) -->
    <div class="mt-2">
        <a href="#" onclick="getChatMessenger('<?= route('user.read.all_conversation') ?>', true); closeMobileSidebar();" id="lwAllMessageChatButtonMobile" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem; position: relative;">
            <span class="badge lw-new-message-badge" style="background: #e91e63; border-radius: 50%; width: 12px; height: 12px; position: absolute; top: 8px; right: 8px;"></span>
            <i class="far fa-comments" style="color: white; margin-right: 0.75rem;"></i>
            <span><?= __tr('Messenger') ?></span>
        </a>
    </div>

    <!-- Credit Wallet -->
    <div class="nav-item">
        <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.credit_wallet.read.view') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
            <i class="fas fa-coins fa-fw" style="color: white; margin-right: 0.75rem;"></i>
            <span style="flex: 1;"><?= __tr('Credit Wallet') ?></span>
            <span class="badge badge-success badge-counter" style="background: #10b981; border-radius: 12px; padding: 2px 8px; font-size: 0.75rem;"><?= totalUserCredits() ?></span>
        </a>
    </div>

    <!-- Profile Booster -->
    <div class="nav-item">
        <a href="#" data-toggle="modal" onclick="showBoosterAlert(); closeMobileSidebar();" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
            <i class="fas fa-bolt fa-fw" style="color: white; margin-right: 0.75rem;"></i>
            <span style="flex: 1;"><?= __tr('Profile Booster') ?></span>
            <span id="lwBoosterTimerCountDownMobile" style="color: white; font-size: 0.75rem; font-family: monospace;"></span>
        </a>
    </div>

    <hr class="sidebar-divider mt-2 mb-2" style="border-color: rgba(255,255,255,0.1); margin-left: 8px; margin-right: 8px;">

    <!-- Main Navigation -->
    <div class="mt-4">
        <!-- Home -->
        <div class="nav-item <?= makeLinkActive('home_page') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('home_page') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fas fa-home" style="color: <?= makeLinkActive('home_page') ? 'white' : 'white' ?>; width: 18px; margin-right: 0.75rem;"></i>
                <span><?= __tr('Home') ?></span>
            </a>
        </div>

        <!-- Find Matches -->
        <div class="nav-item <?= makeLinkActive('user.read.find_matches') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.read.find_matches') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fas fa-search" style="color: <?= makeLinkActive('user.read.find_matches') ? 'white' : 'white' ?>; width: 18px; margin-right: 0.75rem;"></i>
                <span><?= __tr('Find Matches') ?></span>
            </a>
        </div>

        <!-- My Profile -->
        <div class="nav-item <?= makeLinkActive('user.profile_view') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" data-event-callback="lwPrepareUploadPlugIn" href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fas fa-user" style="color: <?= makeLinkActive('user.profile_view') ? 'white' : 'white' ?>; width: 18px; margin-right: 0.75rem;"></i>
                <span><?= __tr('My Profile') ?></span>
            </a>
        </div>

        <!-- My Photos -->
        <div class="nav-item <?= makeLinkActive('user.photos_setting') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" data-event-callback="lwPrepareUploadPlugIn" href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="far fa-images" style="color: <?= makeLinkActive('user.photos_setting') ? 'white' : 'white' ?>; width: 18px; margin-right: 0.75rem;"></i>
                <span><?= __tr('My Photos') ?></span>
            </a>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider mt-2 mb-2" style="border-color: rgba(255,255,255,0.1); margin-left: 8px; margin-right: 8px;">

        <!-- Who likes me -->
        <div class="nav-item <?= makeLinkActive('user.who_liked_me_view') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.who_liked_me_view') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fa fa-thumbs-up" style="color: white; width: 18px; margin-right: 0.75rem;" aria-hidden="true"></i>
                <span style="flex: 1;"><?= __tr('Who likes me') ?></span>
                <?php
                $featurePlans = getStoreSettings('feature_plans');
                $showLike = $featurePlans['show_like']['select_user'];
                ?>
                @if($showLike == 2)
                <span class="lw-premium-feature-badge lw-premium-feature-width" title="{{ __tr('This is Premium feature') }}" style="background: #4F1DA1; border-radius: 50%; width: 16px; height: 16px; display: inline-flex; align-items: center; justify-content: center; margin-left: 4px;"><i class="fas fa-crown" style="font-size: 8px; color: white;"></i></span>
                @endif
            </a>
        </div>

        <!-- Mutual Likes -->
        <div class="nav-item <?= makeLinkActive('user.mutual_like_view') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.mutual_like_view') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fa fa-users" style="color: white; width: 18px; margin-right: 0.75rem;"></i>
                <span><?= __tr('Mutual Likes') ?></span>
            </a>
        </div>

        <!-- My Likes -->
        <div class="nav-item <?= makeLinkActive('user.my_liked_view') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.my_liked_view') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fas fa-fw fa-heart" style="color: white; width: 18px; margin-right: 0.75rem;"></i>
                <span><?= __tr('My Likes') ?></span>
            </a>
        </div>

        <!-- My Dislikes -->
        <div class="nav-item <?= makeLinkActive('user.my_disliked_view') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.my_disliked_view') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fas fa-fw fa-heart-broken" style="color: white; width: 18px; margin-right: 0.75rem;"></i>
                <span><?= __tr('My Dislikes') ?></span>
            </a>
        </div>

        <!-- Visitors -->
        <div class="nav-item <?= makeLinkActive('user.profile_visitors_view') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_visitors_view') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fa fa-user" style="color: <?= makeLinkActive('user.profile_visitors_view') ? 'white' : 'white' ?>; width: 18px; margin-right: 0.75rem;" aria-hidden="true"></i>
                <span><?= __tr('Visitors') ?></span>
            </a>
        </div>

        <!-- Notifications -->
        <div x-data="{totalNotificationCount:'<?= (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' ?>'}" class="nav-item <?= makeLinkActive('user.notification.read.view') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.notification.read.view') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fa fa-bell" style="color: <?= makeLinkActive('user.notification.read.view') ? 'white' : 'white' ?>; width: 18px; margin-right: 0.75rem;" aria-hidden="true"></i>
                <span style="flex: 1;"><?= __tr('Notifications') ?></span>
                <small class="badge" style="background: #ef4444; border-radius: 12px; font-size: 0.75rem; padding: 2px 6px;" x-text="totalNotificationCount" x-show="totalNotificationCount"></small>
            </a>
        </div>

        <!-- Blocked Users -->
        <div class="nav-item <?= makeLinkActive('user.read.block_user_list') ?>">
            <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.read.block_user_list') ?>" onclick="closeMobileSidebar()" style="color: rgba(255,255,255,0.9); font-family: var(--lw-font-family); font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 8px; display: flex; align-items: center; padding: 0.75rem 1rem;">
                <i class="fas fa-ban" style="color: <?= makeLinkActive('user.read.block_user_list') ? 'white' : 'white' ?>; width: 18px; margin-right: 0.75rem;"></i>
                <span><?= __tr('Blocked Users') ?></span>
            </a>
        </div>
    </div>

    <!-- Featured Users Card -->
    <div class="card mt-3 lw-featured-users-block" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; margin: 16px;">
        <h5 class="card-header" style="background: rgba(255,255,255,0.05); color: white; font-family: var(--lw-font-family); font-weight: 600; border-bottom: 1px solid rgba(255,255,255,0.1); border-radius: 12px 12px 0 0; padding: 12px 16px; font-size: 16px;">
            <?= __tr('Featured Users') ?>
        </h5>
        <div class="card-body lw-featured-users" style="padding: 16px;">
            <button type="button" class="btn btn-icon mb-3" id="lw-mobile-featured-users" title="{{ __tr('Get yourself in Featured Users') }}" onclick="closeMobileSidebar()" style="background: linear-gradient(135deg, #4F1DA1, #E78AB0); color: white; border: none; border-radius: 8px; padding: 12px 16px; font-family: var(--lw-font-family); font-weight: 600; width: 100%; transition: all 0.3s ease; transform: translateY(0);"> 
                <i class="fa fa-user-plus mr-2"></i><span><?= __tr('Be Featured') ?></span>
            </button>
            @if(!__isEmpty(getFeatureUserList()))
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                @foreach(getFeatureUserList() as $users)
                <a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_view', ['username' => $users['username']]) ?>" onclick="closeMobileSidebar()" style="display: block; transition: all 0.3s ease;">
                    <img class="img-fluid img-thumbnail lw-sidebar-thumbnail lw-lazy-img" data-src="<?= $users['userImageUrl'] ?>" style="border: 2px solid rgba(255,255,255,0.2); border-radius: 8px; width: 100%; height: 60px; object-fit: cover; transition: all 0.3s ease;">
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
    /* Mobile Sidebar Hover Effects - Loversnmore Design */
    #mobileSidebar .nav-item a:hover {
        background: rgba(244, 233, 255, 0.2) !important; /* Lavender hover */
    }

    #mobileSidebar .nav-item a:active,
    #mobileSidebar .nav-item.active a {
        background: rgba(244, 233, 255, 0.25) !important; /* Lavender active */
    }

    /* Featured Users Button Hover */
    #lw-mobile-featured-users:hover {
        background: linear-gradient(135deg, #5B2BB5, #F4A5C4) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(79, 29, 161, 0.3) !important;
    }

    /* Featured User Thumbnails Hover */
    #mobileSidebar .lw-featured-users a:hover img {
        border-color: #E78AB0 !important; /* Pink border */
        transform: scale(1.05);
    }

    /* Close Button Hover */
    #mobileSidebar button:hover {
        background: rgba(244, 233, 255, 0.3) !important;
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
