<!-- Visitors Page -->
<div class="w-full min-h-screen" style="background-color: #FFFFFF; font-family: 'Poppins', sans-serif;">
    <!-- Purple Header -->
    <div class="w-full py-6 px-6" style="background-color: #5B3E96;">
        <div class="max-w-2xl mx-auto flex items-center">
            <a href="/home" class="lw-ajax-link-action lw-action-with-url mr-4" style="text-decoration: none;">
                <i class="fas fa-arrow-left text-white" style="font-size: 24px;"></i>
            </a>
            <h1 class="text-3xl font-bold text-white" style="font-family: 'Poppins', sans-serif;">Visitors</h1>
        </div>
    </div>

    <!-- Visitors List -->
    <div class="max-w-2xl mx-auto px-4">
        @if(!__isEmpty($usersData))
        <div class="divide-y" style="border-color: #F3F4F6;">
            @foreach($usersData as $user)
            <?php
            $userImage = !empty($user['userImageUrl']) ? $user['userImageUrl'] : getStoreSettings('default_profile_picture');
            // Format name as "FirstName L" (first name + last initial)
            $fullName = $user['userName'] ?? '';
            $nameParts = explode(' ', trim($fullName));
            $displayName = $nameParts[0] ?? '';
            if (isset($nameParts[1]) && !empty($nameParts[1])) {
                $displayName .= ' ' . strtoupper(substr($nameParts[1], 0, 1));
            }
            ?>
            <a href="<?= route('user.profile_view', ['username' => $user['userShortName']]) ?>" class="lw-ajax-link-action lw-action-with-url flex items-center py-4 px-2 transition-all duration-200 hover:bg-gray-50" style="text-decoration: none;">
                <img src="<?= $userImage ?>" alt="<?= $displayName ?>" class="w-16 h-16 rounded-full object-cover mr-4" style="border: 2px solid #E5E7EB;">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold mb-1" style="color: #000000; font-family: 'Poppins', sans-serif;"><?= $displayName ?></h3>
                    <p class="text-base" style="color: #6B7280; font-family: 'Poppins', sans-serif;">Visited your profile</p>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <!-- No Visitors Message -->
        <div class="flex flex-col items-center justify-center py-16">
            <div class="mb-6">
                <i class="fas fa-eye" style="color: #D1D5DB; font-size: 64px;"></i>
            </div>
            <p class="text-xl text-center" style="color: #6B7280; font-family: 'Poppins', sans-serif;">
                <?= __tr('No visitors yet') ?>
            </p>
            <p class="text-sm text-center mt-2" style="color: #9CA3AF; font-family: 'Poppins', sans-serif;">
                <?= __tr('People who visit your profile will appear here') ?>
            </p>
        </div>
        @endif
    </div>
</div>
