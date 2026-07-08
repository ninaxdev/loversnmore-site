@section('page-title', __tr('Membership'))
@section('head-title', __tr('Membership'))
@section('keywordName', __tr('Membership'))
@section('keyword', __tr('Membership'))
@section('description', __tr('Membership'))
@section('keywordDescription', __tr('Membership'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Membership Settings Page -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-2xl mx-auto">
        <!-- Back to Home Link -->
        <div class="mb-6">
            <a href="/home" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Back') ?>
            </a>
        </div>

        <!-- Membership Title -->
        <h1 class="text-4xl font-bold mb-8" style="color: #1F1638;"><?= __tr('Membership') ?></h1>

        <!-- Current Plan Section -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4" style="color: #1F1638;"><?= __tr('Current Plan') ?></h2>

            @if($isPremiumUser && $subscription)
                <!-- Active Premium Plan Card -->
                <div class="py-6 px-6 rounded-3xl mb-4" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-xl font-bold" style="color: #1F1638;">
                            {{ $subscription['planName'] }} <?= __tr('Plan') ?>
                        </h3>
                        @if($subscription['cancelAtPeriodEnd'])
                            <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background-color: #FEF3C7; color: #92400E;">
                                <?= __tr('Cancelling') ?>
                            </span>
                        @else
                            <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background-color: #D1FAE5; color: #065F46;">
                                <?= __tr('Active') ?>
                            </span>
                        @endif
                    </div>
                    <div class="space-y-1 text-sm" style="color: #5B3E96; font-family: 'Poppins', sans-serif;">
                        @if($subscription['planPrice'])
                            <div>
                                <strong><?= __tr('Price') ?>:</strong>
                                ${{ number_format($subscription['planPrice'], 2) }}
                                /{{ $subscription['planInterval'] === 'year' ? __tr('year') : __tr('month') }}
                            </div>
                        @endif
                        @if($subscription['expiryAt'])
                            <div>
                                @if($subscription['cancelAtPeriodEnd'])
                                    <strong><?= __tr('Access until') ?>:</strong> {{ $subscription['expiryAt'] }}
                                @else
                                    <strong><?= __tr('Renews') ?>:</strong> {{ $subscription['expiryAt'] }}
                                @endif
                            </div>
                        @endif
                    </div>
                    @if($subscription['cancelAtPeriodEnd'])
                        <p class="mt-3 text-xs" style="color: #92400E;">
                            <?= __tr('Your subscription is set to cancel. You will retain access until the date above.') ?>
                        </p>
                    @endif
                </div>
            @else
                <!-- Free Plan Card -->
                <div class="py-6 px-6 rounded-3xl mb-4" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                    <h3 class="text-xl font-bold mb-2" style="color: #1F1638;"><?= __tr('Free Plan') ?></h3>
                    <div class="flex justify-between items-center text-base" style="color: #1F1638; font-family: 'Poppins', sans-serif;">
                        <span><strong><?= __tr('Status') ?>:</strong> <?= __tr('Active') ?></span>
                        <span><strong><?= __tr('Renews') ?>:</strong> <?= __tr('N/A') ?></span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4">
            @if($isPremiumUser && $subscription)

                <!-- Change Plan -->
                <a href="{{ route('user.premium_plan.read.select_plan') }}" class="lw-ajax-link-action lw-action-with-url w-full py-4 px-6 rounded-full font-semibold text-lg text-white text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl block" style="background-color: #5B3E96; font-family: 'Poppins', sans-serif; box-shadow: 0 4px 14px rgba(91, 62, 150, 0.35); border: none; cursor: pointer; text-decoration: none;">
                    <i class="fas fa-exchange-alt mr-2"></i><?= __tr('Change Plan') ?>
                </a>

                @if($subscription['hasStripeSubscription'])
                    @if($subscription['cancelAtPeriodEnd'])
                        <!-- Resume Subscription -->
                        <form method="POST" action="{{ route('user.premium_plan.resume') }}">
                            @csrf
                            <button type="submit" class="w-full py-4 px-6 rounded-full font-semibold text-lg text-center transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: #F8F4FF; color: #5B3E96; font-family: 'Poppins', sans-serif; border: 1px solid #E9D8FD; cursor: pointer;">
                                <i class="fas fa-redo mr-2"></i><?= __tr('Resume Subscription') ?>
                            </button>
                        </form>
                    @else
                        <!-- Cancel Subscription -->
                        <form method="POST" action="{{ route('user.premium_plan.cancel') }}" onsubmit="return confirm('<?= __tr('Cancel your subscription? You will keep access until the current period ends.') ?>')">
                            @csrf
                            <button type="submit" class="w-full py-4 px-6 rounded-full font-semibold text-lg text-center transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: #F8F4FF; color: #5B3E96; font-family: 'Poppins', sans-serif; border: 1px solid #E9D8FD; cursor: pointer;">
                                <i class="fas fa-times-circle mr-2"></i><?= __tr('Cancel Subscription') ?>
                            </button>
                        </form>
                    @endif

                    <!-- Manage Billing (Stripe Portal) -->
                    <form method="POST" action="{{ route('user.premium_plan.portal') }}">
                        @csrf
                        <button type="submit" class="w-full py-4 px-6 rounded-full font-semibold text-lg text-center transition-all duration-300 hover:scale-105 hover:shadow-lg" style="background-color: #F8F4FF; color: #5B3E96; font-family: 'Poppins', sans-serif; border: 1px solid #E9D8FD; cursor: pointer;">
                            <i class="fas fa-credit-card mr-2"></i><?= __tr('Manage Billing') ?>
                        </button>
                    </form>
                @endif

                <!-- View Invoices -->
                <a href="{{ route('user.premium_plan.invoices') }}" class="lw-ajax-link-action lw-action-with-url w-full py-4 px-6 rounded-full font-semibold text-lg text-center transition-all duration-300 hover:scale-105 hover:shadow-lg block" style="background-color: #F8F4FF; color: #5B3E96; font-family: 'Poppins', sans-serif; border: 1px solid #E9D8FD; text-decoration: none;">
                    <i class="fas fa-file-invoice mr-2"></i><?= __tr('View Invoices') ?>
                </a>

            @else

                <!-- Go Premium -->
                <a href="{{ route('user.premium_plan.read.view') }}" class="lw-ajax-link-action lw-action-with-url w-full py-4 px-6 rounded-full font-semibold text-lg text-white text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl block" style="background-color: #5B3E96; font-family: 'Poppins', sans-serif; box-shadow: 0 4px 14px rgba(91, 62, 150, 0.35); border: none; cursor: pointer; text-decoration: none;">
                    <i class="fas fa-crown mr-2"></i><?= __tr('Go Premium') ?>
                </a>

            @endif
        </div>

        @if(session('success'))
            <div class="mt-6 p-4 rounded-2xl text-sm font-medium" style="background-color: #D1FAE5; color: #065F46;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mt-6 p-4 rounded-2xl text-sm font-medium" style="background-color: #FEE2E2; color: #991B1B;">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
