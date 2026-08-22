<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{{ $pageTitle ?? 'Legal' }} — LoversNmore</title>
<meta name="robots" content="noindex,follow">
<meta name="theme-color" content="#4c1be0">

<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dist/img/waitlist/favicon-32.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dist/img/waitlist/apple-touch-icon.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('dist/css/waitlist-landing.css') }}?v={{ filemtime(public_path('dist/css/waitlist-landing.css')) }}">

<style>
  .legal-shell {
    max-width: 820px;
    margin: 0 auto;
    padding: 32px 24px 64px;
  }
  .legal-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--brand-purple);
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 24px;
    transition: color 0.15s ease;
  }
  .legal-back:hover { color: var(--brand-pink); }
  .legal-shell h1 {
    font-size: 40px;
    font-weight: 800;
    line-height: 1.1;
    color: var(--brand-ink);
    margin: 0 0 8px;
    letter-spacing: -0.5px;
  }
  .legal-shell .meta {
    color: var(--gray-500);
    font-size: 14px;
    margin: 0 0 32px;
  }
  .legal-shell h2 {
    font-size: 22px;
    font-weight: 700;
    color: var(--brand-ink);
    margin: 32px 0 12px;
  }
  .legal-shell p,
  .legal-shell li {
    font-size: 16px;
    line-height: 1.65;
    color: #333965;
    margin: 0 0 14px;
  }
  .legal-shell ul { padding-left: 22px; margin: 0 0 20px; }
  .legal-shell a { color: var(--brand-purple); }
  .legal-shell strong { color: var(--brand-ink); }

  @media (max-width: 480px) {
    .legal-shell { padding: 20px 16px 40px; }
    .legal-shell h1 { font-size: 30px; }
    .legal-shell h2 { font-size: 19px; margin-top: 24px; }
  }
</style>
</head>
<body>
<main class="page-shell">
  <header class="topbar">
    <span></span>
    <div class="brand-lockup">
      <a href="{{ route('waitlist.landing') }}">
        <img src="{{ asset('dist/img/waitlist/loversnmore-icon.svg') }}" class="brand-icon" alt="">
        <img src="{{ asset('dist/img/waitlist/loversnmore-text.svg') }}" class="brand-wordmark" alt="LoversNmore">
      </a>
    </div>
    <span></span>
  </header>

  <section class="legal-shell">
    <a href="{{ route('waitlist.landing') }}" class="legal-back">&larr; Back to home</a>
    {{ $slot }}
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
