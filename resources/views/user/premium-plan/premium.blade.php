<!-- Premium Plan Page - Modern UI -->
<div class="min-h-screen bg-gradient-to-br from-purple-600 via-purple-700 to-pink-600 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        
        <!-- Logo and Premium Badge -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-pink-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                <h2 class="text-2xl font-bold text-white">loversnmore</h2>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Premium</h1>
            
            @if($premiumPlanData['isPremiumUser'])
            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4 mt-4">
                <p class="text-white text-sm mb-2"><?= __tr('Current Plan') ?>: <span class="font-semibold"><?= $premiumPlanData['userSubscriptionData']['planTitle'] ?></span></p>
                <p class="text-white text-sm"><?= __tr('Expires') ?>: <span class="font-semibold"><?= $premiumPlanData['userSubscriptionData']['expiry_at'] ?></span></p>
            </div>
            @endif
        </div>

        <!-- Premium Features -->
        <div class="space-y-4 mb-8">
            <!-- Priority in search results -->
            <div class="flex items-start bg-white/10 backdrop-blur-sm rounded-lg p-4">
                <svg class="w-6 h-6 text-white mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <div>
                    <h3 class="text-white font-semibold"><?= __tr('Priority in search results') ?></h3>
                </div>
            </div>

            <!-- Browse incognito -->
            <div class="flex items-start bg-white/10 backdrop-blur-sm rounded-lg p-4">
                <svg class="w-6 h-6 text-white mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                </svg>
                <div>
                    <h3 class="text-white font-semibold"><?= __tr('Browse incognito') ?></h3>
                </div>
            </div>

            <!-- See who likes you -->
            <div class="flex items-start bg-white/10 backdrop-blur-sm rounded-lg p-4">
                <svg class="w-6 h-6 text-white mr-4 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-white font-semibold"><?= __tr('See who likes you') ?></h3>
                </div>
            </div>

            <!-- Premium badge -->
            <div class="flex items-start bg-white/10 backdrop-blur-sm rounded-lg p-4">
                <svg class="w-6 h-6 text-white mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                <div>
                    <h3 class="text-white font-semibold"><?= __tr('Premium badge') ?></h3>
                </div>
            </div>

            <!-- Choose duration for plans -->
            <div class="flex items-start bg-white/10 backdrop-blur-sm rounded-lg p-4">
                <svg class="w-6 h-6 text-white mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="text-white font-semibold"><?= __tr('Choose duration for plans') ?></h3>
                </div>
            </div>
        </div>

        <!-- Be Premium Now Button -->
        <button type="button" id="lwBuyPremiumPlanBtn" class="w-full bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-bold text-lg py-4 px-6 rounded-full shadow-lg transition-all duration-200 transform hover:scale-[1.02]">
            <?= __tr('Be Premium Now') ?>
        </button>

    </div>
</div>

@lwPush('appScripts')
<script>
    $(document).ready(function() {
        //buy premium plan button - redirect to plan selection screen
        $("#lwBuyPremiumPlanBtn").on('click', function() {
            window.location.href = '<?= route('user.premium_plan.read.select_plan') ?>';
        });
    });
</script>
@lwPushEnd
