<!-- Privacy Settings -->
<div class="w-full" style="font-family: 'Poppins', sans-serif;">
    <!-- Section Title -->
    <h2 class="text-3xl font-bold mb-6" style="color: #1F1638;">Privacy</h2>

    <!-- Privacy Settings (Placeholder) -->
    <div class="mb-6 p-6 rounded-3xl" style="background-color: #E0F2FE; border: 1px solid #BAE6FD;">
        <div class="flex items-start gap-3">
            <i class="fas fa-info-circle mt-1" style="color: #0284C7;"></i>
            <p class="text-base" style="color: #0C4A6E; font-family: 'Poppins', sans-serif; margin: 0;">
                <?= __tr('Privacy settings will be available soon. You can manage your privacy preferences here.') ?>
            </p>
        </div>
    </div>

    <!-- Privacy Options -->
    <div class="space-y-4">
        <!-- Hide Online Status -->
        <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
            <label for="lwHideOnlineStatus" class="text-base font-normal cursor-pointer" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                <?= __tr('Hide Online Status') ?>
            </label>
            <div class="relative">
                <input type="checkbox" id="lwHideOnlineStatus" disabled class="sr-only peer">
                <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600 opacity-50" style="cursor: not-allowed;"></div>
            </div>
        </div>

        <!-- Profile Visibility -->
        <div>
            <label for="lwProfileVisibility" class="block text-base font-medium mb-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                <?= __tr('Profile Visibility') ?>
            </label>
            <select id="lwProfileVisibility" disabled class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2 opacity-50" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px; cursor: not-allowed;">
                <option><?= __tr('Everyone') ?></option>
                <option><?= __tr('Matches Only') ?></option>
                <option><?= __tr('Nobody') ?></option>
            </select>
            <p class="mt-2 text-sm" style="color: #999; font-family: 'Poppins', sans-serif;"><?= __tr('Control who can see your profile') ?></p>
        </div>

        <!-- Blocked Users Link -->
        <div class="mt-8">
            <a href="<?= route('user.read.block_user_list') ?>" class="lw-ajax-link-action lw-action-with-url block py-4 px-6 rounded-3xl transition-all duration-200 hover:opacity-80 text-center" style="background-color: #FEF2F2; border: 1px solid #FECACA; color: #DC2626; font-family: 'Poppins', sans-serif; text-decoration: none; font-weight: 500;">
                <i class="fas fa-user-slash mr-3"></i><?= __tr('Manage Blocked Users') ?>
            </a>
        </div>
    </div>
</div>
