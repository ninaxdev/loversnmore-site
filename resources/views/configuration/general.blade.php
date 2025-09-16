<style>
	/* Selectize dropdown styling fixes for Tailwind CSS */
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
	#lwSelectTimezone-selectized {
		position: relative !important;
	}
	#lwSelectDefaultLanguage-selectized {
		position: relative !important;
	}
</style>    

<!-- Modern General Settings Page -->
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-lw-primary mb-2">{{ __tr('General Settings') }}</h1>
                <p class="text-lw-secondary">{{ __tr('Configure your website basic settings and preferences') }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-cogs text-white text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Website Configuration Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-700 px-6 py-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-cog text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-lg">{{ __tr('Website Configuration') }}</h3>
                    <p class="text-purple-100 text-sm">{{ __tr('Upload logos and configure basic website information') }}</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <form class="lw-ajax-form lw-form space-y-8" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
                
                <!-- Logo Upload Section -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-6">
                        <div class="lw-form-group">
                            <label class="block text-sm font-semibold text-lw-primary mb-2">{{ __tr('Upload Logo') }}</label>
                            <div class="lw-file-upload-wrapper">
                                <input type="file" class="lw-file-uploader" data-instant-upload="true" data-action="{{ route('media.upload_logo') }}" id="lwUploadLogo" data-callback="afterUploadedFile" data-default-image-url="{{ getStoreSettings('logo_image_url') }}">
                            </div>
                            <div class="mt-2">
                                <small class="text-xs text-lw-secondary">{{ __tr('Recommended size: 200x60px, PNG or JPG format') }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:col-span-4">
                        <div class="lw-form-group">
                            <label class="block text-sm font-semibold text-lw-primary mb-2">{{ __tr('Upload Small Logo') }}</label>
                            <div class="lw-file-upload-wrapper">
                                <input type="file" class="lw-file-uploader" data-instant-upload="true" data-action="{{ route('media.upload_small_logo') }}" id="lwUploadSmallLogo" data-callback="afterUploadedFile" data-default-image-url="{{ getStoreSettings('small_logo_image_url') }}">
                            </div>
                            <div class="mt-2">
                                <small class="text-xs text-lw-secondary">{{ __tr('Recommended size: 60x60px') }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="lg:col-span-2">
                        <div class="lw-form-group">
                            <label class="block text-sm font-semibold text-lw-primary mb-2">{{ __tr('Upload Favicon') }}</label>
                            <div class="lw-file-upload-wrapper">
                                <input type="file" class="lw-file-uploader" data-instant-upload="true" data-action="{{ route('media.upload_favicon') }}" data-callback="afterUploadedFile" id="lwUploadFavicon" data-default-image-url="{{ getStoreSettings('favicon_image_url') }}">
                            </div>
                            <div class="mt-2">
                                <small class="text-xs text-lw-secondary">{{ __tr('16x16px, ICO format') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Information Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Website Name -->
                    <div class="lw-form-group">
                        <label for="lwWebsiteName" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Your Website Name') }} <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            name="name"
                            id="lwWebsiteName"
                            class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400"
                            placeholder="{{ __tr('Enter your website name') }}"
                            value="{{ $configurationData['name'] }}"
                            required
                        />
                    </div>

                    <!-- Business Email -->
                    <div class="lw-form-group">
                        <label for="lwBusinessEmail" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Business Email') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                type="email"
                                name="business_email"
                                id="lwBusinessEmail"
                                class="w-full h-12 pl-10 pr-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400"
                                placeholder="{{ __tr('Enter business email') }}"
                                value="{{ $configurationData['business_email'] }}"
                                required
                            />
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Contact Email -->
                    <div class="lw-form-group">
                        <label for="lwContactEmail" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Contact Email') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                type="email"
                                name="contact_email"
                                id="lwContactEmail"
                                class="w-full h-12 pl-10 pr-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary placeholder-gray-400"
                                placeholder="{{ __tr('Enter contact email') }}"
                                value="{{ $configurationData['contact_email'] }}"
                            />
                        </div>
                    </div>

                    <!-- Select Timezone -->
                    <div class="lw-form-group">
                        <label for="lwSelectTimezone" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Select Timezone') }} <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="timezone"
                            id="lwSelectTimezone"
                            class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary"
                            required
                        >
                            @foreach ($configurationData['timezone_list'] as $timezone)
                                <option value="{{ $timezone['value'] }}" {{ $configurationData['timezone'] == $timezone['value'] ? 'selected' : '' }}>{{ $timezone['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- System Configuration -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Distance Measurement -->
                    <div class="lw-form-group">
                        <label for="lwDistanceMeasurement" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Distance Measurement') }} <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="distance_measurement"
                            id="lwDistanceMeasurement"
                            class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary"
                            required
                        >
                            <option value="6371" {{ $configurationData['distance_measurement'] == '6371' ? 'selected' : '' }}>{{ __tr('Kilometers (KM)') }}</option>
                            <option value="3959" {{ $configurationData['distance_measurement'] == '3959' ? 'selected' : '' }}>{{ __tr('Miles') }}</option>
                        </select>
                    </div>

                    <!-- Select Default language -->
                    <div class="lw-form-group">
                        <label for="lwSelectDefaultLanguage" class="block text-sm font-semibold text-lw-primary mb-2">
                            {{ __tr('Default Language') }} <span class="text-red-500">*</span>
                        </label>
                        <select 
                            name="default_language"
                            id="lwSelectDefaultLanguage"
                            class="w-full h-12 px-4 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 outline-none transition-all font-medium text-lw-primary"
                            required
                        >
                            @if (!__isEmpty($configurationData['languageList']))
                                @foreach ($configurationData['languageList'] as $key => $language)
                                    <option value="{{ $language['id'] }}" {{ $configurationData['default_language'] == $language['id'] ? 'selected' : '' }}>{{ $language['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button 
                        type="submit"
                        class="lw-ajax-form-submit-action px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg"
                    >
                        <i class="fas fa-save mr-2"></i>
                        {{ __tr('Update Settings') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@lwPush('appScripts')
<script>
    // After file successfully uploaded then this function is called
    function afterUploadedFile(responseData) {
        var requestData = responseData.data;
        $('#lwUploadedLogo').attr('src', requestData.path);
    }
    
    $(function() {
        $('#lwSelectTimezone').selectize({
            plugins: ['remove_button'],
            create: false,
            sortField: {
                field: 'text',
                direction: 'asc'
            }
        });
    });

    //initialize selectize element
    $(function() {
        $('#lwSelectDefaultLanguage').selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: ['id', 'name'],
            plugins: ['remove_button'],
            create: false
        });
    });
</script>
@lwPushEnd