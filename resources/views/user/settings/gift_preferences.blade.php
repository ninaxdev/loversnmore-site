<!-- Gift Preferences Settings -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-2xl mx-auto">
        <!-- Back to Settings Link -->
        <div class="mb-6">
            <a href="<?= route('user.settings.index') ?>" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Settings') ?>
            </a>
        </div>

        <!-- Section Title -->
        <h2 class="text-3xl font-bold mb-2" style="color: #1F1638;"><?= __tr('Gift Preferences') ?></h2>
        <p class="text-sm mb-6" style="color: #6B7280;"><?= __tr('Control who can send you gifts and how many you receive.') ?></p>

        <!-- Gift Preferences Form -->
        <form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.setting', ['pageType' => 'gift_preferences']) ?>" data-callback="onGiftPreferencesUpdated">
            <div class="space-y-4">

                <!-- Receive Gifts from Non-Matches -->
                <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                    <div>
                        <label for="lwReceiveGiftsNonMatches" class="text-base font-normal cursor-pointer" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                            <?= __tr('Receive gifts from non-matches') ?>
                        </label>
                        <p class="text-xs mt-1" style="color: #6B7280;"><?= __tr('Allow people you haven\'t matched with to send you gifts') ?></p>
                    </div>
                    <div class="relative flex-shrink-0 ml-4">
                        <input type="hidden" name="receive_gifts_from_non_matches" value="false">
                        <input type="checkbox" id="lwReceiveGiftsNonMatches" name="receive_gifts_from_non_matches" value="true"
                            <?= (isset($userSettingData['receive_gifts_from_non_matches']) && $userSettingData['receive_gifts_from_non_matches'] == true) ? 'checked' : '' ?>
                            class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"
                            style="cursor: pointer;" onclick="document.getElementById('lwReceiveGiftsNonMatches').click()"></div>
                    </div>
                </div>

                <!-- Max Gifts Per Day -->
                <div class="py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                    <label for="lwMaxGiftsPerDay" class="text-base font-normal" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                        <?= __tr('Maximum gifts per day') ?>
                    </label>
                    <p class="text-xs mt-1 mb-3" style="color: #6B7280;"><?= __tr('Limit how many gifts you receive in a single day') ?></p>
                    <select id="lwMaxGiftsPerDay" name="max_gifts_per_day"
                        class="w-full py-2 px-4 rounded-2xl text-base"
                        style="background-color: #EDE9FE; border: 1px solid #C4B5FD; color: #1F1638; font-family: 'Poppins', sans-serif; outline: none; cursor: pointer;">
                        <option value="" <?= (empty($userSettingData['max_gifts_per_day'])) ? 'selected' : '' ?>>
                            <?= __tr('Unlimited') ?>
                        </option>
                        <option value="3" <?= (isset($userSettingData['max_gifts_per_day']) && $userSettingData['max_gifts_per_day'] == 3) ? 'selected' : '' ?>>
                            3 <?= __tr('per day') ?>
                        </option>
                        <option value="5" <?= (isset($userSettingData['max_gifts_per_day']) && $userSettingData['max_gifts_per_day'] == 5) ? 'selected' : '' ?>>
                            5 <?= __tr('per day') ?>
                        </option>
                        <option value="10" <?= (isset($userSettingData['max_gifts_per_day']) && $userSettingData['max_gifts_per_day'] == 10) ? 'selected' : '' ?>>
                            10 <?= __tr('per day') ?>
                        </option>
                    </select>
                </div>

            </div>

            <!-- Save Button -->
            <div class="mt-8 flex justify-center">
                <button type="submit" class="lw-ajax-form-submit-action px-12 py-3 rounded-full text-white font-medium transition-all duration-200 hover:opacity-90 hover:scale-105"
                    style="background-color: #7C3AED; font-family: 'Poppins', sans-serif; font-size: 18px; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35);">
                    <?= __tr('Save Changes') ?>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function onGiftPreferencesUpdated(responseData) {
        if (responseData.reaction == 1) {
            _.delay(function() {
                __Utils.viewReload();
            }, 500);
        }
    }
</script>
