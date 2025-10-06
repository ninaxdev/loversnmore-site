// Start of use strict
"use strict";
// Create a object for messenger
var optionalUserId = optionalLoggedInUserId;
var typingTimeout = null;
var isUserTyping = false;
var __Messenger = {
    sendMessageUrl: null,
    sendMessageRawUrl: null,
    buyStickerUrl: null,
    giphyKey: null,
    loggedInUserProfilePicture: null,
    currentChatUserUid: null,
    // Load Uploader instance
    loadUploaderInstance: function () {
        var pond = null,
            uniqueId = Math.random().toString(36).substr(2, 9);
        if (_.isEmpty(pond)) {
            pond = FilePond.create({
                name: 'filepond',
                labelIdle: "<i class='fas fa-paperclip mb-3'></i>",
                allowDrop: false,
                allowImagePreview: false,
                allowRevert: false,
                server: {
                    process: {
                        url: __Messenger.sendMessageUrl,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': appConfig.csrf_token
                        },
                        withCredentials: false,
                        onload: function (response) {
                            var responseData = JSON.parse(response);
                            var requestData = responseData.data;
                            var storedData = requestData.storedData;

                            if (responseData.reaction == 1) {
                                __Messenger.replaceMessage(storedData.type, storedData.message, storedData.unique_id, storedData.created_on, storedData.chat_id);
                            } else {
                                //  __Messenger.removeMessage(storedData.type, storedData.unique_id);
                                __Messenger.removeMessage(2, uniqueId);
                                showErrorMessage(requestData.message);
                            }
                        },
                        ondata: function (formData) {
                            formData.append('type', 2);
                            formData.append('unique_id', uniqueId);
                            formData.append('optionalLoggedInUserId', optionalUserId);
                            return formData;
                        }
                    }
                },
                onaddfilestart: function () {
                    __Messenger.appendMessage(2, '', uniqueId);
                    $('#lwMessengerFileUpload').hide();
                    $('#lwUploadingLoader').show();
                },
                onprocessfile: function (error, file) {
                    pond.removeFile(file.id);
                    $('#lwMessengerFileUpload').show();
                    $('#lwUploadingLoader').hide();
                }
            });
            pond.appendTo(document.getElementById("lwMessengerFileUpload"));
        }
    },

    $emojiElement: null,
    // Load emoji text box container
    loadEmojiContent: function () {
        __Messenger.$emojiElement = $("#lwChatMessage").emojioneArea({
            placeholder: __Utils.getTranslation('chat_placeholder', "type message..."),
            hidePickerOnBlur: true,
            events: {
                keyup: function (editor, event) {
                    if (event.which == 13) { // On Enter
                        __Messenger.sendMessage(1, {
                            message: this.getText(),
                            type: 1,
                        });

                        this.hidePicker();
                    }
                }
            }
        });
    },

    // Open sticker bottom-sheet
    openStickerBottomSheet: function () {
        $(".lw-messenger").on("click", ".lw-open-stickers-action, .lw-open .lw-overlay", function () {
            $('.lw-messenger-bottom-sheet').toggleClass("lw-open");
            __Messenger.getStickers();
        });
    },

    // Show bottom-sheet fro stickers
    getStickers: function () {
        var $lwBottomSheetHeadingContainer = $('.lw-heading'),
            $lwStickerImagesContainer = $("#lwStickerImagesContainer");

        $lwBottomSheetHeadingContainer.html("");
        $lwStickerImagesContainer.html("");
        $('#lwGifImagesContainer').html("");

        // Set Heading of bottom sheet
        $lwBottomSheetHeadingContainer.append('<h5><i class="fas fa-sticky-note text-success"></i> ' + __Utils.getTranslation('sticker_name_label', 'Stickers') + '</h5>');
    },

    // Fetch Stickers from server
    fetchStickers: function (responseData) {
        // Get sticker response data from server
        var stickers = responseData.data.stickers;
        // check if stickers exists
        if (!_.isEmpty(stickers)) {
            _.forEach(stickers, function (sticker) {
                // Create Image tag
                stickerImageTag = "<span class='lw-buy-sticker-container'><img height='100px' width='110px' src='" + sticker.image_url + "' id='" + sticker.id + "' class='lw-sticker-image' data-is-free='" + sticker.is_free + "' data-is-purchased='" + sticker.is_purchased + "'>";

                // check if sticker is free
                if (sticker.is_free) {
                    stickerImageTag += "<span class='text-center'>Free</span>";
                } else if (!sticker.is_purchased) {
                    stickerImageTag += "<div id='lwBuyNowStickerBtn-" + sticker.id + "' class='text-center'><span>" + sticker.formatted_price + "</span><br><button type='button' class='btn btn-secondary btn-sm' onclick='__Messenger.buySticker(" + sticker.id + ")'>Buy Now</button></span></div>";
                } else if (sticker.is_purchased) {
                    stickerImageTag += "<span class='text-center'>Purchased</span>";
                }

                $('#lwStickerImagesContainer').append(stickerImageTag);
            });
        } else {
            $('#lwStickerImagesContainer').append("<?= __tr('No result found.') ?>");
        }
        // Send selected sticker
        $('.lw-sticker-image').on('click', function () {
            if ($(this).data('is-free') || $(this).data('is-purchased')) {
                __Messenger.sendMessage(12, {
                    message: this.currentSrc,
                    type: 12,
                    item_id: this.id
                });
                $('.lw-messenger-bottom-sheet').toggleClass("lw-open");
            } else {
                __Messenger.buySticker(this.id);
            }
        });
    },

    // Buy sticker
    buySticker: function (stickerId) {
        showConfirmation($('#lwBuyStickerText').data('message'), function () {
            __DataRequest.post(__Messenger.buyStickerUrl, {
                sticker_id: stickerId
            }, function (responseData) {
                if (responseData.reaction == 1) {
                    $("#lwTotalCreditWalletAmt").html(responseData.data.availableCredits)
                    $('#lwBuyNowStickerBtn-' + stickerId).replaceWith("<span class='text-center'>Purchased</span>");
                }
                $("#lwStickerImagesContainer").html("");
                __Messenger.fetchStickers(responseData.data.stickers);
            });
        }, {
            id: 'lwBuyStickerAlert'
        });
    },

    // Open gif bottom-sheet
    openGifBottomSheet: function () {
        $(".lw-messenger").on("click", ".lw-open-gif-action, .lw-open .lw-overlay", function () {
            $('.lw-messenger-bottom-sheet').toggleClass("lw-open");
            __Messenger.getGifImagesContent();
        });
    },

    // Get gif images
    getGifImagesContent: function () {
        var $lwBottomSheetHeadingContainer = $('.lw-heading');
        $lwBottomSheetHeadingContainer.html("");
        // Set Heading of bottom sheet
        $lwBottomSheetHeadingContainer.append('<h5><i class="fa fa-images text-success"></i> '+ __Utils.getTranslation('send_gif', 'Send GIF') +'</h5><div class="input-group lw-gif-search-input"><input type="text" class="form-control" name="search" id="lwSearchInput" value="" placeholder="'+__Utils.getTranslation('search_gif', 'Search GIF')+'"><div class="input-group-append"><button type="button" class="btn btn-secondary" onclick="__Messenger.searchGifImages()"><i class="fas fa-search"></i></button></div></div>');
        __Messenger.fetchGifImages();
    },

    // Search for images
    searchGifImages: function () {
        var searchValue = $('#lwSearchInput').val();
        __Messenger.fetchGifImages({ searchValue: searchValue });
    },

    // Fetch Gif Images
    fetchGifImages: function (queryOptions) {
        $("#lwStickerImagesContainer").html("");
        $lwGifImagesContainer = $('#lwGifImagesContainer');
        $lwGifImagesContainer.html('<div class="lw-messenger-image-loading"></div>');
        var queryURL = '';
        params = {
            limit: 50,
            api_key: __Messenger.giphyKey,
            fmt: "json"
        };

        // check if query options exists
        if (!_.isUndefined(queryOptions)) {
            queryURL = "https://api.giphy.com/v1/gifs/search?";
            params.q = queryOptions.searchValue;
        } else {
            queryURL = "https://api.giphy.com/v1/gifs/trending?";
        }
        // Get data from gify server
        __DataRequest.get(queryURL + $.param(params), {}, function (response) {
            var gifImages = response.data;
            $lwGifImagesContainer.html('');
            if (!_.isEmpty(gifImages)) {
                _.forEach(gifImages, function (gif) {
                    var imageTag = $("<img>");
                    imageTag.attr({
                        height: "100px",
                        width: "100px",
                        src: gif.images.preview_gif.url,
                        class: 'lw-gif-image lw-lazy-img'
                    });
                    $lwGifImagesContainer.append(imageTag);
                });
            } else {
                $lwGifImagesContainer.append(__Utils.getTranslation('gif_no_result', 'Result Not Found'));
            }
            // after click on gif image perform some action
            $('.lw-gif-image').on('click', function () {
                var gifImage = $("<img>");
                gifImage.attr({
                    height: "100px",
                    width: "100px",
                    src: this.currentSrc
                });

                __Messenger.sendMessage(12, {
                    message: this.currentSrc,
                    type: 8
                });
                $('.lw-messenger-bottom-sheet').toggleClass("lw-open");
            });
        }, { csrf: false });
    },

    // Accept message request
    acceptMessageRequest: function () {
        $('#lwSendMessageForm').show();
        $('#lwAcceptChatRequestBtn').hide();
        $('#lwDeclineChatRequestBtn').hide();
        __Messenger.hideShowDropdownButtons(true);
    },

    // Decline Message Request
    declineMessageRequest: function () {
        $('#lwDeclineChatRequestBtn').hide();
        __Messenger.hideShowDropdownButtons(false);
    },

    // Prepare send button instance
    createSendButtonInstance: function () {
        $('#lwSendMessageButton').on('click', function () {
            __Messenger.sendMessageViaForm();
        });
    },

    // send message via form
    sendMessageViaForm: function () {
        var message = '',
            messageFormData = $('#lwSendMessageForm').serializeArray();
        _.forEach(messageFormData, function (item, index) {
            if (item.name == 'message') {
                message = item.value;
            }
        });
        __Messenger.sendMessage(1, {
            message: message,
            type: 1,
        });
    },

    // Send message
    sendMessage: function (type, formData) {
        console.log('here')
        var uniqueId = Math.random().toString(36).substr(2, 9),
            message = formData.message;
        if (!_.isEmpty(message)) {
            __Messenger.appendMessage(type, message, uniqueId);
        } else {
            showErrorMessage(__Utils.getTranslation('message_is_required', 'Message is required'));
            __Utils.throwError('Message is required');
        }
        formData.unique_id = uniqueId;
        formData.optionalLoggedInUserId = optionalLoggedInUserId;

        __DataRequest.post(__Messenger.sendMessageUrl, formData, function (responseData) {
            var requestData = responseData.data,
                storedData = requestData.storedData;
            if (responseData.reaction == 1) {
                __Messenger.replaceMessage(storedData.type, storedData.message, storedData.unique_id, storedData.created_on, storedData.chat_id);
            } else {
                __Messenger.removeMessage(type, uniqueId);
            }
        });
    },

    // Append message to message board
    appendMessage: function (type, message, uniqueId) {
        var $messengerChatWindow = $('.lw-messenger-chat-window'),
            appendText = '';

        if (type == 1) {
            // Text message with new Tailwind design matching user-conversation.blade.php
            appendText = '<div class="flex items-start gap-3 justify-end" id="' + uniqueId + '">' +
                '<div class="flex-1 flex justify-end">' +
                '<div class="lw-message-bubble lw-message-sent group relative max-w-md" data-message-id="' + uniqueId + '">' +
                '<p class="lw-body-text mb-1 text-white">' + message + '</p>' +
                '<div class="flex items-center gap-2 justify-end">' +
                '<span class="lw-small-text text-white opacity-75">Now</span>' +
                '<span class="lw-read-receipt" title="Delivered"><i class="fas fa-check text-white opacity-75" style="font-size: 10px;"></i></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<img src="' + __Messenger.loggedInUserProfilePicture + '" class="w-10 h-10 rounded-full object-cover lw-lazy-img flex-shrink-0" alt="">' +
                '</div>';
        } else {
            // Image/File message with new Tailwind design
            appendText = '<div class="flex items-start gap-3 justify-end" id="' + uniqueId + '">' +
                '<div class="flex-1 flex justify-end">' +
                '<div class="lw-message-bubble lw-message-sent group relative max-w-sm" data-message-id="' + uniqueId + '">' +
                '<span class="lw-messenger-image-loading">Loading... please wait</span>' +
                '<div class="flex items-center gap-2 justify-end mt-2">' +
                '<span class="lw-small-text text-white opacity-75">Now</span>' +
                '<span class="lw-read-receipt" title="Delivered"><i class="fas fa-check text-white opacity-75" style="font-size: 10px;"></i></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<img src="' + __Messenger.loggedInUserProfilePicture + '" class="w-10 h-10 rounded-full object-cover lw-lazy-img flex-shrink-0" alt="">' +
                '</div>';
        }

        $messengerChatWindow.append(appendText);
        __Messenger.$emojiElement[0].emojioneArea.setText('');

        $(".lw-messenger-chat-window").scrollTop($(".lw-messenger-chat-window")[0].scrollHeight);
    },

    // replace message with existing message
    replaceMessage: function (type, message, uniqueId, createdOn, chatId) {
        var messageIdAttr = chatId ? ' data-message-id="' + chatId + '"' : '';

        if (type == 1) {
            // Text message replacement - update timestamp and add chat_id
            var $messageElement = $('#' + uniqueId);
            if ($messageElement.length) {
                var $bubble = $messageElement.find('.lw-message-bubble');
                if (chatId) {
                    $bubble.attr('data-message-id', chatId);
                }
                $bubble.find('.lw-small-text').text(createdOn);
            }
        } else {
            // Image/File message replacement with new Tailwind design
            var replaceContainer = '<div class="flex items-start gap-3 justify-end">' +
                '<div class="flex-1 flex justify-end">' +
                '<div class="lw-message-bubble lw-message-sent group relative max-w-sm"' + messageIdAttr + '>' +
                '<img class="chat-lazy-item rounded-lg" src="' + message + '" alt="" style="max-width: 250px;">' +
                '<div class="flex items-center gap-2 justify-end mt-2">' +
                '<span class="lw-small-text text-white opacity-75">' + createdOn + '</span>' +
                '<span class="lw-read-receipt" title="Delivered"><i class="fas fa-check text-white opacity-75" style="font-size: 10px;"></i></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<img src="' + __Messenger.loggedInUserProfilePicture + '" class="w-10 h-10 rounded-full object-cover lw-lazy-img flex-shrink-0" alt="">' +
                '</div>';

            $('#' + uniqueId).replaceWith(replaceContainer);
        }
    },

    // Remove message from message board
    removeMessage: function (type, uniqueId) {
        // if (type != 1) {
            $('#' + uniqueId).remove();
        // }
    },

    // Append received message
    appendReceivedMessage: function (type, message, createdOn, chatId, isRead) {
        var $messengerChatWindow = $('.lw-messenger-chat-window'),
            appendText = '';
        var messageIdAttr = chatId ? ' data-message-id="' + chatId + '"' : '';
        var readAttr = isRead ? ' data-read="true"' : '';

        if (type == 1) {
            // Text message with new Tailwind design matching user-conversation.blade.php
            appendText = '<div class="flex items-start gap-3">' +
                '<img src="' + __Messenger.recipientUserProfilePicture + '" class="w-10 h-10 rounded-full object-cover lw-lazy-img flex-shrink-0" alt="">' +
                '<div class="flex-1">' +
                '<div class="lw-message-bubble lw-message-received group relative max-w-md"' + messageIdAttr + readAttr + '>' +
                '<p class="lw-body-text mb-1">' + message + '</p>' +
                '<span class="lw-small-text block" style="color: var(--lw-gray-500);">' + createdOn + '</span>' +
                '</div>' +
                '</div>' +
                '</div>';
        } else {
            // Image/File message with new Tailwind design
            appendText = '<div class="flex items-start gap-3">' +
                '<img src="' + __Messenger.recipientUserProfilePicture + '" class="w-10 h-10 rounded-full object-cover lw-lazy-img flex-shrink-0" alt="">' +
                '<div class="flex-1">' +
                '<div class="lw-message-bubble lw-message-received group relative max-w-sm"' + messageIdAttr + readAttr + '>' +
                '<img class="chat-lazy-item rounded-lg" src="' + message + '" alt="" style="max-width: 250px;">' +
                '<span class="lw-small-text block mt-2" style="color: var(--lw-gray-500);">' + createdOn + '</span>' +
                '</div>' +
                '</div>' +
                '</div>';
        }
        $messengerChatWindow.append(appendText);
        $(".lw-messenger-chat-window").scrollTop($(".lw-messenger-chat-window")[0].scrollHeight);
    },

    // Hide / Show sidebar on mobile view
    toggleSidebarOnMobileView: function () {
        if ($('.lw-messenger').hasClass('lw-messenger-sidebar-opened')) {
            $('.lw-messenger').removeClass('lw-messenger-sidebar-opened');
        } else {
            $('.lw-messenger').addClass('lw-messenger-sidebar-opened');
        }
    },

    // Click on toggle button
    hideShowChatSidebar: function () {
        $('#lwChatSidebarToggle').on('click', function () {
            __Messenger.toggleSidebarOnMobileView();
        });
    },

    // Show hide disable enable buttons
    hideShowDropdownButtons: function (showButtons) {
        if (showButtons) {
            // For delete all chat button
            $('#lwDeleteAllChatActiveButton').show();
            $('#lwDeleteAllChatDisableButton').hide();

            // Audio call button 
            $('#lwAudioCallBtn').show();
            $('#lwAudioCallDisableBtn').hide();

            // video Call button
            $('#lwVideoCallBtn').show();
            $('#lwVideoCallDisableBtn').hide();
        } else {
            // For delete all chat button
            $('#lwDeleteAllChatActiveButton').hide();
            $('#lwDeleteAllChatDisableButton').show();

            // Audio call button 
            $('#lwAudioCallBtn').hide();
            $('#lwAudioCallDisableBtn').show();

            // video Call button
            $('#lwVideoCallBtn').hide();
            $('#lwVideoCallDisableBtn').show();
        }
    },
    showMessageRequestNotification: function () {
        //show dialog
        $(".lw-messenger #lwAudioCallDisableBtn, .lw-messenger #lwVideoCallDisableBtn").on("click", function () {
            $('.lw-messenger #lwUserNotAcceptedMsgRequest').modal({
                keyboard: false
            });
        });

        //hide dialog
        $(".lw-messenger .lw-not-accepted-dialog-close-btn, .lw-messenger .lw-not-accepted-dialog-close-btn").on("click", function () {
            $('.lw-messenger #lwUserNotAcceptedMsgRequest').modal('hide');
        });
    },

    // Initialize typing indicator functionality
    initTypingIndicator: function() {
        var $chatInput = $("#lwChatMessage");
        var emojioneArea = $chatInput.data("emojioneArea");

        if (emojioneArea) {
            // For emojioneArea input
            emojioneArea.on("keydown", function(editor, event) {
                __Messenger.handleTypingStart();
            });
        } else {
            // For regular input
            $chatInput.on("keydown", function() {
                __Messenger.handleTypingStart();
            });
        }
    },

    // Handle typing start event
    handleTypingStart: function() {
        if (!isUserTyping && __Messenger.currentChatUserUid) {
            isUserTyping = true;
            __Messenger.broadcastTypingStatus(true);
        }

        // Clear existing timeout
        clearTimeout(typingTimeout);

        // Set new timeout to stop typing after 2 seconds of inactivity
        typingTimeout = setTimeout(function() {
            __Messenger.handleTypingStop();
        }, 2000);
    },

    // Handle typing stop event
    handleTypingStop: function() {
        if (isUserTyping && __Messenger.currentChatUserUid) {
            isUserTyping = false;
            __Messenger.broadcastTypingStatus(false);
        }
    },

    // Broadcast typing status via Pusher
    broadcastTypingStatus: function(isTyping) {
        if (!__Messenger.currentChatUserUid) return;

        __DataRequest.post({
            url: __Utils.apiURL( __Messenger.broadcastTypingStatusUrl),
            data: {
                to_user_uid: __Messenger.currentChatUserUid,
                is_typing: isTyping
            }
        });
    },

    // Show typing indicator
    showTypingIndicator: function() {
        $("#lwTypingIndicator").fadeIn(300);
        $(".lw-messenger-chat-window").scrollTop($(".lw-messenger-chat-window")[0].scrollHeight);
    },

    // Hide typing indicator
    hideTypingIndicator: function() {
        $("#lwTypingIndicator").fadeOut(300);
    },

    // Mark messages as read
    markMessagesAsRead: function(chatIds) {
        if (!chatIds || chatIds.length === 0) return;

        __DataRequest.post({
            url: __Utils.apiURL(__Messenger.markMessagesAsReadUrl),
            data: {
                chat_ids: chatIds,
                to_user_uid: __Messenger.currentChatUserUid
            }
        });
    },

    // Update read receipt UI
    updateReadReceiptUI: function(chatIds) {
        if (!chatIds || chatIds.length === 0) return;

        chatIds.forEach(function(chatId) {
            var $message = $('.lw-message-bubble[data-message-id="' + chatId + '"]');
            var $receipt = $message.find('.lw-read-receipt');

            if ($receipt.length) {
                $receipt.addClass('read');
                $receipt.attr('title', __Utils.getTranslation('read_receipt_label', 'Read'));
            }
        });
    },

    // Mark all unread received messages as read
    markVisibleMessagesAsRead: function() {
        // Only mark as read if user is viewing the chat and has an active chat open
        if (!__Messenger.currentChatUserUid) return;

        var $chatWindow = $(".lw-messenger-chat-window");
        var unreadChatIds = [];

        // Find all received messages that haven't been marked as read yet
        $chatWindow.find('.lw-message-received[data-message-id]').each(function() {
            var $bubble = $(this);

            // Check if this message has already been marked as read
            if ($bubble.attr('data-read') !== 'true') {
                var chatId = $bubble.attr('data-message-id');
                if (chatId) {
                    unreadChatIds.push(chatId);
                    // Mark as read in DOM to prevent duplicate marking
                    $bubble.attr('data-read', 'true');
                }
            }
        });

        // Mark as read if there are unread messages
        if (unreadChatIds.length > 0) {
            __Messenger.markMessagesAsRead(unreadChatIds);
        }
    }
};

function handleMessageActionContainer(messageRequestStatus, loadUploaderInstance) {
    if (messageRequestStatus == 'MESSAGE_REQUEST_ACCEPTED'
        || messageRequestStatus == 'SEND_NEW_MESSAGE') {
        if (loadUploaderInstance) {
            __Messenger.loadUploaderInstance();
        }
        __Messenger.hideShowDropdownButtons(true);
        $('#lwSendMessageForm').show();
        $('#lwDeclineMessage').hide();
    } else if (messageRequestStatus == 'MESSAGE_REQUEST_RECEIVED') {
        $('#lwSendMessageForm').hide();
        $('#lwAcceptChatRequestBtn').show();
        $('#lwDeclineChatRequestBtn').show();
        __Messenger.hideShowDropdownButtons(false);
        if (loadUploaderInstance) {
            __Messenger.loadUploaderInstance();
        }
    } else if (messageRequestStatus == 'MESSAGE_REQUEST_DECLINE') {
        __Messenger.hideShowDropdownButtons(false);
        $('#lwAcceptChatRequestBtn').show();
    } else if (messageRequestStatus == 'MESSAGE_REQUEST_DECLINE_BY_USER') {
        $('#lwSendMessageForm').hide();
        $('#lwDeclineMessage').show();
    } else if (messageRequestStatus == 'MESSAGE_REQUEST_SENT') {
        if (loadUploaderInstance) {
            __Messenger.loadUploaderInstance();
        }
        __Messenger.hideShowDropdownButtons(false);
        $('#lwSendMessageForm').show();
        $('#lwDeclineMessage').hide();
    }
}

var currentSelectedUserId = null,
    currentSelectedUserUid = null,
    optionalLoggedInUserId = null;
// After getting response from selected user
function userChatResponse(responseData) {
    $(".lw-messenger").unbind();
    $('#lwChatSidebarToggle').unbind();
    // $('#lwChatSidebarToggle').unbind();
    if (responseData.reaction == 1) {
        
        currentSelectedUserId = responseData.data.userData.user_id;
        currentSelectedUserUid = responseData.data.userData.user_uid;
        __Messenger.currentChatUserUid = currentSelectedUserUid;
        optionalUserId = responseData.data.userData.optionalLoggedInUserId;
        _.defer(function () {
            optionalLoggedInUserId = responseData.data.userData.optionalLoggedInUserId;
        });
        __Messenger.sendMessageUrl = __Utils.apiURL(__Messenger.sendMessageRawUrl, { userId: currentSelectedUserId });
        _.defer(function () {
            $(".lw-messenger-chat-window").scrollTop($(".lw-messenger-chat-window")[0].scrollHeight);
            var messageRequestStatus = responseData.data.userData.messageRequestStatus;
            handleMessageActionContainer(messageRequestStatus, true);
            __Messenger.hideShowChatSidebar();
            __Messenger.loadEmojiContent();
            __Messenger.openStickerBottomSheet();
            __Messenger.openGifBottomSheet();
            __Messenger.createSendButtonInstance();
            _.delay(function () {
                __Messenger.hideShowDropdownButtons(responseData.data.userData.enableAudioVideoLinks);
            }, 100);
            __Messenger.showMessageRequestNotification();

            // Initialize typing indicator
            __Messenger.initTypingIndicator();

            // Mark visible messages as read when chat is opened
            setTimeout(function() {
                __Messenger.markVisibleMessagesAsRead();
            }, 500);

            // Mark messages as read on scroll
            $(".lw-messenger-chat-window").on('scroll', _.debounce(function() {
                __Messenger.markVisibleMessagesAsRead();
            }, 300));
        });
    }
}