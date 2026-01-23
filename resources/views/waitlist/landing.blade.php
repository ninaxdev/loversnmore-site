<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Join the Beta Waitlist - Loversnmore</title>

    <!-- Brand Meta -->
    <meta name="theme-color" content="#6A36A8">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/icon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/icon-16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/icon-180.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand-purple: #6A36A8;
            --brand-purple-light: #8B5FBF;
            --brand-purple-dark: #542e85;
        }

        body {
            font-family: 'Lexend', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .gradient-hero {
            background: linear-gradient(135deg, rgba(106, 54, 168, 0.03) 0%, rgba(197, 62, 141, 0.03) 100%);
        }

        .gradient-brand {
            background: linear-gradient(135deg, #6A36A8 0%, #8B5FBF 100%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #6A36A8 0%, #c53e8d 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .feature-float {
            animation: floatFeature 6s ease-in-out infinite;
        }

        @keyframes floatFeature {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-card:hover {
            transform: translateY(-12px) scale(1.02);
        }

        .glow-brand {
            box-shadow: 0 10px 40px rgba(106, 54, 168, 0.3);
        }

        .card-float {
            animation: cardFloat 8s ease-in-out infinite;
        }

        @keyframes cardFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .card-stack {
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Mobile hover - smaller spread */
        @media (max-width: 639px) {
            .card-stack-container:hover .card-back {
                transform: translateX(100px) translateY(12px) rotate(12deg) !important;
            }

            .card-stack-container:hover .card-middle {
                transform: translateX(50px) translateY(6px) rotate(8deg) !important;
            }

            .card-stack-container:hover .card-front {
                transform: translateX(-50px) rotate(-8deg) !important;
            }
        }

        /* Tablet and Desktop hover - wider spread */
        @media (min-width: 640px) {
            .card-stack-container:hover .card-back {
                transform: translateX(160px) translateY(16px) rotate(15deg) !important;
            }

            .card-stack-container:hover .card-middle {
                transform: translateX(80px) translateY(8px) rotate(10deg) !important;
            }

            .card-stack-container:hover .card-front {
                transform: translateX(-80px) rotate(-10deg) !important;
            }
        }

        .pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .7; }
        }

        /* Phone-like card styling for swipe effect */
        .swipe-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 10px;
            border-radius: 3rem;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
        }

        .swipe-card:hover {
            z-index: 100 !important;
            transform: scale(1.08) translateY(-15px) !important;
        }

        .swipe-card-inner {
            border-radius: 2.5rem;
            overflow: hidden;
            position: relative;
            height: 100%;
            background: #000;
        }

        .swipe-card-1 {
            background: linear-gradient(135deg, #B794F6 0%, #E879F9 100%);
        }

        .swipe-card-2 {
            background: linear-gradient(135deg, #F472B6 0%, #FB7185 100%);
        }

        .swipe-card-3 {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
        }

        .card-label {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            padding: 1.5rem 1.25rem;
            border-radius: 0 0 2rem 2rem;
        }

        .card-label-1 {
            background: linear-gradient(135deg, #B794F6 0%, #E879F9 100%);
        }

        .card-label-2 {
            background: linear-gradient(135deg, #F472B6 0%, #FB7185 100%);
        }

        .card-label-3 {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
        }

        .card-label h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }

        .card-label p {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.3;
        }
    </style>
</head>
<body class="antialiased min-h-screen bg-lw-light-gray">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 lg:px-20 py-5">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/heart-outline.svg') }}" alt="Loversnmore" class="w-8 h-8" style="filter: invert(24%) sepia(80%) saturate(2087%) hue-rotate(262deg) brightness(84%) contrast(94%);">
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold" style="color: #6A36A8;">loversnmore</span>
                        <span class="text-xs text-gray-500">Dating, reimagined</span>
                    </div>
                </div>

                <!-- Menu Items -->
                <div class="hidden md:flex items-center space-x-8">
                    <button onclick="openWaitlistModal()" class="gradient-brand text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all">
                        Join Waitlist
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-hero py-20 lg:py-32">
        
        <div class="container mx-auto px-6 lg:px-20">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Left Column: Text Content -->
                <div class="order-2 lg:order-1 animate-fade-in">
                    <div class="inline-block px-4 py-2 rounded-full text-sm font-semibold mb-6" style="background: rgba(106, 54, 168, 0.1); color: #6A36A8;">
                        Private beta. Select cities.
                    </div>

                    <h1 class="text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 leading-tight" style="color: #1a202c;">
                        Connection shouldn't live<br>
                        <span class="text-gradient">only on a screen.</span>
                    </h1>

                    <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-xl">
                        We're building a city-by-city dating platform that blends swiping with shared experiences and local events — helping people connect more naturally beyond just profiles
                    </p>

                    <div class="mb-6">
                        <button onclick="openWaitlistModal()" class="gradient-brand text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-xl transition-all inline-flex items-center justify-center glow-brand">
                            Join the waitlist
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>

                    <p class="text-sm text-gray-500">
                        Private beta. Select cities.
                    </p>
                </div>

                <!-- Right Column: Bold Creative People Collage -->
                <div class="order-1 lg:order-2 relative flex items-center justify-center">
                    <div class="relative w-64 sm:w-72 lg:w-80 h-[380px] sm:h-[450px] lg:h-[500px] mx-auto card-stack-container">

                        <div class="card-stack card-back absolute inset-0 translate-x-6 sm:translate-x-8 translate-y-12 sm:translate-y-16 rotate-6 rounded-[2rem] sm:rounded-[2.5rem] bg-gradient-to-br from-[#2D2B52] to-[#1A1832] shadow-2xl border border-white/10 flex flex-col justify-end p-4 sm:p-6 z-10">
                            <h3 class="text-white text-lg sm:text-xl font-bold">Real Connections</h3>
                        </div>

                        <div class="card-stack card-middle absolute inset-0 translate-x-3 sm:translate-x-4 translate-y-6 sm:translate-y-8 rotate-3 rounded-[2rem] sm:rounded-[2.5rem] bg-white shadow-2xl border border-gray-100 overflow-hidden z-20">
                            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=600&h=800&fit=crop&auto=format&q=80" alt="Profile" class="h-2/3 w-full object-cover">
                            <div class="h-1/3 bg-gradient-to-br from-[#F472B6] to-[#FB7185] p-4 sm:p-5 flex flex-col justify-center">
                                <h3 class="text-white text-lg sm:text-xl font-bold">Dating, Not Swiping</h3>
                            </div>
                        </div>

                        <div class="card-stack card-front absolute inset-0 -rotate-3 rounded-[2.5rem] sm:rounded-[3rem] bg-white shadow-2xl border-2 sm:border-4 border-white/20 overflow-hidden z-30">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&h=800&fit=crop&auto=format&q=80" alt="Profile" class="h-[65%] w-full object-cover">
                            <div class="h-[35%] bg-gradient-to-br from-[#9367E8] via-[#D378B1] to-[#FF9C9C] p-4 sm:p-6 flex flex-col justify-center">
                                <h3 class="text-white text-xl sm:text-2xl font-bold">Shared Moments</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-white" id="features">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-4" style="color: #1a202c;">
                    Dating, reimagined.
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Less guessing. Less swiping. More reasons to actually meet.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lw-light feature-card">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, rgba(106, 54, 168, 0.1), rgba(197, 62, 141, 0.1));">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" style="color: #6A36A8;">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1a202c;">City-First</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Built intentionally, one city at a time
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lw-light feature-card">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, rgba(106, 54, 168, 0.1), rgba(139, 95, 191, 0.1));">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" style="color: #6A36A8;">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1a202c;">Shared Context</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Connect around what's happening nearby.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lw-light feature-card">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, rgba(197, 62, 141, 0.1), rgba(232, 93, 159, 0.1));">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" style="color: #6A36A8;">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1a202c;">Easier First Moves</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Start with a message, or send a thoughtful gift.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- How It Comes To Life Section -->
    <section class="bg-white py-24" id="how-it-works">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-4xl lg:text-5xl font-bold mb-6" style="color: #1a202c;">
                    How it comes to life
                </h2>
                <p class="text-xl text-gray-600 leading-relaxed">
                Dating, without the pressure <br/>
                More shared moments. <br/>
                Better first moves  
                          </p>
            </div>
        </div>
    </section>

    <!-- Waitlist CTA Section -->
    <section class="gradient-brand py-24" id="waitlist">
        <div class="container mx-auto px-6 lg:px-20 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                Ready to experience dating differently?
            </h2>
            <p class="text-xl text-purple-100 mb-10 max-w-2xl mx-auto">
                Join thousands already on the waitlist. Be the first to know when loversnmore launches in your city.
            </p>

            <button onclick="openWaitlistModal()" class="bg-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-xl transition-all inline-flex items-center justify-center" style="color: #6A36A8;">
                Join the Waitlist
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </button>

            <p class="text-purple-100 text-sm mt-6">
                Private beta • City-by-city rollout
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white py-16" style="background: #6A36A8;">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/heart-outline.svg') }}" alt="Loversnmore" class="w-8 h-8">
                        <span class="text-2xl font-bold">loversnmore</span>
                    </div>
                    <p class="text-purple-200">
                        Dating, reimagined.
                    </p>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="font-bold mb-4">Product</h4>
                    <ul class="space-y-2 text-purple-200">
                        <li><a href="#features" class="hover:text-white transition">Features</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition">How It Works</a></li>
                        <li><a href="#waitlist" class="hover:text-white transition">Join Waitlist</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-bold mb-4">Company</h4>
                    <ul class="space-y-2 text-purple-200">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="{{ route('user.read.contact') }}" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="space-y-2 text-purple-200">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Community Guidelines</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-purple-700 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-purple-200 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} Loversnmore. All rights reserved. Made with ❤️ for better connections.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-purple-200 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="text-purple-200 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="text-purple-200 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Waitlist Modal -->
    <div id="waitlistModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-8 relative animate-fade-in">
            <!-- Close Button -->
            <button onclick="closeWaitlistModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="mb-6">
                <h3 class="text-3xl font-bold mb-2" style="color: #1a202c;">Join the Waitlist</h3>
                <p class="text-gray-600">Be the first to know when we launch in your city.</p>
            </div>

            <!-- Beta Notice -->
            <div class="bg-purple-50 border border-purple-200 rounded-xl p-4 mb-6">
                <p class="text-sm" style="color: #6A36A8;">
                    <strong>Private Beta</strong> • We're launching city-by-city to ensure the best experience for everyone.
                </p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Waitlist Form -->
            <form action="{{ route('waitlist.signup.process') }}" method="POST" id="waitlistForm">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold mb-2" style="color: #1a202c;">Email Address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition @error('email') border-red-500 @enderror"
                           required>
                </div>

                <div class="mb-6">
                    <label for="city" class="block text-sm font-semibold mb-2" style="color: #1a202c;">Your City</label>
                    <input type="text"
                           id="city"
                           name="city"
                           value="{{ old('city') }}"
                           placeholder="e.g., New York, Los Angeles, Chicago"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition @error('city') border-red-500 @enderror"
                           required>
                    <p class="text-xs text-gray-500 mt-2">We'll notify you when we launch in your city</p>
                </div>

                <button type="submit" class="w-full gradient-brand text-white px-6 py-4 rounded-full font-semibold text-lg hover:shadow-xl transition-all">
                    Join the Waitlist
                </button>

                <p class="text-xs text-gray-500 text-center mt-4">
                    We respect your privacy. Unsubscribe anytime.
                </p>
            </form>
        </div>
    </div>

    <script>
        function openWaitlistModal() {
            document.getElementById('waitlistModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeWaitlistModal() {
            document.getElementById('waitlistModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('waitlistModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeWaitlistModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeWaitlistModal();
            }
        });

        // Auto-open modal if there are form errors or success message
        @if($errors->any() || session('success'))
            window.addEventListener('DOMContentLoaded', function() {
                openWaitlistModal();
            });
        @endif
    </script>

</body>
</html>
