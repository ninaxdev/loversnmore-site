@section('page-title', __tr('Update Profile'))
@section('head-title', __tr('Update Profile'))
@section('keywordName', __tr('Update Profile'))
@section('keyword', __tr('Update Profile'))
@section('description', __tr('Update Profile'))
@section('keywordDescription', __tr('Update Profile'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

@lwPush('header')
<link rel="stylesheet" href="{{ asset('dist/css/profile-wizard.css') }}">
@lwPushEnd

<!-- include header -->
@include('includes.header')
<!-- /include header -->

<body class="lw-login-register-page lw-wizard-page">

    <!-- Background blobs -->
    <div class="lw-wizard-blob lw-wizard-blob-1"></div>
    <div class="lw-wizard-blob lw-wizard-blob-2"></div>

    <div class="lw-wizard-page-bg">
        <!-- White card -->
        <div class="lw-wizard-card">

            <!-- Logout -->
            <a class="lw-wizard-logout-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i> <?= __tr('Logout') ?>
            </a>

            <!-- Logo -->
            <img class="lw-wizard-logo" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
            <h1 class="lw-wizard-title"><?= __tr('Complete Your Profile') ?></h1>
            <p class="lw-wizard-subtitle"><?= __tr('Just a few steps to get started') ?></p>

            <!-- Custom step progress -->
            <div class="lw-wizard-steps" id="lwCustomSteps">
                <div class="lw-wizard-step active" data-step="0">
                    <div class="lw-step-circle">1</div>
                    <span><?= __tr('Profile & Info') ?></span>
                </div>
                <div class="lw-step-divider"></div>
                <div class="lw-wizard-step" data-step="1">
                    <div class="lw-step-circle">2</div>
                    <span><?= __tr('Location') ?></span>
                </div>
                <div class="lw-step-divider"></div>
                <div class="lw-wizard-step" data-step="2">
                    <div class="lw-step-circle">3</div>
                    <span><?= __tr('Done') ?></span>
                </div>
            </div>

            <!-- SmartWizard -->
            <div id="smartwizard">
                <!-- Hidden original nav (SmartWizard requires it) -->
                <ul class="justify-content-center nav" style="display:none!important">
                    <li><a class="h5 nav-link" href="#step-1"></a></li>
                    <li><a class="h5 nav-link" href="#step-2"></a></li>
                    <li><a class="h5 nav-link" href="#step-3"></a></li>
                </ul>

                <div class="tab-content">

                    {{-- ── STEP 1: Profile Pictures & Basic Info ── --}}
                    <div id="step-1" class="tab-pane" role="tabpanel">

                        <p class="lw-step-section-title">
                            <i class="fas fa-user-circle"></i> <?= __tr('Basic Information') ?>
                        </p>

                        <form class="lw-ajax-form lw-form" lwSubmitOnChange method="post" data-show-message="true"
                            action="<?= route('user.write.update_profile_wizard') ?>" data-callback="checkProfileStatus">

                            <div class="row">
                                <!-- Birthday -->
                                <div class="col-md-6">
                                    <div class="lw-wizard-input-group">
                                        <label for="birthday"><?= __tr('Birthday') ?></label>
                                        <i class="fas fa-calendar-alt lw-input-icon"></i>
                                        <input type="date"
                                            id="birthday"
                                            min="{{ getAgeDate(configItem('age_restriction.maximum'), 'max')->format('Y-m-d') }}"
                                            max="{{ getAgeDate(configItem('age_restriction.minimum'))->format('Y-m-d') }}"
                                            class="lw-wizard-field"
                                            name="birthday"
                                            placeholder="<?= __tr('DD-MM-YYYY') ?>"
                                            value="<?= __ifIsset($profileInfo['birthday'], $profileInfo['birthday']) ?>"
                                            required="true">
                                    </div>
                                </div>
                                <!-- Gender -->
                                <div class="col-md-6">
                                    <div class="lw-wizard-input-group">
                                        <label for="select_gender"><?= __tr('Gender') ?></label>
                                        <i class="fas fa-venus-mars lw-input-icon"></i>
                                        <select name="gender" class="lw-wizard-field lw-wizard-select" id="select_gender">
                                            <option value="" selected disabled><?= __tr('Choose your gender') ?></option>
                                            @foreach($genders as $genderKey => $gender)
                                            <option value="<?= $genderKey ?>"
                                                <?= (__ifIsset($profileInfo['gender']) and $genderKey == $profileInfo['gender']) ? 'selected' : '' ?>>
                                                <?= $gender ?>
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr class="lw-wizard-section-divider">

                        <p class="lw-step-section-title">
                            <i class="fas fa-images"></i> <?= __tr('Profile Photos') ?>
                        </p>

                        <div class="lw-upload-row" id="lwProfileAndCoverEditBlock">
                            <!-- Profile photo -->
                            <div class="lw-upload-col-profile">
                                <span class="lw-upload-label"><?= __tr('Profile Photo') ?></span>
                                <input type="file" name="filepond" class="filepond lw-file-uploader"
                                    id="lwFileUploader"
                                    data-remove-media="false"
                                    data-allowed-media='<?= getMediaRestriction('profile') ?>'
                                    data-callback="checkProfileStatus"
                                    data-default-image-url="<?= $profileInfo['profile_picture_url'] ?>"
                                    data-instant-upload="true"
                                    data-action="<?= route('user.upload_profile_image') ?>"
                                    data-label-idle="<?= __tr("Drag & Drop or __browseAction__", [
                                        '__browseAction__' => "<span class='filepond--label-action'>". __tr('Browse')."</span>"
                                    ]) ?>"
                                    data-image-preview-height="170"
                                    data-image-crop-aspect-ratio="1:1"
                                    data-style-panel-layout="compact circle"
                                    data-style-load-indicator-position="center bottom"
                                    data-style-progress-indicator-position="right bottom"
                                    data-style-button-remove-item-position="left bottom"
                                    data-style-button-process-item-position="right bottom">
                                <span class="lw-upload-hint"><?= __tr('Square photo works best') ?></span>
                            </div>
                            <!-- Cover photo -->
                            <div class="lw-upload-col-cover">
                                <span class="lw-upload-label"><?= __tr('Cover Photo') ?></span>
                                <input type="file" name="filepond" class="filepond lw-file-uploader"
                                    id="lwCoverFileUploader"
                                    data-allowed-media='<?= getMediaRestriction('profile') ?>'
                                    data-default-image-url="<?= $profileInfo['cover_picture_url'] ?>"
                                    data-remove-media="false"
                                    data-instant-upload="true"
                                    data-action="<?= route('user.upload_cover_image') ?>"
                                    data-callback="checkProfileStatus"
                                    data-label-idle="<?= __tr("Drag & Drop or __browseAction__", [
                                        '__browseAction__' => "<span class='filepond--label-action'>". __tr('Browse')."</span>"
                                    ]) ?>">
                                <span class="lw-upload-hint"><?= __tr('Landscape photo recommended') ?></span>
                            </div>
                        </div>

                    </div>

                    {{-- ── STEP 2: Location ── --}}
                    <div id="step-2" class="tab-pane" role="tabpanel">

                        <p class="lw-step-section-title">
                            <i class="fas fa-map-marker-alt"></i> <?= __tr('Your Location') ?>
                        </p>
                        <p class="lw-wizard-subtitle" style="text-align:left;margin-bottom:16px;">
                            <?= __tr('We use your city to show you people nearby.') ?>
                        </p>

                        @if(getStoreSettings('allow_google_map'))
                        <div id="lwUserEditableLocation">
                            <div class="lw-wizard-input-group">
                                <label for="address_address"><?= __tr('Search your city or address') ?></label>
                                <i class="fas fa-search lw-input-icon"></i>
                                <input type="text" id="address-input" name="address_address"
                                    class="lw-wizard-field map-input"
                                    placeholder="<?= __tr('Enter a location') ?>">
                                <input type="hidden" name="address_latitude" id="address-latitude" value="<?= $profileInfo['location_latitude'] ?>" />
                                <input type="hidden" name="address_longitude" id="address-longitude" value="<?= $profileInfo['location_longitude'] ?>" />
                            </div>
                            <div id="address-map-container" style="width:100%;height:320px;">
                                <div style="width:100%;height:100%;" id="address-map"></div>
                            </div>
                        </div>

                        @elseif(getStoreSettings('use_static_city_data'))
                        <div class="lw-wizard-input-group">
                            <label for="selectLocationCity"><?= __tr('Search your city') ?></label>
                            <i class="fas fa-map-pin lw-input-icon"></i>
                            <input type="text" id="selectLocationCity"
                                class="lw-wizard-field"
                                placeholder="<?= __tr('Enter a location') ?>">
                        </div>

                        @else
                        <div class="alert alert-info" style="border-radius:12px;">
                            <?= __tr('Something went wrong with Google Api Key, please contact to system administrator.') ?>
                        </div>
                        @endif

                    </div>

                    {{-- ── STEP 3: Finished ── --}}
                    <div id="step-3" class="tab-pane" role="tabpanel">
                        <div class="py-4">
                            <i class="fas fa-heart lw-finish-icon"></i>
                            <h2 class="lw-finish-title"><?= __tr('You\'re all set!') ?></h2>
                            <p class="lw-finish-subtitle"><?= __tr('Your profile is ready. Start exploring people near you.') ?></p>
                            <a href="#" class="lw-finish-btn lw-ajax-link-action"
                                data-method="post"
                                data-action="<?= route('user.profile.finish_wizard') ?>"
                                data-callback="finishWizardCallback">
                                <strong><?= __tr('Go to my profile') ?></strong>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            {{-- /SmartWizard --}}

        </div>
        {{-- /lw-wizard-card --}}
    </div>
    {{-- /lw-wizard-page-bg --}}

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:16px;">
                <div class="modal-header" style="border-bottom:1px solid #f0dff7;">
                    <h5 class="modal-title" style="font-family:'Lexend',sans-serif;color:#33196b;"><?= __tr('Ready to Leave?') ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="font-family:'Lexend',sans-serif;color:#645290;">
                    <?= __tr('Select "Logout" below if you are ready to end your current session.') ?>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f0dff7;">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" style="border-radius:20px;"><?= __tr('Cancel') ?></button>
                    <a class="btn" href="<?= route('user.logout') ?>"
                        style="border-radius:20px;background:#5B3E96;color:white;border:none;">
                        <?= __tr('Logout') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Logout Modal -->

</body>

@lwPush('appScripts')
@if(getStoreSettings('allow_google_map'))
<script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize&language=en" async defer></script>
@endif
<script type="text/javascript">

    // ── Custom step bar sync ──
    function syncStepBar(stepIndex) {
        var $steps = $('#lwCustomSteps .lw-wizard-step');
        var $dividers = $('#lwCustomSteps .lw-step-divider');
        $steps.each(function(i) {
            $(this).removeClass('active completed');
            if (i < stepIndex) $(this).addClass('completed');
            else if (i === stepIndex) $(this).addClass('active');
        });
        $dividers.each(function(i) {
            $(this).css('background', i < stepIndex ? '#c53e8d' : '#f0dff7');
        });
    }

    // ── Button state ──
    function setButtons(stepNumber, stepsStatus, stepPosition) {
        if (stepPosition == 'first') {
            $(".sw-btn-next").attr('disabled', !stepsStatus.step_one);
        } else if (stepPosition == 'middle') {
            $(".sw-btn-next").attr('disabled', !stepsStatus.step_two);
        } else if (stepPosition == 'last') {
            $("#bonusCreditsImg").addClass('lw-bonus-credits-badge');
            var isEnableBonusCredits = "<?= getStoreSettings('enable_bonus_credits') ?>";
            if (isEnableBonusCredits == true) {
                var response = jQuery.parseJSON('<?=bonusCreditNotification()?>');
                if (response.showBadge == true) {
                    $('.credits-display-text').text(response.credits.credits);
                    creditBadgeShow();
                }
            }
        }
    }

    var stepNumber = 0;
    window.stepPosition = 'first';
    var stepsStatus = <?= json_encode($profileStatus) ?>;

    checkProfileStatus = function() {
        __DataRequest.get("<?= route('user.profile.wizard_completed') ?>", {}, function(response) {
            stepsStatus = response.data.profileStatus;
            setButtons(stepNumber, stepsStatus, stepPosition);
        }, {});
    };

    finishWizardCallback = function(response) {
        if (_.has(response.data, 'redirectURL')) {
            window.location = response.data.redirectURL;
        }
    };

    // ── SmartWizard init ──
    $('#smartwizard').smartWizard({
        selected: 0,
        transitionEffect: 'none',
        transitionSpeed: '0',
        showStepURLhash: false,
        enableURLhash: false,
        toolbarSettings: {
            toolbarPosition: 'bottom',
            showPreviousButton: true,
            showNextButton: true,
        },
        lang: {
            next: "<?= __tr('Next') ?> →",
            previous: "← <?= __tr('Previous') ?>"
        }
    });

    // Step show event
    $("#smartwizard").on("showStep", function(e, anchorObject, stepIdx, stepDirection, stepPos) {
        e.preventDefault();
        stepNumber = stepIdx;
        window.stepPosition = stepPos;
        syncStepBar(stepIdx);
        checkProfileStatus();
    });

    // Initial state
    setButtons(stepNumber, stepsStatus, stepPosition);
    syncStepBar(0);

    // ── Google Maps ──
    function initialize() {
        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) { e.preventDefault(); return false; }
        });

        const locationInputs = document.getElementsByClassName("map-input");
        const autocompletes = [];
        const geocoder = new google.maps.Geocoder;

        for (let i = 0; i < locationInputs.length; i++) {
            const input = locationInputs[i];
            const fieldKey = input.id.replace("-input", "");
            const isEdit = document.getElementById(fieldKey + "-latitude").value != ''
                        && document.getElementById(fieldKey + "-longitude").value != '';
            const latitude  = parseFloat(document.getElementById(fieldKey + "-latitude").value)  || -33.8688;
            const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

            const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                center: { lat: latitude, lng: longitude },
                zoom: 13
            });
            const marker = new google.maps.Marker({
                map: map,
                position: { lat: latitude, lng: longitude },
            });
            marker.setVisible(isEdit);

            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.key = fieldKey;
            autocompletes.push({ input, map, marker, autocomplete });
        }

        for (let i = 0; i < autocompletes.length; i++) {
            const { input, autocomplete, map, marker } = autocompletes[i];
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();
                geocoder.geocode({ 'placeId': place.place_id }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        const lat = results[0].geometry.location.lat();
                        const lng = results[0].geometry.location.lng();
                        setLocationCoordinates(autocomplete.key, lat, lng, place);
                    }
                });
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    input.value = "";
                    return;
                }
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });
        }
    }

    function setLocationCoordinates(key, lat, lng, placeData) {
        __DataRequest.post("<?= route('user.write.location_data') ?>", {
            'latitude': lat,
            'longitude': lng,
            'placeData': placeData.address_components
        }, function(responseData) {
            var requestData = responseData.data;
            __DataRequest.updateModels('profileData', {
                city: requestData.city,
                country_name: requestData.country_name
            });
            if (responseData.reaction == 1) {
                _.defer(function() { checkProfileStatus(); });
            }
        });
    }

    @if(!getStoreSettings('allow_google_map') and getStoreSettings('use_static_city_data'))
    $('#selectLocationCity').selectize({
        valueField: 'id',
        labelField: 'cities_full_name',
        searchField: ['cities_full_name'],
        create: false,
        maxItems: 1,
        render: {
            option: function(item, escape) {
                return '<div><span class="title"><span class="name">' + escape(item.cities_full_name) + '</span></span></div>';
            }
        },
        load: function(query, callback) {
            if (!query.length || query.length < 2) return callback([]);
            __DataRequest.post("<?= route('user.read.search_static_cities') ?>", {
                'search_query': query
            }, function(responseData) {
                callback(responseData.data.search_result);
            });
        },
        onChange: function(value) {
            if (!value.length) return;
            __DataRequest.post("<?= route('user.write.store_city') ?>", {
                'selected_city_id': value
            }, function(responseData) {
                var requestData = responseData.data;
                __DataRequest.updateModels('profileData', {
                    city: requestData.city,
                    country_name: requestData.country_name
                });
                if (responseData.reaction == 1) {
                    _.defer(function() { checkProfileStatus(); });
                }
            });
        }
    });
    @endif

    function getUserProfileData(response) {
        if (response.reaction == 1) {
            __DataRequest.get("<?= route('user.get_profile_data', ['username' => getUserAuthInfo('profile.username')]) ?>", {}, function(responseData) {
                var requestData = responseData.data;
                var specificationUpdateData = [];
                _.forEach(requestData.userSpecificationData, function(specification) {
                    _.forEach(specification['items'], function(item) {
                        specificationUpdateData[item.name] = item.value;
                    });
                });
                __DataRequest.updateModels('profileData', requestData.userProfileData);
            });
        }
    }
</script>
@lwPushEnd

<!-- include footer -->
@include('includes.footer')
<!-- /include footer -->
