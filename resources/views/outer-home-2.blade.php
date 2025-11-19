<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="<?= config('CURRENT_LOCALE_DIRECTION') ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Primary Meta Tags -->
    <title>{{ getStoreSettings('name') }}</title>
    <meta name="title" content="{{ getStoreSettings('name') }}">
    <meta name="description" content="{{ getStoreSettings('name') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ getStoreSettings('name') }}">
    <meta property="og:description" content="{{ getStoreSettings('name') }}">
    <meta property="og:image" content="{{ getStoreSettings('logo_image_url') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="{{ getStoreSettings('name') }}">
    <meta property="twitter:description" content="{{ getStoreSettings('name') }}">
    <meta property="twitter:image" content="{{ getStoreSettings('logo_image_url') }}">

    <?= __yesset(['dist/css/bootstrap-assets-app*.css', 'dist/css/public-assets-app*.css', 'dist/fa/css/all.min.css', 'dist/css/app-theme*.css', 'dist/css/main-design-system.css'], true) ?>

    <!-- Google fonts - Lexend for Design System -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- /Google fonts -->

    <link rel="shortcut icon" href="<?= getStoreSettings('favicon_image_url') ?>" type="image/x-icon">
    <link rel="icon" href="<?= getStoreSettings('favicon_image_url') ?>" type="image/x-icon">

    <style>
    .masthead {
        background: var(--lw-gradient-main);
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        /* Dark overlay for text readability */
        box-shadow: inset 0px 0px 280px 300px rgba(0, 0, 0, 0.7);
    }
    
    .masthead::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                    radial-gradient(circle at 70% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        pointer-events: none;
        z-index: 1;
    }
    
    .masthead .lw-main-text-block {
        position: relative;
        z-index: 2;
    }
    
    /* Navbar Design System Updates */
    #mainNav {
        background: rgba(28, 28, 28, 0.8) !important;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        font-family: var(--lw-font-family) !important;
        transition: all var(--lw-transition);
    }
    
    #mainNav.navbar-shrink {
        background: var(--lw-gradient-main) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    
    /* Navbar Brand */
    #mainNav .navbar-brand {
        color: var(--lw-white) !important;
        font-weight: 700;
        transition: var(--lw-transition);
    }
    
    #mainNav .navbar-brand:hover {
        transform: scale(1.05);
    }
    
    /* Navigation Links */
    #mainNav .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 500;
        font-size: var(--lw-font-size-base);
        padding: 12px 20px !important;
        border-radius: var(--lw-radius-full);
        transition: var(--lw-transition);
        margin: 0 4px;
    }
    
    #mainNav .navbar-nav .nav-link:hover {
        color: var(--lw-white) !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
        transform: translateY(-2px);
    }
    
    #mainNav .navbar-nav .nav-link:focus,
    #mainNav .navbar-nav .nav-link:active {
        color: var(--lw-white) !important;
        background-color: rgba(255, 255, 255, 0.15) !important;
    }
    
    /* Login Button - Enhanced specificity for text visibility */
    #mainNav .lw-login-btn,
    #mainNav .lw-login-btn:link,
    #mainNav .lw-login-btn:visited {
        background: white !important;
        color: #222222 !important;
        border: 2px solid #ec9cae !important;
        border-radius: var(--lw-radius-full) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600 !important;
        font-size: var(--lw-font-size-base) !important;
        padding: 10px 20px !important;
        transition: var(--lw-transition);
        margin-left: 8px;
        text-decoration: none !important;
    }

    #mainNav .lw-login-btn:hover,
    #mainNav .lw-login-btn:focus {
        background: #5B3E96 !important;
        color: #ffffff !important;
        border-color: #5B3E96 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(91, 62, 150, 0.3);
        text-decoration: none !important;
    }
    
    /* Mobile Toggle Button */
    #mainNav .navbar-toggler {
        border: 2px solid rgba(255, 255, 255, 0.3) !important;
        border-radius: var(--lw-radius-md) !important;
        color: var(--lw-white) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 500;
        padding: 8px 12px !important;
        transition: var(--lw-transition);
    }
    
    #mainNav .navbar-toggler:hover {
        border-color: var(--lw-white) !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
    }
    
    #mainNav .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2) !important;
    }
    
    /* Dropdown Menu */
    #mainNav .dropdown-menu {
        background: rgba(18, 17, 23, 0.95) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: var(--lw-radius-lg) !important;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3) !important;
        margin-top: 8px;
    }
    
    #mainNav .dropdown-header {
        color: var(--lw-secondary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        font-size: var(--lw-font-size-sm);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    #mainNav .dropdown-divider {
        border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
    
    #mainNav .dropdown-item {
        color: rgba(255, 255, 255, 0.8) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 400;
        transition: var(--lw-transition);
        border-radius: var(--lw-radius-sm);
        margin: 2px 8px;
    }
    
    #mainNav .dropdown-item:hover {
        background-color: var(--lw-gradient-start) !important;
        color: var(--lw-white) !important;
        transform: translateX(4px);
    }
    
    /* Mobile Responsive */
    @media (max-width: 992px) {
        #mainNav .navbar-nav {
            background: rgba(0, 0, 0, 0.2);
            border-radius: var(--lw-radius-lg);
            padding: 16px;
            margin-top: 16px;
        }
        
        #mainNav .navbar-nav .nav-link {
            margin: 4px 0;
            text-align: left !important;
        }
        
        #mainNav .lw-login-btn {
            margin: 12px 0 0 0 !important;
            text-align: center !important;
        }
    }
    
    /* =================
       PAGE DESIGN SYSTEM UPDATES
       ================= */
    
    /* Global Typography */
    body {
        font-family: var(--lw-font-family) !important;
    }
    
    /* Masthead text styling is now handled above */
    
    /* Get Started Button */
    .lw-special-btn {
        background: transparent !important;
        color: #222222 !important;
        border: 2px solid #ec9cae !important;
        border-radius: var(--lw-radius-full) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        font-size: var(--lw-font-size-lg) !important;
        padding: 16px 32px !important;
        text-transform: none !important;
        letter-spacing: 0.5px;
        transition: var(--lw-transition);
        box-shadow: 0 8px 25px rgba(236, 156, 174, 0.3);
    }

    .lw-special-btn:hover {
        background: #5B3E96 !important;
        color: #ffffff !important;
        border-color: #5B3E96 !important;
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(91, 62, 150, 0.3);
        text-decoration: none;
    }
    
    /* All Headings */
    h1, h2, h3, h4, h5, h6 {
        font-family: var(--lw-font-family) !important;
    }
    
    .text-primary {
        color: var(--lw-primary) !important;
    }
    
    .text-dark {
        color: var(--lw-gray-800) !important;
    }
    
    .text-white {
        color: var(--lw-white) !important;
    }
    
    /* Design System Headings */
    .lw-sub-title-katibeh {
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        font-size: var(--lw-font-size-3xl);
        color: var(--lw-primary);
        margin-bottom: var(--lw-space-lg);
    }
    
    /* Search Section */
    .lw-find-match-block {
        background: var(--lw-gradient-main);
        padding: var(--lw-space-3xl) 0;
    }
    
    .lw-find-match-block h3 {
        color: var(--lw-white) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
    }
    
    .lw-find-match-block p {
        color: rgba(255, 255, 255, 0.9) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 400;
    }
    
    /* Search Form Elements */
    .lw-search-container label {
        color: var(--lw-white) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 500;
        margin-bottom: var(--lw-space-sm);
    }
    
    .lw-search-container .form-control,
    .lw-search-container .custom-select {
        background: var(--lw-white) !important;
        border: 2px solid transparent !important;
        border-radius: var(--lw-radius-lg) !important;
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 500;
        padding: 12px 16px;
        transition: var(--lw-transition);
    }
    
    .lw-search-container .form-control:focus,
    .lw-search-container .custom-select:focus {
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2) !important;
    }
    
    /* Search Button */
    .lw-search-btn {
        background: transparent !important;
        color: #222222 !important;
        border: 2px solid #ec9cae !important;
        border-radius: var(--lw-radius-full) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        font-size: var(--lw-font-size-base);
        padding: 12px 24px !important;
        transition: var(--lw-transition);
        height: auto !important;
        text-transform: none !important;
    }

    .lw-search-btn:hover {
        background: #5B3E96 !important;
        color: #ffffff !important;
        border-color: #5B3E96 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(91, 62, 150, 0.3);
    }
    
    /* Feature Button */
    .lw-feature-btn {
        background: transparent !important;
        color: #222222 !important;
        border: 2px solid #ec9cae !important;
        border-radius: var(--lw-radius-full) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        font-size: var(--lw-font-size-base);
        padding: 12px 24px !important;
        transition: var(--lw-transition);
        text-transform: none !important;
        text-decoration: none;
    }

    .lw-feature-btn:hover {
        background: #5B3E96 !important;
        color: #ffffff !important;
        border-color: #5B3E96 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(91, 62, 150, 0.3);
        text-decoration: none;
    }
    
    /* Card Components */
    .card {
        background: var(--lw-white) !important;
        border: none !important;
        border-radius: var(--lw-radius-xl) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
        transition: var(--lw-transition);
        padding: var(--lw-space-lg);
        margin-bottom: var(--lw-space-lg);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
    }
    
    .card h3,
    .card h5 {
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        margin-bottom: var(--lw-space-sm);
    }
    
    .card p {
        color: var(--lw-gray-600) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 400;
        line-height: 1.6;
    }
    
    .card-icon {
        color: var(--lw-gradient-start) !important;
        font-size: var(--lw-font-size-4xl);
        margin-bottom: var(--lw-space-md);
    }
    
    .card-icon i {
        color: var(--lw-gradient-start) !important;
    }
    
    /* Underline in cards */
    .underline {
        width: 60px;
        height: 3px;
        background: var(--lw-gradient-main);
        border-radius: var(--lw-radius-sm);
        margin: var(--lw-space-sm) 0;
    }
    
    /* How It Works Section */
    .lw-hows-it-works-container h4 {
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
    }
    
    .lw-hows-it-works-container .card span {
        display: block;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--lw-gradient-main);
        color: var(--lw-white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--lw-font-size-xl);
        margin: 0 auto var(--lw-space-md);
    }
    
    .lw-hows-it-works-container .card span.bg-green {
        background: linear-gradient(135deg, #10b981, #059669);
    }
    
    .lw-hows-it-works-container .card span.bg-blue {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    }
    
    .lw-hows-it-works-container .card span.bg-violet {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }
    
    /* Sections */
    .lw-section-block {
        background: var(--lw-gray-900) !important;
        padding: var(--lw-space-3xl) 0;
    }
    
    .lw-about-section {
        padding: var(--lw-space-3xl) 0;
    }
    
    .lw-about-section h4 {
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
    }
    
    .lw-about-section p {
        color: var(--lw-gray-600) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 400;
        line-height: 1.7;
        font-size: var(--lw-font-size-base);
    }
    
    /* Features Section */
    .lw-features-block-section {
        background: var(--lw-light-gray) !important;
        padding: var(--lw-space-3xl) 0;
    }
    
    .lw-headings h4 {
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
    }
    
    .lw-headings h3 {
        color: var(--lw-gray-800) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
    }
    
    /* Key Features Section */
    .lw-main-features-block {
        background: var(--lw-light-gray) !important;
        padding: var(--lw-space-3xl) 0;
    }
    
    .lw-main-features-block h1 {
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        font-size: var(--lw-font-size-3xl);
    }
    
    .lw-main-features-block p {
        color: var(--lw-gray-600) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 400;
        line-height: 1.6;
    }
    
    /* Feature Container */
    .lw-feature-container {
        padding: var(--lw-space-3xl) 0;
    }
    
    .lw-feature-container h3 {
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
    }
    
    /* Testimonial Section */
    .lw-testimonial-bg-image {
        background: var(--lw-gradient-main);
        padding: var(--lw-space-3xl) 0;
    }
    
    .testimonial-content {
        color: var(--lw-white) !important;
        font-family: var(--lw-font-family) !important;
    }
    
    .testimonial-content blockquote {
        font-size: var(--lw-font-size-lg);
        font-weight: 400;
        line-height: 1.6;
        margin-bottom: var(--lw-space-lg);
    }
    
    .author-name {
        font-family: var(--lw-font-family) !important;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9) !important;
    }
    
    /* Testimonial Buttons */
    .lw-testimonial-button {
        background: rgba(255, 255, 255, 0.2) !important;
        border: 2px solid rgba(255, 255, 255, 0.3) !important;
        border-radius: var(--lw-radius-full) !important;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--lw-transition);
    }
    
    .lw-testimonial-button:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
        transform: scale(1.1);
    }
    
    /* Call to Action Buttons */
    .btn {
        font-family: var(--lw-font-family) !important;
        border-radius: var(--lw-radius-full) !important;
        transition: var(--lw-transition);
        text-transform: none !important;
    }
    
    .btn-primary {
        background: var(--lw-gradient-main) !important;
        border: none !important;
        color: var(--lw-white) !important;
        font-weight: 600;
    }
    
    .btn-primary:hover {
        background: var(--lw-primary-dark) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(51, 25, 107, 0.3);
        color: var(--lw-white) !important;
    }
    
    /* FAQ Section */
    .faq-section {
        background: var(--lw-light-gray) !important;
        padding: var(--lw-space-3xl) 0;
    }
    
    .faq-question {
        background: var(--lw-white) !important;
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        padding: var(--lw-space-md) var(--lw-space-lg);
        border-radius: var(--lw-radius-lg) !important;
        margin-bottom: var(--lw-space-sm);
        cursor: pointer;
        transition: var(--lw-transition);
        border: 2px solid transparent;
    }
    
    .faq-question:hover {
        border-color: var(--lw-gradient-start);
        background: rgba(197, 62, 141, 0.05) !important;
    }
    
    .faq-question.active {
        background: var(--lw-gradient-main) !important;
        color: var(--lw-white) !important;
    }
    
    .faq-answer {
        background: var(--lw-white) !important;
        padding: 0 var(--lw-space-lg);
        border-radius: 0 0 var(--lw-radius-lg) var(--lw-radius-lg);
        margin-bottom: var(--lw-space-md);
    }
    
    .faq-answer p {
        color: var(--lw-gray-600) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 400;
        line-height: 1.6;
        padding: var(--lw-space-md) 0;
    }
    
    /* FOOTER COMPLETE OVERRIDE - Maximum Specificity */
    body footer,
    footer.py-5,
    section footer,
    .footer,
    footer {
        background: #33196b !important;
        background-image: none !important;
        background-color: #33196b !important;
        color: #ffffff !important;
        padding: 80px 0 40px !important;
        position: relative !important;
        border: none !important;
        margin: 0 !important;
    }
    
    /* Remove all pseudo elements that create lines */
    footer::before,
    footer::after,
    footer *::before,
    footer *::after {
        content: none !important;
        display: none !important;
        background: none !important;
        border: none !important;
    }
    
    /* Footer headings */
    footer h5,
    footer .h5 {
        color: #ffffff !important;
        font-family: 'Lexend', sans-serif !important;
        font-weight: 600 !important;
        font-size: 18px !important;
        margin-bottom: 24px !important;
        position: relative !important;
        border: none !important;
        background: none !important;
    }
    
    /* ONLY heading underlines (these are intentional) */
    footer h5::after {
        content: '' !important;
        position: absolute !important;
        bottom: -8px !important;
        left: 0 !important;
        width: 40px !important;
        height: 3px !important;
        background: linear-gradient(135deg, #c53e8d, #8b5cf6) !important;
        border-radius: 2px !important;
        display: block !important;
    }
    
    /* Footer text */
    footer p {
        color: rgba(255, 255, 255, 0.8) !important;
        font-family: 'Lexend', sans-serif !important;
        font-weight: 400 !important;
        line-height: 1.7 !important;
        font-size: 16px !important;
        margin-bottom: 16px !important;
        background: none !important;
        border: none !important;
    }
    
    /* Footer links */
    footer a {
        color: rgba(255, 255, 255, 0.8) !important;
        font-family: 'Lexend', sans-serif !important;
        font-weight: 400 !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
        background: none !important;
        border: none !important;
    }
    
    footer a:hover {
        color: #c53e8d !important;
        text-decoration: none !important;
        transform: translateX(4px) !important;
        background: none !important;
    }
    
    /* Footer list items */
    footer li {
        margin-bottom: 8px !important;
        list-style: none !important;
        position: relative !important;
        padding-left: 20px !important;
        background: none !important;
        border: none !important;
    }
    
    footer li::before {
        content: '▶' !important;
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        color: #c53e8d !important;
        font-size: 12px !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        background: none !important;
    }
    
    /* Call to Action Section */
    .lw-block-content {
        background: var(--lw-white) !important;
        border-radius: var(--lw-radius-xl) !important;
        padding: var(--lw-space-xl);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    
    .lw-block-content h4 {
        color: var(--lw-primary) !important;
        font-family: var(--lw-font-family) !important;
        font-weight: 600;
        margin-bottom: var(--lw-space-md);
    }
    
    /* Mobile App Section */
    .lw-align-center {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }
    
    /* Images */
    .lw-logo-img {
        transition: var(--lw-transition);
    }
    
    .lw-logo-img:hover {
        transform: scale(1.05);
    }
    
    .lw-couple-img {
        border-radius: var(--lw-radius-lg);
        transition: var(--lw-transition);
    }
    
    .lw-couple-img:hover {
        transform: scale(1.02);
    }
    
    .lw-image {
        border-radius: var(--lw-radius-lg);
        transition: var(--lw-transition);
    }
    
    .lw-image:hover {
        transform: scale(1.02);
    }
    
    /* Google Play Badge */
    .w-25 {
        transition: var(--lw-transition);
        border-radius: var(--lw-radius-md);
    }
    
    .w-25:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .lw-special-btn {
            font-size: var(--lw-font-size-base) !important;
            padding: 12px 24px !important;
        }
        
        .lw-search-btn {
            margin-top: var(--lw-space-md) !important;
        }
        
        .lw-headings {
            text-align: center;
            margin-bottom: var(--lw-space-xl);
        }
        
        .card {
            margin-bottom: var(--lw-space-xl);
        }
        
        .lw-hows-it-works-container .card {
            text-align: center;
        }
    }
    
    /* Additional Text Styling */
    .lw-description {
        font-family: var(--lw-font-family) !important;
        font-weight: 400;
        font-size: var(--lw-font-size-base);
        color: var(--lw-gray-600) !important;
        line-height: 1.6;
    }
    
    /* Lists */
    .lw-side-block-list li {
        padding: var(--lw-space-sm) 0;
    }
    
    .lw-side-block-list a {
        font-family: var(--lw-font-family) !important;
        font-weight: 400;
        transition: var(--lw-transition);
    }
    
    /* HR Elements */
    hr {
        border-color: rgba(255, 255, 255, 0.2) !important;
        background-color: rgba(255, 255, 255, 0.2) !important;
    }
    
    /* Small Text */
    .small {
        font-family: var(--lw-font-family) !important;
        color: rgba(255, 255, 255, 0.7) !important;
    }
    
    /* Divider styling */
    .lw-div-reverse {
        flex-direction: row-reverse;
    }
    
    @media (max-width: 768px) {
        .lw-div-reverse {
            flex-direction: column !important;
        }
    }
    
    /* Featured Text */
    .lw-featured-text-block {
        color: var(--lw-white) !important;
    }
    
    .lw-main-text-block {
        text-align: center;
    }
    
    /* Messenger Video */
    .lw-messenger-video {
        border-radius: var(--lw-radius-xl);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }
    
    /* Feature Icon */
    .lw-feature-icon-img {
        transition: var(--lw-transition);
    }
    
    .lw-feature-icon-img:hover {
        transform: scale(1.05);
    }
    
    /* Center Block */
    .lw-center-block {
        text-align: center;
    }
    
    /* Footer Underline - Updated Design */
    .lw-underline {
        background: var(--lw-gradient-main) !important;
        height: 3px !important;
        width: 60px !important;
        margin: var(--lw-space-md) auto !important;
        border-radius: var(--lw-radius-sm) !important;
    }
    
    /* Copyright Section */
    footer .small {
        font-family: var(--lw-font-family) !important;
        color: rgba(255, 255, 255, 0.6) !important;
        font-size: var(--lw-font-size-sm) !important;
        margin-top: var(--lw-space-xl) !important;
        text-align: center !important;
    }
    
    /* SOCIAL MEDIA ICONS - PERFECT SIZING AND POSITIONING */
    footer li a span i.fab,
    footer li a span i.fa-facebook,
    footer li a span i.fa-instagram,
    footer li a span i.fa-linkedin-in,
    footer li a span i.fa-twitter {
        color: transparent !important;
        font-size: 0 !important;
        margin-right: 12px !important;
        display: inline-block !important;
        width: 24px !important;
        height: 24px !important;
        position: relative !important;
        vertical-align: middle !important;
    }
    
    /* Remove any existing circles or backgrounds */
    footer li a span {
        background: none !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    
    /* PERFECTLY SIZED SOCIAL ICONS */
    footer li a span i.fa-facebook::before {
        content: "f" !important;
        font-family: Arial, sans-serif !important;
        background: #1877f2 !important;
        color: white !important;
        border-radius: 50% !important;
        width: 24px !important;
        height: 24px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: bold !important;
        font-size: 14px !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        line-height: 1 !important;
    }
    
    footer li a span i.fa-instagram::before {
        content: "📷" !important;
        font-family: system-ui, sans-serif !important;
        background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888) !important;
        color: white !important;
        border-radius: 25% !important;
        width: 24px !important;
        height: 24px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 12px !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        line-height: 1 !important;
    }
    
    footer li a span i.fa-linkedin-in::before {
        content: "in" !important;
        font-family: Arial, sans-serif !important;
        background: #0077b5 !important;
        color: white !important;
        border-radius: 15% !important;
        width: 24px !important;
        height: 24px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: bold !important;
        font-size: 10px !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        line-height: 1 !important;
    }
    
    footer li a span i.fa-twitter::before {
        content: "🐦" !important;
        font-family: system-ui, sans-serif !important;
        background: #1da1f2 !important;
        color: white !important;
        border-radius: 50% !important;
        width: 24px !important;
        height: 24px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 12px !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        line-height: 1 !important;
    }
    
    /* Hover effects for social icons */
    footer li:hover a span i.fa-facebook::before,
    footer li:hover a span i.fa-instagram::before,
    footer li:hover a span i.fa-linkedin-in::before,
    footer li:hover a span i.fa-twitter::before {
        transform: scale(1.1) !important;
        transition: transform 0.3s ease !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
    }
    
    /* Footer Divider Line */
    footer hr {
        border: none !important;
        height: 1px !important;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent) !important;
        margin: var(--lw-space-2xl) 0 var(--lw-space-lg) 0 !important;
    }
    
    /* FORCE CLEAR CACHE - Add at very end of CSS */
    footer, footer * {
        background-image: none !important;
        background-color: transparent !important;
        border-top: none !important;
        border-bottom: none !important;
        box-shadow: none !important;
    }
    
    footer {
        background-color: #33196b !important;
    }
    
    /* Remove any inherited styles */
    footer .container,
    footer .row,
    footer .col-sm-12,
    footer .col-md-12,
    footer .col-lg-3 {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
    }
    
    /* Force override any Bootstrap or other framework styles */
    .py-5 footer,
    footer.py-5 {
        background: #33196b !important;
        background-image: none !important;
    }
    
    /* =================
       SENIOR UI DEVELOPER COMPLETE REDESIGN
       ================= */
    
    /* Global Enhancements */
    body {
        background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%) !important;
        overflow-x: hidden;
    }
    
    /* Enhanced Masthead/Hero Section - Ensure text visibility */
    .masthead h1 {
        color: var(--lw-white) !important;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8) !important;
        font-weight: 700 !important;
        font-family: var(--lw-font-family) !important;
    }
    
    .masthead h2 {
        color: rgba(255, 255, 255, 0.95) !important;
        text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.7) !important;
        font-weight: 500 !important;
        font-family: var(--lw-font-family) !important;
    }
    
    .masthead h1 {
        font-size: clamp(2.5rem, 5vw, 4rem) !important;
        line-height: 1.2;
        margin-bottom: var(--lw-space-lg) !important;
    }
    
    .masthead h2 {
        font-size: var(--lw-font-size-xl) !important;
        line-height: 1.6;
        margin-bottom: var(--lw-space-2xl) !important;
    }
    
    /* Enhanced Get Started Button */
    .lw-special-btn {
        background: transparent !important;
        color: #222222 !important;
        border: 2px solid #ec9cae !important;
        border-radius: var(--lw-radius-full) !important;
        font-weight: 700 !important;
        font-size: var(--lw-font-size-lg) !important;
        padding: 18px 40px !important;
        letter-spacing: 0.5px;
        text-transform: none !important;
        box-shadow: 0 15px 35px rgba(236, 156, 174, 0.3), 0 5px 15px rgba(236, 156, 174, 0.2) !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        position: relative;
        overflow: hidden;
    }

    .lw-special-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(91, 62, 150, 0.2), transparent);
        transition: left 0.6s;
    }

    .lw-special-btn:hover {
        background: #5B3E96 !important;
        border-color: #5B3E96 !important;
        transform: translateY(-5px) !important;
        box-shadow: 0 25px 50px rgba(91, 62, 150, 0.3), 0 10px 25px rgba(91, 62, 150, 0.2) !important;
        color: #ffffff !important;
    }

    .lw-special-btn:hover::before {
        left: 100%;
    }
    
    /* Modern Section Designs */
    .lw-section-block {
        background: linear-gradient(135deg, #1a1a2e 0%, #2d2d3a 100%) !important;
        position: relative;
        overflow: hidden;
    }
    
    .lw-section-block::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.1"/></svg>') repeat;
        background-size: 50px 50px;
        pointer-events: none;
    }
    
    /* Enhanced About Section */
    .lw-about-section {
        padding: 120px 0 !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
        position: relative;
    }
    
    .lw-about-section::before {
        content: '';
        position: absolute;
        top: -50px;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(135deg, var(--lw-gradient-start) 0%, var(--lw-gradient-end) 100%);
        clip-path: polygon(0 50px, 100% 0, 100% 50px, 0 100%);
    }
    
    .lw-about-section .couple-image {
        border-radius: var(--lw-radius-xl);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        transition: var(--lw-transition);
    }
    
    .lw-about-section .couple-image:hover {
        transform: scale(1.02) rotate(1deg);
    }
    
    /* Modern Find Match Section */
    .lw-find-match-block {
        background: linear-gradient(135deg, var(--lw-gradient-start) 0%, var(--lw-gradient-end) 100%) !important;
        position: relative;
        padding: 120px 0 !important;
        overflow: hidden;
    }
    
    .lw-find-match-block::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 70% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .lw-search-container {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: var(--lw-radius-xl) !important;
        padding: var(--lw-space-2xl) !important;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin-top: var(--lw-space-2xl);
    }
    
    .lw-search-container label {
        color: var(--lw-primary) !important;
        font-weight: 600 !important;
        font-size: var(--lw-font-size-sm) !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: var(--lw-space-md) !important;
    }
    
    .lw-search-container .form-control,
    .lw-search-container .custom-select {
        height: 60px !important;
        border: 2px solid rgba(197, 62, 141, 0.2) !important;
        border-radius: var(--lw-radius-lg) !important;
        font-size: var(--lw-font-size-base) !important;
        font-weight: 500 !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
    }
    
    .lw-search-container .form-control:focus,
    .lw-search-container .custom-select:focus {
        border-color: var(--lw-gradient-start) !important;
        box-shadow: 0 0 0 4px rgba(197, 62, 141, 0.1), 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        transform: translateY(-2px);
    }
    
    /* Enhanced Search Button */
    .lw-search-btn {
        height: 60px !important;
        background: transparent !important;
        color: #222222 !important;
        border: 2px solid #ec9cae !important;
        font-weight: 700 !important;
        font-size: var(--lw-font-size-base) !important;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 8px 25px rgba(236, 156, 174, 0.3) !important;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .lw-search-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(91, 62, 150, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .lw-search-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .lw-search-btn:hover {
        background: #5B3E96 !important;
        border-color: #5B3E96 !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 15px 35px rgba(91, 62, 150, 0.4) !important;
        color: #ffffff !important;
    }
    
    /* Premium Card Design */
    .card {
        background: var(--lw-white) !important;
        border: none !important;
        border-radius: var(--lw-radius-xl) !important;
        padding: var(--lw-space-xl) !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08), 0 5px 15px rgba(0, 0, 0, 0.04) !important;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
        position: relative;
        overflow: hidden;
        border-top: 3px solid transparent;
    }
    
    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--lw-gradient-start), var(--lw-gradient-end));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12), 0 15px 25px rgba(0, 0, 0, 0.08) !important;
    }
    
    .card:hover::before {
        transform: scaleX(1);
    }
    
    /* Enhanced How It Works Section */
    .lw-hows-it-works-container {
        padding: 120px 0 !important;
        background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
        position: relative;
    }
    
    .lw-hows-it-works-container .card span {
        width: 80px !important;
        height: 80px !important;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--lw-gradient-start), var(--lw-gradient-end)) !important;
        color: var(--lw-white);
        display: flex !important;
        align-items: center;
        justify-content: center;
        font-size: var(--lw-font-size-2xl) !important;
        margin: 0 auto var(--lw-space-lg) !important;
        box-shadow: 0 15px 30px rgba(197, 62, 141, 0.3);
        transition: var(--lw-transition);
        position: relative;
    }
    
    .lw-hows-it-works-container .card:hover span {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 20px 40px rgba(197, 62, 141, 0.4);
    }
    
    /* Enhanced Features Section */
    .lw-features-block-section {
        padding: 120px 0 !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%) !important;
    }
    
    .lw-feature-btn {
        background: transparent !important;
        color: #222222 !important;
        border: 2px solid #ec9cae !important;
        padding: 16px 32px !important;
        font-weight: 700 !important;
        letter-spacing: 1px;
        text-transform: uppercase;
        box-shadow: 0 10px 25px rgba(236, 156, 174, 0.3);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .lw-feature-btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(91, 62, 150, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .lw-feature-btn:hover {
        background: #5B3E96 !important;
        border-color: #5B3E96 !important;
        color: #ffffff !important;
    }

    .lw-feature-btn:hover::after {
        width: 300px;
        height: 300px;
    }
    
    /* Enhanced Card Icons */
    .card-icon {
        width: 80px !important;
        height: 80px !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, rgba(197, 62, 141, 0.1), rgba(139, 92, 246, 0.1)) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 auto var(--lw-space-lg) !important;
        transition: var(--lw-transition) !important;
    }
    
    .card:hover .card-icon {
        background: linear-gradient(135deg, var(--lw-gradient-start), var(--lw-gradient-end)) !important;
        transform: scale(1.1);
    }
    
    .card:hover .card-icon i {
        color: var(--lw-white) !important;
    }
    
    /* Enhanced Testimonials */
    .lw-testimonial-bg-image {
        background: linear-gradient(135deg, var(--lw-gradient-start) 0%, var(--lw-gradient-end) 100%) !important;
        padding: 120px 0 !important;
        position: relative;
        overflow: hidden;
    }
    
    .testimonial-slider {
        position: relative;
        z-index: 2;
    }
    
    .slide {
        background: rgba(255, 255, 255, 0.1) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: var(--lw-radius-xl) !important;
        padding: var(--lw-space-2xl) !important;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
    }
    
    .testimonial-image img {
        border-radius: 50% !important;
        border: 4px solid rgba(255, 255, 255, 0.3) !important;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2) !important;
    }
    
    /* Enhanced FAQ */
    .faq-section {
        padding: 120px 0 !important;
        background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%) !important;
    }
    
    .faq-question {
        background: var(--lw-white) !important;
        border: 2px solid rgba(197, 62, 141, 0.1) !important;
        border-radius: var(--lw-radius-lg) !important;
        padding: var(--lw-space-lg) !important;
        margin-bottom: var(--lw-space-md) !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05) !important;
        transition: all 0.3s ease !important;
    }
    
    .faq-question:hover {
        border-color: var(--lw-gradient-start) !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        transform: translateY(-2px);
    }
    
    .faq-question.active {
        background: linear-gradient(135deg, var(--lw-gradient-start), var(--lw-gradient-end)) !important;
        border-color: transparent !important;
        box-shadow: 0 15px 35px rgba(197, 62, 141, 0.3) !important;
    }
    
    /* Enhanced Footer */
    footer {
        background: linear-gradient(135deg, #1a1a2e 0%, #2d2d3a 100%) !important;
        padding: 80px 0 40px !important;
        position: relative;
        overflow: hidden;
    }
    
    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--lw-gradient-start), var(--lw-gradient-end), transparent);
    }
    
    /* Enhanced Mobile App Section */
    .py-5:has(.lw-couple-img) {
        padding: 120px 0 !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
    }
    
    /* Enhanced Call to Action */
    .lw-block-content {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 249, 252, 0.9)) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .masthead {
            min-height: 80vh;
        }
        
        .masthead h1 {
            font-size: 2.5rem !important;
        }
        
        .lw-search-container {
            padding: var(--lw-space-lg) !important;
        }
        
        .card {
            margin-bottom: var(--lw-space-2xl) !important;
        }
        
        .lw-hows-it-works-container,
        .lw-features-block-section,
        .lw-about-section,
        .faq-section {
            padding: 80px 0 !important;
        }
    }
    </style>
</head>
<div id="preloader" class="lw-modern-preloader" role="status" aria-label="Loading">
    <div class="lw-preloader-content">
        <!-- Animated Heart Icon -->
        <div class="lw-heart-loader" aria-hidden="true">
            <div class="lw-heart lw-heart-1"></div>
            <div class="lw-heart lw-heart-2"></div>
            <div class="lw-heart lw-heart-3"></div>
        </div>
        
        <!-- Logo -->
        <div class="lw-preloader-logo">
            <img src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>" class="lw-logo lw-logo-white" loading="eager" />
        </div>
        
        <!-- Loading Text -->
        <div class="lw-preloader-text">
            <h3 class="lw-title lw-title-sm"><?= __tr('Finding Your Perfect Match') ?></h3>
            <div class="lw-loading-dots" aria-hidden="true">
                <span class="lw-dot lw-dot-1"></span>
                <span class="lw-dot lw-dot-2"></span>
                <span class="lw-dot lw-dot-3"></span>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="lw-progress-container">
            <div class="lw-progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="lw-progress-fill"></div>
            </div>
        </div>
        
        <!-- Screen Reader Text -->
        <span class="sr-only"><?= __tr('Loading application, please wait...') ?></span>
    </div>
    
    <!-- Background Elements -->
    <div class="lw-preloader-bg-1" aria-hidden="true"></div>
    <div class="lw-preloader-bg-2" aria-hidden="true"></div>
</div>

<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand js-scroll-trigger" href="{{ url('') }}#page-top">
                {{-- <img class="lw-logo-img" src="<?= getStoreSettings('logo_image_url') ?>"
                             alt="<?= getStoreSettings('name') ?>" loading="eager"> --}}
                    </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <?php $translationLanguages = getActiveTranslationLanguages(); ?>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto text-center">
                        <!-- About Us -->
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('#about-us') }}"><?= __tr('About Us') ?></a>
                    </li>
                    <!-- /About Us -->
                        
                        <!-- Features -->
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ url('#features') }}"><?= __tr('Features') ?></a>
                    </li>
                    <!-- /Features -->
                        
                        <!-- Contact -->
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger"
                            href="<?= route('user.read.contact') ?>"><?= __tr('Contact') ?></a>
                    </li>
                    <!-- /Contact -->
                        
                        <!-- Language Menu -->
                        @if (!__isEmpty($translationLanguages) and count($translationLanguages) > 1)
                        <?php $translationLanguages['en_US'] = configItem('default_translation_language'); ?>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span
                                class="d-none d-md-inline-block"><?= isset($translationLanguages[config('CURRENT_LOCALE')]) ? $translationLanguages[config('CURRENT_LOCALE')]['name'] : '' ?></span>
                            &nbsp; <i class="fas fa-language"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <h6 class="dropdown-header">
                                    <?= __tr('Choose your language') ?>
                            </h6>
                            <div class="dropdown-divider"></div>
                                <?php foreach ($translationLanguages as $languageId => $language) {
                                    if ($languageId == config('CURRENT_LOCALE') or (isset($language['status']) and $language['status'] == false)) continue;
                                ?>
                            <a class="dropdown-item"
                                   href="<?= route('locale.change', ['localeID' => $languageId]) . '?redirectTo=' . base64_encode(Request::fullUrl()) ?>">
                                    <?= $language['name'] ?>
                                </a>
                                <?php } ?>
                            </div>
                    </li>
                        @endif
                    <!-- Language Menu -->
                        
                    <!-- login -->
                    <li class="nav-item">
                        <a class="nav-link lw-login-btn btn px-4"
                            href="<?= route('user.auth_choice') ?>"><?= __tr('Login') ?></a>
                    </li>
                    <!-- /login -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation -->

    <!-- Header -->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center pt-5 lw-featured-text-block">
            <div class="mx-auto lw-main-text-block">
                <h1 class="mx-auto my-0">{!! Arr::random([
                    __tr('The journey to love starts here.'),
                    __tr('The Real Place For Real Dating.'),
                    __tr("Find love that's meant to be."),
                    __tr('Love is waiting for you.'),
                    __tr('Find love the easy way.'),
                    __tr('The perfect match is just a click away.'),
                    __tr('Find love on your own terms.'),
                    __tr('The best relationships are built on shared interests.'),
                    __tr('Dating should be fun.'),
                    __tr('Your soulmate is waiting for you.'),
                    __tr('Find love, not just a date.'),
                    ]) !!}</h1>
                <h2 class="mx-auto mt-4 mb-4 lw-text-shadow"><?= __tr("Tired of being single? __siteName__ is the answer to your prayers. We have a wide variety of members to choose from, so you're sure to find someone who is perfect for you. Join and start your love life today!", [
                    '__siteName__' => getStoreSettings('name'),
                ]) ?></strong></h2>
                <a href="#search" class="js-scroll-trigger lw-special-btn btn"><?= __tr('Get Started') ?></a>
            </div>
        </div>
    </header>
    <!-- / Header -->

    <!-- section block -->
    <section class="bg-dark lw-section-block items" id="about-us" data-aos="fade-up">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <img class="img-fluid" src="imgs/home/bg-image.png" alt="Dating app illustration" loading="lazy">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <h3 class="lw-sub-title-katibeh text-white py-4">
                        <?= __tr("Find Your Perfect Match – Love Begins Here!") ?>
                    </h3>
                </div>
            </div>
        </div>
    </section>
    <!-- /section block -->

    <!-- about us -->
    <section class="lw-about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <h4 class="text-primary h2 mb-0"><?= __tr('About us') ?></h4>
                    <h3 class="lw-sub-title-katibeh text-dark"><?= __tr('Love Made Simple, Connections Made Real.') ?>
                    </h3>
                    <p class="mt-3">
                        <?= __tr("Finding love should be simple, secure, and exciting. Our platform is designed to connect like-minded individuals, fostering genuine relationships that last. With advanced search, user-friendly features, and a commitment to privacy, we make your dating journey effortless. Whether you're looking for friendship, romance, or a lifelong partner, we’re here to help you every step of the way. Start exploring and let meaningful connections unfold!") ?>
                    </p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 ">
                    <img class="couple-image" src="imgs/home/couple-image.png" alt="Happy couple representing successful dating connections" loading="lazy">
                </div>
            </div>
        </div>

    </section>
    <!-- /about us -->

    <!-- find match block -->
    <section class="lw-find-match-block" id="search">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <div class="text-center text-white">

                    <!-- site logo -->
                    <img class="lw-logo-img" src="<?= getStoreSettings('logo_image_url') ?>"
                        alt="<?= getStoreSettings('name') ?>" loading="lazy">
                    <!-- site logo -->

                    <!-- headings -->
                    <h3 class="lw-sub-title-katibeh text-white my-3"><?= __tr('Find Match Now!') ?></h3>
                    <p class="my-2">
                        <?= __tr('Where Connections Blossom! Your perfect match is just a click away.') ?>
                    </p>
                    <!-- /headings -->

                    <!-- search img -->
                    <img class="lw-search-heart my-4" src="imgs/home/heart.png" alt="search heart image">
                    <!-- /search img -->
                </div>
            </div>
            <!-- search container block -->
            <form method="post" action="<?= route('search_matches') ?>">
                <input type="hidden" name="_token" id="csrf-token" value="<?= csrf_token() ?>" />
                <div class="lw-search-container">
                    <div class="row justify-content-center ">

                        <!-- looking for -->
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?= __tr('Looking for') ?></label>
                                <select name="looking_for" class="custom-select form-control">
                                    <option value="all" selected><?= __tr('All') ?></option>
                                    @foreach (configItem('user_settings.gender') as $genderKey => $gender)
                                    <option value="<?= $genderKey ?>"><?= $gender ?></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- looking for -->

                        <!-- age -->
                        <div class="col-sm-12 col-md-12 col-lg-5 mb-3">
                            <label for="exampleInputEmail1"><?= __tr('Age') ?></label>
                            <div class="row">
                                <!-- Age from -->
                                <div class="col-6">
                                    <select name="min_age" class="custom-select form-control">
                                        <option disabled><?= __tr('Age from') ?></option>
                                        @foreach (configItem('user_settings.age_range') as $age)
                                        <option value="<?= $age ?>"
                                            <?= $age == configItem('user_settings.default_min_age') ? 'selected' : '' ?>><?= __tr('__translatedAge__', [
'__translatedAge__' => $age,
]) ?></option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /Age from -->

                                <!-- Age till -->
                                <div class="col-6">
                                    <select name="max_age" class="custom-select form-control">
                                        <option disabled><?= __tr('Age till') ?></option>
                                        @foreach (configItem('user_settings.age_range') as $age)
                                        <option value="<?= $age ?>"
                                            <?= $age == configItem('user_settings.default_max_age') ? 'selected' : '' ?>><?= __tr('__translatedAge__', [
'__translatedAge__' => $age,
]) ?></option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /Age till -->
                            </div>
                        </div>
                        <!-- age -->

                        <!-- search button -->
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <div class="">
                                <button class="btn btn-primary btn-block lw-search-btn"
                                    type="submit"><?= __tr('Search') ?></button>
                            </div>
                        </div>
                        <!-- /search button -->
                    </div>
                </div>

            </form>
            <!-- / search container block -->
    </section>
    <!-- /find match block -->

    <!-- How It Works -->
    <section class=" py-5 lw-hows-it-works-container">
        <div class="container">

            <!-- headings -->
            <div class="text-center mb-5">
                <h4 class="text-primary h2"><?= __tr('How It Works') ?></h4>
                <h3 class="lw-sub-title-katibeh text-dark">
                    <?= __tr('Discover, Connect, Grow : A Guide to Creating Meaningful Bonds') ?></h3>
            </div>
            <!-- /headings -->

            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <!-- Register -->
                    <div class="card">
                        <span class="my-3"><i class="fas fa-user-plus"></i></span>
                        <h5 class="text-dark font-wight-bold"><?= __tr('Register') ?></h5>
                        <p><?= __tr(' Sign up in just a few simple steps and become part of a vibrant community looking for meaningful connections.') ?>
                        </p>
                    </div>
                    <!-- / Register -->

                    <!-- Create a Profile -->
                    <div class="card">
                        <span class="my-3 bg-green"><i class="fas fa-user"></i></span>
                        <h5 class="text-dark font-wight-bold "><?= __tr('Create a Profile') ?></h5>
                        <p><?= __tr(' Showcase your personality by adding photos and sharing your interests to help others get to know you better.') ?>
                        </p>
                    </div>
                    <!-- /Create a Profile -->


                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <!-- image -->
                    <img class="lw-image" src="imgs/home/bg-2.png" alt="search heart image">
                    <!-- /image -->
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <!-- Find The Match -->
                    <div class="card">
                        <span class="my-3 bg-blue"><i class="fab fa-searchengin"></i></span>
                        <h5 class="text-dark font-wight-bold"><?= __tr('Find The Match') ?></h5>
                        <p><?= __tr('Explore potential matches based on compatibility, shared interests, and preferences.') ?>
                        </p>
                    </div>
                    <!-- /Find The Match -->

                    <!-- Initiate Conversation -->
                    <div class="card">
                        <span class="my-3 bg-violet"><i class="fab fa-rocketchat"></i></span>
                        <h5 class="text-dark font-wight-bold"><?= __tr('Initiate Conversation') ?></h5>
                        <p><?= __tr('Take the first step by sending a message and start building a connection that could turn into something special!') ?>
                        </p>
                    </div>
                    <!-- /Initiate Conversation -->
                </div>
            </div>
        </div>
    </section>
    <!-- How It Works -->

    <!-- features section -->
    <section class="py-5 lw-features-block-section" id="features">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-4">

                    <!-- headings -->
                    <div class=" mb-5 lw-headings">
                        <h4 class="text-primary h2"><?= __tr('Our Services') ?></h4>
                        <h3 class="lw-sub-title-katibeh text-dark">
                            <?= __tr('Enjoy Our Special Features') ?></h3>
                        <a href="<?= route('user.auth_choice') ?>" class="lw-feature-btn btn"><?= __tr('Learn more') ?></a>
                    </div>
                    <!-- /headings -->

                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <!-- Credit System -->
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3 class="card-title"> <?= __tr('Credit System') ?></h3>
                        <div class="underline"></div>
                        <p class="card-description mt-3">
                            <?= __tr('Use credits to send  gifts and stickers, making your conversations more fun and engaging! Purchase credits easily and express yourself in a unique way.') ?>
                        </p>
                    </div>
                    <!-- /Credit System -->

                    <!-- Payment Getaways -->
                    <div class="card">
                        <div class="card-icon">
                        <i class="fas fa-money-check-alt"></i>
                        </div>
                        <h3 class="card-title"> <?= __tr('Payment Getaways') ?></h3>
                        <div class="underline"></div>
                        <p class="card-description mt-3">
                            <?= __tr('Secure and hassle-free transactions at your fingertips! Users can purchase credits easily using Stripe, PayPal, Razorpay, Coingate and Paystack, ensuring a smooth and flexible payment experience.') ?>
                        </p>
                    </div>
                    <!-- /Payment Getaways -->

                    <!-- Social Login -->
                    <div class="card">
                        <div class="card-icon">
                        <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <h3 class="card-title"> <?= __tr('Social Login') ?></h3>
                        <div class="underline"></div>
                        <p class="card-description mt-3">
                            <?= __tr('Social Login is single sign-on for end users. Using existing login information from a social network provider like Facebook or Google.') ?>
                        </p>
                    </div>
                    <!-- /Social Login -->
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 ">
                    <!-- Profile Booster -->
                    <div class="card">
                        <div class="card-icon">
                        <i class="fas fa-search"></i>
                        </div>
                        <h3 class="card-title"> <?= __tr('Advanced Search') ?></h3>
                        <div class="underline"></div>
                        <p class="card-description mt-3">
                            <?= __tr('Refine your search with multiple filters like age, location, profession, and interests. Easily find profiles that match your preferences for a more personalized dating experience.') ?>
                        </p>
                    </div>
                    <!-- /Profile Booster -->

                    <!-- Detailed User Profile -->
                    <div class="card">
                        <div class="card-icon">
                        <i class="fas fa-moon"></i>
                        </div>
                        <h3 class="card-title"> <?= __tr('Modern, Dark & Beautiful') ?></h3>
                        <div class="underline"></div>
                        <p class="card-description mt-3">
                            <?= __tr('Experience the elegance of our Dark & Beautiful theme—where sleek design meets seamless functionality.') ?>
                        </p>
                    </div>
                    <!-- /Detailed User Profile -->
                </div>
            </div>
        </div>
    </section>
    <!-- features section -->

    <!-- key features -->
    <section class="lw-main-features-block py-5 bg-light-primary">
        <div class="container">

            <!-- headings -->
            <div class="text-center mb-5">
                <h3 class="lw-sub-title-katibeh text-primary">
                    <?= __tr('Key Features') ?></h3>
                <h5><?= __tr('Explore the Features That Set Us Apart!') ?></h5>
            </div>
            <!-- /headings -->

            <!-- Beyond Basics: Detailed Profiles -->
            <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="d-flex justify-content-center">
                        <img class="my-3" src="imgs/home/bg-3.png" alt="Stay Connected, Anywhere">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <h1 class="text-primary"><?= __tr('Beyond Basics: Detailed Profiles') ?></h1>
                    <p><?= __tr('The User Profile Detail component shows details about a user including contact information, profile photo, Chatter statistics, and topics the user is knowledgeable about. On other users’ profiles.') ?>
                    </p>
                </div>
            </div>
            <!-- Beyond Basics: Detailed Profiles -->

            <!-- Encounters -->
            <div class="row align-items-center lw-div-reverse">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <h1 class="text-primary"><?= __tr('Encounters that Spark Connections') ?></h1>
                    <p><?= __tr('Get encounter with the person, you may interested in.') ?></p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="d-flex justify-content-center">
                        <img class="my-4" src="imgs/home/encounters.png" alt="Encounters">
                    </div>
                </div>
            </div>
            <!-- Encounters -->

            <!-- Stay Connected, Anywhere -->
            <div class="row align-items-center py-5">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="d-flex justify-content-center pb-5">

                        <video autoplay muted loop="loop" preload="none" width="80%" height="80%"
                            class="lw-messenger-video">
                            <source src="imgs/home/message-video.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <h1 class="text-primary"><?= __tr('Stay Connected, Anywhere') ?></h1>
                    <p><?= __tr('The messenger offers seamless communication with high-quality audio/video calls, an intuitive interface, and built-in emoji support, catering to diverse preferences and keeping users connected effortlessly.') ?>
                    </p>
                </div>

            </div>
            <!-- Stay Connected, Anywhere -->
        </div>
    </section>

    <!-- Meaningful Matches, Every Time -->
    <section class="lw-feature-container py-5">
        <div class="container text-center">
            <!-- image -->
            <img class="my-4 lw-feature-icon-img" src="imgs/home/icons.png" alt="Meaningful Matches, Every Time">
            <!-- /image -->

            <!-- heading -->
            <h3 class="lw-sub-title-katibeh text-dark py-3">
                <?= __tr('Your Favorite Person’s Secret Weapon!') ?></h3>
            <p class="lw-description">
                <?= __tr('Make every conversation count! Break the ice with ease—chat with your matches, express yourself with GIFs and emojis, or surprise them with a thoughtful gift.') ?>
            </p>
            <!-- /heading -->
        </div>
    </section>
    <!-- /Meaningful Matches, Every Time -->

    <!-- / key features -->

    <!-- testimonial block -->
    <section class="py-5" id="success-stories">
        <div class="text-center pb-3">
            <!-- heading -->
            <h3 class="lw-sub-title-katibeh text-primary py-3 ">
                <?= __tr('A Match Made Perfectly!') ?></h3>
            <p class="lw-description">
                <?= __tr('Experience meaningful connections with like-minded individuals in a safe space.') ?>
            </p>
            <!-- /heading -->
        </div>
        <div class="lw-testimonial-bg-image">
            <div class="testimonial-slider container">
                <div class="slider-container">
                    <!-- Slide 1 -->
                    <div class="slide">
                        <div class="testimonial-image">
                            <img src="imgs/home/outdoors-7213961_1280 (1).jpg" alt="Success Stories 1">
                        </div>
                        <div class="testimonial-content">
                            <blockquote>
                                <div class="my-3 text-white">
                                    <i class="fas fa-quote-left my-3"></i>
                                </div>
                                <?= __tr('"The features are so easy to use, and I was able to meet amazing people within days. Highly recommend for anyone looking for a real connection!"') ?>
                            </blockquote>
                            <p class="author-name text-white">—
                                <?= __tr('Sophia Consultant from Bangalore') ?></p>
                        </div>
                    </div>
                    <!-- /Slide 1 -->

                    <!-- Slide 2 -->
                    <div class="slide">
                        <div class="testimonial-image">
                            <img src="imgs/home/smile-7402270_1280.jpg" alt="Success Stories 2">
                        </div>
                        <div class="testimonial-content text-white">
                            <blockquote>
                                <div class="my-3 text-white">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <?= __tr('"I never thought I find a connection so genuine. This platform made it easy to meet someone special. Truly a great experience!"') ?>
                            </blockquote>
                            <p class="author-name">—<?= __tr('Bobby From Dubai') ?></p>
                        </div>
                    </div>
                    <!-- Slide 2 -->

                    <!-- Slide 3 -->
                    <div class="slide">
                        <div class="testimonial-image">
                            <img src="imgs/home/portrait-2865605_1280.jpg" alt="Success Stories 3">
                        </div>
                        <div class="testimonial-content text-white">
                            <blockquote>
                                <div class="my-3 text-white">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <?= __tr(' "I was skeptical at first, but the perfect match really works! I found someone who shares my interests and values. So happy I joined!"') ?>
                            </blockquote>
                            <p class="author-name">—<?= __tr('Isabella from USA') ?></p>
                        </div>
                    </div>
                    <!-- Slide 3 -->

                    <!-- Slide 4 -->
                    <div class="slide">
                        <div class="testimonial-image">
                            <img src="imgs/home/model-2359322_1280.jpg" alt="Success Stories 4">
                        </div>
                        <div class="testimonial-content text-white">
                            <blockquote>
                                <div class="my-3 text-white">
                                    <i class="fas fa-quote-left"></i>
                                </div>
                                <?= __tr('"The platform helped me connect with like-minded individuals. Its user-friendly, and I love how quickly I was able to start conversations!"') ?>
                            </blockquote>
                            <p class="author-name">—<?= __tr('Frankie from America') ?></p>
                        </div>
                    </div>
                    <!-- Slide 4 -->
                </div>
                <button class="prev border-0 lw-testimonial-button">
                    <img src="imgs/home/prev.png" alt="prev arrow">
                </button>
                <button class="next border-0 lw-testimonial-button">
                    <img src="imgs/home/next.png" alt="next arrow">
                </button>
            </div>
        </div>
    </section>
    <!-- /testimonial block-->

    <!-- call to action -->
    <section class="py-5">
        <div class="container text-center">

            <!-- site logo -->
            <h3 class="my-4 text-muted">-----------<img class="lw-logo-img"
                    src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">-----------
            </h3>
            <!-- site logo -->

            <!-- heading -->
            <h3 class="lw-sub-title-katibeh text-primary mb-3">
                <?= __tr('Start Your Love Story Today') ?></h3>
            <p class="lw-description">
                <?= __tr('Sign Up and Meet Your Match!') ?>
            </p>
            <!-- /heading -->

            <div class="row align-items-center justify-content-center py-5">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <!-- image -->
                    <img class="my-4 lw-couple-img" src="imgs/home/call-to-action.png" alt="Meaningful Matches">
                    <!-- /image -->
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="lw-block-content bg-white rounded mx-4">
                        <!-- image -->
                        <img class="my-4" src="imgs/home/heart-list.png" alt="heart">
                        <!-- /image -->
                        <h4 class="lw-sub-title-katibeh text-primary">
                            <?= __tr('A Perfect Match On Your Terms') ?></h4>
                        <a href="<?= route('user.sign_up') ?>"
                            class="lw-feature-btn btn my-3"><?= __tr('Sign Up') ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / call to action -->

    <!-- faq section -->
    <section class="bg-light-primary py-3" id="faq">
        <div class="container faq-section">
            <div class="text-center pt-3 pb-4">
                <!-- heading -->
                <h3 class="lw-sub-title-katibeh text-primary mb-3">
                    <?= __tr('Frequently Asked Questions') ?></h3>
                <p class="lw-description">
                    <?= __tr('Explore helpful information to get started or resolve your queries with ease.') ?>
                </p>
                <!-- /heading -->
            </div>

            <div class="faq-items mb-4">
                <div class="faq-question"><?= __tr('How does this dating platform work?') ?><span class="float-right"><i
                            class="fas fa-caret-down"></i></span></div>

                <div class="faq-answer">
                    <p><?= __tr('We match you based on your interests, preferences, and personality traits. Just sign up, create your profile, and start connecting with like-minded singles!') ?>
                    </p>
                </div>
            </div>
            <div class="faq-item mb-4">
                <div class="faq-question"><?= __tr('Is my personal information safe?') ?><span class="float-right"><i
                            class="fas fa-caret-down"></i></span></div>
                <div class="faq-answer">
                    <p><?= __tr('Absolutely! We prioritize your privacy with top-notch security and encryption, ensuring your data stays confidential.') ?>
                    </p>
                </div>
            </div>
            <div class="faq-item mb-4">
                <div class="faq-question">
                    <?= __tr('What makes this platform different from other dating apps?') ?><span
                        class="float-right"><i class="fas fa-caret-down"></i></span></div>
                <div class="faq-answer">
                    <p><?= __tr('We focus on meaningful connections, real-time compatibility insights, and a unique matchmaking algorithm!') ?>
                    </p>
                </div>
            </div>
            <div class="faq-item mb-4">
                <div class="faq-question"><?= __tr('What happens if I find my perfect match?') ?><span
                        class="float-right"><i class="fas fa-caret-down"></i></span></div>
                <div class="faq-answer">
                    <p><?= __tr('Congratulations! You can continue your journey on or off the platform—our goal is to help you find love.') ?>
                    </p>
                </div>
            </div>
            <div class="faq-item mb-4">
                <div class="faq-question"><?= __tr('Can I filter matches based on my preferences?') ?><span
                        class="float-right"><i class="fas fa-caret-down"></i></span></div>
                <div class="faq-answer">
                    <p><?= __tr('Yes! Use advanced filters like age, location, interests, and lifestyle preferences to find your ideal match.') ?>
                    </p>
                </div>
            </div>
            <div class="faq-item mb-4">
                <div class="faq-question"><?= __tr('Can I use the platform on both mobile and desktop?') ?><span
                        class="float-right"><i class="fas fa-caret-down"></i></span></div>
                <div class="faq-answer">
                    <p><?= __tr('Yes! Our platform is fully responsive, allowing you to connect anytime, anywhere, on any device.') ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /faq section -->

    <!-- mobile app call to action -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6 lw-align-center">
                    <!-- headings -->
                    <div class="">
                        <h3 class="lw-sub-title-katibeh text-dark">
                            <?= __tr('Start your profitable Dating app!') ?></h3>
                        <p class="lw-description py-3 px-0 m-0">
                            <?= __tr('Your next adventure is just a tap away - download now and start exploring!') ?>
                        </p>
                        <h4 class="text-primary h3"><?= __tr('Available On') ?></h4>
                        <!-- google play -->
                        <a href="https://play.google.com/store/apps/details?id=net.livelyworks.loveria_demo&pcampaignid=web_share"
                            target="_blank"><img class="my-4 w-25" src="imgs/home/play-store.png"
                                alt="Google Play Store"></a>
                        <!-- /google play -->
                    </div>
                    <!-- /headings -->
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <!-- image -->
                    <img class="my-4 lw-couple-img" src="imgs/home/dating-app.png" alt="dating App">
                    <!-- /image -->
                </div>
            </div>

        </div>
    </section>
    <!-- /mobile app call to action -->

    <!-- footer -->
    <footer class="py-5 ">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3 m-auto">
                    <!-- site logo -->
                    <img class="lw-logo-img" src="<?= getStoreSettings('logo_image_url') ?>"
                        alt="<?= getStoreSettings('name') ?>">
                    </h3>
                    <!-- site logo -->
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3 lw-center-block my-4">
                    <div>
                        <h5 class="h5 text-white"> <?= __tr('Treat Me Beautiful') ?></h5>
                        <!-- <div class="underline lw-underline"></div> -->
                        <p>
                            <?= __tr('Discover meaningful connections with personalized matches, a safe platform, and a global community, your journey to love starts here.') ?>
                        </p>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="d-flex justify-content-center my-4 lw-side-block-list">
                        <div class="text-left">
                            <h5 class="h5 text-white"> <?= __tr('Quick Links') ?></h5>
                            <div class="underline"></div>
                            <li><a href="#features"><?= __tr('Features') ?></a></li>
                            <li><a href="#faq"><?= __tr('FAQ') ?></a></li>
                            <li><a href="<?= route('user.read.contact') ?>"><?= __tr('Contact us') ?></a></li>
                            <li><a href="<?= route('user.auth_choice') ?>"><?= __tr('Login') ?></a></li>
                            <li><a href="<?= route('user.sign_up') ?>"><?= __tr('Register') ?></a></li>
                        </div>
                    </div>
                </div>
                <!-- /Quick Links -->

                <!-- Social Links -->
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="d-flex justify-content-center my-4 lw-side-block-list">
                        <div class="text-left">
                            <h5 class="h5 text-white"> <?= __tr('Social Links') ?></h5>
                            <div class="underline"></div>
                            <div class="mx-auto">
                                <li><a href="#!"><span><i
                                                class="fab fa-facebook mr-2"></i></span><?= __tr('Facebook') ?></a>
                                </li>
                                <li><a href="#!"><span><i
                                                class="fab fa-instagram mr-2"></i></span><?= __tr('Instagram') ?></a>
                                </li>
                                <li><a href="#!"><span><i
                                                class="fab fa-linkedin-in mr-2"></i></span><?= __tr('Linkedin') ?></a>
                                </li>
                                <li><a href="#!"><span><i
                                                class="fab fa-twitter mr-2"></i></span><?= __tr('Twitter') ?></a>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Social Links -->
            </div>
            <hr class="bg-secondary">
            <div class="small text-center text-white-50">
                <?= __tr('Copyright © __siteName__ __year__', [
                    '__year__' => date('Y'),
                    '__siteName__' => getStoreSettings('name'),
                ]) ?>
            </div>
        </div>
    </footer>
    <!-- /footer -->

    <?= __yesset(['dist/js/vendorlibs-public.js'], true) ?>

    <script>
    (function($) {
        "use strict"; // Start of use strict

        // Smooth scrolling using jQuery easing
        $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location
                .hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: (target.offset().top - 70)
                    }, 1000, "easeInOutExpo");
                    return false;
                }
            }
        });

        // Closes responsive menu when a scroll trigger link is clicked
        $('.js-scroll-trigger').click(function() {
            $('.navbar-collapse').collapse('hide');
        });

        // Activate scrollspy to add active class to navbar items on scroll
        $('body').scrollspy({
            target: '#mainNav',
            offset: 100
        });

        // Collapse Navbar
        var navbarCollapse = function() {
            if ($("#mainNav").offset().top > 100) {
                $("#mainNav").addClass("navbar-shrink");
        } else {
                $("#mainNav").removeClass("navbar-shrink");
        }
    };
        // Collapse now if page is not at top
    navbarCollapse();
        // Collapse the navbar when page is scrolled
        $(window).scroll(navbarCollapse);

    })(jQuery);
    // End of use strict

    // fAQ
    $(function() {
        $('.faq-question').click(function() {
            const answer = $(this).next('.faq-answer');
            answer.css('max-height', answer.css('max-height') === '0px' ? answer.prop('scrollHeight') +
                'px' : '0');
            $(this).toggleClass('active');
        });
    });
    // fAQ

    // preloader
    document.addEventListener("DOMContentLoaded", () => {
        // Add a more sophisticated loading experience
        const preloader = document.getElementById("preloader");
        
        // Simulate progressive loading
        setTimeout(() => {
            // Add the hidden class for smooth transition
            preloader.classList.add("lw-preloader-hidden");
            
            // Remove from DOM after transition completes
            setTimeout(() => {
                preloader.style.display = "none";
            }, 600); // Match the CSS transition duration
        }, 1800); // Slightly longer to show the beautiful animation
    });
    // preloader

    // testimonial slider
    $(function() {
        const $slider = $('.slider-container'),
            $slides = $('.slide');
        let i = 0;
        const update = () =>
            $slider.css('transform', `translateX(-${i * $slides.first().outerWidth()}px)`);
        $('.prev').click(() => (i = (i > 0 ? i - 1 : $slides.length - 1), update()));
        $('.next').click(() => (i = (i < $slides.length - 1 ? i + 1 : 0), update()));
        $(window).resize(update);
        update();
    });
    // /testimonial slider
    </script>
</body>

</html>