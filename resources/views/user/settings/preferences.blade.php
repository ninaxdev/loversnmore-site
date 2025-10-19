<!-- App Preferences -->
<div class="lw-preferences-settings-container">
    <!-- Preferences Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-sliders-h mr-2"></i><?= __tr('App Preferences') ?>
        </h1>
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle mr-2"></i>
        <?= __tr('Customize your app experience with these preferences.') ?>
    </div>

    <!-- Preferences Options -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= __tr('Display Preferences') ?></h5>
            
            <!-- Dark Mode -->
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="darkMode" disabled>
                    <label class="custom-control-label" for="darkMode">
                        <i class="fas fa-moon mr-2"></i><?= __tr('Dark Mode') ?>
                    </label>
                </div>
                <small class="form-text text-muted"><?= __tr('Switch between light and dark themes') ?></small>
            </div>

            <!-- Language Selection -->
            <?php $translationLanguages = getActiveTranslationLanguages(); ?>
            @if(!__isEmpty($translationLanguages) and (count($translationLanguages) > 1))
            <?php $translationLanguages['en_US'] = configItem('default_translation_language');  ?>
            <div class="form-group">
                <label for="languageSelect">
                    <i class="fas fa-language mr-2"></i><?= __tr('Language') ?>
                </label>
                <select class="form-control" id="languageSelect" onchange="changeLanguage(this.value)">
                    <?php foreach ($translationLanguages as $languageId => $language) {
                        if (isset($language['status']) and $language['status'] == false) continue;
                    ?>
                        <option value="<?= $languageId ?>" <?= ($languageId == config('CURRENT_LOCALE')) ? 'selected' : '' ?>>
                            <?= $language['name'] ?>
                        </option>
                    <?php } ?>
                </select>
                <small class="form-text text-muted"><?= __tr('Choose your preferred language') ?></small>
            </div>
            @endif

            <!-- Theme Selection -->
            <div class="form-group">
                <label for="themeSelect">
                    <i class="fas fa-palette mr-2"></i><?= __tr('Color Theme') ?>
                </label>
                <select class="form-control" id="themeSelect" disabled>
                    <option><?= __tr('Default Pink') ?></option>
                    <option><?= __tr('Blue') ?></option>
                    <option><?= __tr('Purple') ?></option>
                    <option><?= __tr('Green') ?></option>
                </select>
                <small class="form-text text-muted"><?= __tr('Customize the color theme of the app') ?></small>
            </div>
        </div>
    </div>
</div>

<script>
function changeLanguage(languageId) {
    window.location.href = '<?= route('locale.change', ['localeID' => '__LANGUAGE_ID__']) ?>'.replace('__LANGUAGE_ID__', languageId);
}
</script>
