<div class="lw-messenger">
    <!-- Page Heading -->
    <!-- <div class="mb-6">
        <h1 class="text-3xl font-semibold lw-font" style="color: var(--lw-primary);">
            <i class="fas fa-comments mr-2" style="color: var(--lw-gradient-start);" aria-hidden="true"></i>
            <?= __tr('Messages') ?>
        </h1>
        <p class="lw-body-text mt-2"><?= __tr('Connect with your matches') ?></p>
    </div> -->

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Sidebar - Contact List -->
        <div class="lg:col-span-4" id="lwChatSidebar">
            <div class="lw-card-glass">
                <!-- Search Box -->
                <div class="p-4 border-b" style="border-color: var(--lw-border);">
                    <div class="relative">
                        <input type="text"
                               id="lwFilterUsers"
                               class="lw-form-input"
                               style="padding-left: 2rem !important;"
                               placeholder="<?= __tr("Search conversations...") ?>">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2"
                           style="color: var(--lw-gray-400);"></i>
                    </div>
                </div>

                <!-- Contact List -->
                <div class="lw-messenger-contact-list overflow-y-auto" style="max-height: 600px;">
                    <!-- Check if messenger users exists -->
                    @if(!__isEmpty($messengerUsers))
                    @foreach($messengerUsers as $messengerUser)
                    <a href="#"
                       class="flex items-center gap-4 p-4 m-3 border-2 rounded-lg transition-all hover:bg-opacity-50 lw-ajax-link-action lw-user-chat-list"
                       style="border-color: #ec9cae;"
                       data-action="<?= route('user.read.user_conversation', ['userId' => $messengerUser['user_id']]) ?>"
                       id="<?= $messengerUser['user_id'] ?>"
                       data-callback="userChatResponse">
                        
                        <div class="relative flex-shrink-0">
                            <img data-src="<?= imageOrNoImageAvailable($messengerUser['profile_picture']) ?>" 
                                 class="w-14 h-14 rounded-full object-cover lw-lazy-img lw-photoswipe-gallery-img" 
                                 alt="<?= $messengerUser['user_full_name'] ?>">
                            
                            <!-- Online Status Badge -->
                            @if($messengerUser['is_online'] == 1)
                            <div class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full border-2 border-white" 
                                 style="background: var(--lw-success);"></div>
                            @elseif($messengerUser['is_online'] == 2)
                            <div class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full border-2 border-white" 
                                 style="background: var(--lw-warning);"></div>
                            @elseif($messengerUser['is_online'] == 3)
                            <div class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full border-2 border-white" 
                                 style="background: var(--lw-gray-400);"></div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <h4 class="lw-heading-5 truncate"><?= $messengerUser['user_full_name'] ?></h4>
                            <p class="lw-small-text truncate" style="color: var(--lw-gray-600);">
                                <?= $messengerUser['last_message'] ?? __tr('No messages yet') ?>
                            </p>
                        </div>

                        @if($messengerUser['unreadMsgCount'] > 0)
                        <span class="lw-badge lw-badge-gradient lw-incoming-message-count-<?= $messengerUser['user_id'] ?>" 
                              data-model="usersUnreadMessageCount<?= $messengerUser['user_id'] ?>">
                            <?= $messengerUser['unreadMsgCount'] ?>
                        </span>
                        @endif
                    </a>
                    @endforeach
                    @else
                    <div class="p-8 text-center">
                        <i class="fas fa-comments text-6xl mb-4" style="color: var(--lw-gray-300);"></i>
                        <p class="lw-body-text" style="color: var(--lw-gray-600);">
                            <?= __tr('No conversations yet') ?>
                        </p>
                    </div>
                    @endif
                    <!-- /Check if messenger users exists -->
                </div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="lg:col-span-8 hidden lg:block" id="lwMainChatArea">
            <div class="lw-card-glass" style="min-height: 600px;">
                <div class="lw-messenger-content" id="lwUserConversationContainer">
                    <!-- Placeholder when no conversation is selected -->
                    <div class="flex items-center justify-center h-full p-8">
                        <div class="text-center">
                            <i class="fas fa-comment-dots text-6xl mb-4" style="color: var(--lw-gray-300);"></i>
                            <h3 class="lw-heading-3 mb-2"><?= __tr('Select a conversation') ?></h3>
                            <p class="lw-body-text" style="color: var(--lw-gray-600);">
                                <?= __tr('Choose a conversation from the list to start chatting') ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        __Messenger.sendMessageRawUrl = "<?= route('user.write.send_message', ['userId' => 'userId']) ?>";
        __Messenger.buyStickerUrl = "<?= route('user.write.buy_stickers') ?>";
        __Messenger.giphyKey = "<?= getStoreSettings('giphy_key') ?>";
        __Messenger.loggedInUserProfilePicture = "<?= $currentUserData['logged_in_user_profile_picture'] ?>";
        __Messenger.loggedInUserUid = "<?= getUserUID() ?>";
        __Messenger.pusherAppKey = "<?= getStoreSettings('pusher_app_key') ?>";
        __Messenger.broadcastTypingStatusUrl = "<?= route("user.write.typing_status") ?>";
        __Messenger.markMessagesAsReadUrl = "<?= route("user.write.mark_messages_read") ?>";

        console.log(__Messenger.broadcastTypingStatusUrl)
        // Select a list of user chat
        var $userListGroup = $('.lw-user-chat-list');
        // Fire click event on first element
        // $($userListGroup[0]).trigger("click");
        // Add Active class to first element
        // $($userListGroup[0]).addClass('active');
        // Click event fire when click on user list
        $userListGroup.click(function(e) {
            if ($(this).hasClass('active')) {
                e.stopPropagation();
            }
            $('.lw-messenger-contact-list a.active').removeClass('active');
            $(this).addClass('active');

            // Show chat area and hide sidebar on mobile
            $('#lwMainChatArea').removeClass('hidden').addClass('block');
            $('#lwChatSidebar').addClass('hidden lg:block');

            __Messenger.toggleSidebarOnMobileView();
            var incomingMsgEl = $('.lw-incoming-message-count-' + $(this).attr('id'));
            if (!_.isEmpty(incomingMsgEl.text())) {
                incomingMsgEl.text(null);
            }
        });
        // lwFilterUsers
        $("#lwFilterUsers").on("keyup", function() {
            var filterQuery = $(this).val().toLowerCase();
            $(".lw-messenger-contact-list a").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(filterQuery) > -1)
            });
        });
    </script>
</div>
