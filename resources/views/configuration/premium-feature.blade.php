<!-- Page Container -->
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-star text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('Feature Settings') }}</h1>
                <p class="font-lw text-lw-secondary">{{ __tr('Configure premium features and user access permissions') }}</p>
            </div>
        </div>
    </x-lw.card>

    <!-- Feature Settings Form -->
    <form class="lw-ajax-form lw-form" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($configurationData['feature_plans'] as $key => $feature)
                @if(isset($feature['enable']) and $feature['enable'])
                    @if($loop->last)
                        <!-- Last item takes full width -->
                        <div class="lg:col-span-2">
                    @else
                        <div>
                    @endif
                        <x-lw.card class="h-full">
                            <!-- Feature Header -->
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="bg-gradient-lw p-2 rounded-lg">
                                    @if($key == 'user_encounter')
                                        <i class="fas fa-users text-white"></i>
                                    @elseif($key == 'booster')
                                        <i class="fas fa-rocket text-white"></i>
                                    @elseif($key == 'gift')
                                        <i class="fas fa-gift text-white"></i>
                                    @elseif($key == 'sticker')
                                        <i class="fas fa-smile text-white"></i>
                                    @else
                                        <i class="fas fa-star text-white"></i>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-lw font-semibold text-lg text-lw-primary">{{ $feature['title'] }}</h3>
                                    <p class="font-lw text-sm text-lw-secondary">{{ __tr('Premium feature configuration') }}</p>
                                </div>
                            </div>

                            <!-- Feature Options -->
                            <div id="lwFeatureSelectUser_{{ $key }}">
                                <x-lw.form-field label="{{ __tr('Access Control') }}" name="feature_plans[{{ $key }}][select_user]" class="mb-6">
                                    <div class="space-y-3">
                                        @foreach($feature['options'] as $optionKey => $option)
                                            <!-- Hidden field for radio group -->
                                            @if($loop->first)
                                                <input type="hidden" name="feature_plans[{{ $key }}][select_user]" value="1" />
                                            @endif

                                            <!-- Radio Option -->
                                            <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                                                <input type="radio" 
                                                       id="lwSelectUser_{{ $key . '_' . $optionKey }}" 
                                                       value="{{ $option['value'] }}" 
                                                       name="feature_plans[{{ $key }}][select_user]" 
                                                       class="form-radio text-lw-primary" 
                                                       {{ $feature['select_user'] == $option['value'] ? 'checked' : '' }}>
                                                <div class="ml-3">
                                                    <span class="font-lw font-medium text-lw-primary">{{ $option['title'] }}</span>
                                                    @if($option['value'] == 1)
                                                        <p class="font-lw text-xs text-lw-secondary mt-1">{{ __tr('Available to all users including free users') }}</p>
                                                    @elseif($option['value'] == 2)
                                                        <p class="font-lw text-xs text-lw-secondary mt-1">{{ __tr('Restricted to premium subscribers only') }}</p>
                                                    @endif
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </x-lw.form-field>

                                <!-- Special Encounter User Count Field -->
                                @if($key == 'user_encounter')
                                    <div id="lwEncounterUserCountField_{{ $key }}" class="mb-6" style="display:none">
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                            <h4 class="font-lw font-semibold text-blue-800 mb-3">{{ __tr('Daily Encounter Limit') }}</h4>
                                            <x-lw.form-field label="{{ __tr('Daily Encounter limit for Normal Users') }}" name="feature_plans[{{ $key }}][encounter_all_user_count]">
                                                <x-lw.input 
                                                    type="number"
                                                    name="feature_plans[{{ $key }}][encounter_all_user_count]"
                                                    placeholder="{{ __tr('Enter daily encounter limit') }}"
                                                    value="{{ $feature['encounter_all_user_count'] }}"
                                                    min="1"
                                                    max="999"
                                                />
                                            </x-lw.form-field>
                                            <div class="mt-2">
                                                <p class="font-lw text-xs text-blue-700">
                                                    <i class="fas fa-info-circle mr-1"></i>
                                                    {{ __tr('Set the maximum number of encounters free users can have per day') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Feature Description -->
                                <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-start space-x-2">
                                        <i class="fas fa-lightbulb text-lw-primary mt-0.5"></i>
                                        <div>
                                            <p class="font-lw text-sm text-lw-secondary">
                                                @if($key == 'user_encounter')
                                                    {{ __tr('Control who can access the user encounter feature. Premium users get unlimited encounters.') }}
                                                @elseif($key == 'booster')
                                                    {{ __tr('Manage access to profile boost features that increase user visibility.') }}
                                                @elseif($key == 'gift')
                                                    {{ __tr('Configure who can send virtual gifts to other users.') }}
                                                @elseif($key == 'sticker')
                                                    {{ __tr('Control access to premium stickers and emoji reactions.') }}
                                                @else
                                                    {{ __tr('Configure access permissions for this premium feature.') }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-lw.card>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-6 border-t border-gray-200 mt-8">
            <x-lw.button 
                type="button"
                variant="primary"
                size="lg"
                class="lw-ajax-form-submit-action px-12"
            >
                <i class="fas fa-save mr-2"></i>
                {{ __tr('Update Feature Settings') }}
            </x-lw.button>
        </div>
    </form>
</div>

<style>
.lw-disabled-block-content {
    opacity: 0.5;
    pointer-events: none;
}
</style>

@lwPush('appScripts')
<script>
    "use strict";
    
    $(document).ready(function() {
        var premiumFeature = JSON.parse('{!! str_replace("\u0022", "\\\\\"", json_encode($configurationData['feature_plans'], JSON_HEX_QUOT)) !!}');
        var enableUserEncounter = premiumFeature['user_encounter']['enable'];

        // Premium plan array on change bind value and disable input price field start
        _.forEach(premiumFeature, function(featureValue, featureKey) {
            var enableFeature = featureValue.enable;
            var featureOption = featureValue.options;

            // Check premium feature are enable or disable
            if (!enableFeature) {
                $("#lwFeatureSelectUser_" + featureKey).addClass('lw-disabled-block-content');
            } else {
                $("#lwFeatureSelectUser_" + featureKey).removeClass('lw-disabled-block-content');
            }

            // Feature option array start
            _.forEach(featureOption, function(optionValue, optionKey) {
                var isCheckedEncounterAllUser = $("#lwSelectUser_user_encounter_0").is(':checked');

                // Check select feature is encounter and select user is 'All user (1)'
                if (enableUserEncounter && isCheckedEncounterAllUser) {
                    $("#lwEncounterUserCountField_" + featureKey).show();
                }

                // Enable plan on change event
                $("#lwSelectUser_" + featureKey + '_' + optionKey).on('change', function(e) {
                    isCheckedEncounterAllUser = $("#lwSelectUser_user_encounter_0").is(':checked');

                    // Check select feature is encounter and select user is 'All user (1)'
                    if (enableUserEncounter && isCheckedEncounterAllUser) {
                        $("#lwEncounterUserCountField_" + featureKey).show();
                    } else {
                        $("#lwEncounterUserCountField_" + featureKey).hide();
                    }
                });
            });
            // Feature option array end
        });
        // Premium plan array on change bind value and disable input price field end

        // Form submission callback - attach to ajax form
        $(document).on('lw.ajax.form.callback', '.lw-ajax-form', function(event, responseData) {
            if (responseData.reaction == 1) {
                showConfirmation("{{ __tr('Feature Settings Updated Successfully') }}", function() {
                    __Utils.viewReload();
                }, {
                    confirmButtonText: "{{ __tr('Reload Page') }}",
                    type: "success"
                });
            }
        });
    });
</script>
@lwPushEnd
