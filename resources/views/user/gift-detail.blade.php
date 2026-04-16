@section('page-title', __tr('Gift Received'))
@section('head-title', __tr('Gift Received'))
@section('keywordName', __tr('Gift Received'))
@section('keyword', __tr('Gift Received'))
@section('description', __tr('Gift Received'))
@section('keywordDescription', __tr('Gift Received'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-lg mx-auto">

        <!-- Back Link -->
        <div class="mb-6">
            <a href="/home" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Back') ?>
            </a>
        </div>

        <!-- Card -->
        <div class="rounded-3xl p-6 md:p-8" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">

            <!-- Sender Info -->
            @if($sender)
            <div class="flex items-center gap-4 mb-6">
                <a href="<?= route('user.profile_view', ['username' => $sender->username]) ?>" class="lw-ajax-link-action lw-action-with-url flex-shrink-0">
                    <img src="<?= imageOrNoImageAvailable($senderProfilePicUrl) ?>" alt="<?= e($sender->first_name) ?>"
                         class="w-16 h-16 rounded-full object-cover" style="border: 2px solid #7C3AED; background-color: #E9D8FD;">
                </a>
                <div>
                    <a href="<?= route('user.profile_view', ['username' => $sender->username]) ?>" class="lw-ajax-link-action lw-action-with-url" style="text-decoration: none;">
                        <p class="text-lg font-semibold" style="color: #1F1638;">
                            <?= e($sender->first_name . ' ' . $sender->last_name) ?>
                        </p>
                    </a>
                    <p class="text-sm" style="color: #6B7280;">@<?= e($sender->username) ?></p>
                </div>
            </div>
            @endif

            <!-- Divider -->
            <hr style="border-color: #E9D8FD; margin-bottom: 1.5rem;">

            <!-- Gift Icon & Title -->
            <div class="text-center mb-6">
                <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-3" style="background: linear-gradient(135deg, #7C3AED, #EC4899);">
                    <i class="fas fa-gift text-3xl text-white"></i>
                </div>
                @if($gift->item)
                <p class="text-xl font-bold" style="color: #1F1638;"><?= e($gift->item->title ?? __tr('Gift')) ?></p>
                @endif
                <p class="text-sm mt-1" style="color: #6B7280;">
                    <?= __tr('Sent') ?> <?= $gift->created_at ? $gift->created_at->diffForHumans() : '' ?>
                </p>
            </div>

            <!-- Message -->
            @if($messageText)
            <div class="rounded-2xl p-4 mb-6" style="background-color: #EDE9FE; border-left: 4px solid #7C3AED;">
                <p class="text-sm font-medium mb-1" style="color: #7C3AED;">
                    <i class="fas fa-comment-dots mr-1"></i> <?= __tr('Message') ?>
                </p>
                <p class="text-base" style="color: #1F1638;"><?= e($messageText) ?></p>
            </div>
            @endif

            <!-- Action Buttons -->
            @if($gift->recipient_action === 'pending')
            <div class="space-y-3" id="lwGiftActionButtons">

                <!-- Thank You -->
                <button onclick="lwGiftAction('thank-you')"
                    class="w-full py-3 rounded-full font-semibold text-white transition-all duration-200 hover:opacity-90 hover:scale-105"
                    style="background: linear-gradient(135deg, #7C3AED, #6D28D9); font-family: 'Poppins', sans-serif; font-size: 16px; box-shadow: 0 4px 14px rgba(124,58,237,0.35); border: none; cursor: pointer;">
                    <i class="fas fa-heart mr-2"></i><?= __tr('Thank You') ?>
                </button>

                <!-- Start Chat -->
                <button onclick="lwGiftAction('start-chat')"
                    class="w-full py-3 rounded-full font-semibold text-white transition-all duration-200 hover:opacity-90 hover:scale-105"
                    style="background: linear-gradient(135deg, #EC4899, #DB2777); font-family: 'Poppins', sans-serif; font-size: 16px; box-shadow: 0 4px 14px rgba(236,72,153,0.35); border: none; cursor: pointer;">
                    <i class="fas fa-comments mr-2"></i><?= __tr('Start Chat') ?>
                </button>

                <!-- Ignore -->
                <button onclick="lwGiftAction('ignore')"
                    class="w-full py-3 rounded-full font-semibold transition-all duration-200 hover:opacity-70"
                    style="background: transparent; border: 2px solid #D1D5DB; color: #6B7280; font-family: 'Poppins', sans-serif; font-size: 16px; cursor: pointer;">
                    <?= __tr('Ignore') ?>
                </button>

            </div>
            @else
            <!-- Already Actioned -->
            <div class="text-center py-4">
                @if($gift->recipient_action === 'thanked')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium" style="background-color: #EDE9FE; color: #7C3AED;">
                        <i class="fas fa-heart"></i> <?= __tr('You thanked them') ?>
                    </span>
                @elseif($gift->recipient_action === 'chatted')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium" style="background-color: #FCE7F3; color: #DB2777;">
                        <i class="fas fa-comments"></i> <?= __tr('Chat started') ?>
                    </span>
                @elseif($gift->recipient_action === 'ignored')
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium" style="background-color: #F3F4F6; color: #6B7280;">
                        <?= __tr('Ignored') ?>
                    </span>
                @endif
            </div>
            @endif


        </div><!-- /.card -->

    </div>
</div>

<script>
var lwGiftUId = '<?= $gift->_uid ?>';
var lwGiftActionRoutes = {
    'thank-you': '<?= route("user.write.gift_thank_you", ["giftUId" => $gift->_uid]) ?>',
    'start-chat': '<?= route("user.write.gift_start_chat", ["giftUId" => $gift->_uid]) ?>',
    'ignore':     '<?= route("user.write.gift_ignore",    ["giftUId" => $gift->_uid]) ?>'
};

function lwGiftAction(action) {
    var url = lwGiftActionRoutes[action];
    if (!url) return;

    // Show loading state
    var buttons = document.getElementById('lwGiftActionButtons');
    if (buttons) {
        buttons.style.opacity = '0.5';
        buttons.style.pointerEvents = 'none';
    }

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            _token: '<?= csrf_token() ?>'
        },
        success: function(response) {
            if (response.reaction == 1) {
                if (action === 'start-chat') {
                    var senderId = response.data && response.data.sender_id ? response.data.sender_id : null;
                    getChatMessenger('<?= route("user.read.all_conversation") ?>', true);
                    $('#messengerDialog').modal('show');

                    if (senderId) {
                        var attempts = 0;
                        var autoClick = setInterval(function() {
                            var $userItem = $('#' + senderId + '.lw-user-chat-list');
                            if ($userItem.length) {
                                clearInterval(autoClick);
                                $userItem.trigger('click');
                            } else if (++attempts > 30) {
                                clearInterval(autoClick);
                            }
                        }, 100);
                    }
                } else {
                    showSuccessMessage(response.message || '<?= __tr("Done!") ?>');
                    setTimeout(function() { location.reload(); }, 800);
                }
            } else {
                if (buttons) {
                    buttons.style.opacity = '1';
                    buttons.style.pointerEvents = 'auto';
                }
                showErrorMessage(response.message || '<?= __tr("Something went wrong.") ?>');
            }
        },
        error: function(xhr) {
            if (buttons) {
                buttons.style.opacity = '1';
                buttons.style.pointerEvents = 'auto';
            }
            var msg = (xhr.responseJSON && xhr.responseJSON.message)
                ? xhr.responseJSON.message
                : '<?= __tr("Something went wrong. Please try again.") ?>';
            showErrorMessage(msg);
        }
    });
}

function lwBlockReport(type, userUid) {
    if (type === 'block') {
        // Trigger existing block user flow
        if (typeof lwBlockUser === 'function') {
            lwBlockUser(userUid);
        } else {
            $.ajax({
                url: '<?= route("user.write.block_user") ?>',
                method: 'POST',
                data: { _token: '<?= csrf_token() ?>', to_user_uid: userUid },
                success: function(response) {
                    if (response.reaction == 1) {
                        __Utils.toast('<?= __tr("User blocked.") ?>', 'success');
                        _.delay(function() { window.location.href = '/home'; }, 800);
                    }
                }
            });
        }
    } else {
        // Trigger existing report user flow - link to their profile
        window.location.href = '<?= url("/") ?>/' + userUid + '/profile-view';
    }
}
</script>
