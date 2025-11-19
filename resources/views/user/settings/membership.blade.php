@section('page-title', __tr('Membership'))
@section('head-title', __tr('Membership'))
@section('keywordName', __tr('Membership'))
@section('keyword', __tr('Membership'))
@section('description', __tr('Membership'))
@section('keywordDescription', __tr('Membership'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Membership Settings Page -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-2xl mx-auto">
        <!-- Back to Home Link -->
        <div class="mb-6">
            <a href="/home" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Back') ?>
            </a>
        </div>

        <!-- Membership Title -->
        <h1 class="text-4xl font-bold mb-8" style="color: #1F1638;">Membership</h1>

        <!-- Current Plan Section -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4" style="color: #1F1638;">Current Plan</h2>

            <!-- Current Plan Card -->
            <div class="py-6 px-6 rounded-3xl mb-4" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <h3 class="text-xl font-bold mb-2" style="color: #1F1638;">Free Basic Plan</h3>
                <div class="flex justify-between items-center text-base" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                    <span><strong>Status:</strong> Active</span>
                    <span><strong>Renews:</strong> N/A</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4">
            <!-- Go Premium Button -->
            <button class="w-full py-4 px-6 rounded-full font-semibold text-lg text-white text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl" style="background-color: #5B3E96; font-family: 'Poppins', sans-serif; box-shadow: 0 4px 14px rgba(91, 62, 150, 0.35); border: none; cursor: pointer;">
                Go Premium
            </button>

            <!-- Manage Subscription Button -->
            <button class="w-full py-4 px-6 rounded-full font-semibold text-lg text-center transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: #F8F4FF; color: #5B3E96; font-family: 'Poppins', sans-serif; border: 1px solid #E9D8FD; cursor: pointer;">
                Manage Subscription
            </button>

            <!-- Restore Purchases Button -->
            <button class="w-full py-4 px-6 rounded-full font-semibold text-lg text-center transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: #F8F4FF; color: #5B3E96; font-family: 'Poppins', sans-serif; border: 1px solid #E9D8FD; cursor: pointer;">
                Restore Purchases
            </button>

            <!-- Terms & Billing Info Button -->
            <button class="w-full py-4 px-6 rounded-full font-semibold text-lg text-center transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: #F8F4FF; color: #5B3E96; font-family: 'Poppins', sans-serif; border: 1px solid #E9D8FD; cursor: pointer;">
                Terms & Billing Info
            </button>
        </div>
    </div>
</div>
