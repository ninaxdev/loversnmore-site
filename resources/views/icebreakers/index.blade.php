<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LoversNmore Icebreakers — Skip the small talk.</title>
    <meta name="description" content="Digital conversation decks from LoversNmore. Pick a deck for first dates, couples, or friends. Real questions. No sign-up.">
    <meta name="theme-color" content="#6b3fd6">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="LoversNmore">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="LoversNmore Icebreakers">
    <meta property="og:description" content="Conversation decks that actually get people talking. Free. No accounts. Just tap a deck.">
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/css/icebreakers.css') }}?v={{ filemtime(public_path('dist/css/icebreakers.css')) }}">
</head>
<body class="ib-body">

@include('icebreakers.partials._topbar')

<main class="ib-view-select">
    <div class="ib-select-hero">
        <h1 class="ib-select-title">ICEBREAKERS</h1>
        <p class="ib-select-sub">Choose a Deck</p>
    </div>

    {{-- Category filter — server-side re-render via ?category= --}}
    <nav class="ib-category-pills" aria-label="Filter decks by category">
        @foreach ($categories as $cat)
            <a href="{{ route('icebreakers.index') }}{{ $cat['id'] === 'all' ? '' : '?category=' . $cat['id'] }}"
               class="ib-cat-pill {{ $activeCategory === $cat['id'] ? 'is-active' : '' }}">
                {{ $cat['label'] }}
            </a>
        @endforeach
    </nav>

    @if (empty($decks))
        <p class="ib-empty">No decks available in this category yet — check back soon.</p>
    @else
        <div class="ib-deck-grid" role="list">
            @foreach ($decks as $deck)
                <div class="ib-deck-item" data-variant="{{ $deck['variant'] }}" data-cat="{{ $deck['category'] }}" role="listitem">
                    <a href="{{ route('icebreakers.show', ['slug' => $deck['slug']]) }}"
                       class="ib-deck-stack"
                       aria-label="Open {{ $deck['name'] }} deck">
                        <span class="ib-st-layer" data-i="2" aria-hidden="true"></span>
                        <span class="ib-st-layer" data-i="1" aria-hidden="true"></span>
                        <span class="ib-st-layer" data-i="0">
                            <span class="ib-cover-inner">
                                @if (!empty($deck['cover_image_url']))
                                    <img src="{{ $deck['cover_image_url'] }}" alt="" class="ib-cover-photo">
                                @endif
                                <span class="ib-cover-top-label">Icebreakers</span>
                                <span class="ib-cover-middle">
                                    @include('icebreakers.partials._heart-svg', ['class' => 'ib-cover-heart'])
                                    <span class="ib-cover-name">{{ $deck['name'] }}</span>
                                    @if (!empty($deck['caption']))
                                        <span class="ib-cover-tagline">{{ $deck['caption'] }}</span>
                                    @endif
                                    <span class="ib-cover-underline"></span>
                                </span>
                                <span class="ib-cover-brand">LoversNmore</span>
                            </span>
                        </span>
                    </a>
                    <div class="ib-deck-caption">
                        <p class="ib-deck-caption-name">{{ $deck['name'] }}</p>
                        <p class="ib-deck-caption-sub">{{ $deck['caption'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</main>

</body>
</html>
