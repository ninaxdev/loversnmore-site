@php
    // Renders the icebreakers header bar. Optional `back` route name shows a
    // back arrow (instead of the hamburger). Optional `favorite` flag shows
    // the pink heart button on the right (used on deck detail / play views).
    $back = $back ?? null;
    $favorite = $favorite ?? false;
@endphp
<header class="ib-topbar">
    @if ($back)
        <a href="{{ $back }}" class="ib-back-btn" aria-label="Back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"/>
            </svg>
        </a>
    @else
        <button class="ib-hamburger" aria-label="Menu" type="button">
            <span></span><span></span><span></span>
        </button>
    @endif

    <a href="{{ route('icebreakers.index') }}" class="ib-brand">
        @include('icebreakers.partials._heart-svg', ['class' => 'ib-brand-mark'])
        <span class="ib-brand-word">loversnmore</span>
    </a>

    @if ($favorite)
        <button class="ib-icon-btn pink" aria-label="Save deck" type="button">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </button>
    @else
        <div class="ib-topbar-actions">
            <a href="{{ route('waitlist.landing') }}" class="ib-icon-btn" aria-label="Join waitlist" title="Join waitlist">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 1 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
            </a>
        </div>
    @endif
</header>
