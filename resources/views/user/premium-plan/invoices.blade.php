@section('page-title', __tr('Billing History'))
@section('head-title', __tr('Billing History'))
@section('keywordName', __tr('Billing History'))
@section('keyword', __tr('Billing History'))
@section('description', __tr('Billing History'))
@section('keywordDescription', __tr('Billing History'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Billing History Page -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-2xl mx-auto">

        <!-- Back Link -->
        <div class="mb-6">
            <a href="{{ route('user.settings.membership') }}" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Back') ?>
            </a>
        </div>

        <!-- Page Title -->
        <h1 class="text-4xl font-bold mb-8" style="color: #1F1638;"><?= __tr('Billing History') ?></h1>

        @if(!empty($invoices))

            <!-- Invoice List -->
            <div class="space-y-3">
                @foreach($invoices as $invoice)
                    <div class="py-5 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                        <div class="flex items-center justify-between flex-wrap gap-3">
                            <div>
                                <p class="font-semibold text-base" style="color: #1F1638;">
                                    ${{ $invoice['amount'] }} {{ $invoice['currency'] }}
                                </p>
                                <p class="text-sm mt-1" style="color: #6B7280;">
                                    {{ $invoice['date'] }}
                                    @if($invoice['number'])
                                        &nbsp;·&nbsp; {{ $invoice['number'] }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                <!-- Status Badge -->
                                @if($invoice['status'] === 'paid')
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background-color: #D1FAE5; color: #065F46;">
                                        <?= __tr('Paid') ?>
                                    </span>
                                @elseif($invoice['status'] === 'open')
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background-color: #FEF3C7; color: #92400E;">
                                        <?= __tr('Open') ?>
                                    </span>
                                @else
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background-color: #F3F4F6; color: #6B7280;">
                                        {{ ucfirst($invoice['status']) }}
                                    </span>
                                @endif

                                <!-- PDF Download -->
                                @if($invoice['pdf_url'])
                                    <a href="{{ $invoice['pdf_url'] }}" target="_blank" rel="noopener" class="inline-flex items-center text-sm font-semibold transition-all duration-200 hover:opacity-70" style="color: #5B3E96; text-decoration: none;">
                                        <i class="fas fa-download mr-1"></i>
                                        <?= __tr('PDF') ?>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else

            <!-- Empty State -->
            <div class="py-12 px-6 rounded-3xl text-center" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <i class="fas fa-file-invoice text-4xl mb-4" style="color: #C4B5FD;"></i>
                <h3 class="text-lg font-semibold mb-2" style="color: #1F1638;"><?= __tr('No invoices yet') ?></h3>
                <p class="text-sm" style="color: #6B7280;"><?= __tr('Your billing history will appear here once you subscribe.') ?></p>
            </div>

        @endif

    </div>
</div>
