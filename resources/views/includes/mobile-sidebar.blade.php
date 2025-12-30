<!-- Mobile Sidebar Overlay -->
<div id="mobileSidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300 lg:hidden" onclick="closeMobileSidebar()"></div>

<!-- Mobile Sidebar -->
<div id="mobileSidebar" class="fixed top-0 left-0 h-full w-64 max-w-[85vw] z-50 transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden overflow-y-auto shadow-2xl" style="background: #5B3E96 !important; font-family: 'Poppins', sans-serif; padding-top:2.375rem;">

    <!-- Close Button -->
    <button onclick="closeMobileSidebar()" class="absolute top-4 right-4 text-white hover:bg-white hover:bg-opacity-20 rounded-lg p-2 transition-all duration-200 z-20" style="position: absolute; top: 1rem; right: 1rem; color: white; border: none; background: transparent; padding: 0.5rem; border-radius: 8px; cursor: pointer; transition: all 0.2s;">
        <i class="fas fa-times text-xl"></i>
    </button>

    <!-- Profile Section -->
    <div class="flex flex-col items-center py-6 px-4" style="display: flex; flex-direction: column; align-items: center; padding: 1.5rem 1rem; border: none; margin-bottom: 0.5rem;">
        <div style="width: 96px; height: 96px; margin-bottom: 1rem;">
            <img src="<?= imageOrNoImageAvailable(getUserAuthInfo('profile.profile_picture_url')) ?>"
                 alt="{{ getUserAuthInfo('profile.first_name') }}"
                 class="rounded-full border-4 border-white object-cover lw-lazy-img"
                 style="width: 96px; height: 96px; border-radius: 50%; border: 4px solid white; object-fit: cover;">
        </div>
        <p class="text-white text-center font-medium m-0" style="color: white; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px; margin: 0;">
            {{ __tr('Welcome back') }}
        </p>
    </div>

    <!-- Main Navigation -->
    <div class="mt-4" style="margin-top: 0.5rem; padding: 0 0.5rem;">
        <!-- Home -->
        <div class="nav-item {{ makeLinkActive('home_page') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('home_page') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('home_page') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-home" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Home') }}</span>
            </a>
        </div>

        <!-- Discover -->
        <div class="nav-item {{ makeLinkActive('user.read.find_matches') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.read.find_matches') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.read.find_matches') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-heart" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Discover') }}</span>
            </a>
        </div>

        <!-- Chat -->
        <div class="nav-item" style="margin-bottom: 0.25rem;">
            <a href="#"
                onclick="getChatMessenger('{{ route('user.read.all_conversation') }}', true); closeMobileSidebar();"
               id="lwAllMessageChatButtonMobile"
               data-chat-loaded="false"
               data-toggle="modal"
               data-target="#messengerDialog"
               class="flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg relative"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; position: relative; text-decoration: none;">
                <span class="badge lw-new-message-badge" style="background: #ef4444; border-radius: 50%; width: 10px; height: 10px; position: absolute; top: 8px; left: 22px;"></span>
                <i class="far fa-comments" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Chat') }}</span>
            </a>
        </div>

        <!-- Alerts -->
        <div class="nav-item {{ makeLinkActive('user.notification.read.view') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg relative"
               href="{{ route('user.notification.read.view') }}"
               onclick="closeMobileSidebar()"
               x-data="{totalNotificationCount:'{{ (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' }}'}"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; position: relative; background: {{ makeLinkActive('user.notification.read.view') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-bell" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; flex: 1; color: white !important;">{{ __tr('Alerts') }}</span>
                <small class="badge" style="background: #ef4444; border-radius: 12px; font-size: 10px; padding: 2px 6px; color: white;" x-text="totalNotificationCount" x-show="totalNotificationCount"></small>
            </a>
        </div>

        <!-- My Profile -->
        <div class="nav-item {{ makeLinkActive('user.profile_view') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]) }}"
               onclick="closeMobileSidebar()"
               data-event-callback="lwPrepareUploadPlugIn"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.profile_view') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-user" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('My Profile') }}</span>
            </a>
        </div>

        <!-- My Photos -->
        <div class="nav-item {{ makeLinkActive('user.photos_setting') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) }}"
               onclick="closeMobileSidebar()"
               data-event-callback="lwPrepareUploadPlugIn"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.photos_setting') ?  : 'transparent' }}; text-decoration: none;">
                <i class="far fa-images" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('My Photos') }}</span>
            </a>
        </div>

        <!-- Who Likes Me -->
        <div class="nav-item {{ makeLinkActive('user.who_liked_me_view') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.who_liked_me_view') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.who_liked_me_view') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fa fa-thumbs-up" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Who Likes Me') }}</span>
            </a>
        </div>

        <!-- Mutual Likes -->
        <div class="nav-item {{ makeLinkActive('user.mutual_like_view') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.mutual_like_view') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.mutual_like_view') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fa fa-users" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Mutual Likes') }}</span>
            </a>
        </div>

        <!-- My Likes -->
        <div class="nav-item {{ makeLinkActive('user.my_liked_view') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.my_liked_view') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.my_liked_view') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-heart" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('My Likes') }}</span>
            </a>
        </div>

        <!-- My Dislikes -->
        <div class="nav-item {{ makeLinkActive('user.my_disliked_view') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.my_disliked_view') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.my_disliked_view') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-heart-broken" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('My Dislikes') }}</span>
            </a>
        </div>

        <!-- Visitors -->
        <div class="nav-item {{ makeLinkActive('user.profile_visitors_view') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.profile_visitors_view') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.profile_visitors_view') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fa fa-user" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Visitors') }}</span>
            </a>
        </div>

        <!-- Blocked Users -->
        <div class="nav-item {{ makeLinkActive('user.read.block_user_list') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.read.block_user_list') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.read.block_user_list') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-ban" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Blocked Users') }}</span>
            </a>
        </div>

        <!-- Credit Wallet -->
        <div class="nav-item {{ makeLinkActive('user.credit_wallet.read.view') }}" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.credit_wallet.read.view') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.credit_wallet.read.view') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-coins" style="color: #fbbf24 !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; flex: 1; color: white !important;">{{ __tr('Credit Wallet') }}</span>
                <span class="badge" style="background: #10b981; border-radius: 12px; font-size: 10px; padding: 2px 6px; color: white;">{{ totalUserCredits() }}</span>
            </a>
        </div>

        <!-- My Earnings -->
        <div class="nav-item {{ makeLinkActive('user.stripe_connect.earnings') }}" style="margin-bottom: 0.25rem;">
            <a class="flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href="{{ route('user.stripe_connect.earnings') }}"
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; background: {{ makeLinkActive('user.stripe_connect.earnings') ?  : 'transparent' }}; text-decoration: none;">
                <i class="fas fa-dollar-sign" style="color: #10b981 !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('My Earnings') }}</span>
            </a>
        </div>

        <!-- Profile Booster -->
        <div class="nav-item" style="margin-bottom: 0.25rem;">
            <a href="#"
               onclick="showBoosterAlert(); closeMobileSidebar();"
               data-toggle="modal"
               class="flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; text-decoration: none;">
                <i class="fas fa-bolt" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Profile Booster') }}</span>
            </a>
        </div>

        <!-- Settings -->
        <div class="nav-item" style="margin-bottom: 0.25rem;">
            <a class="lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               href=""
               onclick="closeMobileSidebar()"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; text-decoration: none;">
                <i class="fas fa-cog" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Settings') }}</span>
            </a>
        </div>

        <!-- Logout -->
        <div class="nav-item" style="margin-bottom: 1.5rem;">
            <a href="{{ route('user.logout') }}"
               onclick="closeMobileSidebar()"
               class="flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
               style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; text-decoration: none;">
                <i class="fas fa-sign-out-alt" style="color: white !important; font-size: 18px; width: 20px;"></i>
                <span style="font-size: 15px; color: white !important;">{{ __tr('Logout') }}</span>
            </a>
        </div>
    </div>

    <!-- Spacer for bottom navigation -->
    <div style="height: 80px;"></div>
</div>

<script>
    // Open mobile sidebar
    function openMobileSidebar() {
        document.getElementById('mobileSidebar').classList.remove('-translate-x-full');
        document.getElementById('mobileSidebarOverlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Close mobile sidebar
    function closeMobileSidebar() {
        document.getElementById('mobileSidebar').classList.add('-translate-x-full');
        document.getElementById('mobileSidebarOverlay').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Handle hamburger click
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggleTop');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();
                openMobileSidebar();
            });
        }

        // Sync message badge between desktop and mobile
        const desktopMessageBadge = document.querySelector('#lwAllMessageChatButton .lw-new-message-badge');
        const mobileMessageBadge = document.querySelector('#lwAllMessageChatButtonMobile .lw-new-message-badge');

        if (desktopMessageBadge && mobileMessageBadge) {
            // Sync visibility
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'style' || mutation.attributeName === 'class') {
                        const isVisible = window.getComputedStyle(desktopMessageBadge).display !== 'none';
                        mobileMessageBadge.style.display = isVisible ? 'block' : 'none';
                    }
                });
            });

            observer.observe(desktopMessageBadge, { attributes: true });
        }
    });
</script>
