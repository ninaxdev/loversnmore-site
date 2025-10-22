@section('page-title', __tr('Discover'))
@section('head-title', __tr('Discover'))
@section('keywordName', __tr('Discover'))
@section('keyword', __tr('Discover'))
@section('description', __tr('Discover new matches'))
@section('keywordDescription', __tr('Discover new matches'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3 pr-3 hidden md:block">
	<h4 class="h5 mb-0">
		<span class="text-primary"><i class="fas fa-heart"></i></span> <?= __tr('Discovery Feed') ?>
	</h4>
	<div class="d-flex gap-2">
		<a href="<?= route('user.read.find_matches') ?>" class="btn btn-sm btn-outline-primary d-none d-lg-inline-flex align-items-center">
			<i class="fas fa-filter mr-2"></i><?= __tr('Advanced Search') ?>
		</a>
	</div>
</div>

<!-- Discovery Feed -->
@include('user.partial-templates.discovery-feed')

@lwPush('appScripts')
<style>
	/* SweetAlert toast custom styling */
	.swal2-html-container{
		color: black !important;
	}
	
</style>
<script>
	// Success message helper
	function showSuccessMessage(message, type = 'success') {
		const bgColor = type === 'success' ? '#10b981' : '#3b82f6';
		showAlert(message, '', {
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 2000,
			timerProgressBar: true,
			icon: type,
			background: bgColor,
			iconColor: '#ffffff',
			customClass: {
				popup: 'colored-toast'
			}
		});
	}
</script>
@lwPushEnd
