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

<div class="min-h-screen px-4 py-6"  x-data="{
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
    <!-- Page Heading -->
    <div class="mb-7">
        <h1 class="text-center text-3xl font-bold" style="color: #1A1638; font-family: 'Poppins', sans-serif; letter-spacing: -0.01em;">
            <?= __tr('Find Matches') ?>
        </h1>
    </div>

    <!-- Filter Form Container -->
    <div class="max-w-md mx-auto">
        <form class="lw-ajax-form lw-action-with-url" method="get" data-show-processing="true" action="<?= route('user.read.find_matches') ?>">
            <input type="hidden" name="is_advance_filter" value="yes">

            <!-- Age Range Section -->
            <div class="mb-7">
                <label class="block text-base font-normal mb-4" style="color: #1A1A1A; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Age Range') ?>
                </label>

                <!-- Dual Range Slider -->
                <div class="relative pt-1 pb-7 px-2">
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

                <!-- Age Display -->
                <div class="text-center text-2xl font-normal mt-1" style="color: #1A1A1A; font-family: 'Poppins', sans-serif;" x-text="min_age + ' - ' + max_age"></div>

                <!-- Hidden inputs for form submission -->
                <input type="hidden" name="min_age" :value="min_age">
                <input type="hidden" name="max_age" :value="max_age">
            </div>

            <!-- Gender Section -->
            <div class="mb-7">
                <label class="block text-base font-normal mb-4" style="color: #1A1A1A; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Gender') ?>
                </label>
                <div class="flex flex-wrap gap-3 justify-start">
                    @foreach(configItem('user_settings.gender') as $genderKey => $gender)
                    <button type="button"
                            @click="looking_for = '<?= $genderKey ?>'"
                            class="flex items-center justify-center py-1.5 px-2 md:px-5 rounded-full transition-all duration-200 hover:scale-105 hover:shadow-md"
                            :style="looking_for === '<?= $genderKey ?>' ? 'background-color: #5B3E96;' : 'background-color: #F5F0FF;'"
                            style="font-family: 'Poppins', sans-serif;">
                        @if($genderKey == '1')
                        <i class="fas fa-user text-base md:text-xl mr-1 md:mr-2" :style="looking_for === '<?= $genderKey ?>' ? 'color: white;' : 'color: #7C3AED;'"></i>
                        @elseif($genderKey == '2')
                        <i class="fas fa-venus text-base md:text-xl mr-1 md:mr-2" :style="looking_for === '<?= $genderKey ?>' ? 'color: white;' : 'color: #7C3AED;'"></i>
                        @endif
                        <span class="text-sm md:text-lg font-normal" :style="looking_for === '<?= $genderKey ?>' ? 'color: white;' : 'color: #1A1A1A;'"><?= $gender ?></span>
                    </button>
                    @endforeach
                </div>
                <input type="hidden" name="looking_for" x-model="looking_for">
            </div>

            <!-- Location Section -->
            <div class="mb-6">
                <label class="block text-base font-normal mb-4" style="color: #1A1A1A; font-family: 'Poppins', sans-serif;">
                    <?= __tr('Location') ?>
                </label>
                <div class="rounded-full px-4 flex items-center transition-all duration-200 hover:shadow-md" style="background-color: #F5F0FF; font-family: 'Poppins', sans-serif;">
                    <i class="fas fa-map-marker-alt text-lg mr-3" style="color: #7C3AED;"></i>
                    <input type="number"
                           min="1"
                           class="bg-transparent border-0 outline-none text-sm font-normal flex-1 placeholder-gray-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                           style="color: #1A1A1A; font-family: 'Poppins', sans-serif;"
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

            <div class="mb-4" x-data="{ open: false }">
                <button type="button"
                        @click="open = !open"
                        class="w-full bg-white rounded-lg py-3.5 flex items-center justify-between transition-all duration-200 hover:shadow-lg"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.06);">
                    <span class="text-base font-normal" style="color: #1A1A1A; font-family: 'Poppins', sans-serif;">
                        <?= $specifications['title'] ?>
                    </span>
                    <i class="fas fa-chevron-down transition-transform duration-200 text-xs" style="color: #666;"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class=" bg-white rounded-b-lg -mt-1"
                     style="box-shadow: 0 1px 2px rgba(0,0,0,0.06);">
                     
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
                        <div class="mb-4 last:mb-0">
                            <div class="grid grid-cols-3 gap-2">
                                @if(isset($item['options']))
                                @foreach($item['options'] as $optionKey => $option)
                                <label class="relative" x-data="{ checked: <?= (!__isEmpty($request->$itemKey) and array_key_exists($optionKey, $request->$itemKey)) ? 'true' : 'false' ?> }">
                                    <input type="checkbox"
                                           class="hidden"
                                           id="<?= $itemKey ?>[<?= $optionKey ?>]"
                                           name="<?= $itemKey ?>[<?= $optionKey ?>]"
                                           value="<?= $optionKey ?>"
                                           x-model="checked"
                                           <?= (!__isEmpty($request->$itemKey) and array_key_exists($optionKey, $request->$itemKey)) ? 'checked' : '' ?>>
                                    <div class="px-3 py-2 rounded-full text-center cursor-pointer transition-all duration-200 hover:opacity-90"
                                         style="font-family: 'Poppins', sans-serif;"
                                         :style="checked ? 'background-color: #5B3E96;' : 'background-color: #F5F0FF;'">
                                        <span class="text-sm font-normal transition-all"
                                              :style="checked ? 'color: white;' : 'color: #1A1A1A;'">
                                            <?= $option ?>
                                        </span>
                                    </div>
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

            <!-- Verified Users Checkbox (Hidden for now to match mockup exactly) -->
            <input type="hidden" name="user_type" value="0">

            <!-- Search Button -->
            <button type="submit"
                    class="w-full py-2 rounded-full font-normal text-lg text-white transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                    style="background-color: #7C3AED; font-family: 'Poppins', sans-serif; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35);">
                <?= __tr('Search') ?>
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
    background: #E9D8FD;
    border-radius: 999px;
    width: 100%;
    top: 10px;
    pointer-events: none;
}

.lw-slider-range {
    position: absolute;
    height: 6px;
    background: #7C3AED;
    border-radius: 999px;
    top: 10px;
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
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #7C3AED;
    border: 5px solid white;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(124, 58, 237, 0.25);
    pointer-events: all;
    transition: all 0.2s ease;
}

/* Slider Thumb - Firefox */
.lw-range-slider::-moz-range-thumb {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #7C3AED;
    border: 5px solid white;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(124, 58, 237, 0.25);
    pointer-events: all;
    transition: all 0.2s ease;
}

/* Slider Thumb Hover */
.lw-range-slider::-webkit-slider-thumb:hover {
    transform: scale(1.05);
    box-shadow: 0 3px 10px rgba(124, 58, 237, 0.35);
}

.lw-range-slider::-moz-range-thumb:hover {
    transform: scale(1.05);
    box-shadow: 0 3px 10px rgba(124, 58, 237, 0.35);
}

/* Slider Thumb Active */
.lw-range-slider::-webkit-slider-thumb:active {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.4);
}

.lw-range-slider::-moz-range-thumb:active {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.4);
}
</style>
