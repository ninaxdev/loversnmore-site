<!-- Enhanced Modern Topbar -->
<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top" style="background: var(--lw-white); box-shadow: 0 4px 20px rgba(51, 25, 107, 0.08); border-radius: 0 0 var(--lw-radius-lg) var(--lw-radius-lg); font-family: var(--lw-font-family); backdrop-filter: blur(10px); border-bottom: 1px solid var(--lw-gray-200);">
    
    <!-- Mobile Sidebar Toggle -->
    <button type="button" id="sidebarToggleTop" class="btn btn-link d-block d-md-none rounded-circle mr-3 lw-mobile-toggle" style="color: var(--lw-primary); border: 2px solid var(--lw-gradient-start); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; transition: var(--lw-transition); background: rgba(197, 62, 141, 0.05); backdrop-filter: blur(5px);">
        <i class="fa fa-bars" style="color: var(--lw-primary); font-size: 16px;"></i>
    </button>
    
    <!-- Left Navigation Items -->
    <ul class="navbar-nav ml-0">
        <!-- Enhanced Search Dropdown -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle lw-search-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: var(--lw-primary); font-family: var(--lw-font-family); font-weight: 500; transition: var(--lw-transition); border-radius: var(--lw-radius-sm); padding: 12px 16px; background: rgba(197, 62, 141, 0.05); backdrop-filter: blur(5px);">
                <i class="fas fa-search fa-sm mr-2" style="color: var(--lw-gradient-start); font-size: 16px;"></i>
                <span class="d-md-inline-block d-none"><?= __tr('Find Matches') ?></span>
            </a>

            <?php
            $allUnreadMsgCount=getUsersAllConversationCount();
            $lookingFor = getUserSettings('looking_for');
            $minAge = getUserSettings('min_age');
            $maxAge = getUserSettings('max_age');
            $request = request();

            if ($request->session()->has('userSearchData')) {
                $userSearchData = session('userSearchData');
                $lookingFor = $userSearchData['looking_for'];
                $minAge = $userSearchData['min_age'];
                $maxAge = $userSearchData['max_age'];
            }
            ?>

            <!-- Enhanced Search Dropdown Form -->
            <div class="dropdown-menu lw-search-dropdown shadow animated--grow-in" aria-labelledby="searchDropdown" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(197, 62, 141, 0.2); border-radius: var(--lw-radius-lg); min-width: 320px; max-width: 95vw; width: 420px; box-shadow: 0 20px 50px rgba(51, 25, 107, 0.15); padding: var(--lw-space-lg);">
                
                <!-- Search Header -->
                <div class="dropdown-header mb-3" style="background: var(--lw-gradient-main); color: white; border-radius: var(--lw-radius-md); padding: var(--lw-space-md); margin: -8px -8px 16px -8px;">
                    <h6 class="mb-0" style="font-family: var(--lw-font-family); font-weight: 600; font-size: var(--lw-font-size-base);">
                        <i class="fas fa-heart mr-2"></i><?= __tr('Find Your Perfect Match') ?>
                    </h6>
                </div>

                <form class="lw-ajax-form lw-action-with-url" method="get" data-title="{{ __tr('Find Matches') }}" data-show-processing="true" action="<?= route('user.read.find_matches') ?>">
                    
                    <!-- Name Field -->
                    <div class="lw-form-group mb-3">
                        <label for="name" class="lw-form-label"><?= __tr('Name') ?></label>
                        <input type="text" class="form-control lw-form-input" name="name" value="" placeholder="<?= __tr('Enter name...') ?>">
                    </div>

                    <!-- Username Field -->
                    <div class="lw-form-group mb-3">
                        <label for="username" class="lw-form-label"><?= __tr('Username') ?></label>
                        <input type="text" class="form-control lw-form-input" name="username" value="" placeholder="<?= __tr('Enter username...') ?>">
                    </div>

                    <!-- Looking For Field -->
                    <div class="lw-form-group mb-3">
                        <label for="looking_for" class="lw-form-label"><?= __tr('Looking For') ?></label>
                        <select name="looking_for" class="form-control lw-form-select" id="looking_for">
                            <option value="all"><?= __tr('All') ?></option>
                            @foreach(configItem('user_settings.gender') as $genderKey => $gender)
                            <option value="<?= $genderKey ?>" <?= ($request->looking_for == $genderKey or $genderKey == $lookingFor) ? 'selected' : '' ?>><?= $gender ?></option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Age Range Fields -->
                    <div class="lw-form-group mb-3">
                        <label class="lw-form-label"><?= __tr('Age Range') ?></label>
                        <div class="row">
                            <div class="col-6">
                                <select name="min_age" class="form-control lw-form-select" id="min_age">
                                    @foreach(range(18,70) as $age)
                                    <option value="<?= $age ?>" <?= ($request->min_age == $age or $age == $minAge) ? 'selected' : '' ?>><?= $age ?></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="max_age" class="form-control lw-form-select" id="max_age">
                                    @foreach(range(18,70) as $age)
                                    <option value="<?= $age ?>" <?= ($request->max_age == $age or $age == $maxAge) ? 'selected' : '' ?>><?= $age ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Distance Field -->
                    <div class="lw-form-group mb-3">
                        <label for="distance" class="lw-form-label"><?= __tr('Distance From My Location (__distanceUnit__)', ['__distanceUnit__' => (getStoreSettings('distance_measurement') == '6371') ? __tr('KM') : __tr('Miles')]) ?></label>
                        <input type="number" min="1" class="form-control lw-form-input" name="distance" value="<?= ($request->distance != null) ? $request->distance : getUserSettings('distance') ?>" placeholder="<?= __tr('Anywhere') ?>">
                    </div>

                    <!-- Verified Users Checkbox -->
                    <div class="lw-form-group mb-4">
                        <div class="lw-custom-checkbox">
                            <input type="hidden" name="user_type" value="0">
                            <input type="checkbox" class="lw-checkbox-input" id="userType" name="user_type" value="1" <?= ($request->user_type == '1') ? 'checked' : '' ?>>
                            <label class="lw-checkbox-label" for="userType">
                                <span class="lw-checkbox-custom"></span>
                                <span class="lw-checkbox-text"><?= __tr('Only Verified Users') ?></span>
                            </label>
                        </div>
                    </div>

                    <!-- Enhanced Search Button -->
                    <div class="lw-form-group">
                        <button type="submit" class="btn lw-search-btn w-100">
                            <i class="fas fa-search mr-2"></i><?= __tr('Find Matches') ?>
                        </button>
                    </div>
                </form>
            </div>
        </li>
    </ul>
    
    <!-- Enhanced Premium Button -->
    @if(!isPremiumUser())
    <a href="<?= route('user.premium_plan.read.view') ?>" class="btn btn-sm lw-ajax-link-action lw-action-with-url lw-premium-btn" title="<?= __tr('Be Premium User') ?>">
        <i class="fas fa-crown mr-2"></i><?= __tr('Go Premium') ?>
    </a>
    @endif

    <!-- Right Navigation Items -->
    <ul class="navbar-nav ml-auto" x-data="{ totalUnreadMsgCount: <?= $allUnreadMsgCount  ?> }">
        
        <!-- Enhanced Messenger Link -->
        <li class="nav-item d-none d-sm-none d-md-block">
            <a class="nav-link lw-nav-icon" onclick="getChatMessenger('<?= route('user.read.all_conversation') ?>', true)" id="lwAllMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog" title="<?= __tr('Messages') ?>">
               <div class="lw-icon-wrapper">
                   <i class="far fa-comments"></i>
                   <span class="lw-notification-badge" data-model="totalUnreadMsgCount" x-show="totalUnreadMsgCount > 0" x-cloak x-text="totalUnreadMsgCount > 99 ? '99+' : totalUnreadMsgCount"></span>
               </div>
            </a>
        </li>
        
        <!-- Enhanced Notification Link -->
        <li class="nav-item dropdown no-arrow mx-1 d-none d-sm-none d-md-block">
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
        <li class="nav-item d-none d-sm-none d-md-block">
            <a class="nav-link lw-ajax-link-action lw-action-with-url lw-credit-link" href="<?= route('user.credit_wallet.read.view') ?>" data-title="{{ __tr('Credit Wallet') }}" title="<?= __tr('Credits') ?>">
                <div class="lw-credit-display">
                    <i class="fas fa-coins mr-2"></i>
                    <span class="lw-credit-amount" id="lwTotalCreditWalletAmt"><?= totalUserCredits() ?></span>
                </div>
            </a>
        </li>

        <!-- Enhanced Profile Booster -->
        <li class="nav-item d-none d-sm-none d-md-block">
            <a class="nav-link lw-ajax-link-action lw-booster-link" method="get" data-callback="updateBoosterPrice" href="<?= route('user.read.booster_data') ?>" onclick="showBoosterAlert()" title="<?= __tr('Profile Booster') ?>">
                <div class="lw-booster-display">
                    <i class="fas fa-bolt mr-2"></i>
                    <span class="lw-booster-timer" id="lwBoosterTimerCountDown"></span>
                </div>
            </a>
        </li>
        
        <!-- Enhanced Admin Panel Link -->
        @if(isAdmin())
        <li class="nav-item d-none d-sm-none d-md-block">
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

        <!-- Enhanced User Profile Dropdown -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle lw-profile-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="lw-profile-avatar">
                    <img class="lw-avatar-img lw-lazy-img lw-photoswipe-gallery-img" data-src="<?= imageOrNoImageAvailable(getUserAuthInfo('profile.profile_picture_url')) ?>" alt="<?= getUserAuthInfo('profile.full_name') ?>">
                    @if(isPremiumUser())
                    <div class="lw-premium-crown">
                        <i class="fas fa-crown"></i>
                    </div>
                    @endif
                </div>
            </a>
            
            <!-- Enhanced User Dropdown Menu -->
            <div class="dropdown-menu dropdown-menu-right lw-profile-dropdown shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- Card Header with Profile Info -->
                <div class="lw-profile-card-header">
                    <div class="lw-profile-avatar-large">
                        <img src="<?= imageOrNoImageAvailable(getUserAuthInfo('profile.profile_picture_url')) ?>" alt="Profile">
                        @if(isPremiumUser())
                        <div class="lw-premium-badge">
                            <i class="fas fa-crown"></i>
                        </div>
                        @endif
                    </div>
                    <div class="lw-user-name-large"><?= getUserAuthInfo('profile.full_name') ?></div>
                    <div class="lw-user-username-large">@<?= getUserAuthInfo('profile.username') ?></div>
                </div>
                
                <!-- Card Body with Button-style Menu Items -->
                <div class="lw-profile-card-body">
                    <a class="lw-profile-card-btn lw-ajax-link-action lw-action-with-url" data-event-callback="lwPrepareUploadPlugIn" title="<?= __tr('My Profile') ?>" href="<?= route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) ?>">
                        <i class="fas fa-user"></i>
                        <span><?= __tr('My Profile') ?></span>
                    </a>
                    
                    <!-- Collapsible Settings Menu -->
                    <div class="lw-settings-group">
                        <a class="lw-profile-card-btn lw-settings-toggle" href="javascript:void(0)" onclick="toggleSettingsMenu(event)">
                            <i class="fas fa-cogs"></i>
                            <span><?= __tr('Settings') ?></span>
                            <i class="fas fa-chevron-down lw-settings-arrow"></i>
                        </a>
                        
                        <!-- Settings Submenu (Collapsible) -->
                        <div class="lw-settings-submenu" style="display: none;">
                            <a class="lw-profile-card-btn lw-profile-card-btn-sm lw-ajax-link-action lw-action-with-url" title="<?= __tr('Notification Settings') ?>" href="<?= route('user.read.setting', ['pageType' => 'notification']) ?>">
                                <i class="fas fa-bell"></i>
                                <span><?= __tr('Notification') ?></span>
                            </a>
                            
                            <a class="lw-profile-card-btn lw-profile-card-btn-sm lw-ajax-link-action lw-action-with-url" title="<?= __tr('Change Email') ?>" href="<?= route('user.change_email') ?>">
                                <i class="fas fa-envelope"></i>
                                <span><?= __tr('Change Email') ?></span>
                            </a>
                            
                            <a class="lw-profile-card-btn lw-profile-card-btn-sm lw-ajax-link-action lw-action-with-url" title="<?= __tr('Change Password') ?>" href="<?= route('user.change_password') ?>">
                                <i class="fas fa-key"></i>
                                <span><?= __tr('Change Password') ?></span>
                            </a>
                        </div>
                    </div>
                    
                    @if(isAdmin())
                    <a class="lw-profile-card-btn lw-ajax-link-action" title="<?= __tr('Admin Panel') ?>" target="_blank" href="<?= route('manage.dashboard') ?>">
                        <i class="fas fa-shield-alt"></i>
                        <span><?= __tr('Admin Panel') ?></span>
                    </a>
                    @endif
                    
                    <a class="lw-profile-card-btn lw-profile-card-btn-logout" title="<?= __tr('Logout') ?>" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt"></i>
                        <span><?= __tr('Logout') ?></span>
                    </a>
                </div>
            </div>
        </li>
    </ul>
</nav>

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

    // Toggle Settings Menu Function
    window.toggleSettingsMenu = function(event) {
        event.preventDefault();
        event.stopPropagation();
        
        var $submenu = $('.lw-settings-submenu');
        var $arrow = $('.lw-settings-arrow');
        
        if ($submenu.is(':visible')) {
            // Collapse
            $submenu.slideUp(250);
            $arrow.removeClass('lw-arrow-rotated');
        } else {
            // Expand
            $submenu.slideDown(250);
            $arrow.addClass('lw-arrow-rotated');
        }
    };

</script>
@lwPushEnd