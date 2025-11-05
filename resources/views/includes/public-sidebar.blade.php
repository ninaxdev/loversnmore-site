<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion d-none d-lg-block bg-gradient-to-b from-purple-700 to-pink-500" id="accordionSidebar" style=" width: 215px !important; font-family: 'Poppins', sans-serif; display: flex; flex-direction: column; min-height: 100vh; padding-top:2.375rem;">

    <!-- Profile Section -->
    <li class="flex flex-col items-center py-6 px-4" style="display: flex; flex-direction: column; align-items: center; padding: 1.5rem 1rem; border: none; margin-bottom: 0.5rem;">
        <div style="width: 96px; height: 96px; margin-bottom: 1rem;">
            <img src="<?= imageOrNoImageAvailable(getUserAuthInfo('profile.profile_picture_url')) ?>"
                 alt="{{ getUserAuthInfo('profile.first_name') }}"
                 class="rounded-full border-4 border-white object-cover lw-lazy-img"
                 style="width: 96px; height: 96px; border-radius: 50%; border: 4px solid white; object-fit: cover;">
        </div>
        <p class="text-white text-center font-medium m-0" style="color: white; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px; margin: 0;">
            {{ __tr('Welcome back') }}
        </p>
    </li>

    <!-- Main Navigation -->
     <li class="nav-item {{ makeLinkActive('home_page') }}" style="margin-bottom: 0.25rem;">
        <a class="nav-link lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
           href="{{ route('home_page') }}"
           style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 0.5rem; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; ">
            <i class="fas fa-home" style="color: white !important; font-size: 18px; width: 20px;"></i>
            <span style="font-size: 15px; color: white !important;">{{ __tr('Home') }}</span>
        </a>
    </li>

     <li class="nav-item {{ makeLinkActive('user.read.find_matches') }}" style="margin-bottom: 0.25rem;">
        <a class="nav-link lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
           href="{{ route('user.read.find_matches') }}"
           style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 0.5rem; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; ">
            <i class="fas fa-heart" style="color: white !important; font-size: 18px; width: 20px;"></i>
            <span style="font-size: 15px; color: white !important;">{{ __tr('Discover') }}</span>
        </a>
    </li>

     <li class="nav-item" style="margin-bottom: 0.25rem;">
        <a href="#"
           onclick="getChatMessenger('{{ route('user.read.all_conversation') }}', true)"
           id="lwAllMessageChatButton"
           data-chat-loaded="false"
           data-toggle="modal"
           data-target="#messengerDialog"
           class="nav-link flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg relative"
           style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 0.5rem; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; position: relative;">
            <span class="badge lw-new-message-badge" style="background: #ef4444; border-radius: 50%; width: 10px; height: 10px; position: absolute; top: 8px; left: 22px;"></span>
            <i class="far fa-comments" style="color: white !important; font-size: 18px; width: 20px;"></i>
            <span style="font-size: 15px; color: white !important;">{{ __tr('Chat') }}</span>
        </a>
    </li>

     <li class="nav-item {{ makeLinkActive('user.notification.read.view') }}" style="margin-bottom: 0.25rem;">
        <a class="nav-link lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg relative"
           href="{{ route('user.notification.read.view') }}"
           x-data="{totalNotificationCount:'{{ (getNotificationList()['notificationCount'] > 0) ? getNotificationList()['notificationCount'] : '' }}'}"
           style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 0.5rem; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem; position: relative; ">
            <i class="fas fa-bell" style="color: white !important; font-size: 18px; width: 20px;"></i>
            <span style="font-size: 15px; flex: 1; color: white !important;">{{ __tr('Alerts') }}</span>
            <small class="badge" style="background: #ef4444; border-radius: 12px; font-size: 10px; padding: 2px 6px; color: white;" x-text="totalNotificationCount" x-show="totalNotificationCount"></small>
        </a>
    </li>

    <!-- Spacer to push bottom items down -->
    <li style="flex: 1;"></li>

     <li class="nav-item" style="margin-bottom: 0.25rem;">
        <a class="nav-link lw-ajax-link-action lw-action-with-url flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
           href=""
           style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 0.5rem; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fas fa-cog" style="color: white !important; font-size: 18px; width: 20px;"></i>
            <span style="font-size: 15px; color: white !important;">{{ __tr('Settings') }}</span>
        </a>
    </li>

     <li class="nav-item" style="margin-bottom: 1.5rem;">
        <a class="nav-link flex items-center text-white transition-all duration-300 hover:bg-white hover:bg-opacity-10 rounded-lg"
           href="{{ route('user.logout') }}"
           style="color: white !important; font-family: 'Poppins', sans-serif; font-weight: 500; transition: all 0.3s ease; border-radius: 8px; margin: 0 0.5rem; padding: 0.5rem 1rem; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fas fa-sign-out-alt" style="color: white !important; font-size: 18px; width: 20px;"></i>
            <span style="font-size: 15px; color: white !important;">{{ __tr('Logout') }}</span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->
