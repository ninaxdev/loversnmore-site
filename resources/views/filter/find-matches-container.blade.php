<!-- Match Result Header -->
<div class="lw-match-result-header">
    <p class="lw-match-result-text">
        <span class="lw-match-count"><?= $totalCount ?></span>
        <?= __trn('Match Found', 'Matches Found', $totalCount) ?>
    </p>
</div>

<!-- User Cards Grid -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6" id="lwUserFilterContainer">
    @if(!__isEmpty($filterData))
    @include('filter.find-matches')
    @endif
</div>

<!-- Load More Button -->
@if($hasMorePages)
<div class="lw-load-more-container">
    <button type="button" class="lw-load-more-btn lw-ajax-link-action" id="lwLoadMoreButton" data-action="<?= $nextPageUrl ?>" data-event-callback="onLoadMoreFilterUsers" data-callback="loadMoreUsers">
        <i class="fas fa-sync-alt mr-2"></i><?= __tr('Load more') ?>
    </button>
</div>
@endif

<!-- End of Results Message -->
<div id="lwLoadMoreResultMessage" style="display:none" class="lw-end-message">
    <p class="lw-end-message-text">
        <i class="fas fa-check-circle mr-2"></i><?= __tr('Looks like you reached the end.') ?>
    </p>
</div>
