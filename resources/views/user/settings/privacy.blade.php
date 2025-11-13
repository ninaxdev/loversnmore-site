<!-- Privacy & Access Settings -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-2xl mx-auto">
        <!-- Back to Settings Link -->
        <div class="mb-6">
            <a href="<?= route('user.settings.index') ?>" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Settings') ?>
            </a>
        </div>

        <!-- Section Title -->
        <h2 class="text-3xl font-bold mb-6" style="color: #1F1638;">Privacy & Access</h2>

        <!-- Privacy Settings Cards -->
        <div class="space-y-3 mb-6">
            <!-- Profile Visibility -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Profile Visibility</span>
                <div class="relative">
                    <input type="checkbox" id="lwProfileVisibility" class="sr-only peer" checked>
                    <div class="w-14 h-7 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all cursor-pointer" style="background-color: #5B3E96;" onclick="document.getElementById('lwProfileVisibility').click()"></div>
                </div>
            </div>

            <!-- Hide Online Status -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Hide Online Status</span>
                <div class="relative">
                    <input type="checkbox" id="lwHideOnlineStatus" class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all cursor-pointer" onclick="document.getElementById('lwHideOnlineStatus').click()"></div>
                </div>
            </div>

            <!-- Blocked Users -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Blocked Users</span>
                <a href="<?= route('user.read.block_user_list') ?>" class="lw-ajax-link-action lw-action-with-url text-base font-medium" style="color: #5B3E96; font-family: 'Poppins', sans-serif; text-decoration: none;">View list</a>
            </div>
        </div>

        <!-- Security Section -->
        <h3 class="text-xl font-semibold mb-3 mt-8" style="color: #000000; font-family: 'Poppins', sans-serif;">Security</h3>
        <div class="space-y-3 mb-6">
            <!-- Reset Password -->
            <div class="py-4 px-6 rounded-3xl cursor-pointer" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;" onclick="showResetPasswordModal()">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Reset Password</span>
            </div>
        </div>

        <!-- Account Status Section -->
        <h3 class="text-xl font-semibold mb-3 mt-8" style="color: #000000; font-family: 'Poppins', sans-serif;">Account Status</h3>
        <div class="space-y-3">
            <!-- Deactivate Account -->
            <div class="py-4 px-6 rounded-3xl cursor-pointer" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;" onclick="showDeactivateAccountModal()">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Deactivate Account</span>
            </div>

            <!-- Delete Account -->
            @if(!isAdmin())
            <div class="py-4 px-6 rounded-3xl cursor-pointer" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;" onclick="showDeleteAccountModal()">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Delete Account</span>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="lwResetPasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header" style="border-bottom: 1px solid #F0F0F0;">
                <h5 class="modal-title font-weight-bold" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Reset Password') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.account_settings') ?>">
                    <div class="mb-4">
                        <label for="new_password" class="font-weight-medium mb-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('New Password') ?></label>
                        <input type="password" name="new_password" placeholder="<?= __tr('New Password') ?>" class="form-control py-3 px-4 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif;" required autocomplete="new-password" />
                    </div>
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="font-weight-medium mb-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Confirm New Password') ?></label>
                        <input type="password" name="new_password_confirmation" placeholder="<?= __tr('Confirm New Password') ?>" class="form-control py-3 px-4 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif;" required autocomplete="new-password" />
                    </div>
                    <button type="submit" class="lw-ajax-form-submit-action w-100 py-3 rounded-full font-weight-medium text-white transition-all duration-200 hover:opacity-90" style="background-color: #5B3E96; font-family: 'Poppins', sans-serif; border: none;"><?= __tr('Reset Password')  ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Deactivate Account Modal -->
<div class="modal fade" id="lwDeactivateAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header" style="border-bottom: 1px solid #F0F0F0;">
                <h5 class="modal-title font-weight-bold" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Deactivate Account') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="p-4 mb-4 rounded-3xl" style="background-color: #FEF2F2; color: #991B1B; font-family: 'Poppins', sans-serif;">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <?= __tr('Your account will be temporarily deactivated. You can reactivate it by logging in again.') ?>
                </div>
                <p class="mb-4" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Are you sure you want to deactivate your account?') ?></p>
                <button type="button" class="w-100 py-3 rounded-full font-weight-medium text-white transition-all duration-200 hover:opacity-90" style="background-color: #DC2626; font-family: 'Poppins', sans-serif; border: none;"><?= __tr('Deactivate Account')  ?></button>
            </div>
        </div>
    </div>
</div>

@if(!isAdmin())
<!-- Delete Account Modal -->
<div class="modal fade" id="lwDeleteAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="border-radius: 20px;">
			<div class="modal-header" style="border-bottom: 1px solid #F0F0F0;">
				<h5 class="modal-title font-weight-bold" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Delete Account?') ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<div class="modal-body p-4">
				<form class="user lw-ajax-form lw-form" method="post" action="<?= route('user.write.delete_account') ?>">
					<div class="p-4 mb-4 rounded-3xl" style="background-color: #FEF2F2; color: #991B1B; font-family: 'Poppins', sans-serif;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <?= __tr('Are you sure you want to delete your account? All content including photos and other data will be permanently removed!') ?>
                    </div>
					<div class="mb-4">
						<label for="password" class="font-weight-medium mb-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Enter your password') ?></label>
						<input type="password" class="form-control py-3 px-4 rounded-3xl" name="password" id="password" placeholder="<?= __tr('Password') ?>" required minlength="6" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif;">
					</div>
					<button type="submit" class="lw-ajax-form-submit-action w-100 py-3 rounded-full font-weight-medium text-white transition-all duration-200 hover:opacity-90" style="background-color: #DC2626; font-family: 'Poppins', sans-serif; border: none;"><?= __tr('Delete Account')  ?></button>
				</form>
			</div>
		</div>
	</div>
</div>
@endif

<script>
function showResetPasswordModal() {
    $('#lwResetPasswordModal').modal('show');
}

function showDeactivateAccountModal() {
    $('#lwDeactivateAccountModal').modal('show');
}

function showDeleteAccountModal() {
    $('#lwDeleteAccountModal').modal('show');
}
</script>
