@section('page-title', __tr('Home'))
@section('head-title', __tr('Home'))
@section('keywordName', __tr('Home'))
@section('keyword', __tr('Home'))
@section('description', __tr('Home'))
@section('keywordDescription', __tr('Home'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Home Page -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <!-- Content Container -->
    <div class="w-full max-w-2xl mx-auto py-12 px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-8" style="color: #1F1638;">Home</h2>

            <!-- Profile Picture -->
            <div class="flex justify-center mb-4">
                <img class="rounded-full object-cover" src="<?= imageOrNoImageAvailable(getUserAuthInfo('profile.profile_picture_url')) ?>" alt="<?= getUserAuthInfo('profile.full_name') ?>" style="width: 140px; height: 140px;">
            </div>
        </div>

        <!-- Icon Grid -->
        <div class="max-w-md mx-auto w-full px-4" style="max-width: 28rem;">
            <!-- First Row -->
            <div class="grid grid-cols-3 gap-6 mb-6" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                <!-- Account -->
                <a href="<?= route('user.settings.account') ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #E9D8FD;">
                        <i class="fas fa-user text-2xl" style="color: #7C3AED;"></i>
                    </div>
                    <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Account') ?></span>
                </a>

                <!-- Notifications -->
                <a href="<?= route('user.read.setting', ['pageType' => 'notification']) ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #FCE7F3;">
                        <i class="far fa-bell text-2xl" style="color: #EC4899;"></i>
                    </div>
                    <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Notifications') ?></span>
                </a>

                <!-- Privacy -->
                <a href="<?= route('user.settings.privacy') ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center ">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #FCE7F3;">
                        <i class="fas fa-shield-alt text-2xl" style="color: #EC4899;"></i>
                    </div>
                    <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Privacy') ?></span>
                </a>
            </div>

            <!-- Second Row -->
            <div class="grid grid-cols-3 gap-6 mb-6" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                <!-- Preferences -->
                <a href="<?= route('user.settings.preferences') ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center ">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #FCE7F3;">
                        <i class="far fa-heart text-2xl" style="color: #EC4899;"></i>
                    </div>
                    <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Preferences') ?></span>
                </a>

                <!-- My Photos -->
                <a href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center" data-event-callback="lwPrepareUploadPlugIn">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #E9D8FD;">
                        <i class="fas fa-image text-2xl" style="color: #7C3AED;"></i>
                    </div>
                    <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('My Photos') ?></span>
                </a>

                <!-- Visitors -->
                <a href="<?= route('user.settings.visitors') ?>" class="lw-ajax-link-action lw-action-with-url flex flex-col items-center " data-event-callback="lwPrepareUploadPlugIn">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #E9D8FD;">
                        <i class="fas fa-eye text-2xl" style="color: #7C3AED;"></i>
                    </div>
                    <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Visitors') ?></span>
                </a>
            </div>

            @if(isAdmin())
            <!-- Admin Panel (if admin) -->
            <div class="mb-6 flex justify-center">
                <a href="<?= route('manage.dashboard') ?>" target="_blank" class="flex flex-col items-center ">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all duration-200 hover:scale-110" style="background-color: #FEE2E2;">
                        <i class="fas fa-shield-alt text-2xl" style="color: #DC2626;"></i>
                    </div>
                    <span class="text-sm font-medium text-center" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Admin Panel') ?></span>
                </a>
            </div>
            @endif

            <!-- Logout Button -->
            <div class="mt-8">
                <a href="<?= route('user.logout') ?>" class="block w-full py-2 rounded-full font-normal text-lg text-white text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl" style="background-color: #7C3AED; font-family: 'Poppins', sans-serif; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35); text-decoration: none;">
                    <?= __tr('Logout') ?>
                </a>
            </div>
        </div>
    </div>
</div>
