<style>
    /* Selectize dropdown styling fixes for Tailwind CSS */
	.selectize-dropdown,
	.selectize-dropdown.form-control {
		position: absolute !important;
		z-index: 9999 !important;
		border: 1px solid #d1d5db !important;
		border-radius: 0.375rem !important;
		background: white !important;
		box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
		max-height: 200px !important;
		overflow-y: auto !important;
		visibility: visible !important;
		opacity: 1 !important;
		margin-top: 1px !important;
	}
	
	.selectize-dropdown-content {
		padding: 0 !important;
		max-height: 200px !important;
		overflow-y: auto !important;
	}
	
	.selectize-dropdown .option,
	.selectize-dropdown [data-selectable] {
		padding: 8px 12px !important;
		border-bottom: 1px solid #f3f4f6 !important;
		cursor: pointer !important;
		display: block !important;
		visibility: visible !important;
		color: #374151 !important;
		background-color: white !important;
		transition: background-color 0.15s ease-in-out !important;
	}
	
	.selectize-dropdown .option:hover,
	.selectize-dropdown .option.active,
	.selectize-dropdown [data-selectable].active {
		background-color: #f3f4f6 !important;
		color: #1f2937 !important;
	}
	
	.selectize-dropdown .option:last-child,
	.selectize-dropdown [data-selectable]:last-child {
		border-bottom: none !important;
	}
	
	/* Ensure selectize control is properly styled */
	.selectize-control.single .selectize-input {
		border: 1px solid #d1d5db !important;
		border-radius: 0.375rem !important;
		padding: 0.5rem 0.75rem !important;
		background-color: white !important;
		color: #374151 !important;
		font-size: 1rem !important;
		line-height: 1.5 !important;
		transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
	}
	.selectize-control{
		border-bottom:none;
	}
	.selectize-control.single .selectize-input:focus {
		border-color: #3b82f6 !important;
		box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
		outline: none !important;
	}
	
	.selectize-control.single .selectize-input input[type="text"] {
		color: #374151 !important;
		font-size: 1rem !important;
		border: none !important;
		outline: none !important;
		background: transparent !important;
		padding: 0 !important;
		margin: 0 !important;
		width: 100% !important;
	}
	
	/* Fix for dropdown positioning */
	#lwSelectCurrency-selectized {
		position: relative !important;
	}
	
	/* Ensure form group has proper position context */
	#lwUserEditableLocation .form-group {
		position: relative !important;
		z-index: 1 !important;
	}
	
	/* Remove border-bottom from selectize control */
	.selectize-control.form-control.single {
		border-bottom: none !important;
	}
	
</style>
<!-- Page Container -->
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-money-bill-alt text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('Currency Settings') }}</h1>
                <p class="font-lw text-lw-secondary">{{ __tr('Configure your application currency and formatting options') }}</p>
            </div>
        </div>
    </x-lw.card>

    <!-- Currency Configuration Form -->
    <x-lw.card title="{{ __tr('Currency Configuration') }}" subtitle="{{ __tr('Set up your preferred currency and symbol settings') }}">
        <form id="form1" class="lw-ajax-form lw-form" name="currency_setting_form" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
            <!-- Hidden form type field -->
            <input type="hidden" name="form_type" value="currency_form" />

            <!-- Currency Selection -->
            <x-lw.form-field label="{{ __tr('Select Currency') }}" name="currency" required>
                <select 
                    name="currency"
                    placeholder="{{ __tr('Select a Currency...') }}"
                    required
                    id="lwSelectCurrency"
                >
                    @if(!__isEmpty($configurationData['currency_options']))
                        @foreach($configurationData['currency_options'] as $key => $currency)
                            <option value="{{ $currency['currency_code'] }}" {{ $configurationData['currency'] == $currency['currency_code'] ? 'selected' : '' }}>{{ $currency['currency_name'] }}</option>
                        @endforeach
                    @endif
                </select>
            </x-lw.form-field>

            <!-- Currency Details -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Currency Code -->
                <x-lw.form-field label="{{ __tr('Currency Code') }}" name="currency_value" required>
                    <x-lw.input 
                        type="text"
                        name="currency_value"
                        placeholder="{{ __tr('e.g., USD, EUR, GBP') }}"
                        value="{{ $configurationData['currency_value'] }}"
                        id="lwCurrencyCode"
                        required
                    />
                </x-lw.form-field>

                <!-- Currency Symbol -->
                <x-lw.form-field label="{{ __tr('Currency Symbol') }}" name="currency_symbol" required>
                    <div class="relative">
                        <x-lw.input 
                            type="text"
                            name="currency_symbol"
                            placeholder="{{ __tr('e.g., $, €, £') }}"
                            value="{{ htmlentities($configurationData['currency_symbol']) }}"
                            id="lwCurrencySymbol"
                            required
                        />
                        <div class="absolute right-5 top-1/2 transform -translate-y-1/2 bg-gray-100 px-3 py-1 rounded-full text-sm font-lw font-medium text-lw-primary border border-gray-200" id="lwCurrencySymbolAddon">
                            {!! $configurationData['currency_symbol'] !!}
                        </div>
                    </div>
                </x-lw.form-field>
            </div>

            <!-- Zero Decimal Currency Settings -->
            <div id="lwIsZeroDecimalCurrency" style="display:none;">
                <!-- Zero Decimal Switch -->
                <x-lw.form-field label="{{ __tr('Zero Decimal Currency Settings') }}" name="round_zero_decimal_currency">
                    <x-lw.checkbox 
                        name="round_zero_decimal_currency"
                        value="1"
                        :checked="$configurationData['round_zero_decimal_currency'] == 1"
                        label="{{ __tr('Round Zero Decimal Currency') }}"
                        id="lwZeroDecimalSwitch"
                    />
                </x-lw.form-field>

                <!-- Warning Message -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4" id="lwZeroDecimalExist" style="display: none;">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-lw font-medium text-yellow-800 mb-1">{{ __tr('Rounding Notice') }}</p>
                            <p class="font-lw text-sm text-yellow-700">{{ __tr('All the price and amount will be rounded. e.g : 10.25 It will become 10, 10.57 It will become 11.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4" id="lwZeroDecimalNotExist" style="display: none;">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-red-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-lw font-medium text-red-800 mb-1">{{ __tr('Important Warning') }}</p>
                            <p class="font-lw text-sm text-red-700">{{ __tr("This currency doesn't support Decimal values it may create error at payment.") }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Currency Information Card -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-lw font-medium text-blue-800 mb-1">{{ __tr('Currency Information') }}</p>
                        <p class="font-lw text-sm text-blue-700">{{ __tr('Select your preferred currency from the dropdown. The currency code and symbol will be automatically filled based on your selection. You can modify them if needed.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-6 border-t border-gray-200">
                <x-lw.button 
                    type="submit"
                    variant="primary"
                    size="lg"
                    class="lw-ajax-form-submit-action px-12"
                >
                    <i class="fas fa-save mr-2"></i>
                    {{ __tr('Save Currency Settings') }}
                </x-lw.button>
            </div>
        </form>
    </x-lw.card>
</div>

@lwPush('appScripts')
<script>
    /***********  Currency block start here ***********/
    var isZeroDecimalCurrency = false, //set by default zero decimal currency false
        zeroDecimal = $("#lwZeroDecimalSwitch").is(':checked');

    //if zero decimal currency check 
    if (zeroDecimal) {
        $("#lwZeroDecimalExist").show();
        $("#lwZeroDecimalNotExist").hide();
    }

    //zero decimal currency on change event
    $(function() {
        $('#lwZeroDecimalSwitch').on('change', function(event) {
            var zeroDecimalValue = event.target.checked;
            //is checked show warning message or error message
            if (zeroDecimalValue) {
                $("#lwZeroDecimalExist").show();
                $("#lwZeroDecimalNotExist").hide();
            } else {
                $("#lwZeroDecimalExist").hide();
                $("#lwZeroDecimalNotExist").show();
            }
        })
    });

    //initialize selectize element
    $(function() {
        $('#lwSelectCurrency').selectize({
            valueField: 'currency_code',
            labelField: 'currency_name',
            searchField: ['currency_code', 'currency_name'],
            plugins: ['remove_button'],
            create: false
        });
    });

    //on change currency input field value 
    $('#lwSelectCurrency').on('change', function(event) {
        var selectedCurrency = event.target.value,
            currencies = {!! json_encode($configurationData['currencies']['details']) !!},
            zeroDecimalCurrency = {!! json_encode($configurationData['currencies']['zero_decimal']) !!},
            isMatch = _.filter(zeroDecimalCurrency, function(value, key) {
                return (key === selectedCurrency);
            });

        isZeroDecimalCurrency = Boolean(isMatch.length);

        //if zero decimal currency is false or blank
        if (isZeroDecimalCurrency) {
            $("#lwIsZeroDecimalCurrency").show();
        } else {
            $("#lwIsZeroDecimalCurrency").hide();
        }

        //on change currency symbol and currency code input field value
        if (!_.isEmpty(selectedCurrency) && selectedCurrency != 'other') {
            if (currencies[selectedCurrency]) {
                $('#lwCurrencyCode').val(selectedCurrency);
                $('#lwCurrencySymbol').val(currencies[selectedCurrency].ASCII);
                $("#lwCurrencySymbolAddon").show();
                $("#lwCurrencySymbolAddon").html(currencies[selectedCurrency].symbol);
            }
        } else {
            $('#lwCurrencyCode').val('');
            $('#lwCurrencySymbol').val('');
            $("#lwCurrencySymbolAddon").hide();
        }
    });
    /***********  Currency block end here ***********/
</script>
@lwPushEnd
