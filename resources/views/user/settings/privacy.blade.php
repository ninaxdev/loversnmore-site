<!-- Privacy Settings -->
<div class="lw-privacy-settings-container">
    <!-- Privacy Settings Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-shield-alt mr-2"></i><?= __tr('Privacy Settings') ?>
        </h1>
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle mr-2"></i>
        <?= __tr('Privacy settings will be available soon. You can manage your privacy preferences here.') ?>
    </div>

    <!-- Privacy Options (Placeholder) -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= __tr('Privacy Options') ?></h5>
            
            <!-- Hide Online Status -->
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="hideOnlineStatus" disabled>
                    <label class="custom-control-label" for="hideOnlineStatus">
                        <i class="fas fa-eye-slash mr-2"></i><?= __tr('Hide Online Status') ?>
                    </label>
                </div>
                <small class="form-text text-muted"><?= __tr('Prevent others from seeing when you\'re online') ?></small>
            </div>

            <!-- Profile Visibility -->
            <div class="form-group">
                <label for="profileVisibility">
                    <i class="fas fa-users mr-2"></i><?= __tr('Profile Visibility') ?>
                </label>
                <select class="form-control" id="profileVisibility" disabled>
                    <option><?= __tr('Everyone') ?></option>
                    <option><?= __tr('Matches Only') ?></option>
                    <option><?= __tr('Nobody') ?></option>
                </select>
                <small class="form-text text-muted"><?= __tr('Control who can see your profile') ?></small>
            </div>

            <!-- Blocked Users Link -->
            <div class="form-group">
                <a href="<?= route('user.read.block_user_list') ?>" class="btn btn-outline-primary lw-ajax-link-action lw-action-with-url">
                    <i class="fas fa-user-slash mr-2"></i><?= __tr('Manage Blocked Users') ?>
                </a>
            </div>
        </div>
    </div>
</div>
