<!-- user encounter main container -->
@if(getFeatureSettings('user_encounter'))
@if(!__isEmpty($randomUserData))
<!-- Modern Encounter Card -->
<div class="lw-encounter-card">
	<!-- Premium Badge -->
	@if($randomUserData['isPremiumUser'])
	<div class="lw-encounter-premium-badge">
		<i class="fas fa-crown"></i>
	</div>
	@endif
	
	<!-- Online Status -->
	@if($randomUserData['userOnlineStatus'])
	<div class="lw-encounter-status">
		@if($randomUserData['userOnlineStatus'] == 1)
		<span class="lw-status-dot lw-status-online" title="{{ __tr('Online') }}"></span>
		@elseif($randomUserData['userOnlineStatus'] == 2)
		<span class="lw-status-dot lw-status-idle" title="{{ __tr('Idle') }}"></span>
		@elseif($randomUserData['userOnlineStatus'] == 3)
		<span class="lw-status-dot lw-status-offline" title="{{ __tr('Offline') }}"></span>
		@endif
	</div>
	@endif

	<!-- Profile Images -->
	<div class="lw-encounter-image-container">
		<!-- Cover Image -->
		<div class="lw-encounter-cover-wrapper">
			<img data-src="<?= $randomUserData['userCoverUrl'] ?>" class="lw-lazy-img lw-encounter-cover" alt="Cover">
		</div>
		
		<!-- Profile Image -->
		<div class="lw-encounter-profile-wrapper">
			<img data-src="<?= $randomUserData['userImageUrl'] ?>" class="lw-lazy-img lw-encounter-profile" alt="<?= $randomUserData['userFullName'] ?>">
		</div>
	</div>

	<!-- User Info -->
	<div class="lw-encounter-info">
		<a class="lw-encounter-name lw-ajax-link-action lw-action-with-url" href="<?= route('user.profile_view', ['username' => $randomUserData['username']]) ?>">
			<?= $randomUserData['userFullName'] ?>@if(isset($randomUserData['userAge'])),@endif
		</a>
		<div class="lw-encounter-meta">
			@if($randomUserData['userAge'])
			<span><?= $randomUserData['userAge'] ?></span>
			@endif
			@if($randomUserData['gender'])
			<span class="lw-encounter-separator">•</span>
			<span><?= $randomUserData['gender'] ?></span>
			@endif
			@if($randomUserData['countryName'])
			<span class="lw-encounter-separator">•</span>
			<i class="fas fa-map-marker-alt lw-encounter-icon"></i>
			<span><?= $randomUserData['countryName'] ?></span>
			@endif
		</div>
	</div>

	<!-- Action Buttons -->
	<div class="lw-encounter-actions">
		<!-- Dislike Button -->
		<button type="button" data-action="<?= route('user.write.encounter.like_dislike', ['toUserUid' => $randomUserData['_uid'], 'like' => 0]) ?>" data-callback="onLikeDisLikeCallback" data-method="post" class="lw-encounter-btn lw-encounter-btn-dislike lw-ajax-link-action" title="<?= __tr('Dislike') ?>" id="lwDislikeBtn">
			<i class="fa fa-times"></i>
		</button>

		<!-- Skip Button -->
		<button type="button" data-action="<?= route('user.write.encounter.skip_user', ['toUserUid' => $randomUserData['_uid']]) ?>" data-method="post" class="lw-encounter-btn lw-encounter-btn-skip lw-ajax-link-action" data-callback="onEncounterUserCallback" title="<?= __tr('Skip') ?>" id="lwSkipBtn">
			<i class="fas fa-chevron-right"></i>
		</button>

		<!-- Like Button -->
		<button type="button" data-action="<?= route('user.write.encounter.like_dislike', ['toUserUid' => $randomUserData['_uid'], 'like' => 1]) ?>" data-callback="onLikeDisLikeCallback" data-method="post" class="lw-encounter-btn lw-encounter-btn-like lw-ajax-link-action" title="<?= __tr('Like') ?>" id="lwLikeBtn">
			<i class="fa fa-heart"></i>
		</button>
	</div>
</div>
<!-- /Modern Encounter Card -->
@else
<!-- No users message -->
<div class="lw-no-results">
	<div class="lw-no-results-icon">
		<i class="fas fa-user-friends"></i>
	</div>
	<p class="lw-no-results-text">
		<?= __tr('Your daily limit for encounters may exceed or there are no users to show.') ?>
	</p>
</div>
<!-- / No users message -->
@endif
@else
<!-- Premium feature alert -->
<div class="lw-alert lw-alert-info">
	<i class="fas fa-crown mr-2"></i>
	<?= __tr('This is a premium feature, to view encounter you need to buy premium plan first.') ?>
</div>
<!-- / Premium feature alert -->
@endif
<!-- /user encounter main container -->
