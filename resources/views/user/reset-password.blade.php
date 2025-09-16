@section('page-title', __tr('Reset Your Password'))
@section('head-title', __tr('Reset Your Password'))
@section('keywordName', strip_tags(__tr('Reset Your Password')))
@section('keyword', strip_tags(__tr('Reset Your Password')))
@section('description', strip_tags(__tr('Reset Your Password')))
@section('keywordDescription', strip_tags(__tr('Reset Your Password')))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- include header -->
@include('includes.header')
<!-- /include header -->

<body class="lw-login-register-page lw-new-login-design">
    <!-- Background Image for larger screens -->
    <div class="lw-page-bg lw-lazy-img d-none d-lg-block" data-src="<?= __yesset("imgs/home/random/*.jpg", false, [
                                                        'random' => true
                                                    ]) ?>"></div>
    
    <!-- Background gradients -->
    <div class="lw-gradient-bg-bottom"></div>
    <div class="lw-gradient-bg-top"></div>
    
    <div class="container-fluid p-lg-0">
        <div class="row no-gutters min-vh-100">
            <!-- Left side image (larger screens) -->
            <div class="col-lg-7 d-none d-lg-block lw-login-left-bg">
                <div class="lw-page-bg lw-lazy-img" data-src="<?= __yesset("imgs/home/random/*.jpg", false, [
                                                        'random' => true
                                                    ]) ?>"></div>
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
                        
                        <h1 class="lw-login-title"><?= __tr('Reset Your Password')  ?></h1>
                        <p class="lw-login-subtitle"><?= __tr('Enter your email and new password.')  ?><br><?= __tr('We will help you reset your password securely.')  ?></p>
                        
                        @if(session('errorStatus'))
                        <div class="alert alert-danger alert-dismissible lw-alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= session('message') ?>
                        </div>
                        @endif
                    </div>
                    
                    <!-- reset password form -->
                    <form class="lw-new-login-form user lw-ajax-form lw-form" method="post" action="<?= route('user.reset_password.process', ['reminderToken' => request()->get('reminderToken')]) ?>" data-show-processing="true" data-secured="true">
                        <!-- email input field -->
                        <div class="lw-form-group">
                            <div class="lw-input-container">
                                <input type="email" class="lw-form-input" name="email" placeholder="<?= __tr('Email Address') ?>" required>
                            </div>
                        </div>
                        <!-- / email input field -->

                        <!-- new password input field -->
                        <div class="lw-form-group">
                            <div class="lw-input-container">
                                <input type="password" class="lw-form-input" name="password" placeholder="<?= __tr('New Password') ?>" required minlength="6">
                            </div>
                        </div>
                        <!-- / new password input field -->

                        <!-- confirm password input field -->
                        <div class="lw-form-group">
                            <div class="lw-input-container">
                                <input type="password" class="lw-form-input" name="password_confirmation" placeholder="<?= __tr('Confirm New Password') ?>" required minlength="6">
                            </div>
                        </div>
                        <!-- / confirm password input field -->

                        @if(getStoreSettings('allow_recaptcha'))
                        <div class="lw-form-group text-center">
                            <div class="g-recaptcha d-inline-block" data-sitekey="{{ getStoreSettings('recaptcha_site_key') }}"></div>
                        </div>
                        @endif

                        <!-- Reset Password button -->
                        <button type="submit" class="lw-gradient-btn lw-ajax-form-submit-action"><?= __tr('Reset Password')  ?></button>
                        <!-- / Reset Password button -->
                    </form>
                    <!-- / reset password form -->
                    
                    <!-- Bottom Links -->
                    <div class="lw-bottom-links">
                        <div class="text-center">
                            <p class="lw-signup-text"><?= __tr('Remember your password?') ?></p>
                            <a class="lw-signup-btn" href="<?= route('user.login') ?>"><?= __tr('Back to Login')  ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@lwPush('appScripts')
<script>
    var recaptchaInstance = "<?= getStoreSettings('allow_recaptcha') ?>";
    //on reset password success callback
    function onResetPasswordCallback(response) {
        if(recaptchaInstance){
            grecaptcha.reset();
        }
    }
</script>
@lwPushEnd

<!-- include footer -->
@include('includes.footer')
<!-- /include footer -->
