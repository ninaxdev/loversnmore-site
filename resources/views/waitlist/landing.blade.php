<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>LoversNmore — Coming to Houston. Connections that go beyond.</title>
<meta name="description" content="Join the LoversNmore waitlist for Houston. A new way to meet friends, date intentionally, and explore your city together. Coming soon.">
<meta name="theme-color" content="#4c1be0">

<!-- Open Graph / Facebook / WhatsApp / iMessage / Discord -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="LoversNmore">
<meta property="og:locale" content="en_US">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="LoversNmore — Coming to Houston">
<meta property="og:description" content="Connections that go beyond. Join the waitlist for Houston.">
<meta property="og:image" content="{{ asset('dist/img/waitlist/og-image.png') }}">
<meta property="og:image:secure_url" content="{{ asset('dist/img/waitlist/og-image.png') }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="LoversNmore — coming to Houston. Less &quot;wyd?&quot;, more real connections.">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ url()->current() }}">
<meta name="twitter:title" content="LoversNmore — Coming to Houston">
<meta name="twitter:description" content="Connections that go beyond. Join the waitlist for Houston.">
<meta name="twitter:image" content="{{ asset('dist/img/waitlist/og-image.png') }}">

<!-- Canonical -->
<link rel="canonical" href="{{ url()->current() }}">

<!-- Favicon (SVG works in all modern browsers) -->
<link rel="icon" type="image/svg+xml" href="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}">
<link rel="alternate icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('dist/css/waitlist-landing.css') }}?v={{ filemtime(public_path('dist/css/waitlist-landing.css')) }}">
</head>
<body>
<main class="page-shell">
  <header class="topbar">
    <button class="dot-grid" aria-label="Menu" type="button">
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
      <span></span><span></span><span></span>
    </button>
    <div class="brand-lockup">
      <!-- <img src="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}" class="brand-icon" alt=""> -->
      <img src="{{ asset('dist/img/waitlist/loversnmore-text.svg') }}" class="brand-wordmark" alt="LoversNmore">
      <p>Connections that go beyond. <span class="purple">&hearts;</span><span class="pink">&hearts;</span></p>
    </div>
    <a href="#waitlist" class="login-button">&#9825;&nbsp;&nbsp;Join Waitlist</a>
  </header>

  <section class="hero-layout">
    <div class="phone-column">
      <div class="phone-shell" aria-hidden="true">
        <div class="phone-status">
          <span>9:41</span><span class="island"></span><span>&#9646;&#9646;&#8961;&#9648;</span>
        </div>

        <div class="phone-brand">
          <!-- <img src="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}" class="phone-brand-icon" alt=""> -->
          <img src="{{ asset('dist/img/waitlist/loversnmore-text.svg') }}" class="phone-brand-text" alt="LoversNmore">
          <small>Connections that go beyond. &hearts;</small>
        </div>

        <section class="phone-feature-cards">
          <article class="phone-feature">
            <div class="feature-icon purple-bg" aria-hidden="true">&#128101;</div>
            <div class="feature-image-box">
              <picture>
                <source srcset="{{ asset('dist/img/waitlist/meet-friends.webp') }}" type="image/webp">
                <img src="{{ asset('dist/img/waitlist/meet-friends.png') }}" alt="Meet Friends" loading="lazy" decoding="async">
              </picture>
            </div>
            <h3>Meet Friends</h3>
            <p>in fun places<br>or attending events</p>
          </article>

          <article class="phone-feature">
            <div class="feature-icon pink-bg" aria-hidden="true">&hearts;</div>
            <div class="feature-image-box">
              <picture>
                <source srcset="{{ asset('dist/img/waitlist/date-intentionally.webp') }}" type="image/webp">
                <img src="{{ asset('dist/img/waitlist/date-intentionally.png') }}" alt="Date Intentionally" loading="lazy" decoding="async">
              </picture>
            </div>
            <h3>Date Intentionally</h3>
            <p>with people who<br>value real connection</p>
          </article>

          <article class="phone-feature">
            <div class="feature-icon purple-bg" aria-hidden="true">&#8982;</div>
            <div class="feature-image-box">
              <picture>
                <source srcset="{{ asset('dist/img/waitlist/explore-together.webp') }}" type="image/webp">
                <img src="{{ asset('dist/img/waitlist/explore-together.png') }}" alt="Explore Together" loading="lazy" decoding="async">
              </picture>
            </div>
            <h3>Explore Together</h3>
            <p>local spots, events,<br>and the city you love</p>
          </article>
        </section>

        <section class="for-you">
          <div class="for-you-title"><h2>For You</h2><a href="#waitlist">See all</a></div>

          <div class="feed-row"><span class="feed-icon purple-lite">&#9749;</span><div><strong>New Thoughtful Gesture</strong><p>Jordan sent you a Coffee Treat. &#9749;</p></div><small>2m ago</small></div>
          <div class="feed-row"><span class="feed-icon pink-lite">&#9825;</span><div><strong>You Matched!</strong><p>Explore Together unlocked &#127881;</p></div><small>15m ago</small></div>
          <div class="feed-row"><span class="feed-icon purple-lite">&#9635;</span><div><strong>Nearby Event</strong><p>Live Music Night  5 people you match with are going.</p></div><small>1h ago</small></div>
          <div class="feed-row"><span class="feed-icon pink-lite">&#128172;</span><div><strong>Ice Breaker</strong><p>What&rsquo;s your ideal Sunday?</p></div><small>2h ago</small></div>
          <div class="feed-row"><span class="feed-icon purple-lite">&#127873;</span><div><strong>New Thoughtful Gesture</strong><p>You have a new gift! &#128157;</p></div><small>3h ago</small></div>
        </section>

        <a href="#waitlist" class="explore-now">Explore Now</a>

        <nav class="bottom-nav" aria-hidden="true">
          <span class="active">&#8962;<small>For You</small></span>
          <span>&hearts;<small>Matches</small></span>
          <span class="plus">&#65291;</span>
          <span>&#127873;<small>Gestures</small></span>
          <span>&#9817;<small>Profile</small></span>
        </nav>
      </div>
    </div>

    <div class="hero-copy">
      <h1>
        <span class="ink">Less &ldquo;wyd?&rdquo;</span><br>
        <span class="purple">More real</span><br>
        <span class="pink">connections.</span> <span class="heart-outline">&hearts;</span>
      </h1>
      <p class="hero-subhead">Meet people with intention, build meaningful relationships, and discover experiences that bring you closer.</p>
      <p class="hero-houston-badge"><span class="badge-dot"></span>Coming soon to Houston</p>
    </div>

    <aside class="waitlist-card" id="waitlist">
      <div class="mail-icon" aria-hidden="true">&#9993;</div>
      <h2>Be the first to know</h2>
      <p class="waitlist-sub">Houston launches first  join from anywhere, we&rsquo;re coming to more cities.</p>

      @if(session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
      @endif

      @if(isset($errors) && $errors->any())
        <div class="alert alert-error" role="alert">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <form action="{{ route('waitlist.signup.process') }}" method="POST" id="waitlistForm" novalidate>
        @csrf

        <label for="wl-first-name">First Name</label>
        <input type="text"
               id="wl-first-name"
               name="first_name"
               value="{{ old('first_name') }}"
               placeholder="Enter your first name"
               autocomplete="given-name"
               required
               minlength="1"
               maxlength="100">

        <label for="wl-email">Email Address</label>
        <input type="email"
               id="wl-email"
               name="email"
               value="{{ old('email') }}"
               placeholder="Enter your email address"
               autocomplete="email"
               inputmode="email"
               required
               maxlength="255">

        <label for="wl-city">City</label>
        <input type="text"
               id="wl-city"
               name="city"
               value="{{ old('city') }}"
               placeholder="e.g. Houston, Austin, Miami"
               autocomplete="address-level2"
               required
               maxlength="100">

        <button type="submit" class="waitlist-button" id="wl-submit-btn">
          <span class="btn-label">&hearts;&nbsp;&nbsp;Join the Waitlist</span>
          <span class="btn-loading" aria-hidden="true">Joining...</span>
        </button>

        <small class="privacy">&#128274; We respect your privacy. No spam, ever.</small>
      </form>
    </aside>
  </section>

  <section class="benefits">
    <article>
      <div class="benefit-icon purple-lite" aria-hidden="true">&#128101;</div>
      <div><h3>Meaningful Connections</h3><p>Meet new friends or find someone special. Build genuine relationships that fit your life.</p></div>
    </article>
    <article>
      <div class="benefit-icon pink-lite" aria-hidden="true">&#127873;</div>
      <div><h3>Thoughtful Gestures</h3><p>Send digital gifts and kind gestures that spark real conversations and show you care.</p></div>
    </article>
    <article>
      <div class="benefit-icon purple-lite" aria-hidden="true">&#8982;</div>
      <div><h3>Explore Together</h3><p>Discover local places, events, and experiences to share unforgettable moments together.</p></div>
    </article>
  </section>

  <footer>
    <div class="footer-brand">
      <img src="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}" alt="">
      <img src="{{ asset('dist/img/waitlist/loversnmore-text.svg') }}" alt="LoversNmore">
    </div>
    <nav>
      <a href="#waitlist">Join Waitlist</a>
      <a href="{{ route('legal.terms') }}">Terms</a>
      <a href="{{ route('legal.privacy') }}">Privacy</a>
    </nav>
    <div class="socials" aria-label="Social links">
      <a href="#" aria-label="Instagram">&#9737;</a>
      <a href="#" aria-label="TikTok">&#9834;</a>
      <a href="#" aria-label="Facebook">&#9679;</a>
      <a href="#" aria-label="X (Twitter)">&#120143;</a>
    </div>
  </footer>
</main>

<script>
(function() {
  var form = document.getElementById('waitlistForm');
  var submitBtn = document.getElementById('wl-submit-btn');
  if (!form || !submitBtn) return;

  form.addEventListener('submit', function(e) {
    // Basic browser validation runs first via `required` attributes
    if (!form.checkValidity()) {
      form.reportValidity();
      e.preventDefault();
      return;
    }
    submitBtn.disabled = true;
    submitBtn.classList.add('is-loading');
  });
})();
</script>
</body>
</html>
