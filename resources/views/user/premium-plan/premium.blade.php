<!-- Premium Plan Page -->
<div class="min-h-screen py-10 px-4" style="background: #ffffff; font-family: 'Poppins', sans-serif;">
    <div class="max-w-md mx-auto">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-3">
                <svg class="w-8 h-8 mr-2" style="color: #e91e8c;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                <span class="text-2xl font-bold" style="color: #1a0a3c;">loversnmore</span>
            </div>
            <h1 class="text-4xl font-bold mb-1" style="color: #1a0a3c;"><?= __tr('Premium') ?></h1>
            <p class="text-sm" style="color: #6b7280;"><?= __tr('Unlock all features and find your match faster') ?></p>

            @if($premiumPlanData['isPremiumUser'])
            <div class="mt-4 rounded-2xl p-4" style="background: #f5f0ff; border: 2px solid #c084fc;">
                <p class="text-sm mb-1" style="color: #1a0a3c;"><?= __tr('Current Plan') ?>: <span class="font-semibold"><?= $premiumPlanData['userSubscriptionData']['planTitle'] ?></span></p>
                <p class="text-sm" style="color: #1a0a3c;"><?= __tr('Expires') ?>: <span class="font-semibold"><?= $premiumPlanData['userSubscriptionData']['expiry_at'] ?></span></p>
            </div>
            @endif
        </div>

        <!-- Premium Features -->
        <div class="space-y-3 mb-8">

            <div class="flex items-center rounded-2xl p-4 shadow-sm" style="background: #ffffff; border: 1.5px solid #f0f0f0;">
                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4" style="background: #e91e8c;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <h3 class="font-semibold" style="color: #1a0a3c;"><?= __tr('Priority in search results') ?></h3>
            </div>

            <div class="flex items-center rounded-2xl p-4 shadow-sm" style="background: #ffffff; border: 1.5px solid #f0f0f0;">
                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4" style="background: #7c3aed;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </div>
                <h3 class="font-semibold" style="color: #1a0a3c;"><?= __tr('Browse incognito') ?></h3>
            </div>

            <div class="flex items-center rounded-2xl p-4 shadow-sm" style="background: #ffffff; border: 1.5px solid #f0f0f0;">
                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4" style="background: #e91e8c;">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="font-semibold" style="color: #1a0a3c;"><?= __tr('See who likes you') ?></h3>
            </div>

            <div class="flex items-center rounded-2xl p-4 shadow-sm" style="background: #ffffff; border: 1.5px solid #f0f0f0;">
                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4" style="background: #7c3aed;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h3 class="font-semibold" style="color: #1a0a3c;"><?= __tr('Premium badge') ?></h3>
            </div>

            <div class="flex items-center rounded-2xl p-4 shadow-sm" style="background: #ffffff; border: 1.5px solid #f0f0f0;">
                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4" style="background: #e91e8c;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold" style="color: #1a0a3c;"><?= __tr('Choose duration for plans') ?></h3>
            </div>

        </div>

        <!-- CTA Button -->
        <button type="button" id="lwBuyPremiumPlanBtn"
                class="w-full font-bold text-lg py-4 px-6 rounded-full text-white transition-all duration-200 hover:opacity-90 hover:scale-[1.02] transform"
                style="background: var(--lw-gradient-main); box-shadow: 0 4px 20px rgba(124,58,237,0.35);">
            <?= __tr('Be Premium Now') ?>
        </button>

        <p class="text-center text-sm mt-4" style="color: #9ca3af;"><?= __tr('Cancel anytime. Terms apply.') ?></p>

    </div>
</div>

@lwPush('appScripts')
<script>
    $(document).ready(function() {
        $("#lwBuyPremiumPlanBtn").on('click', function() {
            window.location.href = '<?= route('user.premium_plan.read.select_plan') ?>';
        });
    });
</script>
@lwPushEnd
