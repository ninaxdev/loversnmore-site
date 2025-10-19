@section('page-title', __tr('Settings'))
@section('head-title', __tr('Settings'))
@section('keywordName', __tr('Settings'))
@section('keyword', __tr('Settings'))
@section('description', __tr('Manage your account settings'))
@section('keywordDescription', __tr('Manage your account settings'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Settings Page Container -->
<div class="lw-settings-container">
    <!-- Settings Header -->
    <div class="lw-settings-header-bar">
        <h1 class="lw-settings-header-title"><?= __tr('Settings') ?></h1>
    </div>

    <!-- Settings Content -->
    <div class="lw-settings-content-area">
        <!-- Settings List -->
        <div class="lw-settings-list">
            
            <!-- Account -->
            <a href="<?= route('user.settings.account') ?>" class="lw-settings-list-item lw-ajax-link-action lw-action-with-url">
                <div class="lw-settings-item-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="lw-settings-item-content">
                    <span class="lw-settings-item-title"><?= __tr('Account') ?></span>
                </div>
                <div class="lw-settings-item-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <!-- Notifications -->
            <a href="<?= route('user.read.setting', ['pageType' => 'notification']) ?>" class="lw-settings-list-item lw-ajax-link-action lw-action-with-url">
                <div class="lw-settings-item-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="lw-settings-item-content">
                    <span class="lw-settings-item-title"><?= __tr('Notifications') ?></span>
                </div>
                <div class="lw-settings-item-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <!-- Privacy -->
            <a href="<?= route('user.settings.privacy') ?>" class="lw-settings-list-item lw-ajax-link-action lw-action-with-url">
                <div class="lw-settings-item-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="lw-settings-item-content">
                    <span class="lw-settings-item-title"><?= __tr('Privacy') ?></span>
                </div>
                <div class="lw-settings-item-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <!-- Membership -->
            <a href="<?= route('user.premium_plan.read.view') ?>" class="lw-settings-list-item lw-ajax-link-action lw-action-with-url">
                <div class="lw-settings-item-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="lw-settings-item-content">
                    <span class="lw-settings-item-title"><?= __tr('Membership') ?></span>
                </div>
                <div class="lw-settings-item-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <!-- Preferences -->
            <a href="<?= route('user.settings.preferences') ?>" class="lw-settings-list-item lw-ajax-link-action lw-action-with-url">
                <div class="lw-settings-item-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <div class="lw-settings-item-content">
                    <span class="lw-settings-item-title"><?= __tr('Preferences') ?></span>
                </div>
                <div class="lw-settings-item-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

        </div>
    </div>
</div>

<!-- Settings Page Styles -->
<style>
/* Settings Container */
.lw-settings-container {
    min-height: 100vh;
    background-color: #f5f5f5;
}

/* Settings Header */
.lw-settings-header-bar {
    background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
    padding: 60px 20px 30px 20px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.lw-settings-header-title {
    color: white;
    font-size: 24px;
    font-weight: 600;
    margin: 0;
    letter-spacing: 0.5px;
}

/* Settings Content Area */
.lw-settings-content-area {
    padding: 0;
}

/* Settings List */
.lw-settings-list {
    background: white;
    margin: 0;
    padding: 0;
}

/* Settings List Item */
.lw-settings-list-item {
    display: flex;
    align-items: center;
    padding: 18px 20px;
    background: white;
    border-bottom: 1px solid #f0f0f0;
    text-decoration: none;
    transition: background-color 0.2s ease;
    cursor: pointer;
}

.lw-settings-list-item:hover {
    background-color: #fafafa;
}

.lw-settings-list-item:active {
    background-color: #f5f5f5;
}

.lw-settings-list-item:last-child {
    border-bottom: none;
}

/* Settings Item Icon */
.lw-settings-item-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
    background: #EC4899;
}

.lw-settings-item-icon i {
    font-size: 18px;
    color: white;
}

/* Settings Item Content */
.lw-settings-item-content {
    flex: 1;
}

.lw-settings-item-title {
    font-size: 16px;
    font-weight: 500;
    color: #1f2937;
    display: block;
}

/* Settings Item Arrow */
.lw-settings-item-arrow {
    color: #9ca3af;
    flex-shrink: 0;
}

.lw-settings-item-arrow i {
    font-size: 14px;
}

/* Desktop Styles */
@media (min-width: 768px) {
    .lw-settings-container {
        background-color: #f9fafb;
    }

    .lw-settings-header-bar {
        padding: 80px 20px 40px 20px;
    }

    .lw-settings-header-title {
        font-size: 32px;
    }

    .lw-settings-content-area {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px 20px;
    }

    .lw-settings-list {
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .lw-settings-list-item {
        padding: 20px 24px;
    }

    .lw-settings-list-item:first-child {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .lw-settings-list-item:last-child {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .lw-settings-item-icon {
        width: 44px;
        height: 44px;
        margin-right: 18px;
    }

    .lw-settings-item-icon i {
        font-size: 19px;
    }

    .lw-settings-item-title {
        font-size: 17px;
    }

    .lw-settings-item-arrow i {
        font-size: 16px;
    }
}

/* Tablet Styles */
@media (min-width: 768px) and (max-width: 1024px) {
    .lw-settings-content-area {
        max-width: 700px;
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .lw-settings-container {
        background-color: #111827;
    }

    .lw-settings-list {
        background: #1f2937;
    }

    .lw-settings-list-item {
        background: #1f2937;
        border-bottom-color: #374151;
    }

    .lw-settings-list-item:hover {
        background-color: #374151;
    }

    .lw-settings-list-item:active {
        background-color: #4b5563;
    }

    .lw-settings-item-title {
        color: #f9fafb;
    }

    .lw-settings-item-arrow {
        color: #6b7280;
    }
}
</style>
