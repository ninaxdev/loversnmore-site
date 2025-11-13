@section('page-title', __tr('Settings'))
@section('head-title', __tr('Settings'))
@section('keywordName', __tr('Settings'))
@section('keyword', __tr('Settings'))
@section('description', __tr('Settings'))
@section('keywordDescription', __tr('Settings'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Settings Overview Page -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-2xl mx-auto">
        <!-- Back to Home Link -->
        <div class="mb-6">
            <a href="/home" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Back') ?>
            </a>
        </div>

        <!-- Settings Title -->
        <h1 class="text-4xl font-bold mb-8" style="color: #1F1638;">Settings</h1>

        <!-- Settings List -->
        <div class="space-y-4">
            <!-- Account -->
            <a href="<?= route('user.settings.account') ?>" class="lw-ajax-link-action lw-action-with-url block py-4 px-6 rounded-3xl transition-all duration-200 hover:shadow-lg" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; text-decoration: none;">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #E9D8FD;">
                            <i class="fas fa-user text-xl" style="color: #7C3AED;"></i>
                        </div>
                        <span class="text-lg font-medium" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Account') ?></span>
                    </div>
                    <i class="fas fa-chevron-right" style="color: #999;"></i>
                </div>
            </a>

            <!-- Notifications -->
            <a href="<?= route('user.read.setting', ['pageType' => 'notification']) ?>" class="lw-ajax-link-action lw-action-with-url block py-4 px-6 rounded-3xl transition-all duration-200 hover:shadow-lg" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; text-decoration: none;">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #FCE7F3;">
                            <i class="far fa-bell text-xl" style="color: #EC4899;"></i>
                        </div>
                        <span class="text-lg font-medium" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Notifications') ?></span>
                    </div>
                    <i class="fas fa-chevron-right" style="color: #999;"></i>
                </div>
            </a>

            <!-- Privacy & Access -->
            <a href="<?= route('user.settings.privacy') ?>" class="lw-ajax-link-action lw-action-with-url block py-4 px-6 rounded-3xl transition-all duration-200 hover:shadow-lg" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; text-decoration: none;">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #FCE7F3;">
                            <i class="fas fa-shield-alt text-xl" style="color: #EC4899;"></i>
                        </div>
                        <span class="text-lg font-medium" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Privacy & Access') ?></span>
                    </div>
                    <i class="fas fa-chevron-right" style="color: #999;"></i>
                </div>
            </a>
        </div>
    </div>
</div>
