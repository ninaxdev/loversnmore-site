<!-- Modern Social Login Settings Page -->
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-lw-primary mb-2">{{ __tr('Social Login Settings') }}</h1>
                <p class="text-lw-secondary">{{ __tr('Configure Facebook and Google login integration for your application') }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-share-alt text-white text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Login Settings Form -->
    <form class="lw-ajax-form lw-form space-y-8" method="post" data-callback="onSocialLoginFormCallback" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        
        <!-- Facebook Login Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fab fa-facebook-f text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">{{ __tr('Facebook Login') }}</h3>
                            <p class="text-blue-100 text-sm">{{ __tr('Enable users to login with their Facebook account') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <!-- Enable Facebook Login Switch -->
                        <input type="hidden" name="allow_facebook_login" id="lwEnableFacebookLogin" value="0" />
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   class="sr-only peer" 
                                   id="lwAllowFacebookLogin" 
                                   {{ $configurationData['allow_facebook_login'] == true ? 'checked' : '' }} 
                                   name="allow_facebook_login" 
                                   value="1">
                            <div class="w-11 h-6 bg-white/30 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-white/50"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Facebook Keys Installed Status -->
                <div class="mb-4" id="lwIsFacebookKeysExist" style="display:none">
                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-green-800 font-medium">{{ __tr('Facebook keys are installed.') }}</span>
                        </div>
                        <button type="button" class="px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors font-medium" id="lwAddFacebookKeys">
                            {{ __tr('Update') }}
                        </button>
                    </div>
                </div>

                <!-- Facebook Keys Hidden Field -->
                <input type="hidden" name="facebook_keys_exist" id="lwFacebookKeysExist" value="{{ $configurationData['facebook_client_id'] }}" />

                <!-- Facebook Configuration Fields -->
                <div id="lwFacebookLoginInputField" class="space-y-6">
                    <!-- Facebook App ID -->
                    <div class="lw-form-group">
                        <label for="lwFacebookAppID" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Facebook App ID') }}
                        </label>
                        <div class="lw-input-container">
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="facebook_client_id" 
                                   placeholder="{{ __tr('Add Your Facebook App ID') }}" 
                                   id="lwFacebookAppID">
                        </div>
                    </div>

                    <!-- Facebook App Secret -->
                    <div class="lw-form-group">
                        <label for="lwFacebookAppSecret" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Facebook App Secret') }}
                        </label>
                        <div class="lw-input-container">
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="facebook_client_secret" 
                                   placeholder="{{ __tr('Add Your Facebook App Secret') }}" 
                                   id="lwFacebookAppSecret">
                        </div>
                    </div>

                    <!-- Facebook Callback URL -->
                    <div class="lw-form-group">
                        <label for="lwFacebookCallbackUrl" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Callback URL') }}
                        </label>
                        <div class="lw-input-container">
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 font-medium cursor-not-allowed" 
                                   id="lwFacebookCallbackUrl" 
                                   value="{{ route('social.user.login.callback', [getSocialProviderKey('facebook')]) }}" 
                                   readonly>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">{{ __tr('Copy this URL to your Facebook app configuration') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Login Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fab fa-google text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">{{ __tr('Google Login') }}</h3>
                            <p class="text-red-100 text-sm">{{ __tr('Enable users to login with their Google account') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <!-- Enable Google Login Switch -->
                        <input type="hidden" name="allow_google_login" id="lwEnableGoogleLogin" value="0" />
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   class="sr-only peer" 
                                   id="lwAllowGoogleLogin" 
                                   {{ $configurationData['allow_google_login'] == true ? 'checked' : '' }} 
                                   name="allow_google_login" 
                                   value="1">
                            <div class="w-11 h-6 bg-white/30 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-white/50"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Google Keys Installed Status -->
                <div class="mb-4" id="lwIsGoogleKeysExist" style="display:none">
                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-green-800 font-medium">{{ __tr('Google keys are installed.') }}</span>
                        </div>
                        <button type="button" class="px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors font-medium" id="lwAddGoogleKeys">
                            {{ __tr('Update') }}
                        </button>
                    </div>
                </div>

                <!-- Google Keys Hidden Field -->
                <input type="hidden" name="google_keys_exist" id="lwGoogleKeysExist" value="{{ $configurationData['google_client_id'] }}" />

                <!-- Google Configuration Fields -->
                <div id="lwGoogleLoginInputField" class="space-y-6">
                    <!-- Google Client ID -->
                    <div class="lw-form-group">
                        <label for="lwGoogleClientId" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Google Client ID') }}
                        </label>
                        <div class="lw-input-container">
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="google_client_id" 
                                   placeholder="{{ __tr('Add Your Google Client ID') }}" 
                                   id="lwGoogleClientId">
                        </div>
                    </div>

                    <!-- Google Client Secret -->
                    <div class="lw-form-group">
                        <label for="lwGoogleClientSecret" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Google Client Secret') }}
                        </label>
                        <div class="lw-input-container">
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="google_client_secret" 
                                   placeholder="{{ __tr('Add Your Google Client Secret') }}" 
                                   id="lwGoogleClientSecret">
                        </div>
                    </div>

                    <!-- Google Callback URL -->
                    <div class="lw-form-group">
                        <label for="lwGoogleCallbackUrl" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Callback URL') }}
                        </label>
                        <div class="lw-input-container">
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-600 font-medium cursor-not-allowed" 
                                   id="lwGoogleCallbackUrl" 
                                   value="{{ route('social.user.login.callback', [getSocialProviderKey('google')]) }}" 
                                   readonly>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">{{ __tr('Copy this URL to your Google app configuration') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Button -->
        <div class="flex justify-end pt-6">
            <button type="submit" class="lw-ajax-form-submit-action px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                <i class="fas fa-save mr-2"></i>
                {{ __tr('Update Settings') }}
            </button>
        </div>
    </form>
</div>

@lwPush('appScripts')
<script>
    // Facebook login js block start
    $(document).ready(function() {
        var allowFacebookLogin = $("#lwAllowFacebookLogin").is(':checked');

        // Initialize state
        if (!allowFacebookLogin) {
            $("#lwFacebookLoginInputField").addClass('opacity-50 pointer-events-none');
            $('#lwAddFacebookKeys').attr("disabled", true);
        }

        // Facebook switch on change event
        $("#lwAllowFacebookLogin").on('change', function(e) {
            allowFacebookLogin = $(this).is(":checked");
            if (!allowFacebookLogin) {
                $("#lwFacebookLoginInputField").addClass('opacity-50 pointer-events-none');
                $('#lwAddFacebookKeys').attr("disabled", true);
            } else {
                $("#lwFacebookLoginInputField").removeClass('opacity-50 pointer-events-none');
                $('#lwAddFacebookKeys').attr("disabled", false);
            }
        });

        // Facebook Keys setting
        var isFacebookKeysInstalled = "{{ $configurationData['facebook_client_id'] }}",
            lwFacebookLoginInputField = $('#lwFacebookLoginInputField'),
            lwIsFacebookKeysExist = $('#lwIsFacebookKeysExist');

        if (isFacebookKeysInstalled) {
            lwFacebookLoginInputField.hide();
            lwIsFacebookKeysExist.show();
        } else {
            lwIsFacebookKeysExist.hide();
        }

        // Update Facebook keys
        $('#lwAddFacebookKeys').click(function() {
            $("#lwFacebookKeysExist").val(0);
            lwFacebookLoginInputField.show();
            lwIsFacebookKeysExist.hide();
        });
    });

    // Google login js block start
    $(document).ready(function() {
        var allowGoogleLogin = $("#lwAllowGoogleLogin").is(':checked');

        // Initialize state
        if (!allowGoogleLogin) {
            $("#lwGoogleLoginInputField").addClass('opacity-50 pointer-events-none');
            $('#lwAddGoogleKeys').attr("disabled", true);
        }

        // Google switch on change event
        $("#lwAllowGoogleLogin").on('change', function(e) {
            allowGoogleLogin = $(this).is(":checked");
            if (!allowGoogleLogin) {
                $("#lwGoogleLoginInputField").addClass('opacity-50 pointer-events-none');
                $('#lwAddGoogleKeys').attr("disabled", true);
            } else {
                $("#lwGoogleLoginInputField").removeClass('opacity-50 pointer-events-none');
                $('#lwAddGoogleKeys').attr("disabled", false);
            }
        });

        // Google Keys setting
        var isGoogleKeysInstalled = "{{ $configurationData['google_client_id'] }}",
            lwGoogleLoginInputField = $('#lwGoogleLoginInputField'),
            lwIsGoogleKeysExist = $('#lwIsGoogleKeysExist');

        if (isGoogleKeysInstalled) {
            lwGoogleLoginInputField.hide();
            lwIsGoogleKeysExist.show();
        } else {
            lwIsGoogleKeysExist.hide();
        }

        // Update Google keys
        $('#lwAddGoogleKeys').click(function() {
            $("#lwGoogleKeysExist").val(0);
            lwGoogleLoginInputField.show();
            lwIsGoogleKeysExist.hide();
        });
    });

    // On social login setting success callback function
    function onSocialLoginFormCallback(responseData) {
        if (responseData.reaction == 1) {
            showConfirmation('{{ __tr("Settings Updated Successfully") }}', null, {
                buttons: [
                    Noty.button('{{ __tr("Reload") }}', 'btn btn-primary btn-sm', function() {
                        __Utils.viewReload();
                    })
                ]
            });
        }
    };
</script>
@lwPushEnd