@section('page-title', __tr('My Likes'))
@section('head-title', __tr('My Likes'))
@section('keywordName', __tr('My Likes'))
@section('keyword', __tr('My Likes'))
@section('description', __tr('My Likes'))
@section('keywordDescription', __tr('My Likes'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<style>
.lw-likes-page-header {
	display: flex;
	align-items: center;
	gap: 0.75rem;
	margin-bottom: 2rem;
	padding: 0 0.5rem;
}

.lw-likes-page-header i {
	font-size: 2rem;
	color: #4F1DA1;
}

.lw-likes-page-header h1 {
	font-size: 2rem;
	font-weight: 700;
	color: #2F1E4E;
	margin: 0;
	font-family: 'Poppins', sans-serif;
}

.lw-likes-container {
	max-width: 600px;
	margin: 0 auto;
}

.lw-liked-user-card {
	display: flex;
	align-items: center;
	gap: 1.25rem;
	background: white;
	padding: 1.5rem;
	border-radius: 1rem;
	margin-bottom: 1rem;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
	transition: all 0.3s ease;
	position: relative;
}

.lw-liked-user-card:hover {
	box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
	transform: translateY(-2px);
}

.lw-liked-user-avatar {
	width: 80px;
	height: 80px;
	border-radius: 50%;
	object-fit: cover;
	flex-shrink: 0;
}

.lw-liked-user-info {
	flex: 1;
	min-width: 0;
}

.lw-liked-user-name {
	font-size: 1.5rem;
	font-weight: 700;
	color: #2F1E4E;
	margin: 0 0 0.25rem 0;
	text-decoration: none;
	display: block;
	font-family: 'Poppins', sans-serif;
}

.lw-liked-user-name:hover {
	color: #4F1DA1;
	text-decoration: none;
}

.lw-liked-user-details {
	font-size: 1rem;
	color: #6B7280;
	margin-bottom: 0.5rem;
	font-family: 'Poppins', sans-serif;
}

.lw-liked-user-location {
	display: flex;
	align-items: center;
	gap: 0.5rem;
	font-size: 0.95rem;
	color: #4F1DA1;
	font-family: 'Poppins', sans-serif;
}

.lw-liked-user-location i {
	font-size: 1rem;
}

.lw-liked-user-status {
	position: absolute;
	top: 1.5rem;
	left: 5.5rem;
	width: 16px;
	height: 16px;
	border-radius: 50%;
	border: 3px solid white;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.lw-status-online {
	background-color: #10B981;
}

.lw-status-idle {
	background-color: #F59E0B;
}

.lw-status-offline {
	background-color: #6B7280;
}

.lw-likes-no-results {
	text-align: center;
	padding: 4rem 2rem;
	background: white;
	border-radius: 1rem;
	max-width: 600px;
	margin: 0 auto;
}

.lw-likes-no-results i {
	font-size: 4rem;
	color: #D1D5DB;
	margin-bottom: 1rem;
}

.lw-likes-no-results p {
	font-size: 1.125rem;
	color: #6B7280;
	margin: 0;
	font-family: 'Poppins', sans-serif;
}

.lw-likes-load-more {
	text-align: center;
	margin: 2rem 0;
}

.lw-likes-load-more-btn {
	display: inline-flex;
	align-items: center;
	gap: 0.5rem;
	background: #4F1DA1;
	color: white;
	padding: 0.75rem 2rem;
	border-radius: 2rem;
	text-decoration: none;
	font-weight: 600;
	transition: all 0.3s ease;
	font-family: 'Poppins', sans-serif;
}

.lw-likes-load-more-btn:hover {
	background: #5B2BB5;
	text-decoration: none;
	color: white;
	transform: translateY(-2px);
	box-shadow: 0 4px 12px rgba(79, 29, 161, 0.3);
}

.lw-likes-end-message {
	text-align: center;
	padding: 2rem;
	color: #9CA3AF;
	font-family: 'Poppins', sans-serif;
}

.lw-likes-end-message i {
	margin-right: 0.5rem;
}

@media (max-width: 640px) {
	.lw-likes-page-header h1 {
		font-size: 1.5rem;
	}

	.lw-liked-user-card {
		padding: 1.25rem;
		gap: 1rem;
	}

	.lw-liked-user-avatar {
		width: 60px;
		height: 60px;
	}

	.lw-liked-user-name {
		font-size: 1.25rem;
	}

	.lw-liked-user-details {
		font-size: 0.875rem;
	}

	.lw-liked-user-status {
		left: 4.25rem;
	}
}
</style>

<!-- Page Heading -->
<div class="lw-likes-page-header">
	<i class="fa fa-heart" aria-hidden="true"></i>
	<h1><?= __tr('My Likes') ?></h1>
</div>

<!-- liked people container -->
<div class="lw-likes-container">
	@if(!__isEmpty($usersData))
	<div id="lwLoadMoreContentContainer">
		@include('user.partial-templates.my-liked-users')
	</div>
	@else
	<!-- No results message -->
	<div class="lw-likes-no-results">
		<i class="fas fa-heart"></i>
		<p><?= __tr('There are no liked users.') ?></p>
	</div>
	<!-- / No results message -->
	@endif
</div>
<!-- / liked people container -->
