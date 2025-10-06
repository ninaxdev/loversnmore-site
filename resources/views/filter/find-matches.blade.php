@if(!__isEmpty($filterData))
@foreach($filterData as $filter)
<div class="col mb-4">
	<div class="lw-user-card <?= (isset($filter['isPremiumUser']) and $filter['isPremiumUser'] == true) ? 'lw-has-premium-badge' : '' ?>">
		<!-- show user online, idle or offline status -->
		@if($filter['userOnlineStatus'])
		<div class="lw-user-card-status">
			@if($filter['userOnlineStatus'] == 1)
			<span class="lw-status-dot lw-status-online" title="<?= __tr('Online') ?>"></span>
			@elseif($filter['userOnlineStatus'] == 2)
			<span class="lw-status-dot lw-status-idle" title="<?= __tr('Idle') ?>"></span>
			@elseif($filter['userOnlineStatus'] == 3)
			<span class="lw-status-dot lw-status-offline" title="<?= __tr('Offline') ?>"></span>
			@endif
		</div>
		@endif
		<!-- /show user online, idle or offline status -->
		
		<!-- User Image -->
		<a class="lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_view', ['username' => $filter['username']]) ?>">
			<div class="lw-user-card-image-wrapper">
				<img data-src="<?= imageOrNoImageAvailable($filter['profileImage']) ?>" class="lw-user-card-image lw-lazy-img" alt="<?= $filter['fullName'] ?>" />
			</div>
		</a>
		
		<!-- User Info -->
		<div class="lw-user-card-info">
			<a class="lw-user-card-name" href="<?= route('user.profile_view', ['username' => $filter['username']]) ?>">
				<?= $filter['fullName'] ?>
			</a>
			<div class="lw-user-card-details">
				<?= $filter['detailString'] ?>
			</div>
			@if($filter['countryName'])
			<div class="lw-user-card-location">
				<i class="fas fa-map-marker-alt"></i>
				<span><?= $filter['countryName'] ?></span>
			</div>
			@endif
		</div>
	</div>
</div>
@endforeach
@else
<!-- No results message -->
<div class="col-12">
	<div class="lw-no-results">
		<div class="lw-no-results-icon">
			<i class="fas fa-search"></i>
		</div>
		<p class="lw-no-results-text">
			<?= __tr('There are no matches found.') ?>
		</p>
	</div>
</div>
<!-- / No results message -->
@endif
