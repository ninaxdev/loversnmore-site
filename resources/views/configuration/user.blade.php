<!-- Page Container -->
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('User Settings') }}</h1>
                <p class="font-lw text-lw-secondary">{{ __tr('Configure user registration, authentication and account management settings') }}</p>
            </div>
        </div>
    </x-lw.card>

    <!-- User Settings Form -->
    <form class="lw-ajax-form lw-form" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        
        <!-- Account Activation Settings -->
        <x-lw.card title="{{ __tr('Account Activation Settings') }}" subtitle="{{ __tr('Configure email activation requirements for new users') }}" class="mb-6">
            <!-- Email activation required for new user -->
            <x-lw.form-field label="{{ __tr('Email activation required for new user') }}" name="activation_required_for_new_user">
                <x-lw.radio-group 
                    name="activation_required_for_new_user"
                    layout="horizontal"
                    :options="[
                        '1' => __tr('Yes'),
                        '0' => __tr('No')
                    ]"
                    value="{{ $configurationData['activation_required_for_new_user'] ? '1' : '0' }}"
                />
                <div class="mt-2">
                    <small class="font-lw text-xs text-lw-secondary">
                        <strong>{{ __tr('Note:') }}</strong> {{ __tr('To update content of activation email you need to edit /resources/views/emails/account/activation.blade.php file.') }}
                    </small>
                </div>
            </x-lw.form-field>

            <!-- Activation required for change email -->
            <x-lw.form-field label="{{ __tr('Activation required for change email') }}" name="activation_required_for_change_email">
                <x-lw.radio-group 
                    name="activation_required_for_change_email"
                    layout="horizontal"
                    :options="[
                        '1' => __tr('Yes'),
                        '0' => __tr('No')
                    ]"
                    value="{{ $configurationData['activation_required_for_change_email'] ? '1' : '0' }}"
                />
                <div class="mt-2">
                    <small class="font-lw text-xs text-lw-secondary">
                        <strong>{{ __tr('Note:') }}</strong> {{ __tr('To update content of welcome email you need to edit /resources/views/emails/account/new-email-activation.blade.php file.') }}
                    </small>
                </div>
            </x-lw.form-field>

            <!-- Send welcome email to newly registered users -->
            <x-lw.form-field label="{{ __tr('Welcome Email Settings') }}" name="send_welcome_email_to_newly_registered_users">
                <x-lw.checkbox 
                    name="send_welcome_email_to_newly_registered_users"
                    value="1"
                    :checked="$configurationData['send_welcome_email_to_newly_registered_users']"
                    label="{{ __tr('Send welcome email to newly registered users') }}"
                />
                <div class="mt-2">
                    <small class="font-lw text-xs text-lw-secondary">
                        <strong>{{ __tr('Note:') }}</strong> {{ __tr('To update content of welcome email you need to edit /resources/views/emails/account/welcome.blade.php file.') }}
                    </small>
                </div>
            </x-lw.form-field>
        </x-lw.card>

        <!-- Admin & User Management -->
        <x-lw.card title="{{ __tr('Admin & User Management') }}" subtitle="{{ __tr('Configure admin visibility and user account settings') }}" class="mb-6">
            <!-- Include admin in search result -->
            <x-lw.form-field label="{{ __tr('Include admin in search result, encounter, random users & featured users') }}" name="include_exclude_admin">
                <x-lw.radio-group 
                    name="include_exclude_admin"
                    layout="horizontal"
                    :options="[
                        '1' => __tr('Yes'),
                        '0' => __tr('No')
                    ]"
                    value="{{ $configurationData['include_exclude_admin'] ? '1' : '0' }}"
                />
            </x-lw.form-field>

            <!-- Display Mobile Number -->
            <x-lw.form-field label="{{ __tr('Display Mobile Number') }}" name="display_mobile_number">
                <x-lw.radio-group 
                    name="display_mobile_number"
                    layout="vertical"
                    :options="$configurationData['admin_choice_display_mobile_number']"
                    value="{{ $configurationData['display_mobile_number'] }}"
                />
            </x-lw.form-field>
        </x-lw.card>

        <!-- Credits & Bonus Settings -->
        <x-lw.card title="{{ __tr('Credits & Bonus Settings') }}" subtitle="{{ __tr('Configure bonus credits for new users') }}" class="mb-6">
            <!-- Allocate Bonus Credits -->
            <x-lw.form-field label="{{ __tr('Bonus Credits Configuration') }}" name="enable_bonus_credits">
                <x-lw.checkbox 
                    name="enable_bonus_credits"
                    value="1"
                    :checked="$configurationData['enable_bonus_credits']"
                    label="{{ __tr('Allocate Bonus Credits to new users') }}"
                    id="lwEnableBonusCredits"
                />
            </x-lw.form-field>

            <!-- Number of credits -->
            <div id="lwNumberOfCredits" style="{{ $configurationData['enable_bonus_credits'] ? '' : 'display: none;' }}">
                <x-lw.form-field label="{{ __tr('How many free credits, do you want to offer to the newly registered user?') }}" name="number_of_credits">
                    <x-lw.input 
                        type="number"
                        name="number_of_credits"
                        placeholder="{{ __tr('Enter number of credits') }}"
                        value="{{ $configurationData['number_of_credits'] }}"
                        min="0"
                    />
                </x-lw.form-field>
            </div>
        </x-lw.card>

        <!-- URLs Configuration -->
        <x-lw.card title="{{ __tr('Legal URLs Configuration') }}" subtitle="{{ __tr('Configure terms, conditions and privacy policy URLs') }}" class="mb-6">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="font-lw font-medium text-blue-800 mb-1">{{ __tr('Tip:') }}</p>
                        <p class="font-lw text-sm text-blue-700">{{ __tr('You can use any external urls for this alternatively you can create pages and use that link here for terms condition and for privacy policy.') }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Terms And Conditions URL -->
                <x-lw.form-field label="{{ __tr('Terms And Conditions URL') }}" name="terms_and_conditions_url" required>
                    <x-lw.input 
                        type="url"
                        name="terms_and_conditions_url"
                        placeholder="{{ __tr('Enter terms and conditions URL') }}"
                        value="{{ $configurationData['terms_and_conditions_url'] }}"
                        required
                    />
                    <div class="mt-2">
                        <small class="font-lw text-xs text-lw-secondary">{{ __tr('Register page will use this url so the user can read terms and conditions.') }}</small>
                    </div>
                </x-lw.form-field>

                <!-- Privacy Policy URL -->
                <x-lw.form-field label="{{ __tr('Privacy Policy URL') }}" name="privacy_policy_url">
                    <x-lw.input 
                        type="url"
                        name="privacy_policy_url"
                        placeholder="{{ __tr('Enter privacy policy URL') }}"
                        value="{{ $configurationData['privacy_policy_url'] }}"
                    />
                    <div class="mt-2">
                        <small class="font-lw text-xs text-lw-secondary">{{ __tr('Privacy policy page will use this url so the user can read it.') }}</small>
                    </div>
                </x-lw.form-field>
            </div>
        </x-lw.card>

        <!-- User Restrictions & Authentication -->
        <x-lw.card title="{{ __tr('User Restrictions & Authentication') }}" subtitle="{{ __tr('Configure photo limits and login options') }}" class="mb-6">
            <!-- Photos restrictions for user -->
            <x-lw.form-field label="{{ __tr('User Photos Restriction') }}" name="user_photo_restriction">
                <x-lw.input 
                    type="number"
                    name="user_photo_restriction"
                    placeholder="{{ __tr('Enter maximum number of photos') }}"
                    value="{{ $configurationData['user_photo_restriction'] }}"
                    min="1"
                />
                <div class="mt-2">
                    <small class="font-lw text-xs text-lw-secondary">{{ __tr('Maximum photos you want to allow user to upload in photos section.') }}</small>
                </div>
            </x-lw.form-field>

            <!-- Allow User login with Mobile Number -->
            <x-lw.form-field label="{{ __tr('Allow User login with Mobile Number') }}" name="allow_user_login_with_mobile_number">
                <x-lw.radio-group 
                    name="allow_user_login_with_mobile_number"
                    layout="horizontal"
                    :options="[
                        '1' => __tr('Yes'),
                        '0' => __tr('No')
                    ]"
                    value="{{ $configurationData['allow_user_login_with_mobile_number'] ? '1' : '0' }}"
                />
                <div class="mt-2">
                    <small class="font-lw text-xs text-lw-secondary">{{ __tr('Enabling it will allow user to login with mobile number along with email and username') }}</small>
                </div>
            </x-lw.form-field>

            <!-- Enable OTP Login -->
            <x-lw.form-field label="{{ __tr('Enable OTP Login') }}" name="enable_otp_Login">
                <x-lw.radio-group 
                    name="enable_otp_Login"
                    layout="horizontal"
                    :options="[
                        '1' => __tr('Yes'),
                        '0' => __tr('No')
                    ]"
                    value="{{ $configurationData['enable_otp_Login'] ? '1' : '0' }}"
                />
                <div class="mt-2">
                    <small class="font-lw text-xs text-lw-secondary">{{ __tr('For the SMS OTP you should have working SMS gateway configured from Email and SMS settings.') }}</small>
                </div>
            </x-lw.form-field>
        </x-lw.card>

        <!-- Submit Button -->
        <div class="flex justify-end pt-6 border-t border-gray-200">
            <x-lw.button 
                type="button"
                variant="primary"
                size="lg"
                class="lw-ajax-form-submit-action px-12"
            >
                <i class="fas fa-save mr-2"></i>
                {{ __tr('Update Settings') }}
            </x-lw.button>
        </div>
    </form>
</div>

@lwPush('appScripts')
<script>
    $(document).ready(function() {
        var enableBonusCredits = {{ $configurationData['enable_bonus_credits'] ? 'true' : 'false' }};
        
        // on change enable credits event
        $("#lwEnableBonusCredits").on('change', function() {
            enableBonusCredits = $(this).is(':checked');
            //check is enable true
            if (enableBonusCredits) {
                //show number of credits input field
                $("#lwNumberOfCredits").show();
            } else {
                //hide number of credits input field
                $("#lwNumberOfCredits").hide();
            }
        });
    });
</script>
@lwPushEnd
