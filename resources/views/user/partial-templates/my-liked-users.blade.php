@foreach($usersData as $user)
<div class="col mb-4">
	<div class="lw-user-card <?= (isset($user['isPremiumUser']) and $user['isPremiumUser'] == true) ? 'lw-has-premium-badge' : '' ?>">
		<!-- show user online, idle or offline status -->
		@if($user['userOnlineStatus'])
		<div class="lw-user-card-status">
			@if($user['userOnlineStatus'] == 1)
			<span class="lw-status-dot lw-status-online" title="<?= __tr('Online') ?>"></span>
			@elseif($user['userOnlineStatus'] == 2)
			<span class="lw-status-dot lw-status-idle" title="<?= __tr('Idle') ?>"></span>
			@elseif($user['userOnlineStatus'] == 3)
			<span class="lw-status-dot lw-status-offline" title="<?= __tr('Offline') ?>"></span>
			@endif
		</div>
		@endif
		<!-- /show user online, idle or offline status -->
		
		<!-- User Image -->
		<a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_view', ['username' => $user['username']]) ?>">
			<div class="lw-user-card-image-wrapper">
				<img data-src="<?= imageOrNoImageAvailable($user['userImageUrl']) ?>" class="lw-user-card-image lw-lazy-img" alt="<?= $user['userFullName'] ?>" />
			</div>
		</a>
		
		<!-- User Info -->
		<div class="lw-user-card-info">
			<a class="lw-user-card-name" href="<?= route('user.profile_view', ['username' => $user['username']]) ?>">
				<?= $user['userFullName'] ?>
			</a>
			<div class="lw-user-card-details">
				<?= $user['detailString'] ?>
			</div>
			@if($user['countryName'])
			<div class="lw-user-card-location">
				<i class="fas fa-map-marker-alt"></i>
				<span><?= $user['countryName'] ?></span>
			</div>
			@endif
			@if($user['updated_at'])
			<div class="lw-user-card-details mt-2">
				<small class="text-muted"><?= $user['updated_at'] ?></small>
			</div>
			@endif
		</div>
	</div>
</div>
@endforeach

@if(!__isEmpty($nextPageUrl))
<div id="lwNextPageLink" class="col-12">
	<div class="lw-load-more-container">
		<a href="<?= $nextPageUrl ?>" class="lw-load-more-btn lw-ajax-link-action" data-method="get" data-callback="loadNextLikedUsers">
			<i class="fas fa-sync-alt mr-2"></i><?= __tr('Load more') ?>
		</a>
	</div>
</div>
@else
<div class="col-12">
	<div class="lw-end-message">
		<p class="lw-end-message-text">
			<i class="fas fa-check-circle mr-2"></i><?= __tr('Looks like you reached the end.') ?>
		</p>
	</div>
</div>
@endIf
