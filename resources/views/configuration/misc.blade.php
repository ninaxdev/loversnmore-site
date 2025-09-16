<!-- Modern Misc Settings Page -->
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-lw-primary mb-2">{{ __tr('Misc Settings') }}</h1>
                <p class="text-lw-secondary">{{ __tr('Configure miscellaneous settings and customize your application behavior') }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="fa fa-cogs text-white text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    @php
    $availableHomePages = [
        'outer-home' => __tr('Home Page 1'),
        'outer-home-2' => __tr('Home Page 2'),
    ];
    @endphp

    <!-- Home Page Settings Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{panelOpened:false}" x-cloak>
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-4 cursor-pointer" @click="panelOpened = !panelOpened">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-home text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold text-lg">{{ __tr('Home Page Settings') }}</h3>
                        <p class="text-indigo-100 text-sm">{{ __tr('Configure your application\'s landing page') }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <small class="text-indigo-200">{{ __tr('Click to expand/collapse') }}</small>
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center transition-transform duration-200" :class="{'rotate-180': panelOpened}">
                        <i class="fas fa-chevron-down text-white text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div x-show="panelOpened" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="p-6">
            <form class="lw-ajax-form lw-form space-y-8" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
                
                <!-- Home Page Selection -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-desktop text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-blue-900 mb-2">{{ __tr('Select Home Page Template') }}</h4>
                            <p class="text-blue-700 text-sm mb-4">{{ __tr('Choose from available home page layouts for your application') }}</p>
                            
                            <div class="lw-form-group">
                                <label for="lwSelectHomePage" class="block text-sm font-semibold text-blue-900 mb-2">
                                    {{ __tr('Home Page Template') }}
                                </label>
                                <select id="lwSelectHomePage" 
                                        class="w-full h-12 px-4 border-2 border-blue-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium text-blue-900 bg-white" 
                                        name="current_home_page_view" 
                                        required>
                                    @foreach ($availableHomePages as $availableHomePageKey => $availableHomePage)
                                        <option value="{{ $availableHomePageKey }}" 
                                            @if($availableHomePageKey == getStoreSettings('current_home_page_view')) selected @endif>
                                            {{ $availableHomePage }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-6 text-lg font-semibold text-gray-400">{{ __tr('OR') }}</span>
                    </div>
                </div>

                <!-- External Home Page -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-external-link-alt text-white"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-purple-900 mb-2">{{ __tr('External Home Page') }}</h4>
                            <p class="text-purple-700 text-sm mb-4">{{ __tr('Use a custom external URL as your home page instead of the default templates') }}</p>
                            
                            <div class="lw-form-group">
                                <label for="lwOtherHomePageUrl" class="block text-sm font-semibold text-purple-900 mb-2">
                                    {{ __tr('External Home Page URL') }}
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-link text-purple-400"></i>
                                    </div>
                                    <input type="url" 
                                           class="w-full h-12 pl-10 pr-4 border-2 border-purple-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-purple-900 placeholder-purple-400 bg-white" 
                                           id="lwOtherHomePageUrl" 
                                           name="other_home_page_url" 
                                           value="{{ $configurationData['other_home_page_url'] }}"
                                           placeholder="{{ __tr('https://example.com') }}">
                                </div>
                                <p class="mt-2 text-sm text-purple-600">{{ __tr('Leave empty to use the selected template above') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end pt-6">
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        <i class="fas fa-save mr-2"></i>
                        {{ __tr('Update Settings') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Additional Features Section (Expandable for Future Use) -->
    <!-- <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-plus-circle text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-lg">{{ __tr('Additional Settings') }}</h3>
                    <p class="text-gray-100 text-sm">{{ __tr('More miscellaneous settings will be available here in future updates') }}</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="flex items-center justify-center py-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-cog text-gray-400 text-xl"></i>
                    </div>
                    <h4 class="text-gray-600 font-medium mb-2">{{ __tr('Coming Soon') }}</h4>
                    <p class="text-gray-500 text-sm">{{ __tr('Additional miscellaneous settings and features will be added here in future updates.') }}</p>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Quick Actions -->
    <!-- <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
       
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-broom text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-900">{{ __tr('Cache Management') }}</h4>
            </div>
            <p class="text-gray-600 text-sm mb-4">{{ __tr('Clear system cache to apply configuration changes') }}</p>
            <a href="{{ route('manage.configuration.clear_cache', []) . '?redirectTo=' . base64_encode(Request::fullUrl()) }}" 
               class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors text-sm font-medium">
                <i class="fas fa-sync-alt mr-2"></i>
                {{ __tr('Clear Cache') }}
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-heartbeat text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-900">{{ __tr('System Status') }}</h4>
            </div>
            <p class="text-gray-600 text-sm mb-4">{{ __tr('Monitor your application health and performance') }}</p>
            <div class="flex items-center text-green-600 text-sm font-medium">
                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                {{ __tr('All Systems Operational') }}
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-question-circle text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-900">{{ __tr('Need Help?') }}</h4>
            </div>
            <p class="text-gray-600 text-sm mb-4">{{ __tr('Access documentation and support resources') }}</p>
            <a href="{{ route('manage.help.read') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium lw-ajax-link-action lw-action-with-url">
                <i class="fas fa-book mr-2"></i>
                {{ __tr('Help Center') }}
            </a>
        </div>
    </div> -->
</div>

@lwPush('appScripts')
<script>
    $(document).ready(function() {
        // Form submission success handler
        $('.lw-ajax-form').on('form:success', function(event, response) {
            if (response.reaction == 1) {
                showConfirmation('{{ __tr("Settings Updated Successfully") }}', function() {
                    __Utils.viewReload();
                }, {
                    confirmButtonText: "{{ __tr('Reload Page') }}",
                    type: "success"
                });
            }
        });

        // Home page select change handler
        $('#lwSelectHomePage').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue) {
                // Clear external URL when template is selected
                $('#lwOtherHomePageUrl').val('');
            }
        });

        // External URL input handler
        $('#lwOtherHomePageUrl').on('input', function() {
            var urlValue = $(this).val();
            if (urlValue) {
                // Reset template selection when external URL is entered
                $('#lwSelectHomePage').val('');
            }
        });

        // Add visual feedback for form interactions
        $('.lw-form-group input, .lw-form-group select').on('focus', function() {
            $(this).closest('.lw-form-group').addClass('focused');
        }).on('blur', function() {
            $(this).closest('.lw-form-group').removeClass('focused');
        });
    });
</script>
@lwPushEnd