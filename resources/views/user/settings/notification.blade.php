<!-- Notification Settings -->
<div class="w-full" style="font-family: 'Poppins', sans-serif;">
    <!-- Back Button and Section Title -->
    <div class="flex items-center gap-3 mb-6">
        <button onclick="window.history.back()" class="flex items-center justify-center w-10 h-10 rounded-full transition-all duration-200 hover:bg-gray-100" style="background-color: transparent; border: none; cursor: pointer;">
            <i class="fas fa-arrow-left" style="color: #1F1638; font-size: 20px;"></i>
        </button>
        <h2 class="text-3xl font-bold" style="color: #1F1638; margin: 0;">Notifications</h2>
    </div>

    <!-- Notification Settings Form -->
    <form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.setting', ['pageType' => request()->pageType]) ?>" data-callback="onUserSettingsUpdated">
        <div class="space-y-4">
            <!-- Show Visitor Notification -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <label for="lwShowVisitorNotify" class="text-base font-normal cursor-pointer" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Show Visitors Notification') ?>
                </label>
                <div class="relative">
                    <input type="hidden" name="show_visitor_notification" value="false">
                    <input type="checkbox" id="lwShowVisitorNotify" name="show_visitor_notification" value="true" <?= $userSettingData['show_visitor_notification'] == true ? 'checked' : '' ?> class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600" style="cursor: pointer;" onclick="document.getElementById('lwShowVisitorNotify').click()"></div>
                </div>
            </div>

            <!-- Show Likes Notification -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <label for="lwShowLikeNotify" class="text-base font-normal cursor-pointer flex items-center gap-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Show Likes Notification') ?>
                    @if(getFeatureSettings('show_like', 'select_user') == '2')
                    <span class="lw-premium-feature-badge" title="{{ __tr('This is Premium feature') }}"></span>
                    @endif
                </label>
                <div class="relative">
                    <input type="hidden" name="show_like_notification" value="false">
                    <input type="checkbox" id="lwShowLikeNotify" name="show_like_notification" value="true" <?= $userSettingData['show_like_notification'] == true ? 'checked' : '' ?> <?= getFeatureSettings('show_like') == true ? '' : 'disabled' ?> class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600 peer-disabled:opacity-50" style="cursor: pointer;" onclick="if(!document.getElementById('lwShowLikeNotify').disabled) document.getElementById('lwShowLikeNotify').click()"></div>
                </div>
            </div>

            <!-- Show Gifts Notification -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <label for="lwShowGiftNotify" class="text-base font-normal cursor-pointer" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Show Gifts Notification') ?>
                </label>
                <div class="relative">
                    <input type="hidden" name="show_gift_notification" value="false">
                    <input type="checkbox" id="lwShowGiftNotify" name="show_gift_notification" value="true" <?= $userSettingData['show_gift_notification'] == true ? 'checked' : '' ?> class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600" style="cursor: pointer;" onclick="document.getElementById('lwShowGiftNotify').click()"></div>
                </div>
            </div>

            <!-- Show Messages Notification -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <label for="lwShowMessageNotify" class="text-base font-normal cursor-pointer" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Show Messages Notification') ?>
                </label>
                <div class="relative">
                    <input type="hidden" name="show_message_notification" value="false">
                    <input type="checkbox" id="lwShowMessageNotify" name="show_message_notification" value="true" <?= $userSettingData['show_message_notification'] == true ? 'checked' : '' ?> class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600" style="cursor: pointer;" onclick="document.getElementById('lwShowMessageNotify').click()"></div>
                </div>
            </div>

            <!-- Show User LoggedIn -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <label for="lwShowLoginNotify" class="text-base font-normal cursor-pointer" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Show Login Notification For Your Liked Users') ?>
                </label>
                <div class="relative">
                    <input type="hidden" name="show_user_login_notification" value="false">
                    <input type="checkbox" id="lwShowLoginNotify" name="show_user_login_notification" value="true" <?= $userSettingData['show_user_login_notification'] == true ? 'checked' : '' ?> class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600" style="cursor: pointer;" onclick="document.getElementById('lwShowLoginNotify').click()"></div>
                </div>
            </div>

            <!-- Display Mobile Number -->
            @if(getStoreSettings('display_mobile_number') == 2)
            <div>
                <label for="lwDisplayMobileNumber" class="block text-base font-medium mb-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Display Mobile Number') ?>
                </label>
                <select id="lwDisplayMobileNumber" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2" name="display_user_mobile_number" required style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;">
                    @foreach($userSettingData['user_choice_display_mobile_number'] as $key => $userChoice)
                    <option value="<?= $key ?>" <?= ($userSettingData['display_user_mobile_number'] == $key) ? 'selected' : '' ?>><?= $userChoice ?></option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="mt-8 flex justify-center">
            <button type="submit" class="lw-ajax-form-submit-action px-12 py-3 rounded-full text-white font-medium transition-all duration-200 hover:opacity-90 hover:scale-105" style="background-color: #7C3AED; font-family: 'Poppins', sans-serif; font-size: 18px; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35);">
                <?= __tr('Save Changes') ?>
            </button>
        </div>
    </form>
</div>

<script>
    function onUserSettingsUpdated(responseData) {
        //check reaction code is 1 then reload view
        if (responseData.reaction == 1) {
            _.delay(function() {
                __Utils.viewReload();
            }, 500);
        }
    }
</script>
