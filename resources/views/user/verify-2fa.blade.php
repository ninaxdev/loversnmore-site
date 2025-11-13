
@section('page-title', __tr('Two-Factor Authentication'))
@section('head-title', __tr('Two-Factor Authentication'))
@section('keywordName', strip_tags(__tr('Two-Factor Authentication')))
@section('keyword', strip_tags(__tr('Two-Factor Authentication')))
@section('description', strip_tags(__tr('Two-Factor Authentication')))
@section('keywordDescription', strip_tags(__tr('Two-Factor Authentication')))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- include header -->
@include('includes.header')
<!-- /include header -->

<body class="lw-login-register-page lw-new-login-design">
    <!-- Background gradients -->
    <div class="lw-gradient-bg-bottom"></div>
    <div class="lw-gradient-bg-top"></div>

    <div class="container-fluid p-lg-0">
        <div class="row no-gutters min-vh-100">
            <!-- Left side image (larger screens) -->
            <div class="col-lg-7 d-none d-lg-block lw-login-left-bg">
                <div class="lw-page-bg" style="background: var(--lw-gradient-main);"></div>
                <div class="lw-login-bg-overlay">
                    <img class="lw-logo-img-on-bg" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
                </div>
            </div>

            <!-- Right side form -->
            <div class="col-lg-5 col-12 lw-login-form-container">
                <div class="lw-login-form-wrapper">
                    <div class="lw-login-header">
                        <!-- Logo for mobile -->
                        <div class="d-lg-none text-center mb-4">
                            <a href="<?= url(''); ?>">
                                <img class="lw-mobile-logo" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
                            </a>
                        </div>

                        <h1 class="lw-login-title"><?= __tr('Two-Factor Authentication') ?></h1>
                        <p class="lw-login-subtitle"><?= __tr('We sent a 6-digit verification code to your email address.') ?><br><?= __tr('Please enter the code below to continue.') ?></p>
                    </div>

                    <!-- 2FA Verification form -->
                    <form class="lw-new-login-form user lw-ajax-form lw-form" method="post"
                        action="<?= route('user.verify.2fa_code') ?>" data-show-processing="true"
                        data-callback="on2FAVerifyCallback" id="lw2FAVerifyForm">
                        @csrf

                        <!-- Verification Code input field -->
                        <div class="lw-form-group">
                            <div class="lw-input-container">
                                <input type="text"
                                    class="lw-form-input lw-2fa-code-input text-center"
                                    name="two_factor_code"
                                    required
                                    id="lw2FACode"
                                    placeholder="<?= __tr('Enter 6-digit code') ?>"
                                    maxlength="6"
                                    pattern="[0-9]{6}"
                                    inputmode="numeric"
                                    autocomplete="off"
                                    style="letter-spacing: 0.5em; font-size: 24px; font-weight: bold; font-family: monospace;">
                            </div>
                            <small class="form-text text-muted mt-2" style="text-align: center; display: block;">
                                <?= __tr('Code expires in 10 minutes') ?>
                            </small>
                        </div>
                        <!-- / Verification Code input field -->

                        <!-- Verify button -->
                        <button type="submit" class="lw-gradient-btn lw-ajax-form-submit-action">
                            <?= __tr('Verify & Login') ?>
                        </button>
                        <!-- / Verify button -->
                    </form>
                    <!-- /2FA Verification form -->

                    <!-- Back to login link -->
                    <div class="lw-bottom-links">
                        <div class="text-center">
                            <p class="lw-signup-text"><?= __tr("Wrong account?") ?></p>
                            <a class="lw-signup-btn" href="<?= route('user.logout') ?>"><?= __tr('Back to Login') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@lwPush('appScripts')
<style>
    /* Additional styling for 2FA code input */
    .lw-2fa-code-input {
        padding: 1rem !important;
    }

    .lw-2fa-code-input:focus {
        border-color: var(--lw-primary-color, #6366f1) !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1) !important;
    }

    /* Remove spinner for number inputs */
    .lw-2fa-code-input::-webkit-outer-spin-button,
    .lw-2fa-code-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .lw-2fa-code-input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<script>
    //on 2FA verify form callback
    function on2FAVerifyCallback(response) {
        //check reaction code is 1
        if (response.reaction == 1) {
            // Redirect to intended page or use response_action
            if (response.response_action && response.response_action.url) {
                _.defer(function() {
                    window.location.href = response.response_action.url;
                });
            } else if (response.data.redirectUrl) {
                _.defer(function() {
                    window.location.href = response.data.redirectUrl;
                });
            } else {
                // Fallback to home page
                _.defer(function() {
                    window.location.href = '<?= route('home_page') ?>';
                });
            }
        }
    }

    // Auto-focus on the code input when page loads
    document.addEventListener('DOMContentLoaded', function() {
        var codeInput = document.getElementById('lw2FACode');
        if (codeInput) {
            codeInput.focus();
        }
    });
</script>
@lwPushEnd

<!-- include footer -->
@include('includes.footer')
<!-- /include footer -->
