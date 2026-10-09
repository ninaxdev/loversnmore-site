<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Playing {{ $deck['name'] }} — LoversNmore Icebreakers</title>
    <meta name="description" content="{{ $deck['description'] ?? $deck['caption'] ?? '' }}">
    <meta name="theme-color" content="#6b3fd6">
    <meta name="robots" content="noindex">

    <link rel="icon" type="image/svg+xml" href="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/css/icebreakers.css') }}?v={{ filemtime(public_path('dist/css/icebreakers.css')) }}">
</head>
<body class="ib-body">

@include('icebreakers.partials._topbar', ['back' => route('icebreakers.show', ['slug' => $deck['slug']]), 'favorite' => true])

<main class="ib-view-play">
    <div id="ibPlayBlock" class="ib-play-scope" data-variant="{{ $deck['variant'] }}">
        <div class="ib-card-stage">
            <div class="ib-behind-layer" data-i="3" aria-hidden="true"></div>
            <div class="ib-behind-layer" data-i="2" aria-hidden="true"></div>
            <div class="ib-behind-layer" data-i="1" aria-hidden="true"></div>
            <div class="ib-behind-layer" data-i="0" aria-hidden="true"></div>

            {{-- Card A (starts as "next") --}}
            <div class="ib-play-card" data-role="next" data-slot="a" tabindex="0" role="group" aria-label="Conversation card">
                <div class="ib-card-face ib-face-front">
                    <span class="ib-cat-pill-tag js-category">BE FOR REAL</span>
                    <p class="ib-card-question js-question"></p>
                    <div class="ib-card-heart-btn" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                </div>
                <div class="ib-card-face ib-face-back">
                    @include('icebreakers.partials._heart-svg', ['class' => 'ib-back-heart'])
                    <div class="ib-back-brand">loversnmore</div>
                    <div class="ib-back-underline"></div>
                    <div class="ib-back-tag">ICEBREAKERS · {{ strtoupper($deck['name']) }}</div>
                </div>
            </div>

            {{-- Card B (starts as "current") --}}
            <div class="ib-play-card" data-role="current" data-slot="b" tabindex="0" role="group" aria-label="Conversation card">
                <div class="ib-card-face ib-face-front">
                    <span class="ib-cat-pill-tag js-category">BE FOR REAL</span>
                    <p class="ib-card-question js-question"></p>
                    <div class="ib-card-heart-btn" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                </div>
                <div class="ib-card-face ib-face-back">
                    @include('icebreakers.partials._heart-svg', ['class' => 'ib-back-heart'])
                    <div class="ib-back-brand">loversnmore</div>
                    <div class="ib-back-underline"></div>
                    <div class="ib-back-tag">ICEBREAKERS · {{ strtoupper($deck['name']) }}</div>
                </div>
            </div>
        </div>

        <div class="ib-counter">
            <span id="ibCounter">01</span> <em>/</em> <span id="ibCounterTotal">{{ str_pad(count($cards), 2, '0', STR_PAD_LEFT) }}</span>
        </div>

        <div class="ib-controls">
            <button class="ib-ctrl pass" id="ibPassBtn" type="button" aria-label="Pass">
                <span class="ib-ctrl-circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </span>
                <span class="ib-ctrl-label">Pass</span>
            </button>
            <button class="ib-ctrl next" id="ibNextBtn" type="button" aria-label="Next card">
                <span class="ib-ctrl-circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                </span>
                <span class="ib-ctrl-label">Next Card</span>
            </button>
            <button class="ib-ctrl save" id="ibSaveBtn" type="button" aria-label="Save this card">
                <span class="ib-ctrl-circle">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </span>
                <span class="ib-ctrl-label">Save</span>
            </button>
        </div>

        <p class="ib-swipe-hint">Swipe left to pass, right for next · tap the card to flip</p>
    </div>

    <section class="ib-view-end" id="ibEndBlock" hidden>
        @include('icebreakers.partials._heart-svg', ['class' => 'ib-end-heart'])
        <h2 class="ib-end-title">That's the whole deck.</h2>
        <p class="ib-end-sub">Save a favourite, screenshot one to send, or try another deck.</p>
        <div class="ib-end-actions">
            <button class="ib-start-btn" id="ibShuffleBtn" type="button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="15" y1="15" x2="21" y2="21"/><line x1="4" y1="4" x2="9" y2="9"/></svg>
                Shuffle &amp; play again
            </button>
            <a href="{{ route('icebreakers.index') }}" class="ib-end-secondary">Pick another deck</a>
        </div>
    </section>
</main>

<script>
    // Deck data injected server-side — the play JS reads from window.__IB_CARDS.
    window.__IB_CARDS = @json($cards);
</script>
<script src="{{ asset('dist/js/icebreakers-play.js') }}?v={{ filemtime(public_path('dist/js/icebreakers-play.js')) }}" defer></script>

</body>
</html>
