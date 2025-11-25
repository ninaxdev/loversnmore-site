@foreach($usersData as $user)
<div class="lw-liked-user-card">
	<!-- User Image -->
	<a href="<?= route('user.profile_view', ['username' => $user['username']]) ?>">
		<img data-src="<?= imageOrNoImageAvailable($user['userImageUrl']) ?>"
			class="lw-liked-user-avatar lw-lazy-img"
			alt="<?= $user['userFullName'] ?>" />
	</a>

	<!-- show user online, idle or offline status -->
	@if($user['userOnlineStatus'])
		@if($user['userOnlineStatus'] == 1)
		<span class="lw-liked-user-status lw-status-online" title="<?= __tr('Online') ?>"></span>
		@elseif($user['userOnlineStatus'] == 2)
		<span class="lw-liked-user-status lw-status-idle" title="<?= __tr('Idle') ?>"></span>
		@elseif($user['userOnlineStatus'] == 3)
		<span class="lw-liked-user-status lw-status-offline" title="<?= __tr('Offline') ?>"></span>
		@endif
	@endif
	<!-- /show user online, idle or offline status -->

	<!-- User Info -->
	<div class="lw-liked-user-info">
		<a class="lw-liked-user-name" href="<?= route('user.profile_view', ['username' => $user['username']]) ?>">
			<?= $user['userFullName'] ?>
		</a>
		<div class="lw-liked-user-details">
			<?= $user['detailString'] ?>
		</div>
		@if($user['countryName'])
		<div class="lw-liked-user-location">
			<i class="fas fa-map-marker-alt"></i>
			<span><?= $user['countryName'] ?></span>
		</div>
		@endif
	</div>
</div>
@endforeach

@if(!__isEmpty($nextPageUrl))
<div id="lwNextPageLink" class="lw-likes-load-more">
	<a href="<?= $nextPageUrl ?>"
		class="lw-likes-load-more-btn lw-ajax-link-action"
		data-method="get"
		data-callback="loadNextLikedUsers">
		<i class="fas fa-sync-alt"></i>
		<span><?= __tr('Load more') ?></span>
	</a>
</div>
@else
<div class="lw-likes-end-message">
	<i class="fas fa-check-circle"></i>
	<span><?= __tr('Looks like you reached the end.') ?></span>
</div>
@endIf
