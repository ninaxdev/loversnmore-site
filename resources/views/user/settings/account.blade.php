<!-- Account Settings -->
<div class="w-full min-h-screen py-8 px-4 md:px-8" style="background-color: #FAFAFA; font-family: 'Poppins', sans-serif;">
    <div class="max-w-2xl mx-auto">
        <!-- Back to Settings Link -->
        <div class="mb-6">
            <a href="<?= route('user.settings.index') ?>" class="lw-ajax-link-action lw-action-with-url inline-flex items-center text-base transition-all duration-200 hover:opacity-70" style="color: #7C3AED; font-family: 'Poppins', sans-serif; text-decoration: none;">
                <i class="fas fa-arrow-left mr-2"></i>
                <?= __tr('Settings') ?>
            </a>
        </div>

        <!-- Section Title -->
        <h2 class="text-3xl font-bold mb-6" style="color: #1F1638;">Account Settings</h2>

        <!-- Account Settings Cards -->
        <div class="space-y-3">
            <!-- Email -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Email</span>
                <a href="javascript:void(0)" onclick="showChangeEmailModal()" class="text-base font-medium" style="color: #5B3E96; font-family: 'Poppins', sans-serif; text-decoration: none;">Change email</a>
            </div>

            <!-- Phone Number -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Phone Number</span>
                <a href="javascript:void(0)" onclick="showEditPhoneModal()" class="text-base font-medium" style="color: #5B3E96; font-family: 'Poppins', sans-serif; text-decoration: none;">Edit phone number</a>
            </div>

            <!-- Two-Factor Authentication -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Two-Factor Authentication</span>
                <div class="relative" onclick="toggle2FA()" style="cursor: pointer;">
                    <div id="lw2FAToggleTrack" class="w-14 h-7 rounded-full transition-all" style="background-color: <?= getUserAuthInfo('profile.two_factor_enabled') ? '#5B3E96' : '#D1D5DB' ?>;">
                        <div id="lw2FAToggleThumb" class="absolute top-0.5 bg-white rounded-full h-6 w-6 transition-all" style="left: <?= getUserAuthInfo('profile.two_factor_enabled') ? '28px' : '4px' ?>;"></div>
                    </div>
                </div>
            </div>

            <!-- Show me in discovery -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Show me in discovery</span>
                <div class="relative">
                    <input type="checkbox" id="lwShowInDiscovery" class="sr-only peer" checked>
                    <div class="w-14 h-7 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all cursor-pointer" style="background-color: #5B3E96;" onclick="document.getElementById('lwShowInDiscovery').click()"></div>
                </div>
            </div>

            <!-- Dark Mode -->
            <div class="flex items-center justify-between py-4 px-6 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD;">
                <span class="text-base font-semibold" style="color: #000000; font-family: 'Poppins', sans-serif;">Dark Mode</span>
                <div class="relative">
                    <input type="checkbox" id="lwDarkMode" disabled class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600 opacity-50" style="cursor: not-allowed;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Email Modal -->
<div class="modal fade" id="lwChangeEmailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header" style="border-bottom: 1px solid #F0F0F0;">
                <h5 class="modal-title font-weight-bold" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Change Email') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.account_settings') ?>">
                    <div class="mb-4">
                        <label for="email" class="font-weight-medium mb-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('New Email Address') ?></label>
                        <input type="email" name="email" value="<?= getUserAuthInfo('profile.email') ?>" placeholder="<?= __tr('Email Address') ?>" class="form-control py-3 px-4 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif;" required />
                    </div>
                    <button type="submit" class="lw-ajax-form-submit-action w-100 py-3 rounded-full font-weight-medium text-white transition-all duration-200 hover:opacity-90" style="background-color: #5B3E96; font-family: 'Poppins', sans-serif; border: none;"><?= __tr('Save Changes')  ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Phone Number Modal -->
<div class="modal fade" id="lwEditPhoneModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header" style="border-bottom: 1px solid #F0F0F0;">
                <h5 class="modal-title font-weight-bold" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Edit Phone Number') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.account_settings') ?>" data-callback="onPhoneUpdateCallback">
                    <div class="mb-4">
                        <label for="mobile_number" class="font-weight-medium mb-2" style="color: #1F1638; font-family: 'Poppins', sans-serif;"><?= __tr('Phone Number') ?></label>
                        <input type="tel" name="mobile_number" id="mobile_number" value="<?= getUserAuthInfo('profile.mobile_number') ?>" placeholder="<?= __tr('Phone Number') ?>" class="form-control py-3 px-4 rounded-3xl" style="background-color: #F8F4FF; border: 1px solid #E9D8FD; color: #1F1638; font-family: 'Poppins', sans-serif;" />
                    </div>
                    <button type="submit" class="lw-ajax-form-submit-action w-100 py-3 rounded-full font-weight-medium text-white transition-all duration-200 hover:opacity-90" style="background-color: #5B3E96; font-family: 'Poppins', sans-serif; border: none;"><?= __tr('Save Changes')  ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function showChangeEmailModal() {
    $('#lwChangeEmailModal').modal('show');
}

function showEditPhoneModal() {
    $('#lwEditPhoneModal').modal('show');
}

function onPhoneUpdateCallback(response) {
    if (response.reaction == 1) {
        $('#lwEditPhoneModal').modal('hide');
        _.delay(function() {
            __Utils.viewReload();
        }, 500);
    }
}

var lw2FAEnabled = <?= getUserAuthInfo('profile.two_factor_enabled') ? 'true' : 'false' ?>;

function toggle2FA() {
    var track = document.getElementById('lw2FAToggleTrack');
    var thumb = document.getElementById('lw2FAToggleThumb');

    // Toggle the state
    lw2FAEnabled = !lw2FAEnabled;

    // Update visual state immediately
    track.style.backgroundColor = lw2FAEnabled ? '#5B3E96' : '#D1D5DB';
    thumb.style.left = lw2FAEnabled ? '28px' : '4px';

    __DataRequest.post('<?= route('user.write.toggle_two_factor') ?>', {
        two_factor_enabled: lw2FAEnabled.toString()
    }, function(response) {
        if (response.reaction == 1) {
            showSuccessMessage(response.data.message);
            _.delay(function() {
                __Utils.viewReload();
            }, 500);
        } else {
            showErrorMessage(response.data.message);
            // Revert on error
            lw2FAEnabled = !lw2FAEnabled;
            track.style.backgroundColor = lw2FAEnabled ? '#5B3E96' : '#D1D5DB';
            thumb.style.left = lw2FAEnabled ? '28px' : '4px';
        }
    });
}
</script>
