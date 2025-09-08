
@section('page-title', __tr('Login'))
@section('head-title', __tr('Login'))
@section('keywordName', strip_tags(__tr('Login')))
@section('keyword', strip_tags(__tr('Login')))
@section('description', strip_tags(__tr('Login')))
@section('keywordDescription', strip_tags(__tr('Login')))
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
                        
                        <h1 class="lw-login-title"><?= __tr('Login')  ?></h1>
                        <p class="lw-login-subtitle"><?= __tr('Please enter your valid email address.')  ?><br><?= __tr('We will help you sign in to your account')  ?></p>
                        
                        @if(session('errorStatus'))
                        <div class="alert alert-danger alert-dismissible lw-alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= session('message') ?>
                        </div>
                        @endif
                    </div>
                    <!-- login form -->
                    <form class="lw-new-login-form user lw-ajax-form lw-form" data-callback="onLoginCallback" method="post" action="<?= route('user.login.process') ?>" data-show-processing="true" data-secured="true">
                        <!-- email input field -->
                         @csrf
                        <div class="lw-form-group">
                            <div class="lw-input-container">
                                <input type="text" class="lw-form-input" name="email_or_username" placeholder="<?= __tr('Username/Email') ?>@if(getStoreSettings('allow_user_login_with_mobile_number')){{ __tr(' or Mobile Number') }}@endif" required>
                            </div>
                        </div>
                        <!-- / email input field -->

                        <!-- password input field -->
                        <div class="lw-form-group">
                            <div class="lw-input-container">
                                <input type="password" class="lw-form-input" name="password" placeholder="<?= __tr('Password') ?>" required minlength="6">
                            </div>
                        </div>
                        <!-- / password input field -->

                        <!-- remember me input field -->
                        <div class="lw-form-group lw-remember-me-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberMeCheckbox" name="remember_me">
                                <label class="custom-control-label lw-remember-label" for="rememberMeCheckbox"><?= __tr('Remember Me')  ?></label>
                            </div>
                        </div>
                        <!-- / remember me input field -->
                        
                        @if(getStoreSettings('allow_recaptcha'))
                        <div class="lw-form-group text-center">
                            <div class="g-recaptcha d-inline-block" data-sitekey="{{ getStoreSettings('recaptcha_site_key') }}"></div>
                        </div>
                        @endif

                        <!-- login button -->
                        <button type="submit" value="Login" class="lw-gradient-btn lw-ajax-form-submit-action"><?= __tr('Submit')  ?></button>
                        <!-- / login button -->
                        @if(getStoreSettings('enable_otp_Login'))
                        <!-- Login With OTP button -->
                        <div class="lw-form-group text-center">
                            <a href="<?= route('login.with.otp') ?>" class="lw-otp-link"><?= __tr('Login with OTP')  ?></a>
                        </div>
                        @endif
                    </form>
                    <!-- / login form -->
                    
                    <!-- OR divider -->
                    @if(getStoreSettings('allow_google_login') || getStoreSettings('allow_facebook_login'))
                    <div class="lw-or-divider">
                        <div class="lw-divider-line"></div>
                        <div class="lw-or-circle">
                            <span class="lw-or-text"><?= __tr('OR') ?></span>
                        </div>
                    </div>
                    
                    <!-- Social login section -->
                    <div class="lw-social-login-section">
                        <h6 class="lw-social-title"><?= __tr('Login using') ?></h6>
                        <div class="lw-social-buttons">
                            @if(getStoreSettings('allow_facebook_login'))
                            <a href="<?= route('social.user.login', [getSocialProviderKey('facebook')]) ?>" class="lw-social-btn lw-facebook-btn">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if(getStoreSettings('allow_google_login'))
                            <a href="<?= route('social.user.login', [getSocialProviderKey('google')]) ?>" class="lw-social-btn lw-google-btn">
                                <i class="fab fa-google"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <!-- Forgot password and signup links -->
                    <div class="lw-bottom-links">
                        <div class="text-center mb-3">
                            <a class="lw-forgot-link" href="<?= route('user.forgot_password') ?>"><?= __tr('Forgot Password?')  ?></a>
                        </div>
                        <div class="text-center">
                            <p class="lw-signup-text"><?= __tr("Don't have an Account?") ?></p>
                            <a class="lw-signup-btn" href="<?= route('user.sign_up') ?>"><?= __tr('Create an Account!')  ?></a>
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
    function onLoginCallback(response) {
        //check reaction code is 1 and intended url is not empty
        if (response.reaction == 1 && !_.isEmpty(response.data.intendedUrl)) {
            //redirect to intendedUrl location
            _.defer(function() {
                window.location.href = response.data.intendedUrl;
            })
        }
        if(recaptchaInstance){
            grecaptcha.reset();
        }
    }
</script>
@lwPushEnd
<!-- include footer -->
@include('includes.footer')
<!-- /include footer -->