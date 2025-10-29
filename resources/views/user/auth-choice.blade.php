@section('page-title', __tr('Welcome'))
@section('head-title', __tr('Welcome'))
@section('keywordName', strip_tags(__tr('Welcome')))
@section('keyword', strip_tags(__tr('Welcome')))
@section('description', strip_tags(__tr('Welcome')))
@section('keywordDescription', strip_tags(__tr('Welcome')))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- include header -->
@include('includes.header')
<!-- /include header -->

<body class="lw-auth-choice-page">
    <div class="min-h-screen flex">
        <!-- Left side - Desktop only (Purple gradient background) -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden" style="background: linear-gradient(135deg, #F4A7B9, #A88BEB, #5B3E96);">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center px-8">
                    <img class="mx-auto mb-8" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>" style="max-width: 300px; filter: brightness(0) invert(1);">
                    <h1 class="text-4xl font-bold text-white mb-4" style="font-family: var(--lw-font-family);">
                        <?= __tr('Welcome to') ?> <?= getStoreSettings('name') ?>
                    </h1>
                    <p class="text-xl text-white opacity-90" style="font-family: var(--lw-font-family);">
                        <?= __tr('Find your perfect match') ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Right side (Mobile: Full width, Desktop: Half width) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-white">
            <div class="w-full max-w-md">
                <!-- Logo for mobile -->
                <div class="lg:hidden text-center mb-12">
                    <img class="mx-auto" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>" style="max-width: 250px;">
                </div>

                <!-- Auth buttons container -->
                <div class="space-y-4">
                    <!-- Login Button -->
                    <a href="<?= route('user.login') ?>" class="lw-auth-btn lw-auth-btn-primary">
                        <?= __tr('Log in') ?>
                    </a>

                    <!-- Register Button -->
                    <a href="<?= route('user.sign_up') ?>" class="lw-auth-btn lw-auth-btn-secondary">
                        <?= __tr('Register') ?>
                    </a>

                    <!-- Forgot Password Button -->
                    <a href="<?= route('user.forgot_password') ?>" class="lw-auth-btn lw-auth-btn-secondary">
                        <?= __tr('Forgot password?') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
/* Auth Choice Page Styling */
.lw-auth-choice-page {
    font-family: var(--lw-font-family);
    background: white;
    margin: 0;
    padding: 0;
}

/* Auth Button Base Style */
.lw-auth-btn {
    display: block;
    width: 100%;
    padding: 1rem 2rem;
    text-align: center;
    font-size: 1.125rem;
    font-weight: 600;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
    font-family: var(--lw-font-family);
}

/* Primary Button (Log in) - Purple filled */
.lw-auth-btn-primary {
    background: #5B3E96;
    color: white;
    border: 2px solid #5B3E96;
}

.lw-auth-btn-primary:hover {
    background: #4a2f7a;
    border-color: #4a2f7a;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(91, 62, 150, 0.3);
    text-decoration: none;
}

/* Secondary Button (Register & Forgot Password) - Rose pink border */
.lw-auth-btn-secondary {
    background: transparent;
    color: #222222;
    border: 2px solid #ec9cae;
}

.lw-auth-btn-secondary:hover {
    background: #5B3E96;
    border-color: #ec9cae;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(236, 156, 174, 0.3);
    text-decoration: none;
}

/* Mobile specific adjustments */
@media (max-width: 1023px) {
    .lw-auth-btn {
        padding: 1.25rem 2rem;
        font-size: 1.25rem;
    }
}

/* Ensure no margin/padding issues */
.lw-auth-choice-page #wrapper,
.lw-auth-choice-page .container,
.lw-auth-choice-page .container-fluid {
    padding: 0 !important;
    margin: 0 !important;
}
</style>

@lwPush('appScripts')
<script>
    // Optional: Add any JavaScript interactions here
</script>
@lwPush('appScripts')

