@section('page-title', __tr('Forgot Your Password?'))
@section('head-title', __tr('Forgot Your Password?'))
@section('keywordName', strip_tags(__tr('Forgot Your Password?')))
@section('keyword', strip_tags(__tr('Forgot Your Password?')))
@section('description', strip_tags(__tr('Forgot Your Password?')))
@section('keywordDescription', strip_tags(__tr('Forgot Your Password?')))
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
                        
                        <h1 class="lw-login-title"><?= __tr('Forgot Password?')  ?></h1>
                        <p class="lw-login-subtitle"><?= __tr('No worries! Enter your email address below.')  ?><br><?= __tr('We will send you a reset link.')  ?></p>
                    </div>
                    <!-- forgot password form -->
                    <form class="lw-new-login-form user lw-ajax-form lw-form" method="post" action="<?= route('user.forgot_password.process') ?>" data-callback="onSuccessCallback">
                        <!-- email input field -->
                        <div class="lw-form-group">
                            <div class="lw-input-container">
                                <input type="email" class="lw-form-input" name="email" placeholder="<?= __tr('Enter Your Email Address') ?>" required>
                            </div>
                        </div>
                        <!-- / email input field -->
                        
                        @if(getStoreSettings('allow_recaptcha'))
                        <div class="lw-form-group text-center">
                            <div class="g-recaptcha d-inline-block" data-sitekey="{{ getStoreSettings('recaptcha_site_key') }}"></div>
                        </div>
                        @endif

                        <!-- Reset Password button -->
                        <button type="submit" class="lw-gradient-btn lw-ajax-form-submit-action"><?= __tr('Send Reset Link')  ?></button>
                        <!-- / Reset Password button -->
                    </form>
                    <!-- / forgot password form -->
                    
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
    //on login success callback
    function onSuccessCallback(response) {
        if(recaptchaInstance){
            grecaptcha.reset();
        }
    }
</script>
@lwPushEnd
@include('includes.footer')