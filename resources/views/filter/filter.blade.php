@section('page-title', __tr('Find Matches'))
@section('head-title', __tr('Find Matches'))
@section('keywordName', __tr('Find Matches'))
@section('keyword', __tr('Find Matches'))
@section('description', __tr('Find Matches'))
@section('keywordDescription', __tr('Find Matches'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="mb-6">
    <h1 class="text-3xl font-semibold lw-font" style="color: var(--lw-primary);">
        <i class="fas fa-search mr-2" style="color: var(--lw-gradient-start);" aria-hidden="true"></i>
        <?= __tr('Find Matches') ?>
    </h1>
</div>

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
    showAdvanceFilter: <?= !__isEmpty($request->is_advance_filter) ? true : 0 ?>,
    distance:'<?= (!__isEmpty($request->distance)) ? $request->distance : getUserSettings('distance') ?>',
    name:'<?= (!__isEmpty($request->name)) ? $request->name : getUserSettings('name') ?>',
    username:'<?= (!__isEmpty($request->username)) ? $request->username : getUserSettings('username') ?>',
    looking_for:'<?= (!__isEmpty($request->looking_for)) ? $request->looking_for : getUserSettings('looking_for') ?>',
    min_age:'<?= (!__isEmpty($request->min_age)) ? $request->min_age : getUserSettings('min_age') ?>',
    max_age:'<?= (!__isEmpty($request->max_age)) ? $request->max_age : getUserSettings('max_age') ?>',
    user_type:['<?= (!__isEmpty($request->user_type)) ? $request->user_type : getUserSettings('user_type') ?>']
}">
{{-- <?= ($request->user_type == '1') ? 'checked' : '' ?> --}}
    <!-- Search Form Card -->
<div class="lw-card-glass mb-6">
    <div class="p-6 md:p-8">
        <form class="lw-ajax-form lw-action-with-url" method="get" data-show-processing="true" action="<?= route('user.read.find_matches') ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Name Field -->
                <div class="lw-form-group">
                    <label for="name" class="lw-form-label"><?= __tr('Name') ?></label>
                    <input type="text" class="lw-form-input" name="name" id="name" x-model="name" placeholder="<?= __tr('Name') ?>">
                </div>

                <!-- Username Field -->
                <div class="lw-form-group">
                    <label for="username" class="lw-form-label"><?= __tr('Username') ?></label>
                    <input type="text" class="lw-form-input" name="username" id="username" x-model="username" placeholder="<?= __tr('Username') ?>">
                </div>

                <!-- Looking For Field -->
                <div class="lw-form-group">
                    <label for="lookingFor" class="lw-form-label"><?= __tr('Looking For') ?></label>
                    <select name="looking_for" x-model="looking_for" class="lw-form-select" id="lookingFor">
                        <option value="all"><?= __tr('All') ?></option>
                        @foreach(configItem('user_settings.gender') as $genderKey => $gender)
                        <option value="<?= $genderKey ?>" <?= ($request->looking_for == $genderKey or $genderKey == $lookingFor) ? 'selected' : '' ?>><?= $gender ?></option>
                        @endforeach
                    </select>
                </div>

                <!-- Min Age Field -->
                <div class="lw-form-group">
                    <label for="minAge" class="lw-form-label"><?= __tr('Min Age') ?></label>
                    <select name="min_age" x-model="min_age" class="lw-form-select" id="minAge">
                        @foreach(configItem('user_settings.age_range') as $age)
                        <option value="<?= $age ?>" <?= ($request->min_age == $age or $age == $minAge) ? 'selected' : '' ?>><?= __tr('__translatedAge__', [
                                                                                                                                    '__translatedAge__' => $age
                                                                                                                                ]) ?></option>
                        @endforeach
                    </select>
                </div>

                <!-- Max Age Field -->
                <div class="lw-form-group">
                    <label for="maxAge" class="lw-form-label"><?= __tr('Max Age') ?></label>
                    <select name="max_age" x-model="max_age" class="lw-form-select" id="maxAge">
                        @foreach(configItem('user_settings.age_range') as $age)
                        <option value="<?= $age ?>" <?= ($request->max_age == $age or $age == $maxAge) ? 'selected' : '' ?>><?= __tr('__translatedAge__', [
                                                                                                                                    '__translatedAge__' => $age
                                                                                                                                ]) ?></option>
                        @endforeach
                    </select>
                </div>

                <!-- Distance Field -->
                <div class="lw-form-group">
                    <label for="distance" class="lw-form-label"><?= __tr('Distance in __distanceUnit__', ['__distanceUnit__' => (getStoreSettings('distance_measurement') == '6371') ? __tr('KM') : __tr('Miles')]) ?></label>
                    <input type="number" min="1" class="lw-form-input" name="distance" id="distance" x-model="distance" placeholder="<?= __tr('Anywhere') ?>">
                </div>
            </div>

            <!-- Verified Users Checkbox -->
            <div class="mt-6">
                <input type="hidden" name="user_type" value="0">
                <div class="lw-checkbox-container">
                    <input type="checkbox" class="lw-checkbox" id="userTypeSearch" name="user_type" value="1" x-model="user_type">
                    <label class="lw-checkbox-label" for="userTypeSearch">
                        <span class="text-lg font-semibold lw-font" style="color: var(--lw-primary);"><?= __tr('Only Verified Users') ?></span>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col md:flex-row gap-4">
                <button type="submit" class="w-full md:w-auto lw-btn lw-btn-primary lw-btn-primary-lg">
                    <i class="fas fa-search mr-2"></i>
                    <?= __tr('Search') ?>
                </button>
                <button type="button" x-show="!showAdvanceFilter" @click="showAdvanceFilter = !showAdvanceFilter" class="lw-btn lw-btn-secondary flex-1 md:flex-none" style="<?= !__isEmpty($request->is_advance_filter) ? 'display: none;' : '' ?>" id="lwShowAdvanceFilterLink">
                    <i class="fas fa-filter mr-2"></i>
                    <?= __tr('Show Advanced Filter') ?>
                </button>
                <button type="button" x-show="showAdvanceFilter" @click="showAdvanceFilter = !showAdvanceFilter" class="lw-btn lw-btn-secondary flex-1 md:flex-none" style="<?= __isEmpty($request->is_advance_filter) ? 'display: none;' : '' ?>" id="lwHideAdvanceFilterLink">
                    <i class="fas fa-filter mr-2"></i>
                    <?= __tr('Hide Advanced Filter') ?>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Found matches container -->
<!-- Advance Filter Options -->
<div x-show="showAdvanceFilter" x-bind:class="showAdvanceFilter ? 'lw-expand-filter' : ''" class="lw-advance-filter-container <?= !__isEmpty($request->is_advance_filter) ? 'lw-expand-filter' : '' ?>">
    <div class="lw-filter-message text-secondary">
    </div>
    <!-- Tabs for advance filter -->
    <div class="lw-card-glass mb-6">
        <ul class="nav nav-tabs border-0 px-6 pt-6" id="myTab" role="tablist" style="border-bottom: 2px solid var(--lw-gray-200) !important;">
                <!-- Personal Tab -->
            <li class="nav-item">
                <a class="nav-link active lw-font" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true" style="font-weight: 600; font-size: 16px; color: var(--lw-primary); border: none; border-bottom: 3px solid transparent; padding: 12px 20px; transition: all 0.3s ease;">
                    <i class="fas fa-info-circle mr-2" style="color: var(--lw-gradient-start);"></i><?= __tr('Personal') ?>
                    </a>
                </li>
            <!-- /Personal Tab -->
                @foreach($userSpecifications['groups'] as $specKey => $specification)
                <?php if(!isset($specification['items'])) continue; ?>
                <?php if(isset($specification['status']) && $specification['status'] == 0) continue; ?>
                @if($specKey != 'favorites')
            <li class="nav-item">
                <a class="nav-link lw-font" data-toggle="tab" href="#tabContainer-<?= $specKey ?>" role="tab" aria-controls="<?= $specKey ?>" aria-selected="false" style="font-weight: 600; font-size: 16px; color: var(--lw-secondary); border: none; border-bottom: 3px solid transparent; padding: 12px 20px; transition: all 0.3s ease;">
                        <?= $specification['title'] ?>
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        <form class="lw-ajax-form lw-action-with-url" data-show-processing="true" action="<?= route('user.read.find_matches') ?>" method="get">
            <div class="tab-content p-6" id="lwAdvanceFilterTabContent">
                <input type="hidden" name="is_advance_filter" value="yes">
                <!-- Hidden field of basic filter -->
                <input type="hidden" name="name"  x-model="name">
                <input type="hidden" name="username" x-model="username">
                <input type="hidden" name="looking_for" x-model="looking_for">
                <input type="hidden" name="user_type" x-model="user_type">
                <input type="hidden" name="min_age"  x-model="min_age">
                <input type="hidden" name="max_age"  x-model="max_age">
                <input type="hidden" name="distance" x-model="distance">
                <!-- /Hidden field of basic filter -->

                <!-- Personal Tab Content -->
                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                    <div class="mb-6">
                        <h3 class="lw-heading-3 mb-4" style="color: var(--lw-primary); border-bottom: 2px solid var(--lw-gradient-start); padding-bottom: 8px;">
                            <i class="fas fa-language mr-2" style="color: var(--lw-gradient-start);"></i><?= __tr('Language') ?>
                        </h3>
                    </div>
                    <!-- Language -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            @foreach($userSettings['preferred_language'] as $langKey => $language)
                        <div>
                            <div class="lw-checkbox-container">
                                <input type="checkbox" class="lw-checkbox" id="language[<?= $langKey  ?>]" name="language[<?= $langKey  ?>]" value="<?= $langKey  ?>" <?= (!__isEmpty($request->language) and array_key_exists($langKey, $request->language)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="language[<?= $langKey  ?>]"><?= $language ?></label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /Language -->
                    <!-- Relationship Status -->
                    <div class="mb-6">
                        <h3 class="lw-heading-3 mb-4" style="color: var(--lw-primary); border-bottom: 2px solid var(--lw-gradient-start); padding-bottom: 8px;">
                            <i class="fas fa-heart mr-2" style="color: var(--lw-gradient-start);"></i><?= __tr('Relationship Status') ?>
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            @foreach($userSettings['relationship_status'] as $relStatusKey => $relationship)
                        <div>
                            <div class="lw-checkbox-container">
                                <input type="checkbox" class="lw-checkbox" id="relationship_status[<?= $relStatusKey  ?>]" name="relationship_status[<?= $relStatusKey  ?>]" value="<?= $relStatusKey  ?>" <?= (!__isEmpty($request->relationship_status) and array_key_exists($relStatusKey, $request->relationship_status)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="relationship_status[<?= $relStatusKey  ?>]"><?= $relationship ?></label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /Relationship Status -->

                    <!-- Work Status -->
                    <div class="mb-6">
                        <h3 class="lw-heading-3 mb-4" style="color: var(--lw-primary); border-bottom: 2px solid var(--lw-gradient-start); padding-bottom: 8px;">
                            <i class="fas fa-briefcase mr-2" style="color: var(--lw-gradient-start);"></i><?= __tr('Work Status') ?>
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            @foreach($userSettings['work_status'] as $workStatusKey => $workStatus)
                        <div>
                            <div class="lw-checkbox-container">
                                <input type="checkbox" class="lw-checkbox" id="work_status[<?= $workStatusKey  ?>]" name="work_status[<?= $workStatusKey  ?>]" value="<?= $workStatusKey  ?>" <?= (!__isEmpty($request->work_status) and array_key_exists($workStatusKey, $request->work_status)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="work_status[<?= $workStatusKey  ?>]"><?= $workStatus ?></label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /Work Status -->

                    <!-- Education -->
                    <div class="mb-6">
                        <h3 class="lw-heading-3 mb-4" style="color: var(--lw-primary); border-bottom: 2px solid var(--lw-gradient-start); padding-bottom: 8px;">
                            <i class="fas fa-graduation-cap mr-2" style="color: var(--lw-gradient-start);"></i><?= __tr('Education') ?>
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            @foreach($userSettings['educations'] as $educationKey => $education)
                        <div>
                            <div class="lw-checkbox-container">
                                <input type="checkbox" class="lw-checkbox" id="education[<?= $educationKey  ?>]" name="education[<?= $educationKey  ?>]" value="<?= $educationKey  ?>" <?= (!__isEmpty($request->education) and array_key_exists($educationKey, $request->education)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="education[<?= $educationKey  ?>]"><?= $education ?></label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /Education -->
                </div>
                <!-- /Personal Tab Content -->
                <!-- Other Tab Content -->
                @foreach($userSpecifications['groups'] as $specKey => $specifications)
                <?php if(isset($specifications['status']) && $specifications['status'] == 0) continue; ?>
                <?php if(!isset($specifications['items'])) continue; ?>
                @if($specKey != 'favorites')
                <div class="tab-pane fade" id="tabContainer-<?= $specKey ?>" role="tabpanel" aria-labelledby="<?= $specKey ?>-tab">
                    @foreach(collect($specifications['items'])->chunk(3) as $specification)
                    @foreach($specification as $itemKey => $item)
                    @if($item['input_type'] == 'select')
                    @if($itemKey == 'height')
                    <div class="mb-6">
                        <h3 class="lw-heading-3 mb-4" style="color: var(--lw-primary); border-bottom: 2px solid var(--lw-gradient-start); padding-bottom: 8px;">
                            <i class="fas fa-ruler-vertical mr-2" style="color: var(--lw-gradient-start);"></i><?= $item['name'] ?>
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="lw-form-group">
                            <label for="min_height" class="lw-form-label"><?= __tr('Minimum Height') ?></label>
                            <select name="min_height" class="lw-form-select" id="min_height">
                                    <option value="" selected><?= __tr('Select Min Height') ?></option>
                                    @foreach($item['options'] as $optionKey => $option)
                                    <option value="<?= $optionKey ?>" <?= ($request->min_height == $optionKey) ? 'selected'  : '' ?>><?= $option ?></option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="lw-form-group">
                            <label for="max_height" class="lw-form-label"><?= __tr('Maximum Height') ?></label>
                            <select name="max_height" class="lw-form-select" id="max_height">
                                    <option value="" selected><?= __tr('Select Max Height') ?></option>
                                    @foreach($item['options'] as $optionKey => $option)
                                    <option value="<?= $optionKey ?>" <?= ($request->max_height == $optionKey) ? 'selected'  : '' ?>><?= $option ?></option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    @else
                    <div class="mb-6">
                        <h3 class="lw-heading-3 mb-4" style="color: var(--lw-primary); border-bottom: 2px solid var(--lw-gradient-start); padding-bottom: 8px;">
                            <?= $item['name'] ?>
                        </h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                            @if(isset($item['options']))
                            @foreach($item['options'] as $optionKey => $option)
                        <div>
                            <div class="lw-checkbox-container">
                                <input type="checkbox" class="lw-checkbox" id="<?= $itemKey ?>[<?= $optionKey  ?>]" name="<?= $itemKey ?>[<?= $optionKey ?>]" <?= (!__isEmpty($request->$itemKey) and array_key_exists($optionKey, $request->$itemKey)) ? 'checked' : '' ?>>
                                <label class="lw-checkbox-label" for="<?= $itemKey ?>[<?= $optionKey  ?>]"><?= $option ?></label>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    @endif
                    @endif
                    @endforeach
                    @endforeach
                </div>
                @endif
                @endforeach
                <!-- /Other Tab Content -->
            </div>
            <div class="px-6  pt-4">
                <button type="submit" class="lw-btn lw-btn-primary lw-btn-primary-lg ">
                    <i class="fas fa-search mr-2"></i><?= __tr('Search with Advanced Filters') ?>
                </button>
            </div>
        </form>
        </div>
    <!-- /Tabs for advance filter -->
</div>
</div>
<div id="lwFindMatchesContainer">
    @include('filter.find-matches-container')
</div>

<style>
/* Advanced Filter Tab Styling - Override existing dark theme */
.lw-advance-filter-container {
    background: transparent !important;
    background-image: none !important;
    border: none !important;
}

.lw-advance-filter-container .lw-card-glass {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(20px) !important;
    -webkit-backdrop-filter: blur(20px) !important;
}

.lw-card-glass .nav-tabs {
    margin-bottom: 0 !important;
    background: transparent !important;
}

.lw-card-glass .nav-tabs .nav-link {
    background: transparent !important;
    border: none !important;
    border-bottom: 3px solid transparent !important;
    color: var(--lw-secondary) !important;
}

.lw-card-glass .nav-tabs .nav-link:hover {
    color: var(--lw-primary) !important;
    background-color: rgba(197, 62, 141, 0.05) !important;
    border-bottom-color: var(--lw-gradient-start) !important;
}

.lw-card-glass .nav-tabs .nav-link.active {
    color: var(--lw-primary) !important;
    background-color: transparent !important;
    border-bottom: 3px solid var(--lw-gradient-start) !important;
}

.lw-card-glass .nav-tabs .nav-link.active i {
    color: var(--lw-gradient-start) !important;
}

/* Tab content styling */
.lw-card-glass .tab-content {
    background: transparent !important;
}

.lw-card-glass .tab-pane {
    background: transparent !important;
    background-color: transparent !important;
}

.lw-card-glass .tab-pane.active {
    background: transparent !important;
    background-color: transparent !important;
}

/* Smooth transitions for tabs */
.lw-card-glass .nav-tabs .nav-link,
.lw-card-glass .tab-content {
    transition: all 0.3s ease;
}

/* Remove default Bootstrap tab styling */
.lw-card-glass .nav-tabs .nav-item {
    margin-bottom: 0;
}

/* Make button container visible */
.lw-card-glass .px-6.pb-6.pt-4 {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    position: relative !important;
    z-index: 10 !important;
    background: white !important;
    border-top: 1px solid var(--lw-gray-200) !important;
}

/* Ensure button is visible and styled correctly */
.lw-card-glass .lw-btn-full {
    display: inline-flex !important;
    visibility: visible !important;
    width: 100% !important;
}

/* Fix expand filter height to show button */
.lw-expand-filter {
    height:411px;
}
.lw-expand-filter .lw-card-glass {
    min-height: auto !important;
    padding-bottom: 0 !important;
}

.lw-expand-filter .tab-pane {
    max-height: 400px !important;
    overflow-y: auto !important;
}
</style>