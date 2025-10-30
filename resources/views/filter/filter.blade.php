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
    <div class="mb-5 hidden lg:block">
        <h1 class="text-3xl font-bold" style="color: var(--lw-primary); font-family: 'Poppins', 'Nunito', sans-serif;">
            <i class="fas fa-search mr-2" style="color: var(--lw-gradient-start);" aria-hidden="true"></i>
            <?= __tr('Find Matches') ?>
        </h1>
    </div>

    <!-- Filter Form Card -->
    <div class="bg-white rounded-3xl shadow-lg p-5 md:p-6" style="font-family: 'Poppins', 'Nunito', sans-serif;">
        <form class="lw-ajax-form lw-action-with-url" method="get" data-show-processing="true" action="<?= route('user.read.find_matches') ?>">
            <input type="hidden" name="is_advance_filter" value="yes">

            <!-- Mobile Header -->
            <div class="mb-5 lg:hidden">
                <h2 class="text-2xl font-bold" style="color: var(--lw-primary); font-family: 'Poppins', 'Nunito', sans-serif;">
                    <i class="fas fa-search mr-2" style="color: var(--lw-gradient-start);"></i>
                    <?= __tr('Find Matches') ?>
                </h2>
            </div>

            <!-- Looking For Section - Always Visible Card -->
            <div class="bg-white rounded-3xl shadow-md p-4 mb-3">
                <label class="block text-base font-bold mb-3" style="color: var(--lw-primary); font-family: 'Poppins', 'Nunito', sans-serif;">
                    <?= __tr('Looking For') ?>
                </label>
                <!-- Mobile Layout: 3 in first row, All in second row -->
                <div class="md:hidden">
                    <div class="grid grid-cols-3 gap-2 mb-2">
                        @foreach(configItem('user_settings.gender') as $genderKey => $gender)
                        <button type="button"
                                @click="looking_for = '<?= $genderKey ?>'"
                                :class="looking_for === '<?= $genderKey ?>' ? 'bg-gradient-to-r from-pink-300 via-purple-300 to-purple-400 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                class="md:px-5 py-2.5 rounded-full font-semibold transition-all duration-200"
                                style="font-family: 'Poppins', 'Nunito', sans-serif;">
                            <?= $gender ?>
                        </button>
                        @endforeach
                    </div>
                    <button type="button"
                            @click="looking_for = 'all'"
                            :class="looking_for === 'all' ? 'bg-gradient-to-r from-pink-300 via-purple-300 to-purple-400 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="w-full px-5 py-2.5 rounded-full font-semibold transition-all duration-200"
                            style="font-family: 'Poppins', 'Nunito', sans-serif;">
                        <?= __tr('All') ?>
                    </button>
                </div>
                <!-- Desktop Layout: All in one row -->
                <div class="hidden md:flex gap-2 flex-wrap">
                    @foreach(configItem('user_settings.gender') as $genderKey => $gender)
                    <button type="button"
                            @click="looking_for = '<?= $genderKey ?>'"
                            :class="looking_for === '<?= $genderKey ?>' ? 'bg-gradient-to-r from-pink-300 via-purple-300 to-purple-400 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="flex-1 px-5 py-2.5 rounded-full font-semibold transition-all duration-200"
                            style="font-family: 'Poppins', 'Nunito', sans-serif;">
                        <?= $gender ?>
                    </button>
                    @endforeach
                    <button type="button"
                            @click="looking_for = 'all'"
                            :class="looking_for === 'all' ? 'bg-gradient-to-r from-pink-300 via-purple-300 to-purple-400 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="flex-1 px-5 py-2.5 rounded-full font-semibold transition-all duration-200"
                            style="font-family: 'Poppins', 'Nunito', sans-serif;">
                        <?= __tr('All') ?>
                    </button>
                </div>
                <input type="hidden" name="looking_for" x-model="looking_for">
            </div>

            <!-- Age Range Slider - Always Visible Card -->
            <div class="bg-white rounded-3xl shadow-md p-4 mb-3">
                <div class="flex items-center justify-between mb-4">
                    <label class="font-bold text-base" style="color: var(--lw-primary); font-family: 'Poppins', 'Nunito', sans-serif;">
                        <?= __tr('Age') ?>
                    </label>
                    <span class="text-sm font-semibold bg-gradient-to-r from-pink-300 via-purple-300 to-purple-400 bg-clip-text text-transparent" style="font-family: 'Poppins', 'Nunito', sans-serif;" x-text="min_age + ' - ' + max_age"></span>
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

            <!-- Location - Always Visible Card -->
            <div class="bg-white rounded-3xl shadow-md p-4 mb-3">
                <label class="block text-base font-bold mb-3" style="color: var(--lw-primary); font-family: 'Poppins', 'Nunito', sans-serif;">
                    <?= __tr('Location') ?>
                </label>
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-600" style="font-family: 'Poppins', 'Nunito', sans-serif;">
                        <?= __tr('Distance in __distanceUnit__', ['__distanceUnit__' => (getStoreSettings('distance_measurement') == '6371') ? __tr('KM') : __tr('Miles')]) ?>
                    </label>
                    <input type="number"
                           min="1"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-purple-300 focus:border-transparent transition-all"
                           style="font-family: 'Poppins', 'Nunito', sans-serif;"
                           name="distance"
                           x-model="distance"
                           placeholder="<?= __tr('Anywhere') ?>">
                </div>
            </div>


            <!-- Lifestyle and Personality - Collapsible Sections Only -->
            @foreach($userSpecifications['groups'] as $specKey => $specifications)
            <?php if(isset($specifications['status']) && $specifications['status'] == 0) continue; ?>
            <?php if(!isset($specifications['items'])) continue; ?>
            <?php if($specKey == 'favorites' || $specKey == 'basics') continue; ?>
            <?php
            // Only show lifestyle and personality sections
            if($specKey != 'lifestyle' && $specKey != 'personality') continue;
            ?>

            <div class="bg-white rounded-3xl shadow-md overflow-hidden mb-3" x-data="{ open: false }">
                <button type="button"
                        @click="open = !open"
                        class="w-full px-4 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="font-bold text-lg" style="color: var(--lw-primary); font-family: 'Poppins', 'Nunito', sans-serif;">
                        <?= $specifications['title'] ?>
                    </span>
                    <i class="fas fa-chevron-down transition-transform duration-200 text-purple-400"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                     
                    @foreach($specifications['items'] as $itemKey => $item)
                    @if($item['input_type'] == 'select')
                        @if($itemKey == 'height')
                        <!-- Height Specific Layout -->
                        <div class="mb-3 last:mb-0">
                            <h4 class="text-sm font-bold mb-2" style="color: var(--lw-primary); font-family: 'Poppins', 'Nunito', sans-serif;">
                                <?= $item['name'] ?>
                            </h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium mb-1.5 text-gray-600" style="font-family: 'Poppins', 'Nunito', sans-serif;">
                                        <?= __tr('Min Height') ?>
                                    </label>
                                    <select name="min_height" class="w-full px-3 py-2 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-purple-300 focus:border-transparent transition-all text-sm" style="font-family: 'Poppins', 'Nunito', sans-serif;">
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
                                    <label class="block text-xs font-medium mb-1.5 text-gray-600" style="font-family: 'Poppins', 'Nunito', sans-serif;">
                                        <?= __tr('Max Height') ?>
                                    </label>
                                    <select name="max_height" class="w-full px-3 py-2 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-purple-300 focus:border-transparent transition-all text-sm" style="font-family: 'Poppins', 'Nunito', sans-serif;">
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
                        <div class="mb-3 last:mb-0">
                            <h4 class="text-sm font-bold mb-2" style="color: var(--lw-primary); font-family: 'Poppins', 'Nunito', sans-serif;">
                                <?= $item['name'] ?>
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @if(isset($item['options']))
                                @foreach($item['options'] as $optionKey => $option)
                                <label class="flex items-center gap-2.5 p-2.5 rounded-xl hover:bg-white transition-colors cursor-pointer">
                                    <input type="checkbox"
                                           class="w-4 h-4 rounded border-2 border-purple-300 text-purple-400 focus:ring-2 focus:ring-purple-300 focus:ring-offset-0 transition-all"
                                           id="<?= $itemKey ?>[<?= $optionKey ?>]"
                                           name="<?= $itemKey ?>[<?= $optionKey ?>]"
                                           value="<?= $optionKey ?>"
                                           <?= (!__isEmpty($request->$itemKey) and array_key_exists($optionKey, $request->$itemKey)) ? 'checked' : '' ?>>
                                    <span class="text-gray-700 font-medium text-sm" style="font-family: 'Poppins', 'Nunito', sans-serif;"><?= $option ?></span>
                                </label>
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
            <div class="mb-4">
                <input type="hidden" name="user_type" value="0">
                <label class="flex items-center gap-3 p-3 bg-white rounded-3xl shadow-md hover:shadow-lg transition-all cursor-pointer">
                    <input type="checkbox"
                           class="w-4 h-4 rounded border-2 border-purple-300 text-purple-400 focus:ring-2 focus:ring-purple-300 focus:ring-offset-0 transition-all"
                           id="userTypeSearch"
                           name="user_type"
                           value="1"
                           x-model="user_type">
                    <span class="font-semibold text-gray-700 text-sm" style="font-family: 'Poppins', 'Nunito', sans-serif;"><?= __tr('Only Verified Users') ?></span>
                </label>
            </div>

            <!-- Apply Filters Button -->
            <button type="submit"
                    class="w-full px-8 py-3.5 rounded-full font-bold text-base text-white bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center"
                    style="font-family: 'Poppins', 'Nunito', sans-serif;">
                <i class="fas fa-search mr-2"></i>
                <?= __tr('Apply Filters') ?>
            </button>
        </form>
    </div>
</div>

<!-- Found matches container -->
<div id="lwFindMatchesContainer" class="mt-6">
    @include('filter.find-matches-container')
</div>

<style>
/* Range Slider Track */
.lw-slider-track {
    position: absolute;
    height: 6px;
    background: #e5e7eb;
    border-radius: 999px;
    width: 100%;
    top: 8px;
    pointer-events: none;
}

.lw-slider-range {
    position: absolute;
    height: 6px;
    background: linear-gradient(135deg, #F4A7B9, #A88BEB);
    border-radius: 999px;
    top: 8px;
    pointer-events: none;
}

/* Range Slider Input */
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

/* Slider Thumb - Webkit */
.lw-range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: white;
    border: 3px solid #a78bfa;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(139, 92, 246, 0.3);
    pointer-events: all;
    transition: all 0.2s ease;
}

/* Slider Thumb - Firefox */
.lw-range-slider::-moz-range-thumb {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: white;
    border: 3px solid #a78bfa;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(139, 92, 246, 0.3);
    pointer-events: all;
    transition: all 0.2s ease;
}

/* Slider Thumb Hover */
.lw-range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.15);
    border-color: #8b5cf6;
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
}

.lw-range-slider::-moz-range-thumb:hover {
    transform: scale(1.15);
    border-color: #8b5cf6;
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
}

/* Slider Thumb Active */
.lw-range-slider::-webkit-slider-thumb:active {
    transform: scale(1.25);
    box-shadow: 0 4px 16px rgba(139, 92, 246, 0.5);
}

.lw-range-slider::-moz-range-thumb:active {
    transform: scale(1.25);
    box-shadow: 0 4px 16px rgba(139, 92, 246, 0.5);
}
</style>
