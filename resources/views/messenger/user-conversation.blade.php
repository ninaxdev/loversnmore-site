<div class="flex flex-col h-full" style="min-height: 600px;">
    <!-- Chat Header -->
    <div class="p-6 border-b" style="border-color: var(--lw-border);">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4 flex-1">
                <div class="relative">
                    <img data-src="<?= imageOrNoImageAvailable($userData['profile_picture_image']) ?>" 
                         class="w-14 h-14 rounded-full object-cover lw-lazy-img lw-photoswipe-gallery-img" 
                         alt="<?= $userData['full_name'] ?>">
                    <div class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full border-2 border-white" 
                         style="background: var(--lw-success);"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="lw-heading-4 truncate"><?= $userData['full_name'] ?></h3>
                    <p class="lw-small-text truncate" style="color: var(--lw-gray-600);">
                        <?= Str::limit($userData['about_me'], 30) ?>
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                @if(getStoreSettings('allow_pusher') and getStoreSettings('allow_agora'))
                @if(getFeatureSettings('audio_call_via_messenger'))
                <!-- Audio Call Button -->
                <button class="lw-btn-icon lw-audio-video-btns" style="display: none;" id="lwAudioCallDisableBtn" disabled>
                    <i class="fas fa-phone-alt" title="<?= __tr('Audio Call') ?>"></i>
                </button>
                <button class="lw-btn-icon-gradient lw-audio-video-btns" style="display: none;" 
                        type="button" id="lwAudioCallBtn" 
                        data-user-uid="<?= $userData['user_uid'] ?>" 
                        data-call-type="audio" 
                        data-confirm="#lwCallErrorContainer" 
                        title="<?= __tr('Audio Call') ?>">
                    <i class="fas fa-phone-alt"></i>
                </button>
                @endif

                @if(getFeatureSettings('video_call_via_messenger'))
                <!-- Video Call Button -->
                <button class="lw-btn-icon lw-audio-video-btns" style="display: none;" id="lwVideoCallDisableBtn" disabled>
                    <i class="fas fa-video" title="<?= __tr('Video Call') ?>"></i>
                </button>
                <button class="lw-btn-icon-gradient lw-audio-video-btns" style="display: none;" 
                        type="button" id="lwVideoCallBtn" 
                        data-user-uid="<?= $userData['user_uid'] ?>" 
                        data-call-type="video" 
                        data-confirm="#lwCallErrorContainer" 
                        title="<?= __tr('Video Call') ?>">
                    <i class="fas fa-video"></i>
                </button>
                @endif
                @endif

                <!-- Menu Dropdown -->
                <div class="lw-messenger-user-menu relative">
                    <div class="dropdown">
                        <button class="lw-btn-icon dropdown-toggle" type="button" id="dropdownMenu2" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <!-- Delete all chat button -->
                            <a class="dropdown-item lw-disable-link" id="lwDeleteAllChatDisableButton" style="cursor: not-allowed; opacity: 0.5;">
                                <i class="fas fa-trash mr-2"></i> <?= __tr('Delete All Chat') ?>
                            </a>
                            <a class="dropdown-item lw-ajax-link-action" id="lwDeleteAllChatActiveButton" 
                               href="<?= route('user.write.delete_all_messages', ['userId' => $userData['user_id']]) ?>" 
                               data-method="post" 
                               data-callback="userChatResponse" 
                               data-post-data='<?= json_encode(['to_user_id' => $userData['user_id']]) ?>' 
                               type="button">
                                <i class="fas fa-trash mr-2"></i> <?= __tr('Delete All Chat') ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Messages Area -->
    <div class="lw-messenger-chat-window flex-1 overflow-y-auto p-6 space-y-4" style="max-height: 400px; background: var(--lw-light-gray);">
        @if(!__isEmpty($userConversations))
        @foreach($userConversations as $conversation)
        @php
            $deleteActionUrl = route('user.write.delete_message', ['chatId' => $conversation['message_id'], 'userId' => $userData['user_id']]);
        @endphp

        @if($conversation['is_message_received'])
        <!-- Received Message -->
        <div class="flex items-start gap-3">
            <img data-src="<?= imageOrNoImageAvailable($userData['profile_picture_image']) ?>" 
                 class="w-10 h-10 rounded-full object-cover lw-lazy-img lw-photoswipe-gallery-img flex-shrink-0" 
                 alt="<?= $userData['full_name'] ?>">
            
            <div class="flex-1">
                @if($conversation['type'] == 1)
                <!-- Text Message -->
                <div class="lw-message-bubble lw-message-received group relative max-w-md" data-message-id="<?= $conversation['chat_id'] ?>"  data-read="{{ $conversation['status'] == 1 ? 'true' : 'false' }}">
                    <p class="lw-body-text mb-1"><?= $conversation['message'] ?></p>
                    <span class="lw-small-text block" style="color: var(--lw-gray-500);">
                        <?= $conversation['created_on'] ?>
                    </span>
                    <a class="lw-message-delete-btn lw-ajax-link-action"
                            href="{{ $deleteActionUrl }}"
                            data-method="post"
                            data-callback="userChatResponse">
                        <i class="fas fa-times"></i>
                        </a>
                </div>
                @elseif($conversation['type'] == 2 or $conversation['type'] == 8 or $conversation['type'] == 12)
                <!-- Image/Sticker/GIF Message -->
                <div class="lw-message-bubble lw-message-received group relative max-w-sm" data-message-id="<?= $conversation['chat_id'] ?>" data-read="true">
                    <img class="chat-lazy-item rounded-lg" data-src="<?= $conversation['message'] ?>" alt="" style="max-width: 250px;">
                    <span class="lw-small-text block mt-2" style="color: var(--lw-gray-500);">
                        <?= $conversation['created_on'] ?>
                    </span>
                    <a class="lw-message-delete-btn lw-ajax-link-action"
                            href="{{ $deleteActionUrl }}"
                            data-method="post"
                            data-callback="userChatResponse">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
        @else
        <!-- Sent Message -->
        <div class="flex items-start gap-3 justify-end">
            <div class="flex-1 flex justify-end">
                @if($conversation['type'] == 1)
                <!-- Text Message -->
                <div class="lw-message-bubble lw-message-sent group relative max-w-md" data-message-id="<?= $conversation['chat_id'] ?>">
                    <p class="lw-body-text mb-1 text-white"><?= $conversation['message'] ?></p>
                    <div class="flex items-center gap-2 justify-end">
                        <span class="lw-small-text text-white opacity-75">
                            <?= $conversation['created_on'] ?>
                        </span>
                        <span class="lw-read-receipt {{ $conversation['status'] == 1 ? 'read' : '' }}" title="<?= __tr('Delivered') ?>">
                            <i class="fas fa-check text-white opacity-75" style="font-size: 10px;"></i>
                        </span>
                    </div>
                    <a class="lw-message-delete-btn lw-ajax-link-action" 
                            href="{{ $deleteActionUrl }}" 
                            data-method="post" 
                            data-callback="userChatResponse">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                @elseif($conversation['type'] == 2 or $conversation['type'] == 8 or $conversation['type'] == 12)
                <!-- Image/Sticker/GIF Message -->
                <div class="lw-message-bubble lw-message-sent group relative max-w-sm" data-message-id="<?= $conversation['chat_id'] ?>">
                    <img class="chat-lazy-item rounded-lg" data-src="<?= $conversation['message'] ?>" alt="" style="max-width: 250px;">
                    <div class="flex items-center gap-2 justify-end mt-2">
                        <span class="lw-small-text text-white opacity-75">
                            <?= $conversation['created_on'] ?>
                        </span>
                        <span class="lw-read-receipt {{ $conversation['status'] == 1 ? 'read' : '' }}" title="<?= __tr('Delivered') ?>">
                            <i class="fas fa-check text-white opacity-75" style="font-size: 10px;"></i>
                        </span>
                    </div>
                    <button class="lw-message-delete-btn lw-ajax-link-action" 
                            data-href="{{ $deleteActionUrl }}" 
                            data-method="post" 
                            data-callback="userChatResponse">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
            </div>
            
            <img data-src="<?= imageOrNoImageAvailable($loggedInUserProfilePicture) ?>" 
                 class="w-10 h-10 rounded-full object-cover lw-photoswipe-gallery-img lw-lazy-img flex-shrink-0" 
                 alt="">
        </div>
        @endif
        @endforeach
        @else
        <!-- Empty State -->
        <div class="flex items-center justify-center h-full">
            <div class="text-center">
                <i class="fas fa-comments text-6xl mb-4" style="color: var(--lw-gray-300);"></i>
                <p class="lw-body-text" style="color: var(--lw-gray-600);">
                    <?= __tr('No messages yet. Start the conversation!') ?>
                </p>
            </div>
        </div>
        @endif
    </div>

    <!-- Typing Indicator -->
    <div id="lwTypingIndicator" class="px-6 pb-2" style="display: none; background: var(--lw-light-gray);">
        <div class="flex items-center gap-2">
            <div class="flex gap-1">
                <span class="lw-typing-dot"></span>
                <span class="lw-typing-dot" style="animation-delay: 0.2s;"></span>
                <span class="lw-typing-dot" style="animation-delay: 0.4s;"></span>
            </div>
            <span class="lw-small-text" style="color: var(--lw-gray-600);">
                <?= $userData['full_name'] ?> <?= __tr('is typing...') ?>
            </span>
        </div>
    </div>

    <!-- Message Input Area -->
    <div class="p-6 border-t" style="border-color: var(--lw-border); background: white;">
        <form class="lw-ajax-form lw-form" method="post" 
              action="<?= route('user.write.send_message', ['userId' => $userData['user_id']]) ?>" 
              id="lwSendMessageForm" style="display: none;">
            <div class="flex items-center gap-2">
                <input type="hidden" name="type" value="1">
                
                <input type="text" name="message" class="lw-form-input flex-1" 
                       placeholder="<?= __tr('Type your message...') ?>" 
                       id="lwChatMessage">

                <button class="lw-btn-icon-gradient" id="lwSendMessageButton" type="button">
                    <i class="fas fa-paper-plane"></i>
                </button>

                @if(getStoreSettings('allow_giphy'))
                <button class="lw-btn-icon lw-open-gif-action" type="button">
                    <i class="fas fa-images"></i>
                </button>
                @endif

                <a class="lw-btn-icon lw-open-stickers-action lw-ajax-link-action" 
                   href="<?= route('user.read.get_stickers') ?>" 
                   data-callback="__Messenger.fetchStickers">
                    <i class="fas fa-sticky-note"></i>
                </a>

                <button class="lw-btn-icon" id="lwUploadingLoader" style="display: none;" disabled>
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only"><?= __tr('Loading...') ?></span>
                    </div>
                </button>

                <button class="lw-btn-icon lw-messenger-file-upload" type="button" id="lwMessengerFileUpload">
                    <i class="fas fa-paperclip"></i>
                </button>
            </div>
        </form>

        @if(isAdmin())
        <!-- Accept/Decline Message Request (Admin) -->
        <div class="flex gap-2 mt-4">
            <a href="<?= route('fake_user.write.accept_decline_message_request', ['userId' => $userData['user_id'], 'optionalLoggedInUserId'=>$userData['optionalLoggedInUserId']]) ?>" 
               class="lw-btn lw-btn-success lw-ajax-link-action" 
               id="lwAcceptChatRequestBtn" 
               data-post-data='<?= json_encode(['message_request_status'=> 1]) ?>' 
               style="display: none;" 
               data-method="post" 
               data-callback="__Messenger.acceptMessageRequest">
                <i class="fas fa-check mr-2"></i><?= __tr('Accept') ?>
            </a>
            <a href="<?= route('fake_user.write.accept_decline_message_request', ['userId' => $userData['user_id'], 'optionalLoggedInUserId'=>$userData['optionalLoggedInUserId']]) ?>" 
               class="lw-btn lw-btn-danger lw-ajax-link-action" 
               id="lwDeclineChatRequestBtn" 
               data-post-data='<?= json_encode(['message_request_status'=> 2]) ?>' 
               style="display: none;" 
               data-method="post" 
               data-callback="__Messenger.declineMessageRequest">
                <i class="fas fa-times mr-2"></i><?= __tr('Decline') ?>
            </a>
        </div>
        @else
        <!-- Accept/Decline Message Request (User) -->
        <div class="flex gap-2 mt-4">
            <a href="<?= route('user.write.accept_decline_message_request', ['userId' => $userData['user_id']]) ?>" 
               class="lw-btn lw-btn-success lw-ajax-link-action" 
               id="lwAcceptChatRequestBtn" 
               data-post-data='<?= json_encode(['message_request_status'=> 1]) ?>' 
               style="display: none;" 
               data-method="post" 
               data-callback="__Messenger.acceptMessageRequest">
                <i class="fas fa-check mr-2"></i><?= __tr('Accept') ?>
            </a>
            <a href="<?= route('user.write.accept_decline_message_request', ['userId' => $userData['user_id']]) ?>" 
               class="lw-btn lw-btn-danger lw-ajax-link-action" 
               id="lwDeclineChatRequestBtn" 
               data-post-data='<?= json_encode(['message_request_status'=> 2]) ?>' 
               style="display: none;" 
               data-method="post" 
               data-callback="__Messenger.declineMessageRequest">
                <i class="fas fa-times mr-2"></i><?= __tr('Decline') ?>
            </a>
        </div>
        @endif

        <div class="text-center mt-4 lw-body-text" id="lwDeclineMessage" style="display: none; color: var(--lw-danger);">
            <?= __tr('Message Request Declined') ?>
        </div>
    </div>
</div>

<div id="lwBuyStickerText" data-message="<?= __('Are you sure to purchase this sticker') ?>"></div>

<!-- Bottom sheet for Sticker / Gif Image -->
<div class="lw-messenger-bottom-sheet">
    <div class="lw-heading"></div>
    <div class="lw-content">
        <div id="lwStickerImagesContainer"></div>
        <div id="lwGifImagesContainer"></div>
    </div>
</div>

<!-- Modal for Not Accepted Message Request -->
<div class="modal fade" id="lwUserNotAcceptedMsgRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: var(--lw-radius-lg); border: none;">
            <div class="modal-header" style="border-bottom: 1px solid var(--lw-border);">
                <h5 class="lw-heading-4"><?= __tr('Message Request') ?></h5>
                <button type="button" class="close lw-not-accepted-dialog-close-btn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-4 text-center">
                <i class="fas fa-envelope-open-text text-6xl mb-4" style="color: var(--lw-gradient-start);"></i>
                <p class="lw-body-text"><?= __tr('User needs to accept chat request') ?></p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--lw-border);">
                <button type="button" class="lw-btn lw-btn-secondary lw-not-accepted-dialog-close-btn">
                    <?= __tr('Close') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    __Messenger.recipientUserProfilePicture = "<?= $userData['profile_picture_image'] ?>";
    $(document).ready(function() {
        var lazyInstance = $('.chat-lazy-item').lazy({
            onFinishedAll: function() {
                // console.log('finished loading all images');
            }
        });
        
        _.delay(function() {
            var $messengerChatWindow = $('.lw-messenger-chat-window');
            if($messengerChatWindow.length) {
                $('.lw-messenger-chat-window').scrollTop($('.lw-messenger-chat-window')[0].scrollHeight);
            }
            $(window).resize();
        }, 500);
    });
</script>
