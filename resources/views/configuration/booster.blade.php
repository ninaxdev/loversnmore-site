<!-- Modern Booster Settings Page -->
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-rocket text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('Booster Settings') }}</h1>
            </div>
        </div>
    </x-lw.card>

    <!-- Email Setting Form -->
    <form class="lw-ajax-form lw-form" method="post" action="{{ route('manage.configuration.write', ['pageType' => request()->pageType]) }}">
        <div class="col-12 mb-3 alert alert-dark">
            {{ __tr('By boosting their profile user will be a part of featured users and will get priority in search and random users for the specified time & credits below.') }}
        </div>

        <div class="grid grid-cols-1 gap-6 mb-6">
            <!-- Booster period -->
            <x-lw.form-field label="{{ __tr('Booster Period (in Minutes)') }}" name="booster_period">
                <x-lw.input type="number" name="booster_period" id="lwBoosterPeriod" min="1" value="{{ $configurationData['booster_period'] ?? '' }}" required />
            </x-lw.form-field>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Booster Price For Standard Users -->
            <x-lw.form-field label="{{ __tr('Booster Price For Standard Users (in Credits)') }}" name="booster_price">
                <x-lw.input type="number" name="booster_price" id="lwBoosterPrice" min="1" value="{{ $configurationData['booster_price'] ?? '' }}" required />
            </x-lw.form-field>

            <!-- Booster Price For Premium Users -->
            <x-lw.form-field label="{{ __tr('Booster Price For Premium Users (in Credits)') }}" name="booster_price_for_premium_user">
                <x-lw.input type="number" name="booster_price_for_premium_user" id="lwPremiumUserBoosterPrice" min="1" value="{{ $configurationData['booster_price_for_premium_user'] ?? '' }}" required />
            </x-lw.form-field>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-6 border-t border-gray-200">
            <x-lw.button type="button" variant="primary" size="lg" class="lw-ajax-form-submit-action px-12">
                <i class="fas fa-save mr-2"></i>
                {{ __tr('Update') }}
            </x-lw.button>
        </div>
    </form>
</div>