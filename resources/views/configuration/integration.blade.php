<!-- Modern Integration Settings Page -->
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-lw-primary mb-2">{{ __tr('Integration Settings') }}</h1>
                <p class="text-lw-secondary">{{ __tr('Configure third-party services and APIs for enhanced functionality') }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                    <i class="far fa-sun text-white text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Integration Settings Form -->
    <form class="lw-ajax-form lw-form space-y-8" method="post" data-callback="onIntegrationSettingCallback" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        
        <!-- Location Map Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-map text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold text-lg">{{ __tr('Location Map') }}</h3>
                        <p class="text-green-100 text-sm">{{ __tr('Choose how location will be displayed on your application') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- OpenStreetMap Option -->
                <div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <input type="hidden" name="display_open_street_map" value="0" />
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               class="sr-only peer" 
                               id="lwDisplayOpenStreetMap"
                               {{ (($configurationData['display_open_street_map']==true) and ($configurationData['display_google_map'] !=true)) ? 'checked' : '' }} 
                               name="display_open_street_map"
                               value="1">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                    </label>
                    <div>
                        <h4 class="font-semibold text-lw-primary">{{ __tr('Use OpenStreetMap') }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ __tr('Location will be displayed on the page using OpenStreetMap') }}</p>
                    </div>
                </div>

                <!-- Google Map Option -->
                <div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <input type="hidden" name="display_google_map" id="lwEnableDisplayGoogleMap" value="0" />
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               class="sr-only peer" 
                               id="lwDisplayGoogleMap"
                               {{ $configurationData['display_google_map']==true ? 'checked' : '' }} 
                               name="display_google_map"
                               value="1">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                    </label>
                    <div>
                        <h4 class="font-semibold text-lw-primary">{{ __tr('Use Google Map') }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ __tr('Location will be displayed on the page using Free Google Map Embed') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Location Search Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-search-location text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold text-lg">{{ __tr('Location Search') }}</h3>
                        <p class="text-blue-100 text-sm">{{ __tr('Configure how users search and select their location') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Static Database Option -->
                <div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <input type="hidden" name="use_static_city_data" value="0" />
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               class="sr-only peer" 
                               id="lwAllowStaticCityData"
                               {{ (($configurationData['use_static_city_data']==true) and ($configurationData['allow_google_map'] !=true)) ? 'checked' : '' }} 
                               name="use_static_city_data"
                               value="1">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                    <div>
                        <h4 class="font-semibold text-lw-primary">{{ __tr('Use Static locations database') }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ __tr('It will use static city data from database to determine user latitude/longitude, make sure you have ran queries from SQL file provided for the static locations.') }}</p>
                    </div>
                </div>

                <!-- Google Map API Option -->
                <div class="flex items-start space-x-4 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                    <input type="hidden" name="allow_google_map" id="lwEnableGoogleMap" value="0" />
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" 
                               class="sr-only peer" 
                               id="lwAllowGoogleMap"
                               {{ $configurationData['allow_google_map']==true ? 'checked' : '' }} 
                               name="allow_google_map"
                               value="1">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                    <div>
                        <h4 class="font-semibold text-lw-primary">{{ __tr('Use Google Map API') }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ __tr('It will be used to determine user latitude/longitude based on selected location') }}</p>
                    </div>
                </div>

                <!-- API Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                        <div>
                            <h4 class="font-medium text-blue-800">{{ __tr('Required Google APIs') }}</h4>
                            <p class="text-sm text-blue-700 mt-1">
                                <a href="https://console.cloud.google.com/" target="_blank" class="underline hover:text-blue-800">
                                    {{ __tr('You need to enable __placesAPI__, __mapsJSAPI__, __geocodingAPI__', [
                                        '__placesAPI__' => 'Places API',
                                        '__mapsJSAPI__' => 'Maps JavaScript API',
                                        '__geocodingAPI__' => 'Geocoding API'
                                    ]) }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Google Map Keys Status -->
                <div class="mb-4" id="lwIsGoggleMapKeysExist" style="display:none">
                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-green-800 font-medium">{{ __tr('Google Map keys are installed.') }}</span>
                        </div>
                        <button type="button" class="px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors font-medium" id="lwAddGoogleMapKeys">
                            {{ __tr('Update') }}
                        </button>
                    </div>
                </div>

                <input type="hidden" name="google_map_keys_exist" id="lwGoogleMapKeysExist" value="{{ $configurationData['google_map_key'] }}" />

                <!-- Google Map Key Input -->
                <div id="lwGoogleMapInputField">
                    <div class="lw-form-group">
                        <label for="lwGoogleMapKey" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Google Map Key') }}
                        </label>
                        <div class="lw-input-container">
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="google_map_key"
                                   placeholder="{{ __tr('Add Your Google Map Key') }}" 
                                   id="lwGoogleMapKey">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pusher Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-broadcast-tower text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">{{ __tr('Pusher') }}</h3>
                            <p class="text-purple-100 text-sm">{{ __tr('Required for realtime communication') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="https://pusher.com/" target="_blank" class="px-3 py-1 bg-white/20 text-white rounded-lg text-sm hover:bg-white/30 transition-colors">
                            <i class="fa fa-info mr-1"></i>{{ __tr('Details') }}
                        </a>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="allow_pusher" id="lwEnablePusher" value="0" />
                            <input type="checkbox" 
                                   class="sr-only peer" 
                                   id="lwAllowPusher"
                                   {{ $configurationData['allow_pusher']==true ? 'checked' : '' }} 
                                   name="allow_pusher" 
                                   value="1">
                            <div class="w-11 h-6 bg-white/30 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-white/50"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Pusher Keys Status -->
                <div class="mb-4" id="lwIsPusherKeysExist" style="display:none">
                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-green-800 font-medium">{{ __tr('Pusher keys are installed.') }}</span>
                        </div>
                        <button type="button" class="px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors font-medium" id="lwAddPusherKeys">
                            {{ __tr('Update') }}
                        </button>
                    </div>
                </div>

                <input type="hidden" name="pusher_keys_exist" id="lwPusherKeysExist" value="{{ $configurationData['pusher_app_id'] }}" />

                <!-- Pusher Configuration Fields -->
                <div id="lwPusherInputField" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Pusher App ID -->
                        <div class="lw-form-group">
                            <label for="lwPusherAppId" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Pusher App ID') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="pusher_app_id"
                                   placeholder="{{ __tr('Add Your Pusher App ID') }}" 
                                   id="lwPusherAppId">
                        </div>

                        <!-- Pusher App Key -->
                        <div class="lw-form-group">
                            <label for="lwPusherAppKey" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Pusher App Key') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="pusher_app_key"
                                   placeholder="{{ __tr('Add Your Pusher App Key') }}" 
                                   id="lwPusherAppKey">
                        </div>

                        <!-- Pusher App Secret -->
                        <div class="lw-form-group">
                            <label for="lwPusherAppSecret" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Pusher App Secret') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="pusher_app_secret"
                                   placeholder="{{ __tr('Add Your Pusher App Secret') }}" 
                                   id="lwPusherAppSecret">
                        </div>

                        <!-- Pusher App Cluster -->
                        <div class="lw-form-group">
                            <label for="lwPusherAppClusterKey" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Pusher App Cluster Key') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="pusher_app_cluster_key"
                                   placeholder="{{ __tr('Add Your Pusher App Cluster Key') }}" 
                                   id="lwPusherAppClusterKey">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agora Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-video text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">{{ __tr('Agora') }}</h3>
                            <p class="text-cyan-100 text-sm">{{ __tr('Required for Audio/Video Calls') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="https://www.agora.io/en/" target="_blank" class="px-3 py-1 bg-white/20 text-white rounded-lg text-sm hover:bg-white/30 transition-colors">
                            <i class="fa fa-info mr-1"></i>{{ __tr('Details') }}
                        </a>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="allow_agora" id="lwEnableAgora" value="0" />
                            <input type="checkbox" 
                                   class="sr-only peer" 
                                   id="lwAllowAgora"
                                   {{ $configurationData['allow_agora']==true ? 'checked' : '' }} 
                                   name="allow_agora" 
                                   value="1">
                            <div class="w-11 h-6 bg-white/30 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-white/50"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Agora Keys Status -->
                <div class="mb-4" id="lwIsAgoraKeysExist" style="display:none">
                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-green-800 font-medium">{{ __tr('Agora keys are installed.') }}</span>
                        </div>
                        <button type="button" class="px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors font-medium" id="lwAddAgoraKeys">
                            {{ __tr('Update') }}
                        </button>
                    </div>
                </div>

                <input type="hidden" name="agora_keys_exist" id="lwAgoraKeysExist" value="{{ $configurationData['agora_app_id'] }}" />

                <!-- Agora Configuration Fields -->
                <div id="lwAgoraInputField" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Agora App ID -->
                        <div class="lw-form-group">
                            <label for="lwAgoraAppId" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Agora App ID') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="agora_app_id"
                                   placeholder="{{ __tr('Add Your Agora App ID') }}" 
                                   id="lwAgoraAppId">
                        </div>

                        <!-- Agora App Certificate -->
                        <div class="lw-form-group">
                            <label for="lwAgoraAppKey" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Agora App Certificate Key') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="agora_app_certificate_key"
                                   placeholder="{{ __tr('Add Your Agora App Certificate Key') }}" 
                                   id="lwAgoraAppKey">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Services Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Giphy Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-pink-500 to-rose-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-images text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">{{ __tr('Giphy') }}</h3>
                                <p class="text-pink-100 text-sm">{{ __tr('GIF integration') }}</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="allow_giphy" id="lwEnableGiphy" value="0" />
                            <input type="checkbox" 
                                   class="sr-only peer" 
                                   id="lwAllowGiphy"
                                   {{ $configurationData['allow_giphy']==true ? 'checked' : '' }} 
                                   name="allow_giphy" 
                                   value="1">
                            <div class="w-11 h-6 bg-white/30 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-white/50"></div>
                        </label>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Giphy Keys Status -->
                    <div class="mb-4" id="lwIsGiphyKeysExist" style="display:none">
                        <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <span class="text-green-800 font-medium">{{ __tr('Giphy keys are installed.') }}</span>
                            </div>
                            <button type="button" class="px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors font-medium" id="lwAddGiphyKeys">
                                {{ __tr('Update') }}
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="giphy_keys_exist" id="lwGiphyKeysExist" value="{{ $configurationData['giphy_key'] }}" />

                    <div id="lwGiphyKeyInputField">
                        <div class="lw-form-group">
                            <label for="lwGiphyKey" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Giphy Key') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-pink-500 focus:ring-4 focus:ring-pink-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="giphy_key"
                                   placeholder="{{ __tr('Add Your Giphy Key') }}" 
                                   id="lwGiphyKey">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ReCaptcha Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-amber-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shield-alt text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg">{{ __tr('ReCaptcha V2') }}</h3>
                                <p class="text-orange-100 text-sm">{{ __tr('Bot protection') }}</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="allow_recaptcha" id="lwEnableRecaptcha" value="0" />
                            <input type="checkbox" 
                                   class="sr-only peer" 
                                   id="lwAllowRecaptcha" 
                                   name="allow_recaptcha" 
                                   value="1" 
                                   {{ $configurationData['allow_recaptcha']==true ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-white/30 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-white/50"></div>
                        </label>
                    </div>
                </div>

                <div class="p-6">
                    <!-- ReCaptcha Keys Status -->
                    <div class="mb-4" id="lwIsRecaptchaKeysExist" style="display:none">
                        <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <span class="text-green-800 font-medium">{{ __tr('ReCaptcha keys are installed.') }}</span>
                            </div>
                            <button type="button" class="px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors font-medium" id="lwAddRecaptchaKeys">
                                {{ __tr('Update') }}
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="recaptcha_site_key_exist" id="lwRecaptchaKeysExist" value="{{ $configurationData['recaptcha_site_key'] }}" />

                    <div id="lwRecaptchaKeyInputField" class="space-y-4">
                        <div class="lw-form-group">
                            <label for="lwReCaptchaClientSecret" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Site Key') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="recaptcha_site_key"
                                   placeholder="{{ __tr('Recaptcha Site Key') }}" 
                                   id="lwReCaptchaClientSecret"
                                   value="{{ getStoreSettings('recaptcha_site_key') }}">
                        </div>

                        <div class="lw-form-group">
                            <label for="lwSecretKey" class="block text-sm font-semibold text-lw-primary mb-2">
                                {{ __tr('Secret Key') }}
                            </label>
                            <input type="text" 
                                   class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                                   name="recaptcha_secret_key" 
                                   id="lwSecretKey"
                                   placeholder="{{ __tr('Recaptcha Secret Key') }}" 
                                   value="{{ getStoreSettings('recaptcha_secret_key') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Microsoft Translator Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{disableMicrosoftTranslatorKeyUpdate:'{{ getStoreSettings("microsoft_translator_api_key") }}'}">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-language text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-semibold text-lg">{{ __tr('Microsoft Translator API') }}</h3>
                        <p class="text-indigo-100 text-sm">{{ __tr('Translation services for your application') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Info Alert -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                        <div>
                            <h4 class="font-medium text-blue-800">{{ __tr('Microsoft Translator Pricing') }}</h4>
                            <p class="text-sm text-blue-700 mt-1">
                                <a target="_blank" href="https://azure.microsoft.com/en-us/pricing/details/cognitive-services/translator-text-api/" class="underline hover:text-blue-800">
                                    https://azure.microsoft.com/en-us/pricing/details/cognitive-services/translator-text-api/
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- API Key Input -->
                <div class="lw-form-group" x-cloak x-show="!disableMicrosoftTranslatorKeyUpdate">
                    <label for="lwMicrosoftTranslatorAPIKey" class="block text-sm font-semibold text-lw-primary mb-2">
                        {{ __tr('Microsoft Translator API Key') }}
                    </label>
                    <input type="text" 
                           class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400" 
                           name="microsoft_translator_api_key"
                           id="lwMicrosoftTranslatorAPIKey">
                </div>

                <!-- Existing Key Status -->
                <div class="lw-form-group" x-cloak x-show="disableMicrosoftTranslatorKeyUpdate">
                    <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-green-800 font-medium">{{ __tr('Microsoft Translator API Key exist') }}</span>
                        </div>
                        <button type="button" @click="disableMicrosoftTranslatorKeyUpdate = !disableMicrosoftTranslatorKeyUpdate" class="px-4 py-2 bg-white border border-green-300 text-green-700 rounded-lg hover:bg-green-50 transition-colors font-medium">
                            {{ __tr('Update') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Button -->
        <div class="flex justify-end pt-6">
            <button type="submit" class="lw-ajax-form-submit-action px-8 py-3 bg-gradient-to-r from-orange-600 to-red-600 text-white font-semibold rounded-xl hover:from-orange-700 hover:to-red-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                <i class="fas fa-save mr-2"></i>
                {{ __tr('Update Settings') }}
            </button>
        </div>
    </form>
</div>

@lwPush('appScripts')
<script>
    // Pusher js block start
    $(document).ready(function() {
        'use strict';
        
        // Pusher Enable / Disable
        var isPusherAllow = $('#lwAllowPusher').is(':checked');
        if (!isPusherAllow) {
            $('#lwPusherInputField').addClass('opacity-50 pointer-events-none');
            $('#lwAddPusherKeys').attr("disabled", true);
        }
        $("#lwAllowPusher").on('change', function(event) {
            isPusherAllow = $(this).is(":checked");
            if (!isPusherAllow) {
                $("#lwPusherInputField").addClass('opacity-50 pointer-events-none');
                $('#lwAddPusherKeys').attr("disabled", true);
            } else {
                $("#lwPusherInputField").removeClass('opacity-50 pointer-events-none');
                $('#lwAddPusherKeys').attr("disabled", false);
            }
        });

        // Pusher Keys setting
        var isPusherKeysInstalled = "{{ $configurationData['pusher_app_id'] }}",
            lwPusherInputField = $('#lwPusherInputField'),
            lwIsPusherKeysExist = $('#lwIsPusherKeysExist');

        if (isPusherKeysInstalled) {
            lwPusherInputField.hide();
            lwIsPusherKeysExist.show();
        } else {
            lwIsPusherKeysExist.hide();
        }
        
        $('#lwAddPusherKeys').click(function() {
            $("#lwPusherKeysExist").val(0);
            lwPusherInputField.show();
            lwIsPusherKeysExist.hide();
        });

        // Agora Enable / Disable
        var isAgoraAllow = $('#lwAllowAgora').is(':checked');
        if (!isAgoraAllow) {
            $('#lwAgoraInputField').addClass('opacity-50 pointer-events-none');
            $('#lwAddAgoraKeys').attr("disabled", true);
        }
        $("#lwAllowAgora").on('change', function(event) {
            isAgoraAllow = $(this).is(":checked");
            if (!isAgoraAllow) {
                $("#lwAgoraInputField").addClass('opacity-50 pointer-events-none');
                $('#lwAddAgoraKeys').attr("disabled", true);
            } else {
                $("#lwAgoraInputField").removeClass('opacity-50 pointer-events-none');
                $('#lwAddAgoraKeys').attr("disabled", false);
            }
        });

        // Agora Keys setting
        var isAgoraKeysInstalled = "{{ $configurationData['agora_app_id'] }}",
            lwAgoraInputField = $('#lwAgoraInputField'),
            lwIsAgoraKeysExist = $('#lwIsAgoraKeysExist');

        if (isAgoraKeysInstalled) {
            lwAgoraInputField.hide();
            lwIsAgoraKeysExist.show();
        } else {
            lwIsAgoraKeysExist.hide();
        }
        
        $('#lwAddAgoraKeys').click(function() {
            $("#lwAgoraKeysExist").val(0);
            lwAgoraInputField.show();
            lwIsAgoraKeysExist.hide();
        });

        // Google Map js block
        $("#lwDisplayOpenStreetMap").on('change', function(event) {
            $('#lwDisplayGoogleMap').trigger('click');
        });
        $("#lwDisplayGoogleMap").on('change', function(event) {
            $('#lwDisplayOpenStreetMap').trigger('click');
        });

        // Google Map Enable / Disable
        var isGoogleMapAllow = $('#lwAllowGoogleMap').is(':checked');
        if (!isGoogleMapAllow) {
            $('#lwGoogleMapInputField').addClass('opacity-50 pointer-events-none');
            $('#lwAddGoogleMapKeys').attr("disabled", true);
        }
        $("#lwAllowStaticCityData").on('change', function(event) {
            $('#lwAllowGoogleMap').trigger('click');
        });
        
        $("#lwAllowGoogleMap").on('change', function(event) {
            var isGoogleMapAllowed = $(this).is(":checked");
            $('#lwAllowStaticCityData').trigger('click');
            if (!isGoogleMapAllowed) {
                $("#lwGoogleMapInputField").addClass('opacity-50 pointer-events-none');
                $('#lwAddGoogleMapKeys').attr("disabled", true);
            } else {
                $("#lwGoogleMapInputField").removeClass('opacity-50 pointer-events-none');
                $('#lwAddGoogleMapKeys').attr("disabled", false);
            }
        });

        // Google Map Keys setting
        var isGoogleMapKeysInstalled = "{{ $configurationData['google_map_key'] }}",
            lwGoogleMapInputField = $('#lwGoogleMapInputField'),
            lwIsGoggleMapKeysExist = $('#lwIsGoggleMapKeysExist');

        if (isGoogleMapKeysInstalled) {
            lwGoogleMapInputField.hide();
            lwIsGoggleMapKeysExist.show();
        } else {
            lwIsGoggleMapKeysExist.hide();
        }
        
        $('#lwAddGoogleMapKeys').click(function() {
            $("#lwGoogleMapKeysExist").val(0);
            lwGoogleMapInputField.show();
            lwIsGoggleMapKeysExist.hide();
        });

        // Giphy Enable / Disable
        var isGiphyAllow = $('#lwAllowGiphy').is(':checked');
        if (!isGiphyAllow) {
            $('#lwGiphyKeyInputField').addClass('opacity-50 pointer-events-none');
            $('#lwAddGiphyKeys').attr("disabled", true);
        }

        $("#lwAllowGiphy").on('change', function(event) {
            isPusherAllow = $(this).is(":checked");
            if (!isPusherAllow) {
                $("#lwGiphyKeyInputField").addClass('opacity-50 pointer-events-none');
                $('#lwAddGiphyKeys').attr("disabled", true);
            } else {
                $("#lwGiphyKeyInputField").removeClass('opacity-50 pointer-events-none');
                $('#lwAddGiphyKeys').attr("disabled", false);
            }
        });

        // Giphy Keys setting
        var isGiphyKeysInstalled = "{{ $configurationData['giphy_key'] }}",
            lwGiphyKeyInputField = $('#lwGiphyKeyInputField'),
            lwIsGiphyKeysExist = $('#lwIsGiphyKeysExist');

        if (isGiphyKeysInstalled) {
            lwGiphyKeyInputField.hide();
            lwIsGiphyKeysExist.show();
        } else {
            lwIsGiphyKeysExist.hide();
        }
        
        $('#lwAddGiphyKeys').click(function() {
            $("#lwGiphyKeysExist").val(0);
            lwGiphyKeyInputField.show();
            lwIsGiphyKeysExist.hide();
        });

        // Recaptcha Enable / Disable
        var isRecaptchaAllow = $('#lwAllowRecaptcha').is(':checked');
        if (!isRecaptchaAllow) {
            $('#lwRecaptchaKeyInputField').addClass('opacity-50 pointer-events-none');
            $('#lwAddRecaptchaKeys').attr("disabled", true);
        }

        $("#lwAllowRecaptcha").on('change', function(event) {
            isPusherAllow = $(this).is(":checked");
            if (!isPusherAllow) {
                $("#lwRecaptchaKeyInputField").addClass('opacity-50 pointer-events-none');
                $('#lwAddRecaptchaKeys').attr("disabled", true);
            } else {
                $("#lwRecaptchaKeyInputField").removeClass('opacity-50 pointer-events-none');
                $('#lwAddRecaptchaKeys').attr("disabled", false);
            }
        });

        // Recaptcha Keys setting
        var isRecaptchaKeysInstalled = "{{ $configurationData['recaptcha_site_key'] }}",
            lwRecaptchaKeyInputField = $('#lwRecaptchaKeyInputField'),
            lwIsRecaptchaKeysExist = $('#lwIsRecaptchaKeysExist');

        if (isRecaptchaKeysInstalled) {
            lwRecaptchaKeyInputField.hide();
            lwIsRecaptchaKeysExist.show();
        } else {
            lwIsRecaptchaKeysExist.hide();
        }
        
        $('#lwAddRecaptchaKeys').click(function() {
            $("#lwRecaptchaKeysExist").val(0);
            lwRecaptchaKeyInputField.show();
            lwIsRecaptchaKeysExist.hide();
        });
    });

    // On integration setting success callback function
    function onIntegrationSettingCallback(responseData) {
        if (responseData.reaction == 1) {
            showConfirmation("{{ __tr('Settings Updated Successfully') }}", function() {
                __Utils.viewReload();
            }, {
                confirmButtonText: "{{ __tr('Reload Page') }}",
                type: "success"
            });
        }
    };
</script>
@lwPushEnd