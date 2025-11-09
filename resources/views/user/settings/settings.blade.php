<?php $pageType = $pageType ?? request()->pageType ?? 'account' ?>
<!-- Settings Page Container -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
	<!-- Settings Header -->
	<div class="max-w-6xl mx-auto mb-8">
		<h1 class="text-4xl md:text-5xl font-bold" style="color: #1F1638;">Settings</h1>
	</div>

	<!-- Tab Navigation -->
	<div class="max-w-6xl mx-auto mb-8">
		<div class="flex flex-wrap gap-3">
			<a href="<?= route('user.settings.account') ?>" class="lw-ajax-link-action lw-action-with-url px-6 py-3 rounded-full transition-all duration-200 hover:opacity-80" style="<?= $pageType === 'account' ? 'background-color: #FCE7F3; color: #1F1638;' : 'background-color: transparent; color: #1F1638;' ?> font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px;">
				Account
			</a>
			<a href="<?= route('user.read.setting', ['pageType' => 'notification']) ?>" class="lw-ajax-link-action lw-action-with-url px-6 py-3 rounded-full transition-all duration-200 hover:opacity-80" style="<?= $pageType === 'notification' ? 'background-color: #FCE7F3; color: #1F1638;' : 'background-color: transparent; color: #1F1638;' ?> font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px;">
				Notifications
			</a>
			<a href="<?= route('user.settings.privacy') ?>" class="lw-ajax-link-action lw-action-with-url px-6 py-3 rounded-full transition-all duration-200 hover:opacity-80" style="<?= $pageType === 'privacy' ? 'background-color: #FCE7F3; color: #1F1638;' : 'background-color: transparent; color: #1F1638;' ?> font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px;">
				Privacy
			</a>
			<a href="<?= route('user.settings.preferences') ?>" class="lw-ajax-link-action lw-action-with-url px-6 py-3 rounded-full transition-all duration-200 hover:opacity-80" style="<?= $pageType === 'preferences' ? 'background-color: #FCE7F3; color: #1F1638;' : 'background-color: transparent; color: #1F1638;' ?> font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px;">
				Preferences
			</a>
			<a href="<?= route('user.settings.visitors') ?>" class="lw-ajax-link-action lw-action-with-url px-6 py-3 rounded-full transition-all duration-200 hover:opacity-80" style="<?= $pageType === 'visitors' ? 'background-color: #FCE7F3; color: #1F1638;' : 'background-color: transparent; color: #1F1638;' ?> font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px;">
				Visitors
			</a>
		</div>
	</div>

	<!-- Settings Content -->
	<div class="max-w-6xl mx-auto">
		@include('user.settings.'. $pageType)
	</div>
</div>

@if(!isAdmin() && !in_array($pageType, ['account', 'privacy', 'preferences']))
<!-- Delete Account Modal -->
<div class="modal fade" id="lwDeleteAccountModel" tabindex="-1" role="dialog" aria-labelledby="messengerModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="border-radius: 20px;">
			<div class="modal-header" style="border-bottom: 1px solid #F0F0F0;">
				<h5 class="modal-title font-weight-bold" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Delete account?') ?></h5>
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