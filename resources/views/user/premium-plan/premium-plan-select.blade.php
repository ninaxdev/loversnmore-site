<!-- Premium Plan Selection - 3 Tier Pricing -->
<div class="min-h-screen bg-gradient-to-br from-purple-600 via-purple-700 to-pink-600 py-6 px-4">
    <div class="max-w-6xl mx-auto">
        
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('user.premium_plan.read.view') }}" class="inline-flex items-center text-white hover:text-white/80 transition-colors">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="text-sm font-medium"><?= __tr('Back') ?></span>
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-2"><?= __tr('Membership') ?></h1>
            <p class="text-white/90 text-base md:text-lg"><?= __tr('Choose a plan and get unlimited access') ?></p>
        </div>

        <!-- Monthly/Yearly Toggle -->
        <div class="flex justify-center mb-8">
            <div class="bg-white/20 backdrop-blur-sm rounded-full p-1 inline-flex">
                <button type="button" id="monthlyBtn" class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-200 pricing-toggle active">
                    <?= __tr('Monthly') ?>
                </button>
                <button type="button" id="yearlyBtn" class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-200 pricing-toggle">
                    <?= __tr('Yearly') ?>
                </button>
            </div>
        </div>

        <!-- Pricing Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6">
            
            <!-- Basic Plan -->
            <div class="bg-white rounded-2xl p-6 shadow-xl border-4 border-pink-500 relative">
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2"><?= __tr('Basic') ?></h2>
                    <div class="mb-3">
                        <span class="price-display text-4xl font-bold text-pink-600" data-monthly="9.99" data-yearly="99">$99</span>
                        <span class="period-display text-xl text-gray-600">/year</span>
                    </div>
                </div>
                
                <div class="space-y-2 mb-6 text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-pink-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('See who likes you') ?></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-pink-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Browse Incognito') ?></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-pink-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Priority in Search') ?></span>
                    </div>
                </div>
                
                <button type="button" class="upgrade-btn w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-200 transform hover:scale-105">
                    <?= __tr('Upgrade Now') ?>
                </button>
            </div>

            <!-- Plus Plan -->
            <div class="bg-white rounded-2xl p-6 shadow-xl border-4 border-purple-600 relative">
                <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                    <?= __tr('POPULAR') ?>
                </div>
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2"><?= __tr('Plus') ?></h2>
                    <div class="mb-3">
                        <span class="price-display text-4xl font-bold text-purple-600" data-monthly="19.99" data-yearly="199">$199</span>
                        <span class="period-display text-xl text-gray-600">/year</span>
                    </div>
                </div>
                
                <div class="space-y-2 mb-6 text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-purple-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Unlimited Chats') ?></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-purple-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Unlimited profile swipes') ?></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-purple-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Message users first') ?></span>
                    </div>
                </div>
                
                <button type="button" class="upgrade-btn w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-3 px-6 rounded-full transition-all duration-200 transform hover:scale-105">
                    <?= __tr('Upgrade Now') ?>
                </button>
            </div>

            <!-- Elite Plan -->
            <div class="bg-white rounded-2xl p-6 shadow-xl border-4 border-indigo-900 relative">
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2"><?= __tr('Elite') ?></h2>
                    <div class="mb-3">
                        <span class="price-display text-4xl font-bold text-indigo-900" data-monthly="29.99" data-yearly="279">$279</span>
                        <span class="period-display text-xl text-gray-600">/year</span>
                    </div>
                </div>
                
                <div class="space-y-2 mb-6 text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-indigo-900 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Unlimited \'Discover Me\' spotlights') ?></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-indigo-900 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Top placement in local searches') ?></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-indigo-900 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Read receipts on messages') ?></span>
                    </div>
                </div>
                
                <button type="button" class="upgrade-btn w-full bg-gradient-to-r from-indigo-900 to-indigo-950 hover:from-indigo-950 hover:to-black text-white font-bold py-3 px-6 rounded-full transition-all duration-200 transform hover:scale-105">
                    <?= __tr('Upgrade Now') ?>
                </button>
            </div>

        </div>

        <!-- Brand Footer -->
        <div class="text-center">
            <p class="text-white/80 text-sm mb-2"><?= __tr('Cancel anytime. Terms apply.') ?></p>
            <div class="flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                <span class="text-2xl font-bold text-white">loversnmore</span>
            </div>
        </div>

    </div>
</div>

<!-- Coming Soon Modal -->
<div id="comingSoonModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-8 max-w-sm w-full shadow-2xl transform transition-all">
        <div class="text-center">
            <div class="mb-4 flex justify-center">
                <svg class="w-16 h-16 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3"><?= __tr('Coming Soon!') ?></h3>
            <p class="text-gray-600 mb-6"><?= __tr('Premium subscriptions will be available soon. Stay tuned for updates!') ?></p>
            <button type="button" id="closeModalBtn" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-200">
                <?= __tr('Got it') ?>
            </button>
        </div>
    </div>
</div>

@lwPush('appScripts')
<script>
    $(document).ready(function() {
        let isYearly = true; // Default to yearly

        // Toggle between monthly and yearly
        $('.pricing-toggle').on('click', function() {
            $('.pricing-toggle').removeClass('active');
            $(this).addClass('active');
            
            isYearly = $(this).attr('id') === 'yearlyBtn';
            updateAllPrices();
        });

        // Update all price displays
        function updateAllPrices() {
            $('.price-display').each(function() {
                const $price = $(this);
                const monthly = parseFloat($price.data('monthly'));
                const yearly = parseFloat($price.data('yearly'));
                
                if (isYearly) {
                    $price.text('$' + yearly);
                } else {
                    $price.text('$' + monthly.toFixed(2));
                }
            });
            
            $('.period-display').text(isYearly ? '/year' : '/month');
        }

        // Upgrade button clicks - show coming soon modal
        $('.upgrade-btn').on('click', function() {
            $('#comingSoonModal').removeClass('hidden');
        });

        // Close modal
        $('#closeModalBtn').on('click', function() {
            $('#comingSoonModal').addClass('hidden');
        });

        // Close modal on backdrop click
        $('#comingSoonModal').on('click', function(e) {
            if (e.target === this) {
                $(this).addClass('hidden');
            }
        });
    });
</script>

<style>
    .pricing-toggle {
        background-color: transparent;
        color: white;
    }
    
    .pricing-toggle.active {
        background-color: rgb(79, 70, 229); /* indigo-600 for dark purple look */
        color: white;
    }
    
    .pricing-toggle:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
@lwPushEnd
