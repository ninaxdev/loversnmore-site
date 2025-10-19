<!-- Account Settings -->
<div class="lw-account-settings-container">
    <!-- Account Settings Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-circle mr-2"></i><?= __tr('Account Settings') ?>
        </h1>
    </div>

    <!-- Account Options List -->
    <div class="card">
        <div class="card-body p-0">
            <div class="lw-account-settings-list">
                
                <!-- Change Email -->
                <a href="<?= route('user.change_email') ?>" class="lw-account-setting-item lw-ajax-link-action lw-action-with-url">
                    <div class="lw-account-item-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="lw-account-item-content">
                        <span class="lw-account-item-title"><?= __tr('Change Email') ?></span>
                        <span class="lw-account-item-description"><?= __tr('Update your email address') ?></span>
                    </div>
                    <div class="lw-account-item-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>

                <!-- Change Password -->
                <a href="<?= route('user.change_password') ?>" class="lw-account-setting-item lw-ajax-link-action lw-action-with-url">
                    <div class="lw-account-item-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <div class="lw-account-item-content">
                        <span class="lw-account-item-title"><?= __tr('Change Password') ?></span>
                        <span class="lw-account-item-description"><?= __tr('Update your password') ?></span>
                    </div>
                    <div class="lw-account-item-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>

                @if(!isAdmin())
                <!-- Delete Account -->
                <a href="javascript:void(0)" class="lw-account-setting-item lw-account-danger-item" data-toggle="modal" data-target="#lwDeleteAccountModel">
                    <div class="lw-account-item-icon lw-icon-danger">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <div class="lw-account-item-content">
                        <span class="lw-account-item-title text-danger"><?= __tr('Delete Account') ?></span>
                        <span class="lw-account-item-description"><?= __tr('Permanently delete your account') ?></span>
                    </div>
                    <div class="lw-account-item-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
                @endif

            </div>
        </div>
    </div>
</div>

@if(!isAdmin())
<!-- Delete Account Modal -->
<div class="modal fade" id="lwDeleteAccountModel" tabindex="-1" role="dialog" aria-labelledby="deleteAccountLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteAccountLabel"><?= __tr('Delete account?') ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<div class="modal-body">
				<form class="user lw-ajax-form lw-form" method="post" action="<?= route('user.write.delete_account') ?>">
					<div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <?= __tr('Are you sure you want to delete your account? All content including photos and other data will be permanently removed!') ?>
                    </div>
					<hr />
					<div class="form-group">
						<label for="password"><?= __tr('Enter your password') ?></label>
						<input type="password" class="form-control" name="password" id="password" placeholder="<?= __tr('Password') ?>" required minlength="6">
					</div>
					<button type="submit" class="lw-ajax-form-submit-action btn btn-danger btn-block"><?= __tr('Delete Account')  ?></button>
				</form>
			</div>
		</div>
	</div>
</div>
@endif

<!-- Account Settings Styles -->
<style>
.lw-account-settings-container {
    margin-top: 20px;
}

.lw-account-settings-list {
    padding: 0;
}

.lw-account-setting-item {
    display: flex;
    align-items: center;
    padding: 18px 20px;
    background: transparent;
    border-bottom: 1px solid #3d3c48;
    text-decoration: none;
    transition: background-color 0.2s ease;
    cursor: pointer;
}

.lw-account-setting-item:hover {
    background-color: rgba(197, 62, 141, 0.05);
}

.lw-account-setting-item:last-child {
    border-bottom: none;
}

.lw-account-item-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    flex-shrink: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.lw-account-item-icon.lw-icon-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.lw-account-item-icon i {
    font-size: 18px;
    color: white;
}

.lw-account-item-content {
    flex: 1;
}

.lw-account-item-title {
    font-size: 16px;
    font-weight: 500;
    color: #d8d8d8;
    display: block;
    margin-bottom: 4px;
}

.lw-account-item-description {
    font-size: 13px;
    color: #858796;
    display: block;
}

.lw-account-item-arrow {
    color: #858796;
    flex-shrink: 0;
}

.lw-account-item-arrow i {
    font-size: 14px;
}

@media (max-width: 768px) {
    .lw-account-setting-item {
        padding: 16px 18px;
    }

    .lw-account-item-icon {
        width: 40px;
        height: 40px;
        margin-right: 14px;
    }

    .lw-account-item-icon i {
        font-size: 16px;
    }

    .lw-account-item-title {
        font-size: 15px;
    }

    .lw-account-item-description {
        font-size: 12px;
    }
}
</style>
