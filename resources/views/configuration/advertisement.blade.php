<!-- Modern Advertisement Management Page -->
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-bullhorn text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('Manage Advertisement') }}</h1>
            </div>
        </div>
    </x-lw.card>

    <form class="lw-ajax-form lw-form" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        <!-- Header Advertisement -->
        <x-lw.card class="mb-6">
            <div class="text-center mb-4">
                <img src="{{ url('imgs/ads/728x90.png') }}" class="mx-auto border border-gray-200 rounded" alt="Header Advertisement Preview">
            </div>
            
            <!-- Header Advertisement Title -->
            <h6 class="text-lg font-semibold mb-4 text-lw-primary">{{ $configurationData['header_advertisement']['title'] ?? '' }}</h6>

            <!-- Hidden Input field for Title -->
            <input type="hidden" name="header_advertisement[title]" value="{{ $configurationData['header_advertisement']['title'] ?? '' }}">

            <!-- Hidden Input field for height -->
            <input type="hidden" name="header_advertisement[height]" value="{{ $configurationData['header_advertisement']['height'] ?? '' }}">

            <!-- Hidden Input field for width -->
            <input type="hidden" name="header_advertisement[width]" value="{{ $configurationData['header_advertisement']['width'] ?? '' }}">

            <!-- Hidden Input field for false checkbox value -->
            <input type="hidden" name="header_advertisement[status]" value="false">

            <!-- Enable Header Ads Checkbox -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="enableHeaderAds" name="header_advertisement[status]" value="true" {{ (($configurationData['header_advertisement']['status'] ?? '') == 'true') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="enableHeaderAds">{{ __tr('Enable') }}</label>
                </div>
            </div>

            <!-- Header Content -->
            <div class="form-group">
                <label for="headerAdsContent" class="block text-sm font-medium text-lw-primary mb-2">{{ __tr('Content') }}</label>
                <textarea class="bg-white text-lw-primary w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="headerAdsContent" name="header_advertisement[content]" rows="3">{{ $configurationData['header_advertisement']['content'] ?? '' }}</textarea>
            </div>
        </x-lw.card>

        <!-- Footer Advertisement -->
        <x-lw.card class="mb-6">
            <div class="text-center mb-4">
                <img src="{{ url('imgs/ads/728x90.png') }}" class="mx-auto border border-gray-200 rounded" alt="Footer Advertisement Preview">
            </div>
            
            <!-- Footer Advertisement Title -->
            <h6 class="text-lg font-semibold mb-4 text-lw-primary">{{ $configurationData['footer_advertisement']['title'] ?? '' }}</h6>

            <!-- Hidden Input field for Title -->
            <input type="hidden" name="footer_advertisement[title]" value="{{ $configurationData['footer_advertisement']['title'] ?? '' }}">

            <!-- Hidden Input field for height -->
            <input type="hidden" name="footer_advertisement[height]" value="{{ $configurationData['footer_advertisement']['height'] ?? '' }}">

            <!-- Hidden Input field for width -->
            <input type="hidden" name="footer_advertisement[width]" value="{{ $configurationData['footer_advertisement']['width'] ?? '' }}">

            <!-- Hidden Input field for false checkbox value -->
            <input type="hidden" name="footer_advertisement[status]" value="false">

            <!-- Enable Footer Ads Checkbox -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="enableFooterAds" name="footer_advertisement[status]" value="true" {{ (($configurationData['footer_advertisement']['status'] ?? '') == 'true') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="enableFooterAds">{{ __tr('Enable') }}</label>
                </div>
            </div>

            <!-- Footer Content -->
            <div class="form-group">
                <label for="footerAdsContent" class="block text-sm font-medium text-lw-primary mb-2">{{ __tr('Content') }}</label>
                <textarea class="bg-white text-lw-primary w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="footerAdsContent" name="footer_advertisement[content]" rows="3">{{ $configurationData['footer_advertisement']['content'] ?? '' }}</textarea>
            </div>
        </x-lw.card>

        <!-- User Sidebar Advertisement -->
        <x-lw.card class="mb-6">
            <div class="text-center mb-4">
                <img src="{{ url('imgs/ads/200x200.png') }}" class="mx-auto border border-gray-200 rounded" alt="Sidebar Advertisement Preview">
            </div>
            
            <!-- User Sidebar Advertisement Title -->
            <h6 class="text-lg font-semibold mb-4 text-lw-primary">{{ $configurationData['user_sidebar_advertisement']['title'] ?? '' }}</h6>

            <!-- Hidden Input field for Title -->
            <input type="hidden" name="user_sidebar_advertisement[title]" value="{{ $configurationData['user_sidebar_advertisement']['title'] ?? '' }}">

            <!-- Hidden Input field for height -->
            <input type="hidden" name="user_sidebar_advertisement[height]" value="{{ $configurationData['user_sidebar_advertisement']['height'] ?? '' }}">

            <!-- Hidden Input field for width -->
            <input type="hidden" name="user_sidebar_advertisement[width]" value="{{ $configurationData['user_sidebar_advertisement']['width'] ?? '' }}">

            <!-- Hidden Input field for false checkbox value -->
            <input type="hidden" name="user_sidebar_advertisement[status]" value="false">

            <!-- Enable User Sidebar Ads Checkbox -->
            <div class="mb-4">
                <div class="flex items-center">
                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="enableUserSidebarAds" name="user_sidebar_advertisement[status]" value="true" {{ (($configurationData['user_sidebar_advertisement']['status'] ?? '') == 'true') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm font-medium text-lw-primary" for="enableUserSidebarAds">{{ __tr('Enable') }}</label>
                </div>
            </div>

            <!-- User Sidebar Content -->
            <div class="form-group">
                <label for="userSidebarAdsContent" class="block text-sm font-medium text-lw-primary mb-2">{{ __tr('Content') }}</label>
                <textarea class="bg-white text-lw-primary w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="userSidebarAdsContent" name="user_sidebar_advertisement[content]" rows="3">{{ $configurationData['user_sidebar_advertisement']['content'] ?? '' }}</textarea>
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