<!-- Loversnmore Loading/Splash Screen -->
<!-- Brand Guidelines: Heart icon only, Background #6A36A8, No text, Fade/scale animation 500-600ms -->
<div id="lwLoadingScreen" class="lw-splash-screen">
    <div class="lw-splash-content">
        <img src="{{ asset('images/heart-outline.svg') }}" alt="Loading" class="lw-splash-icon">
    </div>
</div>

<style>
/* Loversnmore Splash Screen Styles - Per Branding Guide */
.lw-splash-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: #6A36A8; /* Brand color as per guide */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    transition: opacity 600ms ease-out;
}

.lw-splash-screen.lw-fade-out {
    opacity: 0;
    pointer-events: none;
}

.lw-splash-content {
    text-align: center;
}

/* Heart icon animation - Subtle fade and scale (500-600ms) as per guide */
.lw-splash-icon {
    width: 120px;
    height: 120px;
    animation: lwSplashPulse 600ms ease-in-out infinite alternate;
}

@keyframes lwSplashPulse {
    0% {
        opacity: 0.8;
        transform: scale(1);
    }
    100% {
        opacity: 1;
        transform: scale(1.05);
    }
}

/* Mobile responsive */
@media (max-width: 768px) {
    .lw-splash-icon {
        width: 100px;
        height: 100px;
    }
}
</style>

<script>
// Auto-hide splash screen after page load
document.addEventListener('DOMContentLoaded', function() {
    const splashScreen = document.getElementById('lwLoadingScreen');

    // Hide splash screen after minimum display time (1 second)
    setTimeout(function() {
        if (splashScreen) {
            splashScreen.classList.add('lw-fade-out');
            // Remove from DOM after transition completes
            setTimeout(function() {
                splashScreen.style.display = 'none';
            }, 600);
        }
    }, 1000);
});

// Also hide on window load (in case DOMContentLoaded already fired)
window.addEventListener('load', function() {
    const splashScreen = document.getElementById('lwLoadingScreen');
    if (splashScreen && !splashScreen.classList.contains('lw-fade-out')) {
        setTimeout(function() {
            splashScreen.classList.add('lw-fade-out');
            setTimeout(function() {
                splashScreen.style.display = 'none';
            }, 600);
        }, 500);
    }
});
</script>
