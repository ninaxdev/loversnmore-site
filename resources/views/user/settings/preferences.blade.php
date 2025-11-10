<!-- App Preferences -->
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
        <h2 class="text-3xl font-bold mb-6" style="color: #1F1638;">Preferences</h2>

    <!-- Preferences Options -->
    <div class="space-y-4">
        <!-- Dark Mode -->
        <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
            <label for="lwDarkMode" class="text-base font-normal cursor-pointer" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                <?= __tr('Dark Mode') ?>
            </label>
            <div class="relative">
                <input type="checkbox" id="lwDarkMode" disabled class="sr-only peer">
                <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600 opacity-50" style="cursor: not-allowed;"></div>
            </div>
        </div>

        <!-- Language Selection -->
        <?php $translationLanguages = getActiveTranslationLanguages(); ?>
        @if(!__isEmpty($translationLanguages) and (count($translationLanguages) > 1))
        <?php $translationLanguages['en_US'] = configItem('default_translation_language');  ?>
        <div>
            <label for="lwLanguageSelect" class="block text-base font-medium mb-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                <?= __tr('Language') ?>
            </label>
            <select id="lwLanguageSelect" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2" onchange="changeLanguage(this.value)" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;">
                <?php foreach ($translationLanguages as $languageId => $language) {
                    if (isset($language['status']) and $language['status'] == false) continue;
                ?>
                    <option value="<?= $languageId ?>" <?= ($languageId == config('CURRENT_LOCALE')) ? 'selected' : '' ?>>
                        <?= $language['name'] ?>
                    </option>
                <?php } ?>
            </select>
            <p class="mt-2 text-sm" style="color: #999; font-family: 'Poppins', sans-serif;"><?= __tr('Choose your preferred language') ?></p>
        </div>
        @endif
    </div>

    <!-- Back to Home Button -->
    <div class="mt-8 flex justify-center">
        <a href="/home" class="lw-ajax-link-action lw-action-with-url px-12 py-3 rounded-full border-2 transition-all duration-200 hover:bg-gray-50" style="border-color: #1F1638; color: #1F1638; font-family: 'Poppins', sans-serif; font-weight: 500; text-decoration: none;">
            Back → Home
        </a>
    </div>
    </div>
</div>

<script>
function changeLanguage(languageId) {
    window.location.href = '<?= route('locale.change', ['localeID' => '__LANGUAGE_ID__']) ?>'.replace('__LANGUAGE_ID__', languageId);
}
</script>
