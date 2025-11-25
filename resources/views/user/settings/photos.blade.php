@section('page-title', __tr('My Photos'))
@section('head-title', __tr('My Photos'))
@section('keywordName', __tr('My Photos'))
@section('keyword', __tr('My Photos'))
@section('description', __tr('My Photos'))
@section('keywordDescription', __tr('My Photos'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<style>
/* SweetAlert Custom Styling */
.swal2-popup {
    background: white !important;
    color: #374151 !important;
    border-radius: 0.75rem !important;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
}

.swal2-title {
    color: #374151 !important;
    font-weight: 600 !important;
}

.swal2-html-container {
    color: #6b7280 !important;
}

.swal2-confirm {
    background-color: #dc2626 !important;
    color: white !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
    font-weight: 500 !important;
}

.swal2-confirm:hover {
    background-color: #b91c1c !important;
}

.swal2-cancel {
    background-color: #f3f4f6 !important;
    color: #374151 !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
    font-weight: 500 !important;
    border: 1px solid #d1d5db !important;
}

.swal2-cancel:hover {
    background-color: #e5e7eb !important;
}

.swal2-container {
    background-color: rgba(0, 0, 0, 0.4) !important;
}

/* Photo Gallery Enhancements */
.lw-photo-thumbnail {
    transition: all 0.3s ease;
}

.lw-photo-thumbnail:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.lw-photo-thumbnail img {
    transition: transform 0.3s ease;
}

/* FilePond Upload Area Styling */
.filepond--root {
    background: transparent;
}

.filepond--drop-label {

    border: 2px dashed #d1d5db;
    border-radius: 0.5rem;
    color: #6b7280;
    transition: all 0.3s ease;
}

.filepond--drop-label:hover {
    border-color: #3b82f6;
    color: #3b82f6;
    background: #f8fafc;
}

.filepond--panel-root {
    background-color: transparent;
}
</style>
<!-- Modern Photos Settings Page -->
<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <x-lw.card class="mb-6">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-lw p-3 rounded-full">
                <i class="fas fa-images text-white text-xl"></i>
            </div>
            <div>
                <h1 class="font-lw font-bold text-2xl text-lw-primary">{{ __tr('My Photos') }}</h1>
                <p class="font-lw text-lw-secondary">{{ __tr('Upload and manage your profile photos') }}</p>
            </div>
        </div>
    </x-lw.card>

    <!-- Photo Upload and Gallery -->
    <x-lw.card class="mb-6">
        <div class="space-y-6">
            <!-- File Upload Section -->
            @if($photosCount <= 10)
                <div>
                    <h3 class="text-lg font-semibold text-lw-primary mb-4">{{ __tr('Upload Photos') }}</h3>
                    <div class="bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-300">
                        <input type="file" 
                            class="lw-file-uploader" 
                            data-instant-upload="true" 
                            data-action="{{ route('user.upload_photos') }}" 
                            data-default-image-url="" 
                            data-allowed-media="{{ getMediaRestriction('photos') }}" 
                            multiple 
                            data-callback="afterFileUpload" 
                            data-remove-all-media="true">
                    </div>
                </div>
            @endif

            <!-- Photo Gallery Section -->
            <div>
                <h3 class="text-lg font-semibold text-lw-primary mb-4">{{ __tr('My Photo Gallery') }}</h3>
                <div class="bg-gray-50 rounded-lg p-4 min-h-48">
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4 lw-horizontal-container lw-photoswipe-gallery" id="lwUserPhotos">
                        <!-- Photos will be dynamically loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </x-lw.card>
</div>

<!-- JavaScript Template for Photo Rendering -->
<script type="text/_template" id="lwPhotosContainer">
    <% if(!_.isEmpty(__tData.userPhotos)) { %>
        <% _.forEach(__tData.userPhotos, function(item, index) { %>
            <div class="lw-photo-thumbnail relative group bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <!-- User photo container -->
                <div class="relative aspect-square bg-gray-100">
                    <img class="lw-user-photo lw-photoswipe-gallery-img lw-lazy-img absolute inset-0 w-full h-full object-cover cursor-pointer hover:scale-110 transition-transform duration-300"
                        data-img-index="<%= index %>"
                        src="<%= item.image_url %>"
                        data-src="<%= item.image_url %>"
                        alt="{{ __tr('User Photo') }}"
                        loading="lazy">

                    <!-- Delete photo button -->
                    <button class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 lw-remove-photo-btn lw-ajax-link-action z-10 shadow-lg"
                        data-href="<%- item.removePhotoUrl %>"
                        data-callback="onDeletePhotoCallback"
                        data-method="post">
                        <i class="fas fa-trash-alt text-xs"></i>
                    </button>

                    <!-- Overlay on hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 pointer-events-none"></div>
                </div>
            </div>
        <% }); %>
    <% } else { %>
        <div class="col-span-full text-center py-16">
            <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-images text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-lw-primary text-lg font-semibold mb-2">{{ __tr('No Photos Yet') }}</h3>
            <p class="text-lw-secondary mb-2">{{ __tr('There are no photos found.') }}</p>
            <p class="text-sm text-gray-500">{{ __tr('Upload your first photo to get started') }}</p>
        </div>
    <% } %>
</script>

@lwPush('appScripts')
<script>
    var userPhotos = {!! json_encode($userPhotos) !!};

    function preparePhotosList() {
        var photoContainer = _.template($('#lwPhotosContainer').html()),
            compiledHtml = photoContainer({
                'userPhotos': userPhotos
            });
        $('#lwUserPhotos').html(compiledHtml);

        // Apply lazy loading to newly added images
        if (typeof applyLazyImages === 'function') {
            applyLazyImages();
        }

        // Debug: Check if photos are rendered
        console.log('Photos rendered:', $('.lw-photoswipe-gallery-img').length);

        // Re-bind click events for delete buttons
        $('.lw-remove-photo-btn').off('click').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent event bubbling to image
            var $this = $(this);
            var href = $this.data('href');
            var callback = $this.data('callback');
            var method = $this.data('method');

            // Make AJAX request
            __DataRequest.post(href, {}, function(responseData) {
                if (typeof window[callback] === 'function') {
                    window[callback](responseData);
                }
            }, {
                method: method
            });
        });
    }

    // Initialize photo list
    preparePhotosList();

    // After successfully uploaded file
    function afterFileUpload(responseData) {
        if (!_.isUndefined(responseData.data.stored_photo)) {
            userPhotos.push(responseData.data.stored_photo);
            preparePhotosList();
        }
    }

    // Delete photo callback
    function onDeletePhotoCallback(responseData) {
        if (responseData.reaction == 1) {
            // Remove value from array
            _.remove(userPhotos, function(photo) {
                return photo._uid === responseData.data.photoUid;
            });

            // Reload list
            preparePhotosList();
        }
    }
</script>
@lwPushEnd