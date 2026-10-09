<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $deck['name'] }} — LoversNmore Icebreakers</title>
    <meta name="description" content="{{ $deck['description'] ?? $deck['caption'] ?? ($deck['name'] . ' — a LoversNmore conversation deck.') }}">
    <meta name="theme-color" content="#6b3fd6">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="LoversNmore">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $deck['name'] }} — LoversNmore Icebreakers">
    <meta property="og:description" content="{{ $deck['description'] ?? $deck['caption'] ?? '' }}">
    @if (!empty($deck['cover_image_url']))
        <meta property="og:image" content="{{ $deck['cover_image_url'] }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/css/icebreakers.css') }}?v={{ filemtime(public_path('dist/css/icebreakers.css')) }}">
</head>
<body class="ib-body">

@include('icebreakers.partials._topbar', ['back' => route('icebreakers.index'), 'favorite' => true])

<main class="ib-view-detail">
    <div class="ib-deck-item" data-variant="{{ $deck['variant'] }}">
        <div class="ib-detail-stage">
            <div class="ib-detail-stack">
                <div class="ib-st-layer" data-i="2" aria-hidden="true"></div>
                <div class="ib-st-layer" data-i="1" aria-hidden="true"></div>
                <div class="ib-st-layer" data-i="0">
                    <div class="ib-cover-inner">
                        @if (!empty($deck['cover_image_url']))
                            <img src="{{ $deck['cover_image_url'] }}" alt="" class="ib-cover-photo">
                        @endif
                        @include('icebreakers.partials._heart-svg', ['class' => 'ib-cover-heart'])
                        <h2 class="ib-cover-name">{{ $deck['name'] }}</h2>
                        <div class="ib-cover-underline"></div>
                        <p class="ib-detail-kicker">ICEBREAKERS</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h1 class="ib-detail-title">{{ $deck['name'] }}</h1>
    <p class="ib-detail-sub">{{ $deck['description'] ?? $deck['caption'] ?? '' }}</p>

    <div class="ib-detail-facts">
        <div class="ib-detail-fact">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <strong>{{ $deck['question_count'] }}</strong>
            <span class="ib-detail-fact-label">Cards</span>
        </div>
        <div class="ib-detail-fact">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            <strong>{{ $deck['vibe_label'] }}</strong>
            <span class="ib-detail-fact-label">Vibe</span>
        </div>
        <div class="ib-detail-fact">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/></svg>
            <strong>All Levels</strong>
            <span class="ib-detail-fact-label">Depth</span>
        </div>
    </div>

    @if ($deck['question_count'] > 0)
        <a href="{{ route('icebreakers.play', ['slug' => $deck['slug']]) }}" class="ib-start-btn">
            Start Playing
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </a>
    @else
        <p class="ib-empty-detail">This deck is being written. Check back soon.</p>
    @endif
</main>

</body>
</html>
