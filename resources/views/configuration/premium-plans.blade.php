<!-- Page Container -->
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-gem text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('Premium Plan Settings') }}</h1>
                <p class="font-lw text-lw-secondary">{{ __tr('Configure and manage your premium subscription plans and pricing') }}</p>
            </div>
        </div>
    </x-lw.card>

    <!-- Premium Plans Form -->
    <form class="lw-ajax-form lw-form" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($configurationData['plan_duration'] as $key => $plan)
            <x-lw.card class="relative">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-lw p-2 rounded-lg">
                            @if($key == 'one_month')
                                <i class="fas fa-calendar text-white"></i>
                            @elseif($key == 'three_month') 
                                <i class="fas fa-calendar-alt text-white"></i>
                            @elseif($key == 'six_month')
                                <i class="fas fa-calendar-check text-white"></i>
                            @else
                                <i class="fas fa-calendar-plus text-white"></i>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-lw font-semibold text-lg text-lw-primary">{{ $plan['title'] }}</h3>
                            <p class="font-lw text-sm text-lw-secondary">{{ __tr('Premium subscription plan') }}</p>
                        </div>
                    </div>
                    
                    <!-- Enable/Disable Toggle -->
                    <label class="relative inline-flex items-center cursor-pointer">
                        <!-- Hidden field for unchecked state -->
                        <input type="hidden" name="plan_duration[{{ $key }}][enable]" value="false" />
                        <input type="checkbox" 
                               class="sr-only peer" 
                               id="lwEnable_{{ $key }}" 
                               name="plan_duration[{{ $key }}][enable]" 
                               value="true" 
                               {{ $plan['enable'] == 'true' ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-lw"></div>
                        <span class="ml-3 font-lw text-sm text-lw-secondary">{{ __tr('Enable Plan') }}</span>
                    </label>
                </div>

                <!-- Plan Price Field -->
                <div id="lwPlanPriceInputField_{{ $key }}" class="transition-opacity duration-300">
                    <x-lw.form-field label="{{ __tr('Credit Price') }}" name="plan_duration[{{ $key }}][price]">
                        <div class="relative">
                            <x-lw.input 
                                type="number"
                                name="plan_duration[{{ $key }}][price]"
                                placeholder="{{ __tr('Enter credit price') }}"
                                value="{{ $plan['price'] }}"
                                id="lwPrice_{{ $key }}"
                                class="pr-20"
                                min="0"
                                step="0.01"
                            />
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-gradient-lw text-white px-3 py-1 rounded text-sm font-lw">
                                {{ __tr('Credits') }}
                            </div>
                        </div>
                    </x-lw.form-field>

                    <!-- Plan Duration Info -->
                    <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-info-circle text-lw-primary"></i>
                            <span class="font-lw text-sm text-lw-secondary">
                                @if($key == 'one_month')
                                    {{ __tr('Monthly subscription - billed every month') }}
                                @elseif($key == 'three_month')
                                    {{ __tr('Quarterly subscription - billed every 3 months') }}
                                @elseif($key == 'six_month')
                                    {{ __tr('Semi-annual subscription - billed every 6 months') }}
                                @else
                                    {{ __tr('Annual subscription - billed yearly') }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="absolute top-4 right-4">
                    <span id="lwPlanStatus_{{ $key }}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $plan['enable'] == 'true' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $plan['enable'] == 'true' ? __tr('Active') : __tr('Inactive') }}
                    </span>
                </div>
            </x-lw.card>
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
                {{ __tr('Update Premium Plans') }}
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
        var premiumPlan = JSON.parse('{!! json_encode($configurationData['plan_duration']) !!}');

        // Premium plan array on change bind value and disable input price field start
        _.forEach(premiumPlan, function(value, key) {
            var enablePlan = value.enable;
            
            // Check if false then disabled input price field
            if (enablePlan !== 'true' && enablePlan !== true) {
                $("#lwPlanPriceInputField_" + key).addClass('lw-disabled-block-content');
            }

            // Enable plan on change event
            $("#lwEnable_" + key).on('change', function(e) {
                var enablePlan = $(this).is(':checked');
                var statusBadge = $("#lwPlanStatus_" + key);
                
                if (enablePlan) {
                    $("#lwPlanPriceInputField_" + key).removeClass('lw-disabled-block-content');
                    statusBadge.removeClass('bg-gray-100 text-gray-800')
                              .addClass('bg-green-100 text-green-800')
                              .text('{{ __tr('Active') }}');
                } else {
                    $("#lwPlanPriceInputField_" + key).addClass('lw-disabled-block-content');
                    statusBadge.removeClass('bg-green-100 text-green-800')
                              .addClass('bg-gray-100 text-gray-800')
                              .text('{{ __tr('Inactive') }}');
                }
            });
        });
        // Premium plan array on change bind value and disable input price field end

        // Form submission callback - attach to ajax form
        $(document).on('lw.ajax.form.callback', '.lw-ajax-form', function(event, responseData) {
            if (responseData.reaction == 1) {
                showConfirmation("{{ __tr('Premium Plans Updated Successfully') }}", function() {
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
