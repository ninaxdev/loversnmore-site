<!-- Discovery Feed Swipe Interface -->
<div class="relative w-full max-w-[420px] mx-auto py-4 min-h-[70vh] flex flex-col items-center justify-center" id="lwDiscoveryFeed">
    @if(!__isEmpty($filterData) && count($filterData) > 0)
    <div class="relative w-full h-[500px] mb-8 lw-swipe-cards-wrapper">
        @foreach($filterData as $index => $user)
        <div class="lw-swipe-card absolute w-full h-full rounded-[20px] overflow-hidden bg-white shadow-[0_8px_30px_rgba(0,0,0,0.12)] cursor-grab transition-all duration-300 border border-black/5 hover:shadow-[0_12px_40px_rgba(0,0,0,0.15)] active:cursor-grabbing"
             data-user-id="<?= $user['id'] ?>"
             data-user-uid="<?= $user['user_uid'] ?? $user['id'] ?>"
             data-index="<?= $index ?>"
             style="z-index: <?= count($filterData) - $index ?>;">

            <!-- Card Inner -->
            <div class="relative w-full h-full flex flex-col">
                <!-- Profile Image -->
                <div class="relative w-full h-full overflow-hidden">
                    <img src="<?= $user['profileImage'] ?>"
                         alt="<?= $user['fullName'] ?>"
                         class="w-full h-full object-contain md:object-cover object-center">

                    <!-- Gradient Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 h-[60%] pointer-events-none lw-card-gradient"></div>

                    <!-- Premium Badge -->
                    @if($user['isPremiumUser'])
                    <div class="absolute top-4 right-4 bg-gradient-to-br from-yellow-400 to-orange-500 text-black w-[38px] h-[38px] rounded-full flex items-center justify-center text-base shadow-[0_3px_12px_rgba(255,215,0,0.5)] border-2 border-white/30">
                        <i class="fas fa-crown drop-shadow-[0_1px_2px_rgba(0,0,0,0.2)]"></i>
                    </div>
                    @endif

                    <!-- Online Status -->
                    @if($user['userOnlineStatus'] == 1)
                    <div class="absolute top-4 left-4 bg-green-500/95 backdrop-blur-sm px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-semibold text-white shadow-[0_2px_8px_rgba(16,185,129,0.3)]">
                        <span class="w-2 h-2 rounded-full bg-white shadow-[0_0_8px_rgba(255,255,255,0.8)]"></span>
                    </div>
                    @endif
                </div>

                <!-- Card Info -->
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-[2]">
                    <h2 class="text-[26px] font-bold mb-2 text-white leading-tight" style="text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);">
                        <?= $user['fullName'] ?>
                        @if($user['userAge'])
                        <span class="font-semibold opacity-95">, <?= $user['userAge'] ?></span>
                        @endif
                    </h2>

                    @if($user['detailString'])
                    <p class="text-sm my-1.5 text-white/95 flex items-center gap-1.5" style="text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fas fa-info-circle opacity-80 text-[13px]"></i> <?= $user['detailString'] ?>
                    </p>
                    @endif

                    @if($user['countryName'])
                    <p class="text-sm my-1.5 text-white/95 flex items-center gap-1.5" style="text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fas fa-map-marker-alt opacity-80 text-[13px]"></i> <?= $user['countryName'] ?>
                    </p>
                    @endif

                    <!-- Quick Action Buttons (Desktop) -->
                    <div class="mt-3 gap-2 hidden lg:flex">
                        <button class="bg-white/15 backdrop-blur-md border-[1.5px] border-white/25 text-white px-4 py-2 rounded-[20px] text-[13px] font-semibold cursor-pointer transition-all duration-200 flex items-center gap-1.5 hover:bg-white/25 hover:border-white/40 hover:-translate-y-px"
                                onclick="viewUserProfile('<?= $user['username'] ?>')">
                            <i class="fas fa-user text-xs"></i>
                            <span><?= __tr('View Profile') ?></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Swipe Indicators -->
            <div class="lw-swipe-indicator lw-swipe-like absolute top-[40%] -translate-y-1/2 left-10 text-[64px] font-extrabold opacity-0 transition-opacity duration-200 pointer-events-none flex flex-col items-center gap-2 text-green-500" style="filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.4));">
                <i class="fas fa-heart"></i>
                <span class="text-xl tracking-wider font-bold"><?= __tr('LIKE') ?></span>
            </div>
            <div class="lw-swipe-indicator lw-swipe-nope absolute top-[40%] -translate-y-1/2 right-10 text-[64px] font-extrabold opacity-0 transition-opacity duration-200 pointer-events-none flex flex-col items-center gap-2 text-red-500" style="filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.4));">
                <i class="fas fa-times"></i>
                <span class="text-xl tracking-wider font-bold"><?= __tr('SKIP') ?></span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Action Buttons (Always Visible) -->
    <div class="flex gap-4 items-center justify-center py-4">
        <button class="lw-discovery-btn lw-skip-btn w-14 h-14 rounded-full border-none flex items-center justify-center text-2xl cursor-pointer shadow-[0_3px_12px_rgba(0,0,0,0.15)] bg-white text-red-500 border-[2.5px] border-red-500 hover:bg-red-500  hover:scale-[1.08] hover:shadow-[0_4px_16px_rgba(239,68,68,0.3)] transition-all duration-200"
                id="lwSkipBtn"
                title="<?= __tr('Skip') ?>">
            <i class="fas fa-times"></i>
        </button>

        <button class="lw-discovery-btn lw-super-like-btn w-14 h-14 rounded-full border-none hidden lg:flex items-center justify-center text-2xl cursor-pointer shadow-[0_3px_12px_rgba(0,0,0,0.15)] bg-white text-blue-500 border-[2.5px] border-blue-500 hover:bg-blue-500  hover:scale-[1.08] hover:shadow-[0_4px_16px_rgba(59,130,246,0.3)] transition-all duration-200"
                id="lwSuperLikeBtn"
                title="<?= __tr('Super Like') ?>">
            <i class="fas fa-star"></i>
        </button>

        <button class="lw-discovery-btn lw-like-btn w-16 h-16 rounded-full border-none flex items-center justify-center text-[26px] cursor-pointer shadow-[0_4px_16px_rgba(197,62,141,0.3)] text-white hover:scale-[1.08] hover:shadow-[0_6px_20px_rgba(197,62,141,0.4)] transition-all duration-200"
                id="lwLikeBtnDiscovery"
                title="<?= __tr('Like') ?>"
                style="background: var(--lw-gradient-main);">
            <i class="fas fa-heart"></i>
        </button>
    </div>

    @else
    <!-- No More Users -->
    <div class="text-center py-15 px-5">
        <div class="text-[80px] text-gray-400 mb-5">
            <i class="fas fa-users-slash"></i>
        </div>
        <h3 class="text-2xl font-bold mb-2.5" style="color: var(--lw-text-primary);"><?= __tr('No More Profiles') ?></h3>
        <p class="text-base" style="color: var(--lw-text-secondary);"><?= __tr('Check back later for new matches!') ?></p>
        <button class="btn lw-gradient-btn mt-3" onclick="window.location.reload()">
            <i class="fas fa-redo-alt mr-2"></i><?= __tr('Refresh') ?>
        </button>
    </div>
    @endif
</div>



<script>
// Discovery Feed Swipe Functionality
(function() {
    'use strict';

    let currentCardIndex = 0;
    let cards = [];
    let isDragging = false;
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let currentY = 0;
    let currentCard = null;

    function initDiscoveryFeed() {
        cards = Array.from(document.querySelectorAll('.lw-swipe-card'));

        if (cards.length === 0) return;

        // Initialize first card
        showCard(0);

        // Add event listeners for buttons
        document.getElementById('lwSkipBtn')?.addEventListener('click', () => swipeCard('left'));
        document.getElementById('lwLikeBtnDiscovery')?.addEventListener('click', () => swipeCard('right'));
        document.getElementById('lwSuperLikeBtn')?.addEventListener('click', () => swipeCard('up'));

        // Add touch/mouse events to cards
        cards.forEach((card, index) => {
            // Mouse events
            card.addEventListener('mousedown', handleDragStart);
            card.addEventListener('mousemove', handleDragMove);
            card.addEventListener('mouseup', handleDragEnd);
            card.addEventListener('mouseleave', handleDragEnd);

            // Touch events with passive: false to allow preventDefault
            card.addEventListener('touchstart', handleDragStart, { passive: false });
            card.addEventListener('touchmove', handleDragMove, { passive: false });
            card.addEventListener('touchend', handleDragEnd);
        });
    }

    function showCard(index) {
        cards.forEach((card, i) => {
            if (i === index) {
                card.style.display = 'block';
                card.style.zIndex = cards.length - i;
            } else if (i < index) {
                card.style.display = 'none';
            } else {
                card.style.zIndex = cards.length - i;
            }
        });
    }

    function handleDragStart(e) {
        if (e.target.closest('button')) return;

        // Prevent default touch behavior to stop scrolling
        if (e.type === 'touchstart') {
            e.preventDefault();
        }

        isDragging = true;
        currentCard = e.currentTarget;

        const touch = e.type === 'touchstart' ? e.touches[0] : e;
        startX = touch.clientX;
        startY = touch.clientY;

        currentCard.style.transition = 'none';
    }

    function handleDragMove(e) {
        if (!isDragging) return;

        // Prevent scrolling during drag
        if (e.type === 'touchmove') {
            e.preventDefault();
        }

        const touch = e.type === 'touchmove' ? e.touches[0] : e;
        currentX = touch.clientX - startX;
        currentY = touch.clientY - startY;

        const rotate = currentX * 0.1;

        // Use transform3d for hardware acceleration
        currentCard.style.transform = `translate3d(${currentX}px, ${currentY}px, 0) rotate(${rotate}deg)`;

        // Show indicators
        const likeIndicator = currentCard.querySelector('.lw-swipe-like');
        const nopeIndicator = currentCard.querySelector('.lw-swipe-nope');

        if (currentX > 50) {
            likeIndicator.style.opacity = Math.min(currentX / 100, 1);
            nopeIndicator.style.opacity = 0;
        } else if (currentX < -50) {
            nopeIndicator.style.opacity = Math.min(Math.abs(currentX) / 100, 1);
            likeIndicator.style.opacity = 0;
        } else {
            likeIndicator.style.opacity = 0;
            nopeIndicator.style.opacity = 0;
        }
    }

    function handleDragEnd(e) {
        if (!isDragging) return;

        isDragging = false;
        const threshold = 100;

        if (Math.abs(currentX) > threshold) {
            const direction = currentX > 0 ? 'right' : 'left';
            swipeCard(direction, true);
        } else {
            // Reset card position with smooth easing
            currentCard.style.transition = 'transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            currentCard.style.transform = '';

            // Fade out indicators smoothly
            const likeIndicator = currentCard.querySelector('.lw-swipe-like');
            const nopeIndicator = currentCard.querySelector('.lw-swipe-nope');
            likeIndicator.style.transition = 'opacity 0.2s ease';
            nopeIndicator.style.transition = 'opacity 0.2s ease';
            likeIndicator.style.opacity = 0;
            nopeIndicator.style.opacity = 0;
        }

        currentX = 0;
        currentY = 0;
    }

    function swipeCard(direction, fromDrag = false) {
        const card = fromDrag ? currentCard : cards[currentCardIndex];
        if (!card) return;

        const userId = card.dataset.userUid || card.dataset.userId;
        const username = card.dataset.username;

        // Add swipe animation with smooth easing
        card.style.transition = 'transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), opacity 0.4s ease';

        if (direction === 'right') {
            card.classList.add('lw-swipe-right');
            handleLike(userId, username);
        } else if (direction === 'left') {
            card.classList.add('lw-swipe-left');
            handleSkip(userId, username);
        } else if (direction === 'up') {
            card.classList.add('lw-swipe-up');
            handleSuperLike(userId, username);
        }

        // Move to next card
        setTimeout(() => {
            currentCardIndex++;

            if (currentCardIndex >= cards.length) {
                showNoMoreUsers();
            } else {
                showCard(currentCardIndex);
            }
        }, 400);
    }

    function handleLike(userId, username) {
        // Send AJAX request to like user
        __DataRequest.post("<?= route('user.write.like_dislike', ['toUserUid' => '__userId__', 'like' => 1]) ?>".replace('__userId__', userId), {}, function(response) {
            if (response.reaction == 1) {
                showMessage('<?= __tr('Profile Liked!') ?>', 'success');
            }
        });
    }

    function handleSkip(userId, username) {
        // Send AJAX request to skip user (silently, no popup) - save as dislike (0)
        __DataRequest.post("<?= route('user.write.like_dislike', ['toUserUid' => '__userId__', 'like' => 0]) ?>".replace('__userId__', userId), {}, function(response) {
            // Silent skip - no notification needed
        });
    }

    function handleSuperLike(userId, username) {
        // Send AJAX request for super like (can be same as like with special parameter)
        handleLike(userId, username);
        showMessage('<?= __tr('Super Liked!') ?>', 'info');
    }

    function showNoMoreUsers() {
        const container = document.querySelector('.lw-swipe-cards-wrapper');
        if (container) {
            container.style.display = 'none';
        }

        const noMoreUsersDiv = document.querySelector('.text-center.py-15');
        if (!noMoreUsersDiv) {
            const feedContainer = document.getElementById('lwDiscoveryFeed');
            feedContainer.innerHTML = `
                <div class="text-center py-15 px-5">
                    <div class="text-[80px] text-gray-400 mb-5">
                        <i class="fas fa-users-slash"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-2.5" style="color: var(--lw-text-primary);"><?= __tr('No More Profiles') ?></h3>
                    <p class="text-base" style="color: var(--lw-text-secondary);"><?= __tr('Check back later for new matches!') ?></p>
                    <button class="btn lw-gradient-btn mt-3" onclick="window.location.reload()">
                        <i class="fas fa-redo-alt mr-2"></i><?= __tr('Refresh') ?>
                    </button>
                </div>
            `;
        }
    }

    function viewUserProfile(username) {
        window.location.href = "<?= route('user.profile_view', ['username' => '__username__']) ?>".replace('__username__', username);
    }

    function showMessage(message, type) {
        // Use your existing notification system
        showSuccessMessage(message, type);
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDiscoveryFeed);
    } else {
        initDiscoveryFeed();
    }

    // Make viewUserProfile globally accessible
    window.viewUserProfile = viewUserProfile;
})();
</script>
