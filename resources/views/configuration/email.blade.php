<!-- Modern Email & SMS Configuration Page -->
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-envelope text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('Email & SMS') }}</h1>
            </div>
        </div>
    </x-lw.card>

    <!-- Email Setting Form -->
    <form class="lw-ajax-form lw-form" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        <!-- Email Settings Section -->
        <x-lw.card title="{{ __tr('Email Settings') }}" class="mb-6">
            <div class="space-y-6">
                <!-- Environment Settings Toggle -->
                <x-lw.form-field label="{{ __tr('Use email settings from .env file') }}" name="use_env_default_email_settings">
                    <input type="hidden" name="use_env_default_email_settings" value="" />
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only" id="forEnvDefaultSettings" name="use_env_default_email_settings" value="1" {{ ($configurationData['use_env_default_email_settings'] ?? false) == true ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </x-lw.form-field>

                <div id="lwAllFormFieldsBlock">
                    <div class="alert alert-info mb-4">{{ __tr('Instead of email settings from .env file use following for email.') }}</div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-4">
                        <x-lw.form-field label="{{ __tr('Mail From Address') }}" name="mail_from_address">
                            <x-lw.input type="email" name="mail_from_address" id="lwMailFromAddress" value="{{ $configurationData['mail_from_address'] ?? '' }}" required />
                            <small class="text-muted help-text">{{ __tr('Please cross check that from email domain is the same as hosted or usable with respective service provider.') }}</small>
                        </x-lw.form-field>

                        <x-lw.form-field label="{{ __tr('Mail From Name') }}" name="mail_from_name">
                            <x-lw.input type="text" name="mail_from_name" id="lwMailFromName" value="{{ $configurationData['mail_from_name'] ?? '' }}" required />
                        </x-lw.form-field>
                    </div>

                    <div class="mb-4">
                        <x-lw.form-field label="{{ __tr('Mail Driver/Service Provider') }}" name="mail_driver">
                            <select id="lwMailDriver" class="lw-select" name="mail_driver" required>
                                @if(!__isEmpty($configurationData['mail_drivers']))
                                    @foreach($configurationData['mail_drivers'] as $key => $driver)
                                        <option value="{{ $driver['id'] }}" {{ ($driver['id'] == ($configurationData['mail_driver'] ?? '')) ? 'selected' : '' }}>{{ $driver['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </x-lw.form-field>
                    </div>

                    <!-- SMTP Block -->
                    <div id="lwSmtpBlock">
                        <x-lw.card class="mb-4">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                                <x-lw.form-field label="{{ __tr('Mail Host') }}" name="smtp_mail_host">
                                    <x-lw.input type="text" name="smtp_mail_host" id="lwMailHost" value="{{ $configurationData['smtp_mail_host'] ?? '' }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Mail Port') }}" name="smtp_mail_port">
                                    <x-lw.input type="number" name="smtp_mail_port" id="lwMailPort" value="{{ $configurationData['smtp_mail_port'] ?? '' }}" min="0" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Mail Encryption') }}" name="smtp_mail_encryption">
                                    <select id="lwMailEncryption" class="lw-select" name="smtp_mail_encryption" required>
                                        @if(!__isEmpty($configurationData['mail_encryption_types']))
                                            @foreach($configurationData['mail_encryption_types'] as $key => $value)
                                                <option value="{{ $key }}" {{ ($key == ($configurationData['smtp_mail_encryption'] ?? '')) ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </x-lw.form-field>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <x-lw.form-field label="{{ __tr('Mail Username') }}" name="smtp_mail_username">
                                    <x-lw.input type="text" name="smtp_mail_username" id="lwMailUsername" value="{{ $configurationData['smtp_mail_username'] ?? '' }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Mail Password/Api Key') }}" name="smtp_mail_password_or_apikey">
                                    <x-lw.input type="text" name="smtp_mail_password_or_apikey" id="lwMailPasswordKey" value="{{ $configurationData['smtp_mail_password_or_apikey'] ?? '' }}" required />
                                </x-lw.form-field>
                            </div>
                        </x-lw.card>
                    </div>

                    <!-- Sparkpost Block -->
                    <div id="lwSparkpostBlock">
                        <x-lw.card class="mb-4">
                            <x-lw.form-field label="{{ __tr('Sparkpost Key') }}" name="sparkpost_mail_password_or_apikey">
                                <x-lw.input type="text" name="sparkpost_mail_password_or_apikey" id="lwSparkpostKey" value="{{ $configurationData['sparkpost_mail_password_or_apikey'] ?? '' }}" required />
                            </x-lw.form-field>
                        </x-lw.card>
                    </div>

                    <!-- Mailgun Block -->
                    <div id="lwMailgunBlock">
                        <x-lw.card class="mb-4">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
                                <x-lw.form-field label="{{ __tr('Mailgun Domain') }}" name="mailgun_domain">
                                    <x-lw.input type="text" name="mailgun_domain" id="lwMailgunDomain" value="{{ $configurationData['mailgun_domain'] ?? '' }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Mailgun Endpoint') }}" name="mailgun_endpoint">
                                    <x-lw.input type="text" name="mailgun_endpoint" id="lwMailgunEndpoint" value="{{ $configurationData['mailgun_endpoint'] ?? '' }}" required />
                                </x-lw.form-field>
                            </div>

                            <x-lw.form-field label="{{ __tr('Mailgun Secret') }}" name="mailgun_secret">
                                <x-lw.input type="text" name="mailgun_secret" id="lwMailgunSecret" value="{{ $configurationData['mailgun_secret'] ?? '' }}" required />
                            </x-lw.form-field>
                        </x-lw.card>
                    </div>
                </div>
            </div>
        </x-lw.card>

        <!-- SMS Settings Section -->
        <x-lw.card title="{{ __tr('SMS settings') }}" class="mb-6">
            <div class="space-y-6">
                <div class="mb-3">
                    <x-lw.form-field label="{{ __tr('Enable SMS') }}" name="use_enable_sms_settings">
                        <input type="hidden" name="use_enable_sms_settings" value="" />
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only" id="forEnableSmsSettings" name="use_enable_sms_settings" value="1" {{ ($configurationData['use_enable_sms_settings'] ?? false) == true ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </x-lw.form-field>
                    <small class="text-muted">{{ __tr('It will be used for sending OTP etc') }}</small>
                </div>

                <div id="lwAllSmsFieldsBlock">
                    <div class="mb-4">
                        <x-lw.form-field label="{{ __tr('Select SMS Service Provider') }}" name="sms_driver">
                            <select id="lwSmsDriver" class="lw-select" name="sms_driver" required>
                                @if(!__isEmpty($configurationData['sms_drivers']))
                                    @foreach($configurationData['sms_drivers'] as $key => $smsDriver)
                                        <option value="{{ $smsDriver['id'] }}" {{ ($smsDriver['id'] == ($configurationData['sms_driver'] ?? '')) ? 'selected' : '' }}>{{ $smsDriver['name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </x-lw.form-field>
                    </div>

                    <!-- Textlocal Block -->
                    <div id="lwTextlocalBlock">
                        <x-lw.card class="mb-4">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                                <x-lw.form-field label="{{ __tr('Textlocal Username') }}" name="sms_textlocal_username">
                                    <x-lw.input type="text" name="sms_textlocal_username" id="lwTextlocalUsername" placeholder="{{ __tr('Textlocal Username') }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Textlocal Hash') }}" name="sms_textlocal_hash">
                                    <x-lw.input type="text" name="sms_textlocal_hash" id="lwTextlocalHash" placeholder="{{ __tr('Textlocal Hash') }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Textlocal From') }}" name="sms_textlocal_from">
                                    <x-lw.input type="text" name="sms_textlocal_from" id="lwTextlocalFrom" placeholder="{{ __tr('Textlocal From') }}" required />
                                </x-lw.form-field>
                            </div>

                            <div class="text-danger help-text mt-2 text-sm">{{ __tr('IMPORTANT: Country Wise this URL may change.') }}</div>

                            <x-lw.form-field label="{{ __tr('Textlocal URL') }}" name="sms_textlocal_url">
                                <x-lw.input type="text" name="sms_textlocal_url" id="lwTextlocalURL" value="{{ $configurationData['sms_textlocal_url'] ?? '' }}" placeholder="{{ __tr('Textlocal URL') }}" required />
                            </x-lw.form-field>
                        </x-lw.card>
                    </div>

                    <!-- Twilio Block -->
                    <div id="lwTwilioBlock">
                        <x-lw.card class="mb-4">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                <x-lw.form-field label="{{ __tr('Twilio SID') }}" name="sms_twilio_sid">
                                    <x-lw.input type="text" name="sms_twilio_sid" id="lwTwilioSID" placeholder="{{ __tr('Twilio SID') }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Twilio Token') }}" name="sms_twilio_token">
                                    <x-lw.input type="text" name="sms_twilio_token" id="lwTwilioToken" placeholder="{{ __tr('Twilio Token') }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Twilio From') }}" name="sms_twilio_from">
                                    <x-lw.input type="text" name="sms_twilio_from" id="lwTwilioFrom" placeholder="{{ __tr('Twilio From') }}" required />
                                </x-lw.form-field>
                            </div>
                        </x-lw.card>
                    </div>

                    <!-- SMS77 Block -->
                    <div id="lwSms77Block">
                        <x-lw.card class="mb-4">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                <x-lw.form-field label="{{ __tr('Sms77 Api Key') }}" name="sms_sms77_apiKey">
                                    <x-lw.input type="text" name="sms_sms77_apiKey" id="lwSms77ApiKey" placeholder="{{ __tr('Sms77 Api Key') }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Sms77 Flush') }}" name="sms_sms77_flash">
                                    <x-lw.input type="text" name="sms_sms77_flash" id="lwSms77Flush" placeholder="{{ __tr('Sms77 Flush') }}" required />
                                </x-lw.form-field>

                                <x-lw.form-field label="{{ __tr('Sms77 From') }}" name="sms_sms77_from">
                                    <x-lw.input type="text" name="sms_sms77_from" id="lwSms77From" placeholder="{{ __tr('Sms77 From') }}" required />
                                </x-lw.form-field>
                            </div>
                        </x-lw.card>
                    </div>
                </div>
            </div>
        </x-lw.card>

        <!-- Submit Button -->
        <div class="flex justify-end pt-6 border-t border-gray-200">
            <x-lw.button type="button" variant="primary" size="lg" class="lw-ajax-form-submit-action px-12">
                <i class="fas fa-save mr-2"></i>
                {{ __tr('Update') }}
            </x-lw.button>
        </div>
    </form>
</div>

@lwPush('appScripts')
<script type="text/javascript">
    function toggleFormOptions(value) {
        switch (value) {
            case 'smtp':
                $('#lwSparkpostBlock, #lwMailgunBlock').hide();
                $('#lwSmtpBlock').show();
                break;
            case 'sparkpost':
                $('#lwSmtpBlock, #lwMailgunBlock').hide();
                $('#lwSparkpostBlock').show();
                break;
            case 'mailgun':
                $('#lwSparkpostBlock, #lwSmtpBlock').hide();
                $('#lwMailgunBlock').show();
                break;
            default:
        }
    };

    function toggleSmsFormOptions(value) {
        switch (value) {
            case 'textlocal':
                $('#lwTwilioBlock, #lwSms77Block').hide();
                $('#lwTextlocalBlock').show();
                break;
            case 'twilio':
                $('#lwSms77Block, #lwTextlocalBlock').hide();
                $('#lwTwilioBlock').show();
                break;
            case 'sms77':
                $('#lwTwilioBlock, #lwTextlocalBlock').hide();
                $('#lwSms77Block').show();
                break;
            default:
        }
    };

    //for all form fields
    function toggleFormByEnvSettings(value) {
        if (value == true) {
            $('#lwAllFormFieldsBlock').hide();
        } else {
            $('#lwAllFormFieldsBlock').show();
        }
    };

    function toggleFormBySmsSettings(value) {
        if (value == true) {
            $('#lwAllSmsFieldsBlock').show();
        } else {
            $('#lwAllSmsFieldsBlock').hide();
        }
    };

    toggleFormByEnvSettings(Boolean("{{ $configurationData['use_env_default_email_settings'] ?? false }}"));

    toggleFormBySmsSettings(Boolean("{{ $configurationData['use_enable_sms_settings'] ?? false }}"));

    toggleFormOptions("{{ $configurationData['mail_driver'] ?? '' }}");

    toggleSmsFormOptions("{{ $configurationData['sms_driver'] ?? '' }}");

    $('#forEnvDefaultSettings:checkbox').change(function(value) {
        toggleFormByEnvSettings(this.checked);
    });

    $('#forEnableSmsSettings:checkbox').change(function(value) {
        toggleFormBySmsSettings(this.checked);
    });

    //initialize selectize element
    $(function() {
        $('#lwMailDriver').selectize({
            onChange: function(value) {
                toggleFormOptions(value);
            }
        });
        $('#lwSmsDriver').selectize({
            onChange: function(value) {
                toggleSmsFormOptions(value);
            }
        });
    });

    //initialize selectize element
    $(function() {
        $('#lwMailEncryption').selectize({});
    });
</script>
@lwPushEnd