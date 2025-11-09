<!-- Account Settings -->

<div class="w-full" style="font-family: 'Poppins', sans-serif;">
    <!-- Back Button and Section Title -->
    <div class="flex items-center gap-3 mb-6">
        <button onclick="window.history.back()" class="flex items-center justify-center w-10 h-10 rounded-full transition-all duration-200 hover:bg-gray-100" style="background-color: transparent; border: none; cursor: pointer;">
            <i class="fas fa-arrow-left" style="color: #1F1638; font-size: 20px;"></i>
        </button>
        <h2 class="text-3xl font-bold" style="color: #1F1638; margin: 0;">Account</h2>
    </div>

    <!-- Account Form -->
    <form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.account_settings') ?>">
        <div class="space-y-4">
            <!-- Full Name -->
            <div>
                <input type="text" name="full_name" value="<?= getUserAuthInfo('profile.full_name') ?>" placeholder="Full Name" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;" />
            </div>

            <!-- Email Address -->
            <div>
                <input type="email" name="email" value="<?= getUserAuthInfo('profile.email') ?>" placeholder="Email Address" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;" />
            </div>

            <!-- Date of Birth -->
            <div>
                <?php
                    use App\Yantrana\Components\User\Models\UserProfile;

                    $userId = getUserID();
                    $userProfile = UserProfile::where('users__id', $userId)->first();
                    $dob = !empty($userProfile) ? $userProfile->dob : '';
                    $aboutMe = !empty($userProfile) ? $userProfile->about_me : '';

                    // Convert YYYY-MM-DD to DD/MM/YYYY for display
                    if (!empty($dob) && preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $dob, $matches)) {
                        $dob = $matches[3] . '/' . $matches[2] . '/' . $matches[1];
                    }
                ?>
                <input type="text" name="dob" value="<?= $dob ?>" placeholder="DD / MM / YYYY" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;" />
            </div>

            <!-- About Me -->
            <div>
                <textarea name="about_me" placeholder="About Me" rows="4" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2 resize-none" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;"><?= htmlspecialchars($aboutMe) ?></textarea>
            </div>

            <!-- Divider -->
            <div class="py-4">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t" style="border-color: #E9D8FD;"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white" style="color: #999; font-size: 14px; background-color: #FAFAFA;">Change Password (Optional)</span>
                    </div>
                </div>
            </div>

            <!-- Current Password -->
            <!-- <div>
                <input type="password" name="current_password" placeholder="Current Password" autocomplete="current-password" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;" />
            </div> -->

            <!-- New Password -->
            <div>
                <input type="password" name="new_password" placeholder="New Password" autocomplete="new-password" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;" />
            </div>

            <!-- Confirm New Password -->
            <div>
                <input type="password" name="new_password_confirmation" placeholder="Confirm New Password" autocomplete="new-password" class="w-full py-4 px-6 rounded-3xl transition-all duration-200 focus:outline-none focus:ring-2" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif; font-size: 16px;" />
            </div>
        </div>

        <!-- Save Button -->
        <div class="mt-8 flex justify-center">
            <button type="submit" class="lw-ajax-form-submit-action px-12 py-3 rounded-full text-white font-medium transition-all duration-200 hover:opacity-90 hover:scale-105" style="background-color: #7C3AED; font-family: 'Poppins', sans-serif; font-size: 18px; box-shadow: 0 4px 14px rgba(124, 58, 237, 0.35);">
                Save Changes
            </button>
        </div>
    </form>

    <!-- Additional Options -->
    @if(!isAdmin())
    <div class="mt-12">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#lwDeleteAccountModel" class="block py-4 px-6 rounded-3xl transition-all duration-200 hover:opacity-80 text-center" style="background-color: #FEF2F2; border: 1px solid #FECACA; color: #DC2626; font-family: 'Poppins', sans-serif; text-decoration: none;">
            <i class="fas fa-trash-alt mr-3"></i><?= __tr('Delete Account') ?>
        </a>
    </div>
    @endif
</div>

@if(!isAdmin())
<!-- Delete Account Modal -->
<div class="modal fade" id="lwDeleteAccountModel" tabindex="-1" role="dialog" aria-labelledby="deleteAccountLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="border-radius: 20px;">
			<div class="modal-header" style="border-bottom: 1px solid #F0F0F0;">
				<h5 class="modal-title font-weight-bold" id="deleteAccountLabel" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Delete account?') ?></h5>
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
