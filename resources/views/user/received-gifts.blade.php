@section('page-title', __tr('My Gifts'))
@section('head-title', __tr('My Gifts'))
@section('keywordName', __tr('My Gifts'))
@section('keyword', __tr('My Gifts'))
@section('description', __tr('My Gifts'))
@section('keywordDescription', __tr('My Gifts'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-2xl mx-auto">

        <!-- Back Link -->
        <div class="mb-6">
            <a href="/home" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Back') ?>
            </a>
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold mb-6" style="color: #1F1638;"><?= __tr('My Gifts') ?></h1>

        @if(!empty($giftsData))
        <div class="space-y-4">
            @foreach($giftsData as $gift)
            <a href="<?= $gift['detailUrl'] ?>" class="lw-ajax-link-action lw-action-with-url block rounded-3xl p-4 transition-all duration-200 hover:shadow-lg" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; text-decoration: none;">
                <div class="flex items-center gap-4">

                    <!-- Sender Photo -->
                    @if($gift['sender'])
                    <div class="flex-shrink-0">
                        <img src="<?= $gift['sender']['profilePicUrl'] ?>"
                             alt="<?= e($gift['sender']['name']) ?>"
                             class="w-14 h-14 rounded-full object-cover"
                             style="border: 2px solid #C4B5FD; background-color: #E9D8FD;">
                    </div>
                    @else
                    <div class="flex-shrink-0 w-14 h-14 rounded-full flex items-center justify-center" style="background-color: #E9D8FD;">
                        <i class="fas fa-user text-xl" style="color: #7C3AED;"></i>
                    </div>
                    @endif

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                            <p class="font-semibold truncate" style="color: #1F1638;">
                                @if($gift['sender'])
                                    <?= e($gift['sender']['name']) ?>
                                @else
                                    <?= __tr('Unknown') ?>
                                @endif
                            </p>
                            <!-- Status Badge -->
                            @if($gift['recipientAction'] === 'pending')
                                <span class="flex-shrink-0 text-xs px-3 py-1 rounded-full font-medium" style="background-color: #FEF3C7; color: #92400E;">
                                    <?= __tr('New') ?>
                                </span>
                            @elseif($gift['recipientAction'] === 'thanked')
                                <span class="flex-shrink-0 text-xs px-3 py-1 rounded-full font-medium" style="background-color: #EDE9FE; color: #7C3AED;">
                                    <i class="fas fa-heart mr-1"></i><?= __tr('Thanked') ?>
                                </span>
                            @elseif($gift['recipientAction'] === 'chatted')
                                <span class="flex-shrink-0 text-xs px-3 py-1 rounded-full font-medium" style="background-color: #FCE7F3; color: #DB2777;">
                                    <i class="fas fa-comments mr-1"></i><?= __tr('Chatted') ?>
                                </span>
                            @elseif($gift['recipientAction'] === 'ignored')
                                <span class="flex-shrink-0 text-xs px-3 py-1 rounded-full font-medium" style="background-color: #F3F4F6; color: #6B7280;">
                                    <?= __tr('Ignored') ?>
                                </span>
                            @endif
                        </div>

                        <p class="text-sm mt-0.5" style="color: #7C3AED;">
                            <i class="fas fa-gift mr-1"></i><?= e($gift['giftName']) ?>
                        </p>

                        @if($gift['messageText'])
                        <p class="text-sm mt-1 truncate" style="color: #6B7280;">
                            <i class="fas fa-comment-dots mr-1"></i><?= e($gift['messageText']) ?>
                        </p>
                        @endif

                        <p class="text-xs mt-1" style="color: #9CA3AF;">
                            <?= $gift['createdAt'] ? $gift['createdAt']->diffForHumans() : '' ?>
                        </p>
                    </div>

                    <i class="fas fa-chevron-right flex-shrink-0" style="color: #C4B5FD;"></i>
                </div>
            </a>
            @endforeach
        </div>

        @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: #EDE9FE;">
                <i class="fas fa-gift text-4xl" style="color: #C4B5FD;"></i>
            </div>
            <p class="text-lg font-medium mb-1" style="color: #1F1638;"><?= __tr('No gifts yet') ?></p>
            <p class="text-sm" style="color: #9CA3AF;"><?= __tr('When someone sends you a gift, it will appear here.') ?></p>
        </div>
        @endif

    </div>
</div>
