@section('page-title', strip_tags($userData['fullName']))
@section('head-title', strip_tags($userData['fullName']))
@section('page-url', url()->current())

@if(isset($userData['aboutMe']))
@section('keywordName', strip_tags($userProfileData['aboutMe']))
@section('keyword', strip_tags($userProfileData['aboutMe']))
@section('description', strip_tags($userProfileData['aboutMe']))
@section('keywordDescription', strip_tags($userProfileData['aboutMe']))
@endif

@if(isset($userData['profilePicture']))
@section('page-image', $userData['profilePicture'])
@endif
@if(isset($userData['coverPicture']))
@section('twitter-card-image', $userData['coverPicture'])
@endif

@lwPush('header')
<link rel="stylesheet" href="{{ __yesset('dist/css/vendorlibs-leaflet.css') }}" />
<link rel="stylesheet" href="{{ asset('dist/css/mobile-profile.css') }}" />
<style>
	#staticMapId {
		height: 300px;
	}
	
	/* Fix for form styling conflicts */
	.lw-ajax-form select {
		z-index: 1000 !important;
		position: relative !important;
		pointer-events: auto !important;
		-webkit-appearance: menulist !important;
		-moz-appearance: menulist !important;
		appearance: auto !important;
		background-image: none !important;
	}
	
	.lw-ajax-form .mb-4 {
		margin-bottom: 1rem !important;
	}
	
	/* Ensure dropdown options are visible */
	select option {
		color: var(--lw-primary) !important;
		background-color: white !important;
		padding: 8px !important;
		display: block !important;
		visibility: visible !important;
	}
	
	/* Fix select dropdown appearance */
	.lw-ajax-form select:not([multiple]) {
		-webkit-appearance: menulist !important;
		-moz-appearance: menulist !important;
		appearance: menulist !important;
	}
	
	/* Override any conflicting styles */
	select {
		max-height: none !important;
		overflow: visible !important;
	}
	
	/* Specific fix for gender select */
	#select_gender, #select_preferred_language, #select_relationship_status, #select_work_status, #select_education {
		-webkit-appearance: menulist !important;
		-moz-appearance: menulist !important;
		appearance: auto !important;
		background-image: none !important;
	}
	
	/* Selectize dropdown styling fixes for Tailwind CSS */
	.selectize-dropdown,
	.selectize-dropdown.form-control {
		position: absolute !important;
		z-index: 9999 !important;
		border: 1px solid #d1d5db !important;
		border-radius: 0.375rem !important;
		background: white !important;
		box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
		max-height: 200px !important;
		overflow-y: auto !important;
		visibility: visible !important;
		opacity: 1 !important;
		margin-top: 1px !important;
	}
	
	.selectize-dropdown-content {
		padding: 0 !important;
		max-height: 200px !important;
		overflow-y: auto !important;
	}
	
	.selectize-dropdown .option,
	.selectize-dropdown [data-selectable] {
		padding: 8px 12px !important;
		border-bottom: 1px solid #f3f4f6 !important;
		cursor: pointer !important;
		display: block !important;
		visibility: visible !important;
		color: #374151 !important;
		background-color: white !important;
		transition: background-color 0.15s ease-in-out !important;
	}
	
	.selectize-dropdown .option:hover,
	.selectize-dropdown .option.active,
	.selectize-dropdown [data-selectable].active {
		background-color: #f3f4f6 !important;
		color: #1f2937 !important;
	}
	
	.selectize-dropdown .option:last-child,
	.selectize-dropdown [data-selectable]:last-child {
		border-bottom: none !important;
	}
	
	/* Ensure selectize control is properly styled */
	.selectize-control.single .selectize-input {
		border: 1px solid #d1d5db !important;
		border-radius: 0.375rem !important;
		padding: 0.5rem 0.75rem !important;
		background-color: white !important;
		color: #374151 !important;
		font-size: 1rem !important;
		line-height: 1.5 !important;
		transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
	}
	.selectize-control{
		border-bottom:none;
	}
	.selectize-control.single .selectize-input:focus {
		border-color: #3b82f6 !important;
		box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
		outline: none !important;
	}
	
	.selectize-control.single .selectize-input input[type="text"] {
		color: #374151 !important;
		font-size: 1rem !important;
		border: none !important;
		outline: none !important;
		background: transparent !important;
		padding: 0 !important;
		margin: 0 !important;
		width: 100% !important;
	}
	
	/* Fix for dropdown positioning */
	#selectLocationCity-selectized {
		position: relative !important;
	}
	
	/* Ensure form group has proper position context */
	#lwUserEditableLocation .form-group {
		position: relative !important;
		z-index: 1 !important;
	}
	
	/* Remove border-bottom from selectize control */
	.selectize-control.form-control.single {
		border-bottom: none !important;
	}
	
	/* Fix country code select dropdown to match design */
	.lw-country-select,
	.lw-country-code-select,
	#country_code {
		width: 100% !important;
		height: 3rem !important; /* h-12 */
		background-color: white !important;
		border: 2px solid var(--lw-gradient-start) !important; /* border-2 border-lw-gradient-start */
		border-radius: 9999px !important; /* rounded-full */
		padding: 0 1.25rem !important; /* px-5 */
		padding-right: 3rem !important; /* pr-12 */
		font-family: var(--font-lw), sans-serif !important; /* font-lw */
		font-weight: 500 !important; /* font-medium */
		font-size: 1rem !important; /* text-base */
		color: var(--lw-primary) !important; /* text-lw-primary */
		outline: none !important;
		cursor: pointer !important;
		transition: all 0.3s ease !important; /* transition-all */
		-webkit-appearance: menulist !important;
		-moz-appearance: menulist !important;
		appearance: auto !important;
		background-image: none !important;
		line-height: 1.5 !important;
	}
	
	.lw-country-select:focus,
	.lw-country-code-select:focus,
	#country_code:focus {
		border-color: var(--lw-gradient-end) !important; /* focus:border-lw-gradient-end */
		box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1) !important; /* focus:ring-4 focus:ring-pink-500/10 */
	}
	
	.lw-country-select:disabled,
	.lw-country-code-select:disabled,
	#country_code:disabled {
		opacity: 0.6 !important; /* disabled:opacity-60 */
		cursor: not-allowed !important; /* disabled:cursor-not-allowed */
	}
	
	.lw-country-select option,
	.lw-country-code-select option,
	#country_code option {
		color: var(--lw-primary) !important; /* text-lw-primary */
		background-color: white !important; /* bg-white */
		padding: 0.5rem !important; /* py-2 */
		display: block !important;
		visibility: visible !important;
	}
	
	/* Fix mobile input group layout for rounded design */
	.lw-mobile-input-group {
		display: flex !important;
		gap: 0.75rem !important; /* Increased gap for better spacing */
		align-items: stretch !important;
		flex-wrap: nowrap !important;
	}
	
	.lw-mobile-input-group .lw-country-select {
		flex: 0 0 auto !important;
		min-width: 220px !important; /* Increased for better text visibility */
		max-width: 250px !important;
	}
	
	.lw-mobile-input-group .lw-mobile-input {
		flex: 1 1 auto !important;
		height: 3rem !important; /* h-12 to match select */
		background-color: white !important;
		border: 2px solid var(--lw-gradient-start) !important;
		border-radius: 9999px !important; /* rounded-full to match */
		padding: 0 1.25rem !important;
		font-family: var(--font-lw), sans-serif !important;
		font-weight: 500 !important;
		font-size: 1rem !important;
		color: var(--lw-primary) !important;
		outline: none !important;
		transition: all 0.3s ease !important;
	}
	
	.lw-mobile-input-group .lw-mobile-input:focus {
		border-color: var(--lw-gradient-end) !important;
		box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1) !important;
	}
	
	.lw-mobile-input-group .lw-mobile-input::placeholder {
		color: var(--lw-secondary, #9ca3af) !important;
		font-weight: 400 !important;
	}
	
	/* Remove spinner from number input */
	.lw-remove-spinner::-webkit-outer-spin-button,
	.lw-remove-spinner::-webkit-inner-spin-button {
		-webkit-appearance: none !important;
		margin: 0 !important;
	}
	
	.lw-remove-spinner {
		-moz-appearance: textfield !important;
	}

	/* Mobile Photo Upload FilePond Styling */
	#mobilePhotoUploadContainer .filepond--root {
		background: transparent;
		margin-bottom: 0;
	}

	#mobilePhotoUploadContainer .filepond--drop-label {
		background: #F4E9FF;
		border: 2px dashed #9B8AAE;
		border-radius: 0.75rem;
		color: #4F1DA1;
		cursor: pointer;
		transition: all 0.3s ease;
		min-height: 100px;
	}

	#mobilePhotoUploadContainer .filepond--drop-label:hover {
		background: #E8D5FF;
		border-color: #4F1DA1;
	}

	#mobilePhotoUploadContainer .filepond--panel-root {
		background-color: transparent;
		border-radius: 0.75rem;
	}

	#mobilePhotoUploadContainer .filepond--label-action {
		text-decoration: none;
		color: #4F1DA1;
		font-weight: 600;
	}
</style>
@lwPushEnd
@lwPush('footer')
<script src="{{ __yesset('dist/js/vendorlibs-leaflet.js') }}"></script>
@lwPushEnd

@php 
$latitude = (__ifIsset($userProfileData['latitude'], $userProfileData['latitude'], '21.120779'));
$longitude = (__ifIsset($userProfileData['longitude'], $userProfileData['longitude'], '79.0544606'));
@endphp
<!-- if user block then don't show profile page content -->
{{-- @if($isBlockUser)
<!-- info message -->
<div class="alert alert-info">
	{{ __tr('This user is unavailable.') }}
</div>
<!-- / info message -->
@else --}}
@if($blockByMeUser)
<!-- info message -->
<div class="alert alert-info">
	{{ __tr('You have blocked this user.') }}
</div>
<!-- / info message -->
@else

<!-- NEW MOBILE PROFILE VIEW - TAILWIND CSS -->
<div class="md:hidden bg-white pb-20 font-lw" style="font-family: 'Poppins', sans-serif;">
	<!-- Profile Header -->
	<div class="relative p-4 bg-white">
		<a href="javascript:void(0);" onclick="window.history.back();" class="absolute left-4 top-4 w-10 h-10 bg-white border-0 rounded-lg flex items-center justify-center text-[#2F1E4E] text-xl z-10">
			<i class="fas fa-chevron-left"></i>
		</a>
		<h1 class="text-center font-bold text-2xl text-[#2F1E4E] m-0 py-2">{{ __tr('Profile') }}</h1>
	</div>

	<!-- Profile Picture and Name -->
	<div class="flex flex-col items-center px-4 py-6 bg-white">
		<div class="relative w-[280px] h-[280px] mb-4">
			<img src="{{ imageOrNoImageAvailable($userData['profilePicture']) }}"
				 alt="{{ $userData['fullName'] }}"
				 class="w-[280px] h-[280px] rounded-full object-cover border-[6px] border-[#F4E9FF] bg-[#F4E9FF] lw-lazy-img"
				 data-src="{{ imageOrNoImageAvailable($userData['profilePicture']) }}">
		</div>
		<h2 class="font-semibold text-[28px] text-[#2F1E4E] mt-2 mb-0">
			{{ $userData['fullName'] }}@if(!__isEmpty($userData['userAge'])), {{ __tr($userData['userAge']) }}@endif
		</h2>
	</div>

	<!-- Tab Navigation -->
	<div class="flex justify-center items-center gap-0 bg-[#F4E9FF] rounded-xl p-1 mx-4 mb-6">
		<button class="lw-mobile-tab flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-white border-0 rounded-lg font-medium text-sm text-[#4F1DA1] cursor-pointer transition-all shadow-sm" data-tab="about">
			<i class="fas fa-star text-base"></i>
			<span>{{ __tr('About') }}</span>
		</button>
		<button class="lw-mobile-tab flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-transparent border-0 rounded-lg font-medium text-sm text-[#9B8AAE] cursor-pointer transition-all" data-tab="info">
			<i class="fas fa-user text-base"></i>
			<span>{{ __tr('Info') }}</span>
		</button>
		<button class="lw-mobile-tab flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-transparent border-0 rounded-lg font-medium text-sm text-[#9B8AAE] cursor-pointer transition-all" data-tab="photos">
			<i class="fas fa-images text-base"></i>
			<span>{{ __tr('Photos') }}</span>
		</button>
	</div>

	<!-- Tab Content -->
	<div class="px-4 pb-6">
		<!-- About Tab -->
		<div class="lw-mobile-tab-content" id="mobile-about-tab">
			@if(isset($userProfileData['aboutMe']) and $userProfileData['aboutMe'])
				<p class="font-normal text-base leading-relaxed text-[#2F1E4E] p-0 m-0">{{ $userProfileData['aboutMe'] }}</p>
			@else
				<div class="text-center py-12 px-4">
					<div class="text-5xl text-[#9B8AAE] mb-4">
						<i class="fas fa-info-circle"></i>
					</div>
					<p class="font-normal text-base text-[#9B8AAE]">{{ __tr('No information available') }}</p>
				</div>
			@endif

			<!-- Edit Profile Button for About Tab -->
			@if($isOwnProfile)
				<button data-toggle="modal" data-target="#mobileEditProfileModal" class="block  mx-auto mt-6 px-5 py-3 bg-[#4F1DA1] border-0 rounded-full font-medium text-base text-white text-center cursor-pointer shadow-md transition-all hover:bg-[#5B2BB5] hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0">
					{{ __tr('Edit Profile') }}
				</button>
			@endif
		</div>

		<!-- Info Tab -->
		<div class="lw-mobile-tab-content hidden" id="mobile-info-tab">
			<ul class="list-none p-0 m-0">
				@if(!__isEmpty($userSpecificationData))
					@foreach($userSpecificationData as $specificationKey => $specifications)
						@foreach($specifications['items'] as $item)
							@if(!empty($item['value']))
								<li class="flex justify-between items-center py-4 border-b border-[#F4E9FF] last:border-b-0">
									<span class="font-semibold text-base text-[#2F1E4E]">{{ $item['label'] }}</span>
									<span class="font-normal text-base text-[#2F1E4E] text-right">{{ $item['value'] }}</span>
								</li>
							@endif
						@endforeach
					@endforeach
				@endif

		

				@if(isset($userProfileData['formatted_education']) and $userProfileData['formatted_education'])
					<li class="flex justify-between items-center py-4 border-b border-[#F4E9FF] last:border-b-0">
						<span class="font-semibold text-base text-[#2F1E4E]">{{ __tr('Education') }}</span>
						<span class="font-normal text-base text-[#2F1E4E] text-right">{{ $userProfileData['formatted_education'] }}</span>
					</li>
				@endif

				@if(isset($userProfileData['formatted_work_status']) and $userProfileData['formatted_work_status'])
					<li class="flex justify-between items-center py-4 border-b border-[#F4E9FF] last:border-b-0">
						<span class="font-semibold text-base text-[#2F1E4E]">{{ __tr('Occupation') }}</span>
						<span class="font-normal text-base text-[#2F1E4E] text-right">{{ $userProfileData['formatted_work_status'] }}</span>
					</li>
				@endif
			</ul>

			@if(__isEmpty($userSpecificationData) and empty($userProfileData['formatted_body_type']) and empty($userProfileData['formatted_education']) and empty($userProfileData['formatted_work_status']))
				<div class="text-center py-12 px-4">
					<div class="text-5xl text-[#9B8AAE] mb-4">
						<i class="fas fa-user"></i>
					</div>
					<p class="font-normal text-base text-[#9B8AAE]">{{ __tr('No profile information available') }}</p>
				</div>
			@endif

			<!-- Edit Profile Button for Info Tab -->
			@if($isOwnProfile)
				<button data-toggle="modal" data-target="#mobileEditProfileModal" class="block w-[calc(100%-64px)] mx-auto mt-6 px-5 py-3 bg-[#4F1DA1] border-0 rounded-full font-medium text-base text-white text-center cursor-pointer shadow-md transition-all hover:bg-[#5B2BB5] hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0">
					{{ __tr('Edit Profile') }}
				</button>
			@endif
		</div>

		<!-- Photos Tab -->
		<div class="lw-mobile-tab-content hidden" id="mobile-photos-tab">
			@if(!__isEmpty($photosData) || $isOwnProfile)
				<div class="lw-masonry-grid" style="column-count: 2; column-gap: 0.5rem; margin: 0;">
					<!-- Upload Button (only for own profile) -->
					@if($isOwnProfile)
						<div class="lw-masonry-item" style="break-inside: avoid; margin-bottom: 0.5rem;" id="mobilePhotoUploadContainer">
							<input type="file"
								class="lw-file-uploader"
								id="mobilePhotoUpload"
								data-instant-upload="true"
								data-action="{{ route('user.upload_photos') }}"
								data-default-image-url=""
								data-allowed-media="{{ getMediaRestriction('photos') }}"
								multiple
								data-callback="afterMobilePhotoUpload"
								data-remove-all-media="true"
								data-label-idle='<div style="width: 100%; text-align: center; padding: 1.25rem 1rem;"><i class="fas fa-plus" style="font-size: 2rem; color: #4F1DA1; display: block; margin-bottom: 0.5rem;"></i><span style="color: #4F1DA1; font-weight: 500; font-size: 0.875rem;">{{ __tr("Add Photos") }}</span></div>'>
						</div>
					@endif

					@foreach($photosData as $key => $photo)
						<div class="lw-masonry-item" style="break-inside: avoid; margin-bottom: 0.5rem;">
							<img src="{{ imageOrNoImageAvailable($photo['image_url']) }}"
								 alt="Photo {{ $key + 1 }}"
								 class="w-full rounded-xl cursor-pointer transition-transform active:scale-95 lw-photoswipe-gallery-img lw-lazy-img"
								 style="display: block; width: 100%; height: auto; border-radius: 0.75rem;"
								 data-img-index="{{ $key }}"
								 data-src="{{ imageOrNoImageAvailable($photo['image_url']) }}">
						</div>
					@endforeach
				</div>
			@else
				<div class="text-center py-12 px-4">
					<div class="text-5xl text-[#9B8AAE] mb-4">
						<i class="fas fa-images"></i>
					</div>
					<p class="font-normal text-base text-[#9B8AAE]">{{ __tr('No photos available') }}</p>
				</div>
			@endif
		</div>
	</div>
</div>
<!-- /NEW MOBILE PROFILE VIEW -->

<!-- Mobile Edit Profile Modal -->
@if($isOwnProfile)
<div class="modal fade" id="mobileEditProfileModal" tabindex="-1" role="dialog" aria-labelledby="mobileEditProfileModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="margin: 0; max-width: 100%; height: 100vh;">
		<div class="modal-content" style="height: 100%; border-radius: 0; border: none;">
			<!-- Modal Header -->
			<div class="modal-header" style="background: white; border-bottom: 1px solid #E5E7EB; padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; left: 1rem; background: transparent; border: none; padding: 0; margin: 0; font-size: 24px; color: #6B7280; opacity: 1;">
					<i class="fas fa-chevron-left"></i>
				</button>
				<h5 class="modal-title font-semibold text-xl text-[#2F1E4E]" id="mobileEditProfileModalLabel" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 20px; color: #2F1E4E; margin: 0 auto;">
					{{ __tr('Info') }}
				</h5>
			</div>

			<!-- Modal Body -->
			<div class="modal-body" style="padding: 1.5rem; overflow-y: auto; background: white;">
				<form class="lw-ajax-form lw-form" method="post" action="{{ route('user.write.mobile_profile_update') }}" data-callback="onMobileProfileUpdate" id="lwMobileEditProfileForm">

					<!-- Name Field -->
					<div class="mb-4" style="margin-bottom: 1rem;">
						<div style="background: #F9F5FF; border: 1px solid #F4E9FF; border-radius: 16px; padding: 1rem 1.25rem;">
							<label class="d-block mb-1" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #2F1E4E; margin-bottom: 0.25rem;">
								{{ __tr('Name') }}
							</label>
							<input type="text" name="first_name" class="border-0 bg-transparent w-100 p-0" value="{{ $userData['first_name'] }}" required style="font-family: 'Poppins', sans-serif; font-size: 18px; color: #2F1E4E; outline: none;">
						</div>
					</div>

					<!-- Age Field -->
					<div class="mb-4" style="margin-bottom: 1rem;">
						<div style="background: #F9F5FF; border: 1px solid #F4E9FF; border-radius: 16px; padding: 1rem 1.25rem;">
							<label class="d-block mb-1" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #2F1E4E; margin-bottom: 0.25rem;">
								{{ __tr('Age') }}
							</label>
							<input type="number" name="age" class="border-0 bg-transparent w-100 p-0" value="{{ $userData['userAge'] }}" min="18" max="100" style="font-family: 'Poppins', sans-serif; font-size: 18px; color: #2F1E4E; outline: none;">
						</div>
					</div>

					<!-- Location Field -->
					<div class="mb-4" style="margin-bottom: 1rem;">
						<div style="background: #F9F5FF; border: 1px solid #F4E9FF; border-radius: 16px; padding: 1rem 1.25rem;">
							<label class="d-block mb-1" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #2F1E4E; margin-bottom: 0.25rem;">
								{{ __tr('Location') }}
							</label>
							<input type="text"
								   id="mobileLocationSearch"
								   class="border-0 bg-transparent w-100 p-0"
								   value="{{ $userProfileData['city'] ?? '' }}{{ $userProfileData['city'] && $userProfileData['country_name'] ? ', ' : '' }}{{ $userProfileData['country_name'] ?? '' }}"
								   placeholder="{{ __tr('Search for a city...') }}"
								   autocomplete="off"
								   style="font-family: 'Poppins', sans-serif; font-size: 18px; color: #2F1E4E; outline: none;">
							<input type="hidden" name="selected_city" id="selectedCityId" value="{{ $userProfileData['cities__id'] ?? '' }}">
							<!-- Autocomplete dropdown -->
							<div id="mobileLocationResults" style="display: none; position: absolute; background: white; border: 1px solid #E5E7EB; border-radius: 8px; margin-top: 0.5rem; max-height: 200px; overflow-y: auto; z-index: 1000; width: calc(100% - 3rem); box-shadow: 0 4px 6px rgba(0,0,0,0.1);"></div>
						</div>
					</div>

					<!-- About Me Field -->
					<div class="mb-4" style="margin-bottom: 1rem;">
						<div style="background: #F9F5FF; border: 1px solid #F4E9FF; border-radius: 16px; padding: 1rem 1.25rem;">
							<label class="d-block mb-1" style="font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 14px; color: #2F1E4E; margin-bottom: 0.25rem;">
								{{ __tr('About Me') }}
							</label>
							<textarea name="about_me" class="border-0 bg-transparent w-100 p-0" rows="5" style="font-family: 'Poppins', sans-serif; font-size: 18px; color: #2F1E4E; resize: vertical; min-height: 120px; outline: none;">{{ $userProfileData['aboutMe'] ?? '' }}</textarea>
						</div>
					</div>

					<!-- Submit Button -->
					<button type="submit" class="btn btn-primary w-100" style="width: 100%; padding: 1rem; background: linear-gradient(90deg, #4F1DA1 0%, #E78AB0 100%); border: none; border-radius: 12px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 16px; color: white; cursor: pointer; margin-top: 1.5rem;">
						{{ __tr('Save Changes') }}
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endif
<!-- /Mobile Edit Profile Modal -->

<!-- DESKTOP PROFILE VIEW -->
<div class="lw-contains-profile-fields lw-desktop-profile-view">
<x-lw.card class="mb-6">
<!-- Header Section -->
<div class="relative">
@if(!$isOwnProfile)
<div class="absolute top-0 right-0 flex space-x-2">
<!-- report button -->
<a class="text-lw-secondary hover:text-lw-primary transition-colors p-2 rounded-lg hover:bg-gray-50" title="{{ __tr('Report') }}" data-toggle="modal" data-target="#lwReportUserDialog">
					<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
</a>
<!-- /report button -->

 <!-- Block User button -->
 <a class="text-lw-secondary hover:text-lw-primary transition-colors p-2 rounded-lg hover:bg-gray-50" title="{{ __tr('Block User') }}" id="lwBlockUserBtn">
  <i class="fas fa-ban"></i>
</a>
<!-- /Block User button -->
</div>
@endif

<!-- User Name and Status -->
<div class="mb-4">
<h2 class="font-lw font-bold text-2xl text-lw-primary mb-2">
 {{ $userData['fullName'] }}
 @if(!__isEmpty($userData['userAge'])) 
  <span class="font-lw font-medium text-lg text-lw-secondary" data-model="userData.userAge">({{ __tr($userData['userAge']) }})</span> 
 @endif

					<!-- show user online, idle or offline status -->
 @if(!$isOwnProfile)
  @if($userOnlineStatus == 1)
  <span class="inline-block w-3 h-3 bg-green-500 rounded-full ml-2 animate-pulse" title="{{ __tr('Online') }}"></span>
  @elseif($userOnlineStatus == 2)
  <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full ml-2" title="{{ __tr('Idle') }}"></span>
						@elseif($userOnlineStatus == 3)
  <span class="inline-block w-3 h-3 bg-gray-400 rounded-full ml-2" title="{{ __tr('Offline') }}"></span>
  @endif
 @endif
 <!-- /show user online, idle or offline status -->

  <!-- if user is premium then show badge -->
  @if(getFeatureSettings('premium_badge'))
   <i class="fas fa-star text-yellow-500 ml-2"></i>
  @endif
  <!-- /if user is premium then show badge -->

  @if(__ifIsset($userProfileData['isVerified']) and $userProfileData['isVerified'] == 1)
   <i class="fas fa-user-check text-blue-500 ml-2"></i>
 @endif
</h2>
</div>

<!-- Location and Stats Row -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
				<!-- Location -->
@if((__ifIsset($userProfileData['city']) and __ifIsset($userProfileData['country_name'])))
<div class="flex items-center text-lw-secondary">
<i class="fas fa-map-marker-alt text-green-500 mr-2"></i>
<span class="font-lw font-medium">
  <span data-model="profileData.city">{{ $userProfileData['city'] }}</span>, 
   <span data-model="profileData.country_name">{{ $userProfileData['country_name'] }}</span>
  </span>
  </div>
   @endif

				<!-- Stats (for own profile) -->
				@if($isOwnProfile)
				<div class="flex items-center space-x-6">
					<!-- total user likes count -->
					<div class="flex items-center text-lw-secondary">
						<i class="fas fa-heart text-red-500 mr-2"></i>
						<span id="lwTotalUserLikes" class="font-lw font-semibold">
							{{ __trn('__totalUserLike__ like', '__totalUserLike__ likes', $totalUserLike, [
								'__totalUserLike__' => $totalUserLike
							]) }}
						</span>
					</div>
					<!-- /total user likes count -->

					<!-- total user visitors count -->
					<div class="flex items-center text-lw-secondary">
						<i class="fas fa-eye text-yellow-500 mr-2"></i>
						<span class="font-lw font-semibold">
							{{ __trn('__totalVisitors__ view', '__totalVisitors__ views', $totalVisitors, [
								'__totalVisitors__' => $totalVisitors
							]) }}
						</span>
					</div>
					<!-- /total user visitors count -->
				</div>
				@endif
			</div>
		</div>
	</x-lw.card>
	<!-- User Profile and Cover photo -->
	<x-lw.card class="lw-profile-image-card-container">
		<div class="card-body">
			@if($isOwnProfile)
			<span class="lw-profile-edit-button-container">
				<a class="lw-icon-btn" href role="button" id="lwEditProfileAndCoverPhoto">
					<i class="fa fa-pencil-alt"></i>
				</a>
				<a class="lw-icon-btn" href role="button" id="lwCloseProfileAndCoverBlock" style="display: none;">
					<i class="fa fa-times"></i>
				</a>
			</span>
			@endif
            <div class="d-none d-md-flex lw-profile-side-block-container">
                <!-- profile related -->
                @if(!$isOwnProfile)
                <div class="card lw-profile-side-block">
                    <div class="card-body text-center">
                        <!-- Like and dislike buttons -->
                        <div class="lw-like-dislike-box">
                            <!-- like button -->
                            <a href data-action="{{ route('user.write.like_dislike', ['toUserUid' => $userData['userUId'], 'like' => 1]) }}" data-method="post" data-callback="onLikeCallback" title="{{ __tr('Like') }}" class="lw-ajax-link-action" id="lwLikeBtn">
                                <span class="lw-animated-heart lw-animated-like-heart {{ (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? 'lw-is-active' : '' }}"></span>
                            </a>
                            <span data-model="userLikeStatus">{{ (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? __tr('Liked') : __tr('Like') }}
                            </span>
                            <!-- /like button -->
                        </div>
                        <div class="lw-like-dislike-box mb-4">
                            <!-- dislike button -->
                            <a href data-action="{{ route('user.write.like_dislike', ['toUserUid' => $userData['userUId'], 'like' => 0]) }}" data-method="post" data-callback="onLikeCallback" title="{{ __tr('Dislike') }}" class="lw-ajax-link-action" id="lwDislikeBtn">
                                <span class="lw-animated-heart lw-animated-broken-heart {{ (isset($userLikeData['like']) and $userLikeData['like'] == 0) ? 'lw-is-active' : '' }}"></span>
                            </a>
                            <span data-model="userDislikeStatus">{{ (isset($userLikeData['like']) and $userLikeData['like'] == 0) ? __tr('Disliked') : __tr('Dislike') }}
                            </span>
                            <!-- /dislike button -->
                        </div>
                        <div class="">
                            <!-- message button -->
                            <a title="{{ __tr('Send Message or Gift') }}" class=" btn-link btn mb-3" onclick="getChatMessenger('{{ route('user.read.individual_conversation', ['specificUserId' => $userData['userId']]) }}')" href id="lwMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog"><i class="far fa-comments fa-3x"></i>
                                <br> {{ __tr('Message') }}</a>
                            <!-- send gift button -->
                            <a href title="{{ __tr('Send Gift') }}" data-toggle="modal" data-target="#lwSendGiftDialog" class="btn-link btn"><i class="fa fa-gift fa-3x" aria-hidden="true"></i>
                                <br> {{ __tr('Gift') }}
                            </a>
                            <!-- /send gift button -->
                        </div>
                    </div>
                </div>
                @endif
            </div>
			<div class="row" id="lwProfileAndCoverStaticBlock">
                @if($isPremiumUser)
                <span class="lw-premium-badge lw-on-cover-image" title="{{ __tr('You are a Premium User') }}"></span>
                @endif
				<div class="col-lg-12">
					<div class="card mb-3 lw-profile-image-card-container">
						<img class="lw-profile-thumbnail lw-photoswipe-gallery-img lw-lazy-img" id="lwProfilePictureStaticImage" data-src="{{ imageOrNoImageAvailable($userData['profilePicture']) }}">
						<img class="lw-cover-picture card-img-top lw-photoswipe-gallery-img lw-lazy-img" id="lwCoverPhotoStaticImage" data-img-index="1" data-src="{{ imageOrNoImageAvailable($userData['coverPicture']) }}">
					</div>
				</div>
			</div>
			@if($isOwnProfile)
			<div class="row" id="lwProfileAndCoverEditBlock" style="display: none;">
				<div class="col-lg-3">
					<input type="file" name="filepond" class="filepond lw-file-uploader" id="lwFileUploader" data-remove-media="true" data-instant-upload="true" data-action="{{ route('user.upload_profile_image') }}" data-label-idle="{{ __tr("Drag & Drop your picture or __browseAction__", [
																																																												'__browseAction__' => "<span class='filepond--label-action'>" . __tr('Browse') . "</span>"
																																																											]) }}" data-image-preview-height="170" data-image-crop-aspect-ratio="1:1" data-style-panel-layout="compact circle" data-style-load-indicator-position="center bottom" data-style-progress-indicator-position="right bottom" data-style-button-remove-item-position="left bottom" data-style-button-process-item-position="right bottom" data-callback="afterUploadedProfilePicture">
				</div>
				<div class="col-lg-9">
					<input type="file" name="filepond" class="filepond lw-file-uploader mt-5" id="lwFileUploader" data-remove-media="false" data-instant-upload="true" data-action="{{ route('user.upload_cover_image') }}" data-callback="afterUploadedCoverPhoto" data-label-idle="{{ __tr("Drag & Drop your picture or __browseAction__", [
																																																																							'__browseAction__' => "<span class='filepond--label-action'>" . __tr('Browse') . "</span>"
																																																																						]) }}">
				</div>
			</div>
			@endif
		</div>
	</x-lw.card>
	<!-- /User Profile and Cover photo -->

	<!-- mobile view like dislike block -->
	@if(!$isOwnProfile)
	<div class="mb-4 d-block d-md-none">
		<!-- profile related -->
		<x-lw.card>
			<div class="card-header bg-gradient-lw">
				{{ __tr('Like Dislike') }}
			</div>
			<div class="card-body">
				<!-- Like and dislike buttons -->
				@if(!$isOwnProfile)
				<div class="lw-like-dislike-box">
					<!-- like button -->
					<a href data-action="{{ route('user.write.like_dislike', ['toUserUid' => $userData['userUId'], 'like' => 1]) }}" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn">
						<span class="lw-animated-heart lw-animated-like-heart {{ (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? 'lw-is-active' : '' }}"></span>
					</a>
					<span data-model="userLikeStatus">{{ (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? __tr('Liked') : __tr('Like') }}
					</span>
					<!-- /like button -->
				</div>
				<div class="lw-like-dislike-box">
					<!-- dislike button -->
					<a href data-action="{{ route('user.write.like_dislike', ['toUserUid' => $userData['userUId'], 'like' => 0]) }}" data-method="post" data-callback="onLikeCallback" title="Dislike" class="lw-ajax-link-action lw-dislike-action-btn" id="lwDislikeBtn">
						<span class="lw-animated-heart lw-animated-broken-heart {{ (isset($userLikeData['like']) and $userLikeData['like'] == 0) ? 'lw-is-active' : '' }}"></span>
					</a>
					<span data-model="userDislikeStatus">{{ (isset($userLikeData['like']) and $userLikeData['like'] == 0) ? __tr('Disliked') : __tr('Dislike') }}
					</span>
					<!-- /dislike button -->
				</div>
				@endif
			</div>
			<!-- / Like and dislike buttons -->
		</x-lw.card>
		<x-lw.card class="mt-3">
			<div class="card-header">
				{{ __tr('Send Message or Gift') }}
			</div>
			<div class="card-body text-center">
				<!-- message button -->
				<a class="mr-3 btn-link btn" onclick="getChatMessenger('{{ route('user.read.individual_conversation', ['specificUserId' => $userData['userId']]) }}')" href id="lwMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog"><i class="far fa-comments fa-3x"></i>
					<br> {{ __tr('Message') }}</a>

				<!-- send gift button -->
				<a href title="{{ __tr('Send Gift') }}" data-toggle="modal" data-target="#lwSendGiftDialog" class="btn-link btn"><i class="fa fa-gift fa-3x" aria-hidden="true"></i>
					<br> {{ __tr('Gift') }}
				</a>
				<!-- /send gift button -->
			</div>
		</x-lw.card>
	</div>
	@endif
	<!-- /mobile view like dislike block -->
	@if(isset($userProfileData['aboutMe']) and $userProfileData['aboutMe'])
	<x-lw.card class="mb-3">
		<div class="card-header bg-gradient-lw">
            <h5 class="text-white font-lw font-semibold"><i class="fas fa-user text-primary"></i> {{ __tr('About Me') }}</h5>
		</div>
		<div class="card-body">
			<!-- About Me -->
			<div class="form-group">
				<div class="lw-inline-edit-text" data-model="profileData.aboutMe">
					{{ __ifIsset($userProfileData['aboutMe'], $userProfileData['aboutMe'], '-') }}
				</div>
			</div>
			<!-- /About Me -->
		</div>
	</x-lw.card>
	@endif
	@if(!__isEmpty($photosData) or $isOwnProfile)
	<x-lw.card class="mb-3">
		<div class="card-header bg-gradient-lw">
			@if($isOwnProfile)
			<span class="float-right">
				<a class="lw-icon-btn lw-ajax-link-action lw-action-with-url" data-event-callback="lwPrepareUploadPlugIn" href="{{ route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) }}" role="button">
					<i class="fas fa-cog"></i>
				</a>
			</span>
			@endif
			<h5 class="text-white font-lw font-semibold"><i class="fas fa-images text-warning"></i> {{ __tr('Photos') }}</h5>
		</div>

		<div class="card-body">
			<div class="row text-center text-lg-left lw-horizontal-container pl-2">
				@if(!__isEmpty($photosData))
				@foreach($photosData as $key => $photo)
				<img class="lw-user-photo lw-photoswipe-gallery-img lw-lazy-img" data-img-index="{{ $key }}" data-src="{{ imageOrNoImageAvailable($photo['image_url']) }}">
				@endforeach
				@else
				{{ __tr('Ooops... No images found...') }}
				@endif
			</div>
		</div>
	</x-lw.card>
	@endif

	<!-- user gift data -->
	@if(!__isEmpty($userGiftData) or $isOwnProfile)
	<x-lw.card class="mb-3">
		<!-- Gift Header -->
		<div class="card-header bg-gradient-lw">
			<h5 class="text-white font-lw font-semibold"><i class="fa fa-gifts" aria-hidden="true"></i> {{ __tr('Gifts') }}</h5>
		</div>
		<!-- /Gift Header -->
		<!-- Gift Card Body -->
		<div class="card-body" id="lwUserGift">
			@if(!__isEmpty($userGiftData))
			<div class="row">
				@foreach($userGiftData as $gift)
				<div class="col-sm-12 col-md-6 col-lg-2">
				<div class="lw-user-gift-container">
					<img data-src="{{ imageOrNoImageAvailable($gift['userGiftImgUrl']) }}" class="lw-user-gift-img lw-lazy-img" />
					<small>
						{{ __tr('sent by') }} <br>
						<a class="lw-ajax-link-action lw-action-with-url" href="{{ route('user.profile_view', ['username' => $gift['senderUserName']]) }}">{{ $gift['fromUserName'] }}</a></small>
					@if($gift['status'] === 1)
					<i class="fas fa-mask" title="{{ __tr('This is a private gift you and only sender can see this.') }}"></i>
					@endif
				</div>
				</div>
				@endforeach
			</div>
			<!-- show more gift button -->
			<div class="mt-3">
				<button class="btn btn-dark btn-sm btn-block" id="showMoreGiftBtn"> <i class="fa fa-chevron-down"></i> {{ __tr('Show More') }}</button>
			</div>
			<!-- /show more gift button -->

			<!-- show less gift button -->
			<div class="mt-3">
				<button class="btn btn-dark btn-sm btn-block" id="showLessGiftBtn"> <i class="fa fa-chevron-up"></i> {{ __tr('Show Less') }}</button>
			</div>
			<!-- /show less gift button -->
			@else
			<!-- info message -->
			<div class="alert alert-info">
				{{ __tr('There are no gifts.') }}
			</div>
			<!-- / info message -->
			@endif
		</div>
		<!-- Gift Card Body -->
	</x-lw.card>
	@endif
	<!-- /user gift data -->

	<!-- User Basic Information -->
	<x-lw.card class="mb-3">
		<!-- Basic information Header -->
		<div class="card-header bg-gradient-lw">
			<!-- Check if its own profile -->
			@if($isOwnProfile)
			<span class="float-right">
				<a class="lw-icon-btn" href role="button" id="lwEditBasicInformation">
					<i class="fa fa-pencil-alt"></i>
				</a>
				<a class="lw-icon-btn" href role="button" id="lwCloseBasicInfoEditBlock" style="display: none;">
					<i class="fa fa-times"></i>
				</a>
			</span>
			@endif
			<!-- /Check if its own profile -->
			<h5 class="text-white font-lw font-semibold"><i class="fas fa-info-circle text-info"></i> {{ __tr('Basic Information') }}</h5>
		</div>
		<!-- /Basic information Header -->
		<!-- Basic Information content -->
		<div class="card-body">
			<!-- Static basic information container -->
			<div id="lwStaticBasicInformation">
				@if($isOwnProfile)
				<div class="form-group row">
					<!-- First Name -->
					<div class="col-sm-6 mb-3 mb-sm-0">
						<label for="first_name" class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('First Name') }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="userData.first_name">{{ __ifIsset($userData['first_name'], $userData['first_name'], '-') }}</div>
					</div>
					<!-- /First Name -->
					<!-- Last Name -->
					<div class="col-sm-6">
						<label for="last_name" class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('Last Name') }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="userData.last_name">{{ __ifIsset($userData['last_name'], $userData['last_name'], '-') }}</div>
					</div>
					<!-- /Last Name -->
				</div>
				@endif
				<div class="form-group row">
					<!-- Gender -->
					<div class="col-sm-6 mb-3 mb-sm-0">
						<label for="select_gender" class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('Gender') }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="profileData.gender_text">
							{{ __ifIsset($userProfileData['gender_text'], $userProfileData['gender_text'], '-') }}
						</div>
					</div>
					<!-- /Gender -->
					<!-- Preferred Language -->
					<div class="col-sm-6">
						<label class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('Preferred Language') }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="profileData.formatted_preferred_language">
							{{ __ifIsset($userProfileData['formatted_preferred_language'], $userProfileData['formatted_preferred_language'], '-') }}
						</div>
					</div>
					<!-- /Preferred Language -->
				</div>
				<div class="form-group row">
					<!-- Relationship Status -->
					<div class="col-sm-6 mb-3 mb-sm-0">
						<label class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('Relationship Status') }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="profileData.formatted_relationship_status">
							{{ __ifIsset($userProfileData['formatted_relationship_status'], $userProfileData['formatted_relationship_status'], '-') }}
						</div>
					</div>
					<!-- /Relationship Status -->
					<!-- Work Status -->
					<div class="col-sm-6">
						<label for="work_status" class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('Work Status') }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="profileData.formatted_work_status">
							{{ __ifIsset($userProfileData['formatted_work_status'], $userProfileData['formatted_work_status'], '-') }}
						</div>
					</div>
					<!-- /Work Status -->
				</div>
				<div class="form-group row">
					<!-- Education -->
					<div class="col-sm-6 mb-3 mb-sm-0">
						<label for="education" class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('Education') }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="profileData.formatted_education">
							{{ __ifIsset($userProfileData['formatted_education'], $userProfileData['formatted_education'], '-') }}
						</div>
					</div>
					<!-- /Education -->
					<!-- Birthday --> 
					<div class="col-sm-6">
						<label for="birthday" class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('Birthday') }}</strong></label>
						<div class="lw-inline-edit-text d-block font-lw text-lw-primary" data-model="profileData.birthday">
							{{ __ifIsset($userProfileData['birthday'], $userProfileData['birthday'], '-') }}
						</div>
					</div>
					<!-- /Birthday -->
				</div>
				@if(array_get($userProfileData, 'showMobileNumber'))
				<div class="form-group row">
					<!-- Mobile Number -->
					<div class="col-sm-6 mb-3 mb-sm-0">
						<label for="mobile_number" class="font-lw font-semibold text-lw-primary"><strong>{{ __tr('Mobile Number') }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="profileData.mobile_number">
							{{ __ifIsset($userProfileData['mobile_number'], $userProfileData['mobile_number'], '-') }}
						</div>
					</div>
					<!-- /Mobile Number -->
				</div>
				@endif
			</div>
			<!-- /Static basic information container -->

			@if($isOwnProfile)
			<!-- User Basic Information Form -->
			<form class="lw-ajax-form lw-form" lwSubmitOnChange method="post" data-show-message="true" action="{{ route('user.write.basic_setting') }}" data-callback="getUserProfileData" style="display: none;" id="lwUserBasicInformationForm">
				<div class="form-group row">
					<!-- First Name -->
					<div class="col-sm-6 mb-3 mb-sm-0">
						<x-lw.form-field label="{{ __tr('First Name') }}" name="first_name" required>
							<x-lw.input 
								type="text"
								name="first_name"
								value="{{ $userData['first_name'] }}"
								placeholder="{{ __tr('First Name') }}"
								required
							/>
						</x-lw.form-field>
					</div>
					<!-- /First Name -->
					<!-- Last Name -->
					<div class="col-sm-6">
						<x-lw.form-field label="{{ __tr('Last Name') }}" name="last_name" required>
							<x-lw.input 
								type="text"
								name="last_name"
								value="{{ $userData['last_name'] }}"
								placeholder="{{ __tr('Last Name') }}"
								required
							/>
						</x-lw.form-field>
					</div>
					<!-- /Last Name -->
				</div>
				<div class="form-group row">
					<!-- Gender -->
					<div class="col-sm-6 mb-3 mb-sm-0 mt-2">
						<x-lw.form-field label="{{ __tr('Gender') }}" name="gender">
							<x-lw.select 
								name="gender"
								placeholder="{{ __tr('Choose your gender') }}"
								:options="$genders"
								value="{{ __ifIsset($userProfileData['gender'], $userProfileData['gender'], '') }}"
								id="select_gender"
							/>
						</x-lw.form-field>
					</div>

					<!-- /Gender -->
					<!-- Preferred Language -->
					<div class="col-sm-6 mt-2">
						<x-lw.form-field label="{{ __tr('Preferred Language') }}" name="preferred_language">
							<x-lw.select 
								name="preferred_language"
								placeholder="{{ __tr('Choose your Preferred Language') }}"
								:options="$preferredLanguages"
								value="{{ __ifIsset($userProfileData['preferred_language'], $userProfileData['preferred_language'], '') }}"
								id="select_preferred_language"
							/>
						</x-lw.form-field>
					</div>
					<!-- /Preferred Language -->
				</div>
				<div class="form-group row">
					<!-- Relationship Status -->
					<div class="col-sm-6 mb-3 mb-sm-0">
						<x-lw.form-field label="{{ __tr('Relationship Status') }}" name="relationship_status">
							<x-lw.select 
								name="relationship_status"
								placeholder="{{ __tr('Choose your Relationship Status') }}"
								:options="$relationshipStatuses"
								value="{{ __ifIsset($userProfileData['relationship_status'], $userProfileData['relationship_status'], '') }}"
								id="select_relationship_status"
							/>
						</x-lw.form-field>
					</div>
					<!-- /Relationship Status -->
					<!-- Work status -->
					<div class="col-sm-6">
						<x-lw.form-field label="{{ __tr('Work Status') }}" name="work_status">
							<x-lw.select 
								name="work_status"
								placeholder="{{ __tr('Choose your work status') }}"
								:options="$workStatuses"
								value="{{ __ifIsset($userProfileData['work_status'], $userProfileData['work_status'], '') }}"
								id="select_work_status"
							/>
						</x-lw.form-field>
					</div>
					<!-- /Work status -->
				</div>
				<div class="form-group row">
					<!-- Education -->
					<div class="col-sm-6 mb-3 mb-sm-0">
						<x-lw.form-field label="{{ __tr('Education') }}" name="education">
							<x-lw.select 
								name="education"
								placeholder="{{ __tr('Choose your education') }}"
								:options="$educations"
								value="{{ __ifIsset($userProfileData['education'], $userProfileData['education'], '') }}"
								id="select_education"
							/>
						</x-lw.form-field>
					</div>
					<!-- /Education -->
					<!-- Birthday -->
					<div class="col-sm-6">
						<x-lw.form-field label="{{ __tr('Birthday') }}" name="birthday">
							<x-lw.input 
								type="date"
								name="birthday"
								min="{{ getAgeDate(configItem('age_restriction.maximum'), 'max')->format('Y-m-d') }}"
								max="{{ getAgeDate(configItem('age_restriction.minimum'))->format('Y-m-d') }}"
								class="lw-date-input"
								placeholder="{{ __tr('DD-MM-YYYY') }}"
								value="{{ __ifIsset($userProfileData['dob'], $userProfileData['dob']) }}"
								required
							/>
						</x-lw.form-field>
					</div>
					<!-- /Birthday -->
				</div>
				@if($isOwnProfile)

				<div class="form-group row">
					<!-- Mobile Number -->
					<div class="form-group col-sm-6">
					<x-lw.form-field label="{{ __tr('Mobile Number') }}" name="mobile_number">
							<div class="lw-mobile-input-group">
					@php
					$countryOptions = [];
									$countryOptions[''] = __tr('Select Country Code');
					foreach(getCountryPhoneCodes() as $getCountryCode) {
										$countryOptions[$getCountryCode['phone_code']] = $getCountryCode['name'] . ' (0' . $getCountryCode['phone_code'] . ')';
					}
					@endphp
								<x-lw.select 
					name="country_code"
									class="lw-country-select lw-country-code-select"
									:options="$countryOptions"
									value="{{ $userData['country_code'] }}"
					id="country_code"
					required
								/>
					<x-lw.input 
					type="number"
					name="mobile_number"
					value="{{ $userData['mobile_number'] }}"
					placeholder="{{  __tr('Mobile Number') }}"
									class="lw-mobile-input lw-remove-spinner"
					minlength="8"
					maxlength="15"
					required
					/>
					</div>
					</x-lw.form-field>
					</div>
					<!-- /Mobile Number -->
				</div>
				<!-- About Me -->
				<div class="form-group mt-5">
					<x-lw.form-field label="{{ __tr('About Me') }}" name="about_me">
						<x-lw.textarea 
							name="about_me"
							rows="3"
							placeholder="{{ __tr('Say something about yourself.') }}"
						>{{ __ifIsset($userProfileData['aboutMe'], $userProfileData['aboutMe'], '') }}</x-lw.textarea>
					</x-lw.form-field>
				</div>
				<!-- /About Me -->
				@endif
			</form>
			<!-- /User Basic Information Form -->
			@endif
		</div>
	</x-lw.card>
	<!-- /User Basic Information -->
	<x-lw.card class="mb-3">
		<div class="card-header bg-gradient-lw">
			@if($isOwnProfile)
			<span class="float-right">
				<a class="lw-icon-btn" href role="button" id="lwEditUserLocation">
					<i class="fa fa-pencil-alt"></i>
				</a>
				<a class="lw-icon-btn" href role="button" id="lwCloseLocationBlock" style="display: none;">
					<i class="fa fa-times"></i>
				</a>
			</span>
			@endif
			<h5 class="text-white font-lw font-semibold"><i class="fas fa-map-marker-alt"></i> {{ __tr('Location') }}</h5>
		</div>
		<div class="card-body">
			<div id="lwUserStaticLocation">
			@if(getStoreSettings('display_google_map'))
				<div class="gmap_canvas"><iframe height="300" id="gmap_canvas" src="https://maps.google.com/maps/place?q={{ $latitude }},{{ $longitude }}&output=embed&language={{ app()->getLocale() }}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
				</div>
			@else
			<div id="staticMapId"></div>
			@endif
			</div>
            @if(getStoreSettings('allow_google_map') or getStoreSettings('use_static_city_data'))
			<div id="lwUserEditableLocation" style="display: none;">
				@if(getStoreSettings('use_static_city_data'))
					<div class="form-group">
						<label for="selectLocationCity">{{ __tr('Location') }}</label>
						<input type="text" id="selectLocationCity" class="form-control" placeholder="{{ __tr('Enter a location') }}">
					</div>
				@else
					<div class="form-group">
						<label for="address_address">{{ __tr('Location') }}</label>
						<input type="text" id="address-input" name="address_address" class="form-control map-input" placeholder="{{ __tr('Enter a location') }}">

						<!-- show select location on map error -->
						<div class="alert alert-danger mt-2 alert-dismissible" style="display: none" id="lwShowLocationErrorMessage">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span data-model="locationErrorMessage"></span>
						</div>
						<!-- /show select location on map error -->

						<input type="hidden" name="address_latitude" data-model="profileData.latitude" id="address-latitude" value="{{ $latitude }}" />
						<input type="hidden" name="address_longitude" data-model="profileData.longitude" id="address-longitude" value="{{ $longitude }}" />
					</div>
					<div id="address-map-container" style="width:100%;height:400px; ">
						<div style="width: 100%; height: 100%" id="address-map"></div>
					</div>
				@endif
			</div>
			@else
			<!-- info message -->
			<div class="alert alert-info">
				{{ __tr('Something went wrong with Google Api Key, please contact to system administrator.') }}
			</div>
			<!-- / info message -->
			@endif
		</div>
	</x-lw.card>

	<!-- User Specifications -->
	@if(!__isEmpty($userSpecificationData))
	@foreach($userSpecificationData as $specificationKey => $specifications)
	<x-lw.card class="mb-3 {{ $specifications['title'] === 'Lifestyle' ? 'd-none' : '' }}">
		<!-- User Specification Header -->
		<div class="card-header bg-gradient-lw">
			<!-- Check if its own profile -->
			@if($isOwnProfile)
			<span class="float-right">
				<a class="lw-icon-btn " href role="button" id="lwEdit{{ $specificationKey }}" onclick="showHideSpecificationUser('{{ $specificationKey }}', event)">
					<i class="fa fa-pencil-alt"></i>
				</a>
				<a class="lw-icon-btn " href role="button" id="lwClose{{ $specificationKey }}Block" onclick="showHideSpecificationUser('{{ $specificationKey }}', event)" style="display: none;">
					<i class="fa fa-times"></i>
				</a>
			</span>
			@endif
			<!-- /Check if its own profile -->
			<h5 class="text-white font-lw font-semibold">{!! $specifications['icon'] !!} {{ $specifications['title'] }}</h5>
		</div>
		<!-- /User Specification Header -->
		<div class="card-body">
			<!-- User Specification static container -->
			<div id="lw{{ $specificationKey }}StaticContainer">
				@foreach(collect($specifications['items'])->chunk(2) as $specKey => $specification)
				<div class="form-group row">
					@foreach($specification as $itemKey => $item)
					<div class="col-sm-6 mb-3 mb-sm-0">
						<label class="font-lw font-semibold text-lw-primary"><strong>{{ $item['label'] }}</strong></label>
						<div class="lw-inline-edit-text font-lw text-lw-primary" data-model="specificationData.{{ $item['name'] }}">
							{!! __tr($item['value'],escapeInputString:false) !!}
						</div>
					</div>
					@endforeach
				</div>
				@endforeach
			</div>
			<!-- /User Specification static container -->
			@if($isOwnProfile)
			<!-- User Specification Form -->
			<form class="lw-ajax-form lw-form" method="post" lwSubmitOnChange action="{{ route('user.write.profile_setting') }}" data-callback="getUserProfileData" id="lwUser{{ $specificationKey }}Form" style="display: none;">
				@foreach(collect($specifications['items'])->chunk(2) as $specification)
				<div class="form-group row">
					@foreach($specification as $itemKey => $item)
					<div class="col-sm-6 mb-3 mb-sm-0">
						@if($item['input_type'] == 'select')
						<x-lw.form-field label="{{ $item['label'] }}" name="{{ $item['name'] }}">
							<x-lw.select 
								name="{{ $item['name'] }}"
								placeholder="{{ __tr('Choose __label__', ['__label__' => $item['label']]) }}"
								:options="$item['options'] ?? []"
								value="{{ $item['selected_options'] ?? '' }}"
							/>
						</x-lw.form-field>
						@elseif($item['input_type'] == 'textbox')
						<x-lw.form-field label="{{ $item['label'] }}" name="{{ $item['name'] }}">
							<x-lw.input 
								type="text"
								name="{{ $item['name'] }}"
								value="{{ $item['selected_options'] }}"
							/>
						</x-lw.form-field>
						@endif
					</div>
					@endforeach
				</div>
				@endforeach
			</form>
			<!-- /User Specification Form -->
			@endif
		</div>
	</x-lw.card>
	@endforeach
	@endif
	<!-- /User Specifications -->

</div>
<!-- /DESKTOP PROFILE VIEW -->



<!-- user report Modal-->
	<div class="modal fade" id="lwReportUserDialog" tabindex="-1" role="dialog" aria-labelledby="userReportModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="userReportModalLabel">{{ __tr('Abuse Report to __username__', [
																			'__username__' => $userData['fullName']
																		]) }}</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="lw-ajax-form lw-form" id="lwReportUserForm" method="post" data-callback="userReportCallback" action="{{ route('user.write.report_user', ['sendUserUId' => $userData['userUId']]) }}">
					<div class="modal-body">
						<!-- reason input field -->
						<div class="form-group">
							<label for="lwUserReportReason">{{ __tr('Reason') }}</label>
							<textarea class="form-control" rows="3" id="lwUserReportReason" name="report_reason" required></textarea>
						</div>
						<!-- / reason input field -->
					</div>

					<!-- modal footer -->
					<div class="modal-footer mt-3">
						<button class="btn btn-light btn-sm" id="lwCloseUserReportDialog">{{ __tr('Cancel') }}</button>
						<button type="submit" class="btn btn-primary btn-sm lw-ajax-form-submit-action btn-user lw-btn-block-mobile">{{ __tr('Report') }}</button>
					</div>
				</form>
				<!-- modal footer -->
			</div>
		</div>
	</div>
	<!-- /user report Modal-->

	<!-- send gift Modal-->
	<div class="modal fade" id="lwSendGiftDialog" tabindex="-1" role="dialog" aria-labelledby="sendGiftModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					@php $totalAvailableCredits = totalUserCredits() @endphp
					<h5 class="modal-title" id="sendGiftModalLabel">{{ __tr('Send Gift') }} <small class="text-muted">{{ __tr('(Credits Available:  __availableCredits__)', [
																															'__availableCredits__' => $totalAvailableCredits
																														]) }}</small></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				@if(isset($giftListData) and !__isEmpty($giftListData))

				<!-- insufficient balance error message -->
				<div class="alert alert-info" id="lwGiftModalErrorText" style="display: none">
					{{ __tr('Your credit balance is too low, please') }}
					<a href="{{ route('user.credit_wallet.read.view') }}">{{ __tr('purchase credits') }}</a>
				</div>
				<!-- / insufficient balance error message -->

				<form class="lw-ajax-form lw-form" id="lwSendGiftForm" method="post" data-callback="sendGiftCallback" action="{{ route('user.write.send_gift', ['sendUserUId' => $userData['userUId']]) }}">
					<div class="modal-body">
						<div class="btn-group-toggle" data-toggle="buttons">
							@foreach($giftListData as $key => $gift)
							<span class="btn lw-group-radio-option-img" id="lwSendGiftRadioBtn_{{ $gift['_uid'] }}">
								<input type="radio" value="{{ $gift['_uid'] }}" name="selected_gift" />
								<span>
									<img class="lw-lazy-img" data-src="{{ imageOrNoImageAvailable($gift['gift_image_url']) }}" /><br>
									{{ $gift['formattedPrice'] }}
								</span>
							</span>
							@endforeach
						</div>

						<!-- select private / public -->
						<div class="custom-control custom-checkbox custom-control-inline mt-3">
							<input type="checkbox" class="custom-control-input" id="isPrivateCheck" name="isPrivateGift">
							<label class="custom-control-label" for="isPrivateCheck">{{ __tr('Private') }}</label>
						</div>
						<!-- /select private / public -->
					</div>
					<!-- modal footer -->
					<div class="modal-footer mt-3">
						<button class="btn btn-light btn-sm" id="lwCloseSendGiftDialog">{{ __tr('Cancel') }}</button>
						<button type="submit" class="btn btn-primary btn-sm lw-ajax-form-submit-action btn-user lw-btn-block-mobile">{{ __tr('Send') }}</button>
					</div>
					<!-- modal footer -->
				</form>
				@else
				<!-- info message -->
				<div class="alert alert-info">
					{{ __tr('There are no gifts') }}
				</div>
				<!-- / info message -->
				@endif
			</div>
		</div>
	</div>
	<!-- /send gift Modal-->

	<!-- User block Confirmation text html -->
	<div id="lwBlockUserConfirmationText" style="display: none;">
		<h3>{{ __tr('Are You Sure!') }}</h3>
		<strong>{{ __tr('You want to block this user.') }}</strong>
	</div>
	<!-- /User block Confirmation text html -->
@endif
<!-- /if user block then don't show profile page content -->

@lwPush('appScripts')
@if(getStoreSettings('allow_google_map'))
<script src="https://maps.googleapis.com/maps/api/js?key={{ getStoreSettings('google_map_key') }}&libraries=places&callback=initialize&language={{ app()->getLocale() }}" async defer></script>
@endif
<script>
	//start show more gift item if user gift length is greater then 10
	var userGiftLength = $("#lwUserGift, .lw-user-gift-container").length;

	$("#showMoreGiftBtn").hide();
	$("#showLessGiftBtn").hide();
	//check gift length is greater than 10
	if (userGiftLength > 8) {
		$("#showMoreGiftBtn").show();
		$('.lw-user-gift-container').hide();
		$('.lw-user-gift-container:lt(8)').show();

		//on click show more gift show all remaining gifts
		$("#showMoreGiftBtn").on('click', function() {
			$('.lw-user-gift-container:lt(' + userGiftLength + ')').show();
			$("#showMoreGiftBtn").hide();
			$("#showLessGiftBtn").show();
		});

		//on click show less gift show only 10 gifts
		$("#showLessGiftBtn").on('click', function() {
			$('.lw-user-gift-container').hide();
			$('.lw-user-gift-container:lt(8)').show();
			$("#showMoreGiftBtn").show();
			$("#showLessGiftBtn").hide();
		});
	}
	//end show more gift item if user gift length is greater then 10


	// Get user profile data
	function getUserProfileData(response) {
		// If successfully stored data
		if (response.reaction == 1) {
			__DataRequest.get("{{ route('user.get_profile_data', ['username' => getUserAuthInfo('profile.username')]) }}", {}, function(responseData) {
				var requestData = responseData.data;
				var specificationUpdateData = [];
				_.forEach(requestData.userSpecificationData, function(specification) {
					_.forEach(specification['items'], function(item) {
						specificationUpdateData[item.name] = item.value;
					});
				});
				__DataRequest.updateModels('userData', requestData.userData);
				__DataRequest.updateModels('profileData', requestData.userProfileData);
				__DataRequest.updateModels('specificationData', specificationUpdateData);
			});
		}
	}

	// Mobile Edit Profile Modal Callback
	function onMobileProfileUpdate(response) {
		if (response.reaction == 1) {
			// Close the modal
			$('#mobileEditProfileModal').modal('hide');

			// Show success message
			showSuccessMessage(response.data.message || '{{ __tr("Profile updated successfully") }}');

			// Reload the page to show all updates
			setTimeout(function() {
				location.reload();
			}, 800);
		}
	}

	// Mobile Location Search Autocomplete
	$(document).ready(function() {
		let searchTimeout;
		const $locationSearch = $('#mobileLocationSearch');
		const $locationResults = $('#mobileLocationResults');
		const $selectedCityId = $('#selectedCityId');

		$locationSearch.on('input', function() {
			clearTimeout(searchTimeout);
			const searchTerm = $(this).val().trim();

			if (searchTerm.length < 2) {
				$locationResults.hide().empty();
				$selectedCityId.val('');
				return;
			}

			searchTimeout = setTimeout(function() {
				// Search for cities using __DataRequest
				__DataRequest.post('{{ route("user.read.search_static_cities") }}', {
					search_query: searchTerm
				}, function(response) {
					if (response.data && response.data.length > 0) {
						let html = '';
						response.data.forEach(function(city) {
							html += '<div class="location-result-item" data-city-id="' + city._id + '" data-city-name="' + city.name + ', ' + city.country_name + '" style="padding: 0.75rem 1rem; cursor: pointer; border-bottom: 1px solid #F3F4F6; transition: background 0.2s;" onmouseover="this.style.background=\'#F9FAFB\'" onmouseout="this.style.background=\'white\'">' +
									'<div style="font-family: \'Poppins\', sans-serif; font-size: 14px; color: #2F1E4E;">' + city.name + ', ' + city.country_name + '</div>' +
									'</div>';
						});
						$locationResults.html(html).show();
					} else {
						$locationResults.html('<div style="padding: 0.75rem 1rem; font-family: \'Poppins\', sans-serif; font-size: 14px; color: #9CA3AF;">{{ __tr("No cities found") }}</div>').show();
					}
				}, function(error) {
					console.error('Location search error:', error);
					$locationResults.html('<div style="padding: 0.75rem 1rem; font-family: \'Poppins\', sans-serif; font-size: 14px; color: #EF4444;">{{ __tr("Error searching cities") }}</div>').show();
				});
			}, 300);
		});

		// Handle city selection
		$(document).on('click', '.location-result-item', function() {
			const cityId = $(this).data('city-id');
			const cityName = $(this).data('city-name');

			$locationSearch.val(cityName);
			$selectedCityId.val(cityId);
			$locationResults.hide().empty();
		});

		// Hide results when clicking outside
		$(document).on('click', function(e) {
			if (!$(e.target).closest('#mobileLocationSearch, #mobileLocationResults').length) {
				$locationResults.hide();
			}
		});
	});

	/**************** User Like Dislike Fetch and Callback Block Start ******************/
	//add disabled anchor tag class on click
	$(".lw-like-action-btn, .lw-dislike-action-btn").on('click', function() {
		$('.lw-like-dislike-box').addClass("lw-disable-anchor-tag");
	});
	//on like Callback function
	function onLikeCallback(response) {
		var requestData = response.data;
		//check reaction code is 1 and status created or updated and like status is 1
		if (response.reaction == 1 && requestData.likeStatus == 1 && (requestData.status == "created" || requestData.status == 'updated')) {
			__DataRequest.updateModels({
				'userLikeStatus': '{{ __tr('Liked') }}', //user liked status
				'userDislikeStatus': '{{ __tr('Dislike') }}', //user dislike status
			});
			//add class
			$(".lw-animated-like-heart").toggleClass("lw-is-active");
			//check if updated then remove class in dislike heart
			if (requestData.status == 'updated') {
				$(".lw-animated-broken-heart").toggleClass("lw-is-active");
			}
		}
		//check reaction code is 1 and status created or updated and like status is 2
		if (response.reaction == 1 && requestData.likeStatus == 2 && (requestData.status == "created" || requestData.status == 'updated')) {
			__DataRequest.updateModels({
				'userLikeStatus': '{{ __tr('Like') }}', //user like status
				'userDislikeStatus': '{{ __tr('Disliked') }}', //user disliked status
			});
			//add class
			$(".lw-animated-broken-heart").toggleClass("lw-is-active");
			//check if updated then remove class in like heart
			if (requestData.status == 'updated') {
				$(".lw-animated-like-heart").toggleClass("lw-is-active");
			}
		}
		//check reaction code is 1 and status deleted and like status is 1
		if (response.reaction == 1 && requestData.likeStatus == 1 && requestData.status == "deleted") {
			__DataRequest.updateModels({
				'userLikeStatus': '{{ __tr('Like') }}', //user like status
			});
			$(".lw-animated-like-heart").toggleClass("lw-is-active");
		}
		//check reaction code is 1 and status deleted and like status is 2
		if (response.reaction == 1 && requestData.likeStatus == 2 && requestData.status == "deleted") {
			__DataRequest.updateModels({
				'userDislikeStatus': '{{ __tr('Dislike') }}', //user like status
			});
			$(".lw-animated-broken-heart").toggleClass("lw-is-active");
		}
		//remove disabled anchor tag class
		_.delay(function() {
			$('.lw-like-dislike-box').removeClass("lw-disable-anchor-tag");
		}, 1000);
	}
	/**************** User Like Dislike Fetch and Callback Block End ******************/


	//send gift callback
	function sendGiftCallback(response) {
		//check success reaction is 1
		if (response.reaction == 1) {
			var requestData = response.data;
			//form reset after success
			$("#lwSendGiftForm").trigger("reset");
			//remove active class after success on select gift radio option
			$("#lwSendGiftRadioBtn_" + requestData.giftUid).removeClass('active');
			//close dialog after success
			$('#lwSendGiftDialog').modal('hide');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            //updated credit wallet amt
            if (_.has(requestData, 'creditsRemaining')) {
                $("#lwTotalCreditWalletAmt").html(requestData.creditsRemaining)
            }

			//if error type is insufficient balance then show error message
		} else if (response.data['errorType'] == 'insufficient_balance') {
			//show error div
			$("#lwGiftModalErrorText").show();
		} else {
			//hide error div
			$("#lwGiftModalErrorText").hide();
		}
	}

	//close Send Gift Dialog
	$("#lwCloseSendGiftDialog").on('click', function(e) {
		e.preventDefault();
		//form reset after success
		$("#lwSendGiftForm").trigger("reset");
		//close dialog after success
		$('#lwSendGiftDialog').modal('hide');
	});

	//user report callback
	function userReportCallback(response) {
		//check success reaction is 1
		if (response.reaction == 1) {
			var requestData = response.data;
			//form reset after success
			$("#lwReportUserForm").trigger("reset");
			//close dialog after success
			$('#lwReportUserDialog').modal('hide');
		}
	}

	//close User Report Dialog
	$("#lwCloseUserReportDialog").on('click', function(e) {
		e.preventDefault();
		//form reset after success
		$("#lwReportUserForm").trigger("reset");
		//close dialog after success
		$('#lwReportUserDialog').modal('hide');
	});

	//block user confirmation
	$("#lwBlockUserBtn").on('click', function(e) {
		var confirmText = $('#lwBlockUserConfirmationText');
		//show confirmation 
		showConfirmation(confirmText, function() {
			var requestUrl = '{{ route('user.write.block_user') }}',
				formData = {
					'block_user_id': '{{ $userData['userUId'] }}',
				};
			// post ajax request
			__DataRequest.post(requestUrl, formData, function(response) {
				if (response.reaction == 1) {
				}
			});
		}, {
            background: '#333',
            popup: 'dark-theme',
        });
	});

	// Click on edit / close button 
	$('#lwEditBasicInformation, #lwCloseBasicInfoEditBlock').click(function(e) {
		e.preventDefault();
		showHideBasicInfoContainer();
	});
	// Show / Hide basic information container
	function showHideBasicInfoContainer() {
		$('#lwUserBasicInformationForm').toggle();
		$('#lwStaticBasicInformation').toggle();
		$('#lwCloseBasicInfoEditBlock').toggle();
		$('#lwEditBasicInformation').toggle();
	}
	// Show hide specification user settings
	function showHideSpecificationUser(formId, event) {
		event.preventDefault();
		$('#lwEdit' + formId).toggle();
		$('#lw' + formId + 'StaticContainer').toggle();
		$('#lwUser' + formId + 'Form').toggle();
		$('#lwClose' + formId + 'Block').toggle();
	}
	// Click on profile and cover container edit / close button 
	$('#lwEditProfileAndCoverPhoto, #lwCloseProfileAndCoverBlock').click(function(e) {
		e.preventDefault();
		showHideProfileAndCoverPhotoContainer();
	});
	// Hide / show profile and cover photo container
	function showHideProfileAndCoverPhotoContainer() {
		$('#lwProfileAndCoverStaticBlock').toggle();
		$('#lwProfileAndCoverEditBlock').toggle();
		$('#lwEditProfileAndCoverPhoto').toggle();
		$('#lwCloseProfileAndCoverBlock').toggle();
	}
	// After successfully upload profile picture
	function afterUploadedProfilePicture(responseData) {
		$('#lwProfilePictureStaticImage, .lw-profile-thumbnail').attr('src', responseData.data.image_url);
	}
	// After successfully upload Cover photo
	function afterUploadedCoverPhoto(responseData) {
		$('#lwCoverPhotoStaticImage').attr('src', responseData.data.image_url);
	}
</script>
<script>
	// Click on edit / close button 
	$('#lwEditUserLocation, #lwCloseLocationBlock').click(function(e) {
		e.preventDefault();
		showHideLocationContainer();
	});
	// Show hide location container
	function showHideLocationContainer() {
		$('#lwUserStaticLocation').toggle();
		$('#lwUserEditableLocation').toggle();
		$('#lwEditUserLocation').toggle();
		$('#lwCloseLocationBlock').toggle();
	}

	function initialize() {
		@if(getStoreSettings('allow_google_map'))
		$('form').on('keyup keypress', function(e) {
			var keyCode = e.keyCode || e.which;
			if (keyCode === 13) {
				e.preventDefault();
				return false;
			}
		});
		const locationInputs = document.getElementsByClassName("map-input");

		const autocompletes = [];
		const geocoder = new google.maps.Geocoder;
		for (let i = 0; i < locationInputs.length; i++) {

			const input = locationInputs[i];
			const fieldKey = input.id.replace("-input", "");
			const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

			const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
			const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

			const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
				center: {
					lat: latitude,
					lng: longitude
				},
				zoom: 13
			});
			const marker = new google.maps.Marker({
				map: map,
				position: {
					lat: latitude,
					lng: longitude
				},
			});

			marker.setVisible(isEdit);

			const autocomplete = new google.maps.places.Autocomplete(input);
			autocomplete.key = fieldKey;
			autocompletes.push({
				input: input,
				map: map,
				marker: marker,
				autocomplete: autocomplete
			});
		}

		for (let i = 0; i < autocompletes.length; i++) {
			const input = autocompletes[i].input;
			const autocomplete = autocompletes[i].autocomplete;
			const map = autocompletes[i].map;
			const marker = autocompletes[i].marker;

			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				marker.setVisible(false);
				const place = autocomplete.getPlace();

				geocoder.geocode({
					'placeId': place.place_id
				}, function(results, status) {
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
		@endif
	}

	function setLocationCoordinates(key, lat, lng, placeData) {
		__DataRequest.post("{{ route('user.write.location_data') }}", {
			'latitude': lat,
			'longitude': lng,
			'placeData': placeData.address_components
		}, function(responseData) {
			var requestData = responseData.data;
			//check reaction code is not 1
			if (responseData.reaction != 1) {
				$("#lwShowLocationErrorMessage").show();
				__DataRequest.updateModels({
					'locationErrorMessage': requestData.message
				});
				return false;
			}
			//check reaction code is 1
			if (responseData.reaction == 1) {
				$("#lwShowLocationErrorMessage").hide();
				showHideLocationContainer();
				__DataRequest.updateModels('profileData', {
					city: requestData.city,
					country_name: requestData.country_name,
					latitude: lat,
					longitude: lng
				});
			}

			var mapSrc = "https://maps.google.com/maps/place?q=" + lat + "," + lng + "&output=embed&language={{ app()->getLocale() }}";
			$('#gmap_canvas').attr('src', mapSrc)
		});
	};
	@if(!getStoreSettings('allow_google_map') and getStoreSettings('use_static_city_data'))
	var $selectLocationCity = $('#selectLocationCity').selectize({
		// plugins: ['restore_on_backspace'],
		valueField: 'id',
		labelField: 'cities_full_name',
		searchField: [
			'cities_full_name'
		],
		// options: [],
		create: false,
		// loadThrottle: 2000,
		maxItems: 1,
		render: {
			option: function(item, escape) {
				return '<div><span class="title"><span class="name">' + escape(item.cities_full_name) + '</span></span></div>';
			}
		},
		load: function(query, callback) {
			if (!query.length || (query.length < 2)) {
				return callback([]);
			} else {
				__DataRequest.post("{{ route('user.read.search_static_cities') }}", {
					'search_query': query
				}, function(responseData) {
						callback(responseData.data.search_result);
				});
			}
		},
		onChange: function(value) {
			if (!value.length) {
				return;
			};
			__DataRequest.post("{{ route('user.write.store_city') }}", {
				'selected_city_id': value
			}, function(responseData) {
				if (responseData.reaction == 1) {
					__Utils.viewReload();
				}
			});
		}
	});

	var selectLocationCityControl = $selectLocationCity[0].selectize;
		selectLocationCityControl.clear(true);
		selectLocationCityControl.clearOptions(true);
    @endif
    @if(!getStoreSettings('display_google_map'))
	// leaflet map
	var leafletMap = L.map('staticMapId').setView(["{{ $latitude }}", "{{ $longitude }}"], 13);
	L.tileLayer(
		'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, '
		}
	).addTo(leafletMap);
    var leafLetOptions = {};
    @if(request()->ajax())
        leafLetOptions = {
            icon : L.icon({
            iconUrl: "{{ asset('dist/css/images/marker-icon.png') }}"
        })
    };
    @endif
	// add marker
	L.marker(["{{ $latitude }}", "{{ $longitude }}"],leafLetOptions).addTo(leafletMap);
	@endif

	// Mobile Profile Tab Navigation
	document.addEventListener('DOMContentLoaded', function() {
		const tabs = document.querySelectorAll('.lw-mobile-tab');
		const tabContents = document.querySelectorAll('.lw-mobile-tab-content');

		tabs.forEach(tab => {
			tab.addEventListener('click', function() {
				const targetTab = this.getAttribute('data-tab');

				// Remove active class from all tabs
				tabs.forEach(t => {
					t.classList.remove('bg-white', 'text-[#4F1DA1]', 'shadow-sm');
					t.classList.add('bg-transparent', 'text-[#9B8AAE]');
				});

				// Add active class to clicked tab
				this.classList.remove('bg-transparent', 'text-[#9B8AAE]');
				this.classList.add('bg-white', 'text-[#4F1DA1]', 'shadow-sm');

				// Hide all tab contents
				tabContents.forEach(content => {
					content.classList.add('hidden');
				});

				// Show target tab content
				const targetContent = document.getElementById(`mobile-${targetTab}-tab`);
				if (targetContent) {
					targetContent.classList.remove('hidden');

					// Initialize photo uploader when Photos tab is shown
					if (targetTab === 'photos' && $('#mobilePhotoUpload').length) {
						setTimeout(function() {
							if (window.lwPluginFuncs && !$('#mobilePhotoUpload').data('filepond-initialized')) {
								window.lwPluginFuncs.lwUploader('#mobilePhotoUpload');
								$('#mobilePhotoUpload').data('filepond-initialized', true);
							}
						}, 100);
					}
				}
			});
		});
	});

	// After successfully uploaded photo in mobile view
	function afterMobilePhotoUpload(responseData) {
		if (!_.isUndefined(responseData.data.stored_photo)) {
			// Reload the page to show the new photo
			location.reload();
		}
	}
</script>
@lwPushEnd