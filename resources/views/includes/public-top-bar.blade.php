<!-- Enhanced Modern Topbar -->
<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top" style="background: var(--lw-white); box-shadow: 0 4px 20px rgba(51, 25, 107, 0.08); border-radius: 0 0 var(--lw-radius-lg) var(--lw-radius-lg); font-family: var(--lw-font-family); backdrop-filter: blur(10px); border-bottom: 1px solid var(--lw-gray-200);">
    
    <!-- Mobile Sidebar Toggle -->
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-block d-lg-none rounded-circle mr-3 lw-mobile-toggle" style="color: var(--lw-primary); border: 2px solid var(--lw-gradient-start); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; transition: var(--lw-transition); background: rgba(197, 62, 141, 0.05); backdrop-filter: blur(5px);">
        <i class="fa fa-bars" style="color: var(--lw-primary); font-size: 16px;"></i>
    </button>
    
    <!-- Discovery Feed Link -->
    <ul class="navbar-nav ml-0">
        <li class="nav-item">
            <a class="nav-link lw-ajax-link-action lw-action-with-url" href="<?= route('user.read.discovery') ?>" style="color: var(--lw-primary); font-family: var(--lw-font-family); font-weight: 500; transition: var(--lw-transition); border-radius: var(--lw-radius-sm); padding: 12px 16px; background: rgba(197, 62, 141, 0.05); backdrop-filter: blur(5px);">
                <i class="fas fa-heart fa-sm mr-2" style="color: var(--lw-gradient-start); font-size: 16px;"></i>
                <span class="d-lg-inline-block d-none"><?= __tr('Discover') ?></span>
            </a>
        </li>
    </ul>

    <?php
    $allUnreadMsgCount=getUsersAllConversationCount();
    ?>

    <!-- Enhanced Premium Button -->
    @if(!isPremiumUser())
    <a href="<?= route('user.premium_plan.read.view') ?>" class="btn btn-sm lw-ajax-link-action lw-action-with-url lw-premium-btn" title="<?= __tr('Be Premium User') ?>">
        <i class="fas fa-crown mr-2"></i><?= __tr('Go Premium') ?>
    </a>
    @endif

    <!-- Right Navigation Items -->
    <ul class="navbar-nav ml-auto" x-data="{ totalUnreadMsgCount: <?= $allUnreadMsgCount  ?> }">
        
        <!-- Enhanced Messenger Link -->
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link lw-nav-icon" onclick="getChatMessenger('<?= route('user.read.all_conversation') ?>', true)" id="lwAllMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog" title="<?= __tr('Messages') ?>">
               <div class="lw-icon-wrapper">
                   <i class="far fa-comments"></i>
                   <span class="lw-notification-badge" data-model="totalUnreadMsgCount" x-show="totalUnreadMsgCount > 0" x-cloak x-text="totalUnreadMsgCount > 99 ? '99+' : totalUnreadMsgCount"></span>
               </div>
            </a>
        </li>
        
        <!-- Enhanced Notification Link -->
        <li class="nav-item dropdown no-arrow mx-1 d-none d-lg-block">
            <a class="nav-link dropdown-toggle lw-ajax-link-action lw-notification-dropdown-toggle lw-nav-icon" href="<?= route('user.notification.write.read_all_notification') ?>" data-callback="onReadAllNotificationCallback" id="alertsDropdown" role="button" aria-haspopup="true" aria-expanded="false" data-method="post" title="<?= __tr('Notifications') ?>">
                <div class="lw-icon-wrapper">
                    <i class="fas fa-bell fa-fw"></i>
                    <span class="lw-notification-badge" data-model="totalNotificationCount"><?= (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' ?></span>
                </div>
            </a>
            
            <!-- Enhanced Notification Dropdown -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right lw-notification-dropdown shadow animated--grow-in" aria-labelledby="alertsDropdown" id="dropdownAlerts">
                <div class="lw-dropdown-header">
                    <i class="fas fa-bell mr-2"></i><?= __tr('Notifications') ?>
                </div>
                <div id="lwNotificationContent" class="lw-notification-content"></div>
                <script type="text/_template" id="lwNotificationListTemplate">
                    <% if(!_.isEmpty(__tData.notificationList)) { %>
						<% _.forEach(__tData.notificationList, function(notification) { %>
							<a class="lw-notification-item lw-ajax-link-action lw-action-with-url" href="<%- notification['actionUrl'] %>">
                                <div class="lw-notification-content">
                                    <div class="lw-notification-message"><%- notification['message'] %></div>
                                    <div class="lw-notification-time"><%- notification['created_at'] %></div>
                                </div>
							</a>
						<% }); %>
						<a class="lw-notification-footer lw-ajax-link-action lw-action-with-url" href="<?= route('user.notification.read.view') ?>" id="lwShowAllNotifyLink" data-show-if="showAllNotifyLink"><?= __tr('View All Notifications') ?></a>
					<% } else { %>
						<div class="lw-notification-empty"><?= __tr('No new notifications') ?></div>
					<% } %>
				</script>
            </div>
        </li>

        <!-- Enhanced Credit Wallet -->
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link lw-ajax-link-action lw-action-with-url lw-credit-link" href="<?= route('user.credit_wallet.read.view') ?>" data-title="{{ __tr('Credit Wallet') }}" title="<?= __tr('Credits') ?>">
                <div class="lw-credit-display">
                    <i class="fas fa-coins mr-2"></i>
                    <span class="lw-credit-amount" id="lwTotalCreditWalletAmt"><?= totalUserCredits() ?></span>
                </div>
            </a>
        </li>

        <!-- Enhanced Profile Booster -->
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link lw-ajax-link-action lw-booster-link" method="get" data-callback="updateBoosterPrice" href="<?= route('user.read.booster_data') ?>" onclick="showBoosterAlert()" title="<?= __tr('Profile Booster') ?>">
                <div class="lw-booster-display">
                    <i class="fas fa-bolt mr-2"></i>
                    <span class="lw-booster-timer" id="lwBoosterTimerCountDown"></span>
                </div>
            </a>
        </li>
        
        <!-- Enhanced Admin Panel Link -->
        @if(isAdmin())
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link lw-admin-link" title="<?= __tr('Admin Panel') ?>" href="<?= route('manage.dashboard') ?>">
                <i class="fas fa-cogs mr-2"></i>
                <span class="d-none d-lg-inline"><?= __tr('Admin') ?></span>
            </a>
        </li>
        @endif
        
        <!-- Enhanced Language Dropdown -->
        <?php $translationLanguages = getActiveTranslationLanguages(); ?>
        @if(!__isEmpty($translationLanguages) and (count($translationLanguages) > 1))
        <?php $translationLanguages['en_US'] = configItem('default_translation_language');  ?>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle lw-language-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-language mr-2"></i>
                <span class="d-none d-lg-inline"><?= (isset($translationLanguages[config('CURRENT_LOCALE')])) ? $translationLanguages[config('CURRENT_LOCALE')]['name'] : '' ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right lw-language-dropdown shadow animated--grow-in" aria-labelledby="languageDropdown">
                <div class="lw-dropdown-header">
                    <i class="fas fa-globe mr-2"></i><?= __tr('Choose Language') ?>
                </div>
                <div class="dropdown-divider"></div>
                <?php foreach ($translationLanguages as $languageId => $language) {
                    if ($languageId == config('CURRENT_LOCALE') or (isset($language['status']) and $language['status'] == false)) continue;
                ?>
                    <a class="lw-language-item lw-ajax-link-action" data-callback="__Utils.viewReload" href="<?= route('locale.change', ['localeID' => $languageId]);  ?>">
                        <?= $language['name'] ?>
                    </a>
                <?php } ?>
            </div>
        </li>
        @endif

        <!-- User Profile Button -->
        <li class="nav-item">
            <a class="nav-link lw-profile-toggle" href="#" id="userProfileButton">
                <div class="lw-profile-avatar">
                    <img class="lw-avatar-img lw-lazy-img lw-photoswipe-gallery-img" data-src="<?= imageOrNoImageAvailable(getUserAuthInfo('profile.profile_picture_url')) ?>" alt="<?= getUserAuthInfo('profile.full_name') ?>">
                    @if(isPremiumUser())
                    <div class="lw-premium-crown">
                        <i class="fas fa-crown"></i>
                    </div>
                    @endif
                </div>
            </a>
        </li>
    </ul>
</nav>

<!-- User Profile Modal -->
<div id="userProfileModal" class="fixed inset-0 hidden" style="font-family: 'Poppins', sans-serif; z-index: 9999;">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black bg-opacity-50" id="modalBackdrop" style="z-index: 1;"></div>

    <!-- Modal Content - Full screen on mobile, with sidebar space on desktop -->
    <div class="fixed inset-0 md:left-64 bg-white overflow-y-auto" style="z-index: 2;">
        <!-- Close Button -->
        <div class="absolute top-4 right-4 z-20">
            <button id="closeProfileModal" class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200 hover:bg-gray-100" style="background-color: #F5F0FF;">
                <i class="fas fa-times text-xl" style="color: #7C3AED;"></i>
            </button>
        </div>

        <!-- Content Container -->
        <div class="w-full py-12 px-4">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold mb-8" style="color: #1F1638;">Home</h2>

                <!-- Profile Picture -->
                <div class="flex justify-center mb-4">
                    <img class="rounded-full object-cover" src="<?= imageOrNoImageAvailable(getUserAuthInfo('profile.profile_picture_url')) ?>" alt="<?= getUserAuthInfo('profile.full_name') ?>" style="width: 140px; height: 140px;">
                </div>
            </div>

            <!-- Icon Grid -->
            <div class="max-w-md mx-auto w-full px-4" style="max-width: 28rem;">
                <!-- First Row -->
                <div class="grid grid-cols-3 gap-6 mb-6" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <!-- Account -->
                    <a href="<?= route('user.settings.account') ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #E9D8FD;">
                            <i class="fas fa-user text-2xl" style="color: #7C3AED;"></i>
                        </div>
                        <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Account') ?></span>
                    </a>

                    <!-- Notifications -->
                    <a href="<?= route('user.read.setting', ['pageType' => 'notification']) ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #FCE7F3;">
                            <i class="far fa-bell text-2xl" style="color: #EC4899;"></i>
                        </div>
                        <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Notifications') ?></span>
                    </a>

                    <!-- Privacy -->
                    <a href="<?= route('user.settings.privacy') ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center ">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #FCE7F3;">
                            <i class="fas fa-shield-alt text-2xl" style="color: #EC4899;"></i>
                        </div>
                        <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Privacy') ?></span>
                    </a>
                </div>

                <!-- Second Row -->
                <div class="grid grid-cols-3 gap-6 mb-6" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <!-- Preferences -->
                    <a href="<?= route('user.settings.preferences') ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center ">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #FCE7F3;">
                            <i class="far fa-heart text-2xl" style="color: #EC4899;"></i>
                        </div>
                        <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Preferences') ?></span>
                    </a>

                    <!-- My Photos -->
                    <a href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center" data-event-callback="lwPrepareUploadPlugIn">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #E9D8FD;">
                            <i class="fas fa-image text-2xl" style="color: #7C3AED;"></i>
                        </div>
                        <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('My Photos') ?></span>
                    </a>

                    <!-- Visitors -->
                    <a href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center " data-event-callback="lwPrepareUploadPlugIn">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #E9D8FD;">
                            <i class="fas fa-eye text-2xl" style="color: #7C3AED;"></i>
                        </div>
                        <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Visitors') ?></span>
                    </a>
                </div>

                @if(isAdmin())
                <!-- Admin Panel (if admin) -->
                <div class="mb-6 flex justify-center">
                    <a href="<?= route('manage.dashboard') ?>" target="_blank" class="flex flex-col items-center ">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #FEE2E2;">
                            <i class="fas fa-shield-alt text-2xl" style="color: #DC2626;"></i>
                        </div>
                        <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Admin Panel') ?></span>
                    </a>
                </div>
                @endif

                <!-- Logout Button -->
                <div class="mt-8">
                    <a href="<?= route('user.logout') ?>" class="block w-full py-2 rounded-full font-normal text-lg text-white text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl" style="background-color: #7C3AED; font-family: 'Poppins', sans-serif; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35); text-decoration: none;">
                        <?= __tr('Logout') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Booster Message Hidden -->
<div class="d-none" id="boosterMsg">
    <?= __tr('By boosting your profile you will be a part of featured user and will a get priority in search and random users. It will costs you __boosterPrice__ credits for immediate __boosterPeriod__ minutes', [
        '__boosterPrice__' => '<strong id="lwBoosterPrice">' . (isPremiumUser() ? getStoreSettings('booster_price_for_premium_user') : getStoreSettings('booster_price')) . '</strong>',
        '__boosterPeriod__' => '<strong id="lwBoosterPeriod">' . getStoreSettings('booster_period') . '</strong>'
    ]) ?>
</div>

<div class="alert alert-info" id="lwBoosterCreditsNotAvailable" style="display: none;">
    <?= __tr('Your credit balance is too low, please') ?>
    <a href="<?= route('user.credit_wallet.read.view') ?>"><?= __tr('purchase credits') ?></a>
</div>

<!-- Image Gallery Include -->
@include('includes.image-gallery')



<!-- End of Enhanced Topbar -->
@lwPush('appScripts')
<script>
    // Update models for reactive data
    __DataRequest.updateModels({
        totalUnreadMsgCount:'<?= $allUnreadMsgCount?>'
    });

    // Enhanced Featured Users Click Handler
    $('#lw-default-featured-users').on('click', function(){
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

    // Premium view redirect
    function premiumView() {
        window.location.href = '<?= route("user.premium_plan.read.view") ?>';
    }

    // Enhanced Booster Alert
    function showBoosterAlert() {
        var message = $("#boosterMsg").text();
        showConfirmation(message, function() {
            var requestUrl = '<?= route('user.write.boost_profile') ?>';
            __DataRequest.post(requestUrl, null, function(response) {
                onProfileBoosted(response);
            });
        }, {
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmBtnColor: '#10b981',
            confirmButtonText: '<i class="fas fa-bolt fa-fw mr-2"></i><?= __tr('Activate Boost') ?>',
            confirmButtonAriaLabel: 'Activate profile boost',
            type: "success",
            background: 'var(--lw-white)',
            customClass: {
                popup: 'lw-swal-popup',
                confirmButton: 'lw-swal-confirm',
                cancelButton: 'lw-swal-cancel'
            }
        });
    }

    // Enhanced window resize handler
    window.onresize = function() {
        _.delay(function() {
            $('#cboxWrapper,#colorbox').height($('#cboxContent').height());
            $('#cboxWrapper,#colorbox').width($('#cboxContent').width() - 5);
        }, 300);
    };

    // Update booster price callback
    updateBoosterPrice = function(response) {
        if (response.reaction == 1) {
            $("#lwBoosterPeriod").html(response.data.booster_period);
            $("#lwBoosterPrice").html(response.data.booster_price);
        }
    };

    // Enhanced profile boosted callback
    onProfileBoosted = function(response) {
        if (_.has(response.data, 'boosterExpiry')) {
            activateBooster(response.data.boosterExpiry);
        }
        
        if (_.has(response.data, 'creditsRemaining')) {
            $("#lwTotalCreditWalletAmt").html(response.data.creditsRemaining);
            
            // Add success animation
            $("#lwTotalCreditWalletAmt").addClass('animate__animated animate__pulse');
            setTimeout(() => {
                $("#lwTotalCreditWalletAmt").removeClass('animate__animated animate__pulse');
            }, 1000);
        }
        
        if (_.has(response.data, 'insufficientCredits')) {
            var message = $("#lwBoosterCreditsNotAvailable").html();
            showConfirmation(message, function() {
                window.location.href = '<?= route('user.credit_wallet.read.view') ?>';
            }, {
                confirmButtonText:"<i class='fas fa-coins mr-2'></i><?= __tr('Purchase Credits') ?>",
                confirmBtnColor: '#f59e0b',
                background: 'var(--lw-white)',
                customClass: {
                    popup: 'lw-swal-popup',
                    confirmButton: 'lw-swal-warning'
                }
            });
        }
    };

    var boosterInterval;

    // Enhanced booster countdown
    activateBooster = function(boosterExpiry) {
        clearInterval(boosterInterval);
        if (boosterExpiry > 0) {
            var boosterExpiryTime = (new Date().getTime()) + (boosterExpiry * 1000);
            
            boosterInterval = setInterval(function() {
                var now = new Date().getTime();
                var timeRemaining = boosterExpiryTime - now;
                var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
                
                var timeString = ("0" + hours.toString()).slice(-2) + ":" + 
                               ("0" + minutes.toString()).slice(-2) + ":" + 
                               ("0" + seconds.toString()).slice(-2);
                
                $('#lwBoosterTimerCountDown,#lwBoosterTimerCountDownOnSB').html(timeString);
                
                // Add pulsing effect when time is low
                if (timeRemaining < 300000) { // 5 minutes
                    $('#lwBoosterTimerCountDown').addClass('animate__animated animate__pulse animate__infinite');
                }
                
                if (timeRemaining < 0) {
                    clearInterval(boosterInterval);
                    $('#lwBoosterTimerCountDown,#lwBoosterTimerCountDownOnSB').html("");
                    $('#lwBoosterTimerCountDown').removeClass('animate__animated animate__pulse animate__infinite');
                }
            }, 1000);
        }
    };

    // Initialize booster
    activateBooster(<?= getProfileBoostTime() ?>);

    // Enhanced RTL support
    function setTextDirection(isRtl) {
        if (isRtl) {
            $('html').attr('dir', 'rtl');
            $('.topbar').addClass('rtl-support');
        }
    }

    // Language detection and RTL setup
    var translationLanguages = '<?= (!__isEmpty($translationLanguages)) ? json_encode($translationLanguages) : null ?>',
        currentLocale = "<?= config('CURRENT_LOCALE') ?>";
        
    if (!_.isEmpty(translationLanguages)) {
        if (!_.isUndefined(JSON.parse(translationLanguages)[currentLocale])) {
            var selectedLang = JSON.parse(translationLanguages)[currentLocale];
            if (selectedLang['is_rtl']) {
                setTextDirection(true);
            }
        }
    }

    // Enhanced notification system
    <?php $getNotificationList = getNotificationList() ?>;
    var template = _.template($("#lwNotificationListTemplate").html());
    $("#lwNotificationContent").html(template({
        'notificationList': JSON.parse('<?= json_encode($getNotificationList['notificationData']) ?>'),
    }));

    // Enhanced notification read callback
    function onReadAllNotificationCallback(responseData) {
        if (responseData.reaction == 1) {
            __DataRequest.updateModels({
                'totalNotificationCount': '',
            });
            
            // Add success feedback
            $('.lw-notification-badge').fadeOut(300);
        }
    }

    // Enhanced notification dropdown toggle
    $('body').on('click', '.lw-notification-dropdown-toggle', function (ev) {
        ev.preventDefault();
        var $dropdown = $(this).parents('.dropdown');
        var $menu = $(this).parent().find('.dropdown-menu');
        
        $dropdown.toggleClass('show');
        $menu.toggleClass('show');
        
        // Add smooth animation and mobile positioning
        if ($menu.hasClass('show')) {
            $menu.css({
                'animation': 'slideDown 0.3s ease-out',
                'transform-origin': 'top center'
            });
            
            // Position for mobile
            if ($(window).width() <= 768) {
                $menu.css({
                    'position': 'fixed',
                    'left': '50%',
                    'transform': 'translateX(-50%)',
                    'max-width': '95vw'
                });
            }
        }
    });

    // Enhanced dropdown positioning for mobile
    $(document).ready(function() {
        function positionDropdown($dropdown) {
            var windowWidth = $(window).width();
            
            if (windowWidth <= 768) {
                // Position dropdown centered on mobile
                $dropdown.css({
                    'position': 'fixed',
                    'left': '50%',
                    'right': 'auto',
                    'transform': 'translateX(-50%)',
                    'max-width': '95vw',
                    'margin': '0'
                });
                
                // Adjust top position to ensure it's visible
                var dropdownTop = $dropdown.offset().top;
                var dropdownHeight = $dropdown.outerHeight();
                var windowHeight = $(window).height();
                
                if (dropdownTop + dropdownHeight > windowHeight) {
                    $dropdown.css('top', 'auto');
                    $dropdown.css('bottom', '10px');
                }
            } else {
                // Reset to default positioning on desktop
                $dropdown.css({
                    'position': '',
                    'left': '',
                    'right': '',
                    'transform': '',
                    'max-width': '',
                    'margin': '',
                    'top': '',
                    'bottom': ''
                });
            }
        }
        
        $('.dropdown').on('show.bs.dropdown', function() {
            var $dropdown = $(this).find('.dropdown-menu');
            positionDropdown($dropdown);
        });
        
        // Reposition on window resize
        $(window).on('resize', _.debounce(function() {
            $('.dropdown-menu.show').each(function() {
                positionDropdown($(this));
            });
        }, 100));
        
        // Prevent horizontal scroll on mobile
        if ($(window).width() <= 768) {
            $('body, #wrapper, #content-wrapper').css({
                'overflow-x': 'hidden',
                'max-width': '100vw'
            });
        }
    });

    // Enhanced search form validation
    $('.lw-search-btn').on('click', function(e) {
        var $form = $(this).closest('form');
        var hasValue = false;
        
        $form.find('input[type="text"], select').each(function() {
            if ($(this).val() && $(this).val() !== 'all') {
                hasValue = true;
                return false;
            }
        });
        
        if (!hasValue) {
            e.preventDefault();
            $(this).addClass('animate__animated animate__shake');
            setTimeout(() => {
                $(this).removeClass('animate__animated animate__shake');
            }, 600);
        }
    });

    // Add loading states for navigation items (without rotation)
    $('.lw-nav-icon').on('click', function() {
        $(this).addClass('loading');
        setTimeout(() => {
            $(this).removeClass('loading');
        }, 2000);
    });

    // Settings functionality removed - now uses dedicated settings page

    // User Profile Modal
    $(document).ready(function() {
        const modal = $('#userProfileModal');

        // Open modal when profile button is clicked
        $('#userProfileButton').on('click', function(e) {
            e.preventDefault();
            modal.removeClass('hidden');
            $('body').css('overflow', 'hidden');
        });

        // Close modal when close button is clicked
        $('#closeProfileModal').on('click', function(e) {
            e.preventDefault();
            modal.addClass('hidden');
            $('body').css('overflow', '');
        });

        // Close modal when backdrop is clicked
        $('#modalBackdrop').on('click', function() {
            modal.addClass('hidden');
            $('body').css('overflow', '');
        });

        // Close modal when any link inside the modal is clicked
        $('#userProfileModal a').on('click', function() {
            modal.addClass('hidden');
            $('body').css('overflow', '');
        });
    });

</script>
@lwPushEnd