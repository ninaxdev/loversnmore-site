@section('page-title', __tr('Who Likes Me'))
@section('head-title', __tr('Who Likes Me'))
@section('keywordName', __tr('Who Likes Me'))
@section('keyword', __tr('Who Likes Me'))
@section('description', __tr('Who Likes Me'))
@section('keywordDescription', __tr('Who Likes Me'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="d-flex align-items-center justify-content-between mb-4">
	<h1 class="lw-heading-2 mb-0">
		<span class="lw-text-primary">
			<i class="fa fa-thumbs-up mr-2" aria-hidden="true"></i>
		</span>
		<?= __tr('Who Likes Me') ?>
	</h1>
</div>

<!-- who liked me container -->
<div class="container-fluid px-0">
	@if(getFeatureSettings('show_like'))
	@if(!__isEmpty($usersData))
	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6" id="lwLoadMoreContentContainer">
		@include('user.partial-templates.my-liked-users')
	</div>
	@else
	<!-- No results message -->
	<div class="lw-no-results">
		<div class="lw-no-results-icon">
			<i class="fas fa-thumbs-up"></i>
		</div>
		<p class="lw-no-results-text">
			<?= __tr('There are no users who liked me.') ?>
		</p>
	</div>
	<!-- / No results message -->
	@endif
	@else
	<!-- Premium feature alert -->
	<div class="lw-alert lw-alert-info">
		<i class="fas fa-crown mr-2"></i>
		<?= __tr('This is a premium feature, to view who likes me you need to buy premium plan first.') ?>
	</div>
	<!-- / Premium feature alert -->
	@endif
</div>
<!-- / who liked me container -->
