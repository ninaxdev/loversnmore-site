@section('page-title', __tr('Find Matches'))
@section('head-title', __tr('Find Matches'))
@section('keywordName', __tr('Find Matches'))
@section('keyword', __tr('Find Matches'))
@section('description', __tr('Find Matches'))
@section('keywordDescription', __tr('Find Matches'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<?php
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

<div x-data="{
    looking_for: '<?= (!__isEmpty($request->looking_for)) ? $request->looking_for : $lookingFor ?>',
    min_age: '<?= (!__isEmpty($request->min_age)) ? $request->min_age : $minAge ?>',
    max_age: '<?= (!__isEmpty($request->max_age)) ? $request->max_age : $maxAge ?>',
    distance: '<?= (!__isEmpty($request->distance)) ? $request->distance : getUserSettings('distance') ?>',
    name: '<?= (!__isEmpty($request->name)) ? $request->name : '' ?>',
    username: '<?= (!__isEmpty($request->username)) ? $request->username : '' ?>',
    user_type: ['<?= (!__isEmpty($request->user_type)) ? $request->user_type : '' ?>'],
    openSections: {
        search: <?= !__isEmpty($request->name) || !__isEmpty($request->username) ? 'true' : 'false' ?>,
        location: <?= !__isEmpty($request->distance) ? 'true' : 'false' ?>,
        ethnicity: <?= !__isEmpty($request->ethnicity) ? 'true' : 'false' ?>,
        language: <?= !__isEmpty($request->language) ? 'true' : 'false' ?>,
        relationship: <?= !__isEmpty($request->relationship_status) ? 'true' : 'false' ?>,
        work: <?= !__isEmpty($request->work_status) ? 'true' : 'false' ?>,
        education: <?= !__isEmpty($request->education) ? 'true' : 'false' ?>,
    },
    toggleSection(section) {
        this.openSections[section] = !this.openSections[section];
    }
}">
    <!-- Page Heading - Desktop Only -->
    <div class="mb-6 hidden lg:block">
        <h1 class="text-3xl font-semibold lw-font" style="color: var(--lw-primary);">
            <i class="fas fa-search mr-2" style="color: var(--lw-gradient-start);" aria-hidden="true"></i>
            <?= __tr('Find Matches') ?>
        </h1>
    </div>

    <!-- Filter Form Card -->
    <div class="lw-card-glass">
        <div class="p-4 md:p-6">
            <form class="lw-ajax-form lw-action-with-url" method="get" data-show-processing="true" action="<?= route('user.read.find_matches') ?>">
                <input type="hidden" name="is_advance_filter" value="yes">

                <!-- Mobile Header -->
                <div class="mb-6 lg:hidden">
                    <h2 class="text-2xl font-semibold lw-font" style="color: var(--lw-primary);">
                        <i class="fas fa-search mr-2" style="color: var(--lw-gradient-start);"></i>
                        <?= __tr('Find Matches') ?>
                    </h2>
                </div>

                <!-- Looking For Section -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-3 lw-font" style="color: var(--lw-primary);">
                        <?= __tr('Looking For') ?>
                    </label>
                    <div class="flex gap-3 flex-wrap">
                        @foreach(configItem('user_settings.gender') as $genderKey => $gender)
                        <button type="button"
                                @click="looking_for = '<?= $genderKey ?>'"
                                :class="looking_for === '<?= $genderKey ?>' ? 'bg-gradient-lw text-white' : 'bg-white text-gray-700 border-2'"
                                class="flex-1 px-6 py-3 rounded-lg font-semibold transition-all duration-200 border-2"
                                style="border-color: #ec9cae;">
                            <?= $gender ?>
                        </button>
                        @endforeach
                        <button type="button"
                                @click="looking_for = 'all'"
                                :class="looking_for === 'all' ? 'bg-gradient-lw text-white' : 'bg-white text-gray-700 border-2'"
                                class="md:flex-1 px-6 py-3 rounded-lg font-semibold transition-all duration-200 border-2"
                                style="border-color: #ec9cae;">
                            <?= __tr('All') ?>
                        </button>
                    </div>
                    <input type="hidden" name="looking_for" x-model="looking_for">
                </div>

                <!-- Age Range Slider -->
                <div class="mb-4 border-2 rounded-lg p-4" style="border-color: #ec9cae;">
                    <div class="flex items-center justify-between mb-4">
                        <label class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= __tr('Age') ?>
                        </label>
                        <span class="text-sm font-semibold" style="color: #ec9cae;" x-text="min_age + ' - ' + max_age"></span>
                    </div>

                    <!-- Dual Range Slider -->
                    <div class="relative pt-2 pb-6">
                        <!-- Track Background -->
                        <div class="lw-slider-track"></div>

                        <!-- Active Track -->
                        <div class="lw-slider-range"
                             :style="`left: ${((parseInt(min_age) - <?= min(configItem('user_settings.age_range')) ?>) / (<?= max(configItem('user_settings.age_range')) ?> - <?= min(configItem('user_settings.age_range')) ?>)) * 100}%; right: ${100 - ((parseInt(max_age) - <?= min(configItem('user_settings.age_range')) ?>) / (<?= max(configItem('user_settings.age_range')) ?> - <?= min(configItem('user_settings.age_range')) ?>)) * 100}%;`">
                        </div>

                        <!-- Min Range Input -->
                        <input type="range"
                               min="<?= min(configItem('user_settings.age_range')) ?>"
                               max="<?= max(configItem('user_settings.age_range')) ?>"
                               x-model.number="min_age"
                               @input="if (parseInt(min_age) >= parseInt(max_age)) { min_age = parseInt(max_age) - 1; }"
                               class="lw-range-slider lw-range-min">

                        <!-- Max Range Input -->
                        <input type="range"
                               min="<?= min(configItem('user_settings.age_range')) ?>"
                               max="<?= max(configItem('user_settings.age_range')) ?>"
                               x-model.number="max_age"
                               @input="if (parseInt(max_age) <= parseInt(min_age)) { max_age = parseInt(min_age) + 1; }"
                               class="lw-range-slider lw-range-max">
                    </div>

                    <!-- Hidden inputs for form submission -->
                    <input type="hidden" name="min_age" :value="min_age">
                    <input type="hidden" name="max_age" :value="max_age">
                </div>

                <!-- Search by Name Collapsible -->
                <div class="mb-4 border-2 rounded-lg overflow-hidden" style="border-color: #ec9cae;">
                    <button type="button"
                            @click="toggleSection('search')"
                            class="w-full px-4 py-4 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= __tr('Search by Name') ?>
                        </span>
                        <i class="fas fa-chevron-down transition-transform duration-200"
                           :class="openSections.search ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openSections.search"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-4 py-4 bg-gray-50 border-t-2" style="border-color: #ec9cae;">
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2" style="color: var(--lw-secondary);">
                                <?= __tr('Name') ?>
                            </label>
                            <input type="text"
                                   class="lw-form-input w-full"
                                   name="name"
                                   x-model="name"
                                   placeholder="<?= __tr('Name') ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: var(--lw-secondary);">
                                <?= __tr('Username') ?>
                            </label>
                            <input type="text"
                                   class="lw-form-input w-full"
                                   name="username"
                                   x-model="username"
                                   placeholder="<?= __tr('Username') ?>">
                        </div>
                    </div>
                </div>

                <!-- Location Collapsible -->
                <div class="mb-4 border-2 rounded-lg overflow-hidden" style="border-color: #ec9cae;">
                    <button type="button"
                            @click="toggleSection('location')"
                            class="w-full px-4 py-4 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= __tr('Location') ?>
                        </span>
                        <i class="fas fa-chevron-down transition-transform duration-200"
                           :class="openSections.location ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openSections.location"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-4 py-4 bg-gray-50 border-t-2" style="border-color: #ec9cae;">
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: var(--lw-secondary);">
                                <?= __tr('Distance in __distanceUnit__', ['__distanceUnit__' => (getStoreSettings('distance_measurement') == '6371') ? __tr('KM') : __tr('Miles')]) ?>
                            </label>
                            <input type="number"
                                   min="1"
                                   class="lw-form-input w-full"
                                   name="distance"
                                   x-model="distance"
                                   placeholder="<?= __tr('Anywhere') ?>">
                        </div>
                    </div>
                </div>

                <!-- Ethnicity Collapsible -->
                @if(isset($userSpecifications['groups']['basics']['items']['ethnicity']))
                <?php $ethnicityItem = $userSpecifications['groups']['basics']['items']['ethnicity']; ?>
                <div class="mb-4 border-2 rounded-lg overflow-hidden" style="border-color: #ec9cae;">
                    <button type="button"
                            @click="toggleSection('ethnicity')"
                            class="w-full px-4 py-4 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= __tr('Ethnicity') ?>
                        </span>
                        <i class="fas fa-chevron-down transition-transform duration-200"
                           :class="openSections.ethnicity ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openSections.ethnicity"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-4 py-4 bg-gray-50 border-t-2" style="border-color: #ec9cae;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @if(isset($ethnicityItem['options']))
                            @foreach($ethnicityItem['options'] as $optionKey => $option)
                            <div class="lw-checkbox-container">
                                <input type="checkbox"
                                       class="lw-checkbox"
                                       id="ethnicity[<?= $optionKey ?>]"
                                       name="ethnicity[<?= $optionKey ?>]"
                                       value="<?= $optionKey ?>"
                                       <?= (!__isEmpty($request->ethnicity) and array_key_exists($optionKey, $request->ethnicity)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="ethnicity[<?= $optionKey ?>]">
                                    <?= $option ?>
                                </label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Language Collapsible -->
                <div class="mb-4 border-2 rounded-lg overflow-hidden" style="border-color: #ec9cae;">
                    <button type="button"
                            @click="toggleSection('language')"
                            class="w-full px-4 py-4 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= __tr('Language') ?>
                        </span>
                        <i class="fas fa-chevron-down transition-transform duration-200"
                           :class="openSections.language ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openSections.language"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-4 py-4 bg-gray-50 border-t-2" style="border-color: #ec9cae;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($userSettings['preferred_language'] as $langKey => $language)
                            <div class="lw-checkbox-container">
                                <input type="checkbox"
                                       class="lw-checkbox"
                                       id="language[<?= $langKey ?>]"
                                       name="language[<?= $langKey ?>]"
                                       value="<?= $langKey ?>"
                                       <?= (!__isEmpty($request->language) and array_key_exists($langKey, $request->language)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="language[<?= $langKey ?>]">
                                    <?= $language ?>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Relationship Status Collapsible -->
                <div class="mb-4 border-2 rounded-lg overflow-hidden" style="border-color: #ec9cae;">
                    <button type="button"
                            @click="toggleSection('relationship')"
                            class="w-full px-4 py-4 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= __tr('Relationship Status') ?>
                        </span>
                        <i class="fas fa-chevron-down transition-transform duration-200"
                           :class="openSections.relationship ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openSections.relationship"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-4 py-4 bg-gray-50 border-t-2" style="border-color: #ec9cae;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($userSettings['relationship_status'] as $relStatusKey => $relationship)
                            <div class="lw-checkbox-container">
                                <input type="checkbox"
                                       class="lw-checkbox"
                                       id="relationship_status[<?= $relStatusKey ?>]"
                                       name="relationship_status[<?= $relStatusKey ?>]"
                                       value="<?= $relStatusKey ?>"
                                       <?= (!__isEmpty($request->relationship_status) and array_key_exists($relStatusKey, $request->relationship_status)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="relationship_status[<?= $relStatusKey ?>]">
                                    <?= $relationship ?>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Work Status Collapsible -->
                <div class="mb-4 border-2 rounded-lg overflow-hidden" style="border-color: #ec9cae;">
                    <button type="button"
                            @click="toggleSection('work')"
                            class="w-full px-4 py-4 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= __tr('Work Status') ?>
                        </span>
                        <i class="fas fa-chevron-down transition-transform duration-200"
                           :class="openSections.work ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openSections.work"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-4 py-4 bg-gray-50 border-t-2" style="border-color: #ec9cae;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($userSettings['work_status'] as $workStatusKey => $workStatus)
                            <div class="lw-checkbox-container">
                                <input type="checkbox"
                                       class="lw-checkbox"
                                       id="work_status[<?= $workStatusKey ?>]"
                                       name="work_status[<?= $workStatusKey ?>]"
                                       value="<?= $workStatusKey ?>"
                                       <?= (!__isEmpty($request->work_status) and array_key_exists($workStatusKey, $request->work_status)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="work_status[<?= $workStatusKey ?>]">
                                    <?= $workStatus ?>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Education Collapsible -->
                <div class="mb-4 border-2 rounded-lg overflow-hidden" style="border-color: #ec9cae;">
                    <button type="button"
                            @click="toggleSection('education')"
                            class="w-full px-4 py-4 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= __tr('Education') ?>
                        </span>
                        <i class="fas fa-chevron-down transition-transform duration-200"
                           :class="openSections.education ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openSections.education"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-4 py-4 bg-gray-50 border-t-2" style="border-color: #ec9cae;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($userSettings['educations'] as $educationKey => $education)
                            <div class="lw-checkbox-container">
                                <input type="checkbox"
                                       class="lw-checkbox"
                                       id="education[<?= $educationKey ?>]"
                                       name="education[<?= $educationKey ?>]"
                                       value="<?= $educationKey ?>"
                                       <?= (!__isEmpty($request->education) and array_key_exists($educationKey, $request->education)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="education[<?= $educationKey ?>]">
                                    <?= $education ?>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Other Specification Groups -->
                @foreach($userSpecifications['groups'] as $specKey => $specifications)
                <?php if(isset($specifications['status']) && $specifications['status'] == 0) continue; ?>
                <?php if(!isset($specifications['items'])) continue; ?>
                <?php if($specKey == 'favorites') continue; ?>

                <div class="mb-4 border-2 rounded-lg overflow-hidden" style="border-color: #ec9cae;" x-data="{ open: false }">
                    <button type="button"
                            @click="open = !open"
                            class="w-full px-4 py-4 flex items-center justify-between bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-semibold lw-font" style="color: var(--lw-primary);">
                            <?= $specifications['title'] ?>
                        </span>
                        <i class="fas fa-chevron-down transition-transform duration-200"
                           :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-4 py-4 bg-gray-50 border-t-2" style="border-color: #ec9cae;">
                        @foreach($specifications['items'] as $itemKey => $item)
                        @if($item['input_type'] == 'select')
                            @if($itemKey == 'height')
                            <!-- Height Specific Layout -->
                            <div class="mb-4 last:mb-0">
                                <h4 class="text-sm font-semibold mb-3" style="color: var(--lw-primary);">
                                    <?= $item['name'] ?>
                                </h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium mb-2" style="color: var(--lw-secondary);">
                                            <?= __tr('Min Height') ?>
                                        </label>
                                        <select name="min_height" class="lw-form-select w-full">
                                            <option value=""><?= __tr('Select Min Height') ?></option>
                                            @if(isset($item['options']))
                                            @foreach($item['options'] as $optionKey => $option)
                                            <option value="<?= $optionKey ?>" <?= ($request->min_height == $optionKey) ? 'selected' : '' ?>>
                                                <?= $option ?>
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-2" style="color: var(--lw-secondary);">
                                            <?= __tr('Max Height') ?>
                                        </label>
                                        <select name="max_height" class="lw-form-select w-full">
                                            <option value=""><?= __tr('Select Max Height') ?></option>
                                            @if(isset($item['options']))
                                            @foreach($item['options'] as $optionKey => $option)
                                            <option value="<?= $optionKey ?>" <?= ($request->max_height == $optionKey) ? 'selected' : '' ?>>
                                                <?= $option ?>
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @elseif($itemKey != 'ethnicity')
                            <!-- Other Select Fields -->
                            <div class="mb-4 last:mb-0">
                                <h4 class="text-sm font-semibold mb-3" style="color: var(--lw-primary);">
                                    <?= $item['name'] ?>
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @if(isset($item['options']))
                                    @foreach($item['options'] as $optionKey => $option)
                                    <div class="lw-checkbox-container">
                                        <input type="checkbox"
                                               class="lw-checkbox"
                                               id="<?= $itemKey ?>[<?= $optionKey ?>]"
                                               name="<?= $itemKey ?>[<?= $optionKey ?>]"
                                               value="<?= $optionKey ?>"
                                               <?= (!__isEmpty($request->$itemKey) and array_key_exists($optionKey, $request->$itemKey)) ? 'checked' : '' ?>>
                                        <label class="lw-checkbox-label" for="<?= $itemKey ?>[<?= $optionKey ?>]">
                                            <?= $option ?>
                                        </label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endif
                        @endforeach
                    </div>
                </div>
                @endforeach

                <!-- Verified Users Checkbox -->
                <div class="mb-6">
                    <input type="hidden" name="user_type" value="0">
                    <div class="lw-checkbox-container">
                        <input type="checkbox"
                               class="lw-checkbox"
                               id="userTypeSearch"
                               name="user_type"
                               value="1"
                               x-model="user_type">
                        <label class="lw-checkbox-label" for="userTypeSearch">
                            <span class="font-semibold"><?= __tr('Only Verified Users') ?></span>
                        </label>
                    </div>
                </div>

                <!-- Apply Filters Button -->
                <button type="submit"
                        class="w-full md:w-auto px-6 py-4 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center"
                        style="background: transparent; border: 2px solid #ec9cae; color: #222222;"
                        onmouseover="this.style.background='#5B3E96'; this.style.color='white'; this.style.borderColor='#5B3E96';"
                        onmouseout="this.style.background='transparent'; this.style.color='#222222'; this.style.borderColor='#ec9cae';">
                    <i class="fas fa-search mr-2"></i>
                    <?= __tr('Apply Filters') ?>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Found matches container -->
<div id="lwFindMatchesContainer" class="mt-6">
    @include('filter.find-matches-container')
</div>

<style>
/* Collapsible transitions */
[x-cloak] {
    display: none !important;
}

/* Toggle button styling */
.bg-gradient-lw {
    background: linear-gradient(135deg, #F4A7B9, #A88BEB);
    box-shadow: 0 4px 12px rgba(236, 156, 174, 0.3);
}

/* Chevron rotation */
.rotate-180 {
    transform: rotate(180deg);
}

/* Range Slider Container */
.lw-slider-track {
    position: absolute;
    height: 6px;
    background: #e0e0e0;
    border-radius: 3px;
    width: 100%;
    top: 8px;
    pointer-events: none;
}

.lw-slider-range {
    position: absolute;
    height: 6px;
    background: linear-gradient(135deg, #F4A7B9, #A88BEB);
    border-radius: 3px;
    top: 8px;
    pointer-events: none;
}

/* Range Slider Styling */
.lw-range-slider {
    -webkit-appearance: none;
    appearance: none;
    position: absolute;
    width: 100%;
    height: 6px;
    background: transparent;
    outline: none;
    pointer-events: none;
}

.lw-range-slider.lw-range-min {
    z-index: 3;
}

.lw-range-slider.lw-range-max {
    z-index: 4;
}

.lw-range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
    border: 3px solid #ec9cae;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    pointer-events: all;
    position: relative;
}

.lw-range-slider::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
    border: 3px solid #ec9cae;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    pointer-events: all;
}

.lw-range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.1);
    border-color: #A88BEB;
}

.lw-range-slider::-moz-range-thumb:hover {
    transform: scale(1.1);
    border-color: #A88BEB;
}

.lw-range-slider::-webkit-slider-thumb:active {
    transform: scale(1.2);
    box-shadow: 0 4px 12px rgba(236, 156, 174, 0.4);
}

.lw-range-slider::-moz-range-thumb:active {
    transform: scale(1.2);
    box-shadow: 0 4px 12px rgba(236, 156, 174, 0.4);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .lw-card-glass {
        border-radius: 0 !important;
        margin: 0 -1rem;
    }

    .lw-card-glass .p-4 {
        padding: 1rem !important;
    }
}

/* Checkbox styling adjustments */
.lw-checkbox-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem;
    border-radius: 0.5rem;
    transition: background-color 0.2s;
}

.lw-checkbox-container:hover {
    background-color: rgba(236, 156, 174, 0.05);
}

.lw-checkbox {
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 0.25rem;
    border: 2px solid #ec9cae;
    cursor: pointer;
}

.lw-checkbox:checked {
    background-color: #ec9cae;
    border-color: #ec9cae;
}

.lw-checkbox-label {
    cursor: pointer;
    user-select: none;
    flex: 1;
    margin: 0;
}
</style>
