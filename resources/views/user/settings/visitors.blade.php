<!-- Visitors Settings -->
<div class="w-full" style="font-family: 'Poppins', sans-serif;">
    <!-- Back Button and Section Title -->
    <div class="flex items-center gap-3 mb-6">
        <button onclick="window.history.back()" class="flex items-center justify-center w-10 h-10 rounded-full transition-all duration-200 hover:bg-gray-100" style="background-color: transparent; border: none; cursor: pointer;">
            <i class="fas fa-arrow-left" style="color: #1F1638; font-size: 20px;"></i>
        </button>
        <h2 class="text-3xl font-bold" style="color: #1F1638; margin: 0;">Visitors</h2>
    </div>

    <!-- List of Visitors -->
    <div class="mb-6">
        @if(!__isEmpty($usersData))
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($usersData as $user)
            <div class="p-4 rounded-3xl transition-all duration-200 hover:shadow-lg" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <div class="flex flex-col items-center text-center">
                    <?php
                    $userImage = !empty($user['userImageUrl']) ? $user['userImageUrl'] : getStoreSettings('default_profile_picture');
                    ?>
                    <img src="<?= $userImage ?>" alt="<?= $user['userName'] ?? '' ?>" class="w-20 h-20 rounded-full object-cover mb-3" style="border: 3px solid #7C3AED;">
                    <h3 class="text-lg font-semibold mb-1" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= $user['userName'] ?? '' ?></h3>
                    <p class="text-sm mb-3" style="color: #999; font-family: 'Poppins', sans-serif;"><?= $user['userAge'] ?? '' ?> years old</p>
                    <a href="<?= route('user.profile_view', ['username' => $user['userShortName']]) ?>" class="lw-ajax-link-action lw-action-with-url px-6 py-2 rounded-full text-white font-medium transition-all duration-200 hover:opacity-90" style="background-color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none; font-size: 14px;">
                        View Profile
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- No Visitors Message -->
        <div class="flex flex-col items-center justify-center py-12">
            <div class="mb-4">
                <i class="fas fa-user-friends" style="color: #D1D5DB; font-size: 80px;"></i>
            </div>
            <p class="text-xl" style="color: #999; font-family: 'Poppins', sans-serif;">
                <?= __tr('There are no visitors.') ?>
            </p>
        </div>
        @endif
    </div>

    <!-- Back to Home Button -->
    <div class="mt-8 flex justify-center">
        <a href="/home" class="lw-ajax-link-action lw-action-with-url px-12 py-3 rounded-full border-2 transition-all duration-200 hover:bg-gray-50" style="border-color: #1F1638; color: #1F1638; font-family: 'Poppins', sans-serif; font-weight: 500; text-decoration: none;">
            Back → Home
        </a>
    </div>
</div>
