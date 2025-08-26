<?php $pageTitle = __tr('Create an Account'); ?>
@section('page-title', $pageTitle)
@section('head-title', $pageTitle)
@section('keywordName', strip_tags(__tr('Create an Account!')))
@section('keyword', strip_tags(__tr('Create an Account!')))
@section('description', strip_tags(__tr('Create an Account!')))
@section('keywordDescription', strip_tags(__tr('Create an Account!')))
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
                <div class="lw-register-form-wrapper">
                    <div class="lw-login-header">
                        <!-- Logo for mobile -->
                        <div class="d-lg-none text-center mb-4">
                            <a href="<?= url(''); ?>">
                                <img class="lw-mobile-logo" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
                            </a>
                        </div>
                        
                        <h1 class="lw-login-title"><?= __tr('Sign Up')  ?></h1>
                        <p class="lw-login-subtitle"><?= __tr('Create your account to get started.')  ?><br><?= __tr('Join our community today!')  ?></p>
                    </div>
                    <!-- register form -->
                    <form class="lw-new-register-form user lw-ajax-form lw-form" method="post" action="<?= route('user.sign_up.process') ?>" data-show-processing="true" data-secured="true" data-unsecured-fields="first_name,last_name">
                        
                        <!-- Name Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="lw-form-group">
                                    <div class="lw-input-container">
                                        <input type="text" class="lw-form-input" name="first_name" placeholder="<?= __tr('First Name') ?>" required minlength="3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="lw-form-group">
                                    <div class="lw-input-container">
                                        <input type="text" class="lw-form-input" name="last_name" placeholder="<?= __tr('Last Name') ?>" required minlength="3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Username -->
                        <div class="lw-form-group">
                            <div class="lw-input-container lw-input-with-icon">
                                <span class="lw-input-icon">@</span>
                                <input type="text" class="lw-form-input lw-form-input-with-icon" name="username" placeholder="<?= __tr('Username') ?>" required minlength="5">
                            </div>
                        </div>
                        
                        <!-- Mobile Number -->
                        <div class="lw-form-group">
                            <div class="lw-mobile-input-group">
                                <select name="country_code" class="lw-country-select" required>
                                    <option value=""><?= __tr('Code') ?></option>
                                    @foreach(getCountryPhoneCodes() as $getCountryCode)
                                    <option value="<?= $getCountryCode['phone_code'] ?>">0{{ $getCountryCode['phone_code'] }}</option>
                                    @endforeach
                                </select>
                                <input type="number" class="lw-form-input lw-mobile-input" placeholder="<?= __tr('Mobile Number') ?>" name="mobile_number" minlength="8" maxlength="15" required>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="lw-form-group">
                            <div class="lw-input-container lw-input-with-icon">
                                <span class="lw-input-icon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="lw-form-input lw-form-input-with-icon" name="email" placeholder="<?= __tr('Email Address') ?>" required>
                            </div>
                        </div>
                        
                        <!-- Gender and DOB Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="lw-form-group">
                                    <select name="gender" class="lw-form-select" required>
                                        <option value=""><?= __tr('Select Gender') ?></option>
                                        @foreach($genders as $genderKey => $gender)
                                        <option value="<?= $genderKey ?>"><?= $gender ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="lw-form-group">
                                    <input type="date" class="lw-form-input lw-date-input" name="dob" 
                                           min="{{ getAgeDate(configItem('age_restriction.maximum'), 'max')->format('Y-m-d') }}"
                                           max="{{ getAgeDate(configItem('age_restriction.minimum'))->format('Y-m-d') }}"
                                           required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Password Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="lw-form-group">
                                    <div class="lw-input-container">
                                        <input type="password" class="lw-form-input" name="password" placeholder="<?= __tr('Password') ?>" required minlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="lw-form-group">
                                    <div class="lw-input-container">
                                        <input type="password" class="lw-form-input" name="repeat_password" placeholder="<?= __tr('Confirm Password') ?>" required minlength="6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Terms and Conditions -->
                        <div class="lw-form-group lw-terms-group">
                            <div class="custom-control custom-checkbox">
                                <input type="hidden" name="accepted_terms">
                                <input type="checkbox" class="custom-control-input" id="acceptTerms" name="accepted_terms" value="1" required>
                                <label class="custom-control-label lw-terms-label" for="acceptTerms">
                                    <?= __tr('I accept all ') ?>
                                    <a target="_blank" href="<?= getStoreSettings('terms_and_conditions_url') ?>"><?= __tr('terms and conditions') ?></a> 
                                    @if(getStoreSettings('privacy_policy_url')){{ __tr('and') }} <a target="_blank" href="<?= getStoreSettings('privacy_policy_url') ?>"><?= __tr('privacy policy') ?></a>@endif
                                </label>
                            </div>
                        </div>
                        
                        @if(getStoreSettings('allow_recaptcha'))
                        <div class="lw-form-group text-center">
                            <div class="g-recaptcha d-inline-block" data-sitekey="{{ getStoreSettings('recaptcha_site_key') }}"></div>
                        </div>
                        @endif

                        <!-- Register Button -->
                        <button type="submit" class="lw-gradient-btn lw-ajax-form-submit-action"><?= __tr('Create Account')  ?></button>
                        
                    </form>
                    <!-- / register form -->
                    
                    <!-- Bottom Links -->
                    <div class="lw-bottom-links">
                        <div class="text-center">
                            <p class="lw-signup-text"><?= __tr('Already have an account?') ?></p>
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
<!-- include footer -->
@include('includes.footer')
<!-- /include footer -->

</html>