@section('page-title', __tr('My Likes'))
@section('head-title', __tr('My Likes'))
@section('keywordName', __tr('My Likes'))
@section('keyword', __tr('My Likes'))
@section('description', __tr('My Likes'))
@section('keywordDescription', __tr('My Likes'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="lw-heading-2 mb-0">
		<span class="lw-text-primary">
			<i class="fa fa-heart mr-2" aria-hidden="true"></i>
		</span>
		<?= __tr('My Likes') ?>
	</h1>
</div>

<!-- liked people container -->
<div class="container-fluid px-0">
	@if(!__isEmpty($usersData))
	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6" id="lwLoadMoreContentContainer">
		@include('user.partial-templates.my-liked-users')
	</div>
	@else
	<!-- No results message -->
	<div class="lw-no-results">
		<div class="lw-no-results-icon">
			<i class="fas fa-heart"></i>
		</div>
		<p class="lw-no-results-text">
			<?= __tr('There are no liked users.') ?>
		</p>
	</div>
	<!-- / No results message -->
	@endif
</div>
<!-- / liked people container -->
