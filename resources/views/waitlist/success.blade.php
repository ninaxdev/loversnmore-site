<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

<title>You're on the list — LoversNmore</title>
<meta name="description" content="You're on the LoversNmore Houston waitlist. We'll notify you when we launch.">
<meta name="theme-color" content="#4c1be0">
<meta name="robots" content="noindex">

<link rel="icon" type="image/svg+xml" href="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}">
<link rel="apple-touch-icon" href="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('dist/css/waitlist-landing.css') }}?v={{ filemtime(public_path('dist/css/waitlist-landing.css')) }}">

<style>
  .success-shell {
    max-width: 640px;
    margin: 0 auto;
    padding: 48px 24px 24px;
    text-align: center;
  }
  .success-card {
    background: #fff;
    border-radius: 28px;
    padding: 48px 32px;
    box-shadow: 0 18px 50px rgba(84, 54, 145, 0.10);
    margin-top: 32px;
  }
  .success-check {
    width: 88px; height: 88px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4c1be0 0%, #7a4bff 100%);
    color: #fff;
    display: grid;
    place-items: center;
    font-size: 44px;
    margin: 0 auto 24px;
    box-shadow: 0 12px 28px rgba(76, 27, 224, 0.3);
  }
  .success-card h1 {
    font-size: 34px;
    line-height: 1.1;
    margin: 0 0 12px;
    color: var(--brand-ink);
    letter-spacing: -0.5px;
  }
  .success-card .lead {
    font-size: 18px;
    line-height: 1.55;
    color: #333965;
    margin: 0 0 24px;
    max-width: 480px;
    margin-left: auto;
    margin-right: auto;
  }
  .success-highlights {
    display: flex;
    flex-direction: column;
    gap: 14px;
    text-align: left;
    max-width: 420px;
    margin: 24px auto 32px;
  }
  .success-highlights li {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 12px 14px;
    background: #f8f4ff;
    border-radius: 14px;
    color: var(--brand-ink);
    font-weight: 500;
    font-size: 15px;
  }
  .success-highlights li strong { display: block; margin-bottom: 2px; }
  .success-highlights li span.icon {
    width: 28px; height: 28px;
    border-radius: 50%;
    background: var(--brand-purple);
    color: #fff;
    display: grid;
    place-items: center;
    font-size: 14px;
    flex-shrink: 0;
  }
  .success-back {
    display: inline-block;
    color: var(--brand-purple);
    text-decoration: none;
    font-weight: 700;
    padding: 12px 22px;
    border: 1.5px solid var(--brand-purple);
    border-radius: 999px;
    margin-top: 8px;
    transition: background 0.15s ease;
  }
  .success-back:hover { background: #faf7ff; }
  .success-email {
    font-family: 'Inter', monospace;
    background: #f1eaff;
    color: #3c1897;
    padding: 4px 10px;
    border-radius: 8px;
    font-weight: 700;
  }

  @media (max-width: 480px) {
    .success-shell { padding: 24px 16px; }
    .success-card { padding: 32px 20px; border-radius: 20px; }
    .success-card h1 { font-size: 26px; }
    .success-card .lead { font-size: 16px; }
  }
</style>
</head>
<body>
<main class="page-shell">
  <header class="topbar">
    <span></span>
    <div class="brand-lockup">
      <img src="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}" class="brand-icon" alt="">
      <img src="{{ asset('dist/img/waitlist/loversnmore-text.svg') }}" class="brand-wordmark" alt="LoversNmore">
    </div>
    <span></span>
  </header>

  <section class="success-shell">
    <div class="success-card">
      <div class="success-check" aria-hidden="true">&#10003;</div>

      <h1>
        @if($signupFirstName)
          You&rsquo;re on the list, {{ $signupFirstName }}!
        @else
          You&rsquo;re on the list!
        @endif
      </h1>

      <p class="lead">
        We&rsquo;ll send updates to <span class="success-email">{{ $signupEmail }}</span>
        and let you know the moment LoversNmore is live in Houston.
      </p>

      <ul class="success-highlights" role="list">
        <li>
          <span class="icon" aria-hidden="true">&#9993;</span>
          <div><strong>Check your inbox</strong>A confirmation email is on the way. Whitelist us so it doesn&rsquo;t land in spam.</div>
        </li>
        <li>
          <span class="icon" aria-hidden="true">&#127968;</span>
          <div><strong>Houston first</strong>We&rsquo;re building city-by-city, and Houston is our launch city.</div>
        </li>
        <li>
          <span class="icon" aria-hidden="true">&hearts;</span>
          <div><strong>Something better than swiping</strong>Real connections, thoughtful gestures, and shared experiences.</div>
        </li>
      </ul>

      <a href="{{ route('waitlist.landing') }}" class="success-back">&larr; Back to home</a>
    </div>
  </section>

  <footer>
    <div class="footer-brand">
      <img src="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}" alt="">
      <img src="{{ asset('dist/img/waitlist/loversnmore-text.svg') }}" alt="LoversNmore">
    </div>
    <nav>
      <a href="{{ route('waitlist.landing') }}">Home</a>
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
</body>
</html>
