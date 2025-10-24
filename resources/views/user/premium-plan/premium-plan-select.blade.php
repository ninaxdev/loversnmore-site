<!-- Premium Plan Selection Page - Choose Your Plan -->
<div class="min-h-screen bg-gradient-to-br from-purple-600 via-purple-700 to-pink-600 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('user.premium_plan.read.view') }}" class="inline-flex items-center text-white hover:text-white/80 transition-colors">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="text-sm font-medium"><?= __tr('Back') ?></span>
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2"><?= __tr('Choose Your Plan') ?></h1>
            <p class="text-white/80 text-sm"><?= __tr('Select a plan that works best for you') ?></p>
        </div>

        <!-- Monthly/Yearly Toggle -->
        <div class="flex justify-center mb-8">
            <div class="bg-white/20 backdrop-blur-sm rounded-full p-1 inline-flex">
                <button type="button" id="monthlyPlanBtn" class="px-8 py-2 rounded-full font-medium transition-all duration-200 plan-toggle active">
                    <?= __tr('Monthly') ?>
                </button>
                <button type="button" id="yearlyPlanBtn" class="px-8 py-2 rounded-full font-medium transition-all duration-200 plan-toggle">
                    <?= __tr('Yearly') ?>
                </button>
            </div>
        </div>

        <!-- Premium Plan Card -->
        <div class="bg-white rounded-3xl p-8 shadow-2xl mb-6">
            <!-- Plan Title -->
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900 mb-2"><?= __tr('Premium') ?></h2>
                <div id="planPrice" class="mb-1">
                    <span id="priceAmount" class="text-5xl font-bold text-pink-600">$9.99</span><span id="pricePeriod" class="text-2xl text-gray-600">/month</span>
                </div>
            </div>

            <hr class="border-gray-200 mb-6">

            <!-- Features -->
            <div class="mb-8">
                <h3 class="text-gray-900 font-semibold mb-4"><?= __tr('Unlock all the premium features:') ?></h3>
                <div class="space-y-3">
                    <!-- See who likes you -->
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-pink-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('See who likes you') ?></span>
                    </div>

                    <!-- Browse incognito -->
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-pink-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Browse incognito') ?></span>
                    </div>

                    <!-- Priority in matches -->
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-pink-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Priority in matches') ?></span>
                    </div>

                    <!-- Premium badge -->
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-pink-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('Premium badge') ?></span>
                    </div>

                    <!-- No Ads -->
                    <!-- <div class="flex items-center">
                        <svg class="w-6 h-6 text-pink-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                        <span class="text-gray-700"><?= __tr('No Ads') ?></span>
                    </div> -->

                    @if(!__isEmpty($premiumPlanData['premiumFeature']))
              
                    @foreach($premiumPlanData['premiumFeature'] as $featureKey => $feature)
                    @if(isset($feature['enable']) && $feature['enable'] && $feature['select_user'] != 1)
                    @if($feature['title'] != 'Video Call Via Messenger' && $feature['title'] != 'Audio Call Via Messenger')
                    <div class="flex items-center">
                        <div class="w-6 h-6 mr-3 flex-shrink-0 flex items-center justify-center text-pink-500">
                            <?= $feature['icon'] ?>
                        </div>
                        <span class="text-gray-700"><?= $feature['title'] ?></span>
                    </div>
                    @endif
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>

            <!-- Continue Button -->
            <button type="button" id="continuePremiumBtn" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-bold text-lg py-4 px-6 rounded-full shadow-lg transition-all duration-200 transform hover:scale-[1.02]">
                <?= __tr('Continue') ?>
            </button>
        </div>

        <!-- Info Message -->
        <div class="text-center">
            <p class="text-white/80 text-sm"><?= __tr('Cancel anytime. Terms apply.') ?></p>
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
        // Pricing data
        const pricingPlans = {
            monthly: {
                amount: '$9.99',
                period: '/month'
            },
            yearly: {
                amount: '$99.99',
                period: '/year'
            }
        };

        let currentPlan = 'monthly';

        // Toggle between monthly and yearly
        $('.plan-toggle').on('click', function() {
            $('.plan-toggle').removeClass('active');
            $(this).addClass('active');
            
            if ($(this).attr('id') === 'monthlyPlanBtn') {
                currentPlan = 'monthly';
            } else {
                currentPlan = 'yearly';
            }
            
            updatePricing();
        });

        // Update pricing display
        function updatePricing() {
            const plan = pricingPlans[currentPlan];
            $('#priceAmount').text(plan.amount);
            $('#pricePeriod').text(plan.period);
        }

        // Continue button - show coming soon modal
        $('#continuePremiumBtn').on('click', function() {
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
    .plan-toggle {
        background-color: transparent;
        color: white;
    }
    
    .plan-toggle.active {
        background-color: white;
        color: #7c3aed; /* purple-600 */
    }
    
    .plan-toggle:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
@lwPushEnd
