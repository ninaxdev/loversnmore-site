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

        .gradient-card-1 {
            background: linear-gradient(135deg, #6A36A8 0%, #8B5FBF 100%);
        }

        .gradient-card-2 {
            background: linear-gradient(135deg, #c53e8d 0%, #e85d9f 100%);
        }

        .gradient-card-3 {
            background: linear-gradient(135deg, #8B5FBF 0%, #c53e8d 100%);
        }

        .pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .7; }
        }

        /* Hover improvements for image visibility */
        .person-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .person-card:hover {
            z-index: 100 !important;
            transform: scale(1.08) !important;
        }

        .image-overlay {
            transition: opacity 0.5s ease;
        }

        .person-card:hover .image-overlay {
            opacity: 0.15 !important;
        }

        .person-card:hover img {
            filter: brightness(1.1) contrast(1.05);
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
                    <span class="text-2xl font-bold" style="color: #6A36A8;">loversnmore</span>
                </div>

                <!-- Menu Items -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#waitlist" class="gradient-brand text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition-all">
                        Join Waitlist
                    </a>
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
                        🎉 Beta Access Opening Soon
                    </div>

                    <h1 class="text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 leading-tight" style="color: #1a202c;">
                        Shared experiences<br>
                        <span class="text-gradient">make dating easier.</span>
                    </h1>

                    <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-xl">
                        A dating platform that helps real connections happen — using shared real-world moments to move things off the screen naturally.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-6">
                        <a href="#waitlist" class="gradient-brand text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-xl transition-all inline-flex items-center justify-center glow-brand">
                            Join the Waitlist
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="#how-it-works" class="bg-white border-2 px-8 py-4 rounded-full font-semibold text-lg hover:bg-purple-50 transition-all inline-flex items-center justify-center" style="color: #6A36A8; border-color: #6A36A8;">
                            Learn More
                        </a>
                    </div>

                    <p class="text-sm text-gray-500">
                        ✨ Get early access when your city opens • No credit card required
                    </p>
                </div>

                <!-- Right Column: Bold Creative People Collage -->
                <div class="order-1 lg:order-2 relative">
                    <div class="relative h-[550px] lg:h-[700px] w-full">

                        <!-- Large Feature Card 1 - Asian Woman - Left Side -->
                        <div class="person-card absolute top-0 left-0 w-80 lg:w-96 bg-white rounded-3xl shadow-2xl transform -rotate-3 hover:rotate-0 card-float overflow-hidden" style="animation-delay: 0s; z-index: 15;">
                            <div class="relative h-80 lg:h-96 overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&h=800&fit=crop&auto=format&q=80"
                                     alt="Happy Asian woman"
                                     class="w-full h-full object-cover transition-all duration-700">
                                <div class="image-overlay absolute inset-0 bg-gradient-to-t from-[#6A36A8] via-transparent to-transparent opacity-30"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-6">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="bg-white bg-opacity-30 backdrop-blur-sm p-3 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-white text-2xl font-bold">Shared Moments</h3>
                                            <p class="text-white text-sm text-opacity-90">Connect through experiences</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Large Feature Card 2 - Black Man - Top Right -->
                        <div class="person-card absolute top-8 lg:top-12 right-0 w-80 lg:w-96 bg-white rounded-3xl shadow-2xl transform rotate-3 hover:rotate-0 card-float overflow-hidden" style="animation-delay: 0.8s; z-index: 14;">
                            <div class="relative h-80 lg:h-96 overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=600&h=800&fit=crop&auto=format&q=80"
                                     alt="Confident Black man"
                                     class="w-full h-full object-cover transition-all duration-700">
                                <div class="image-overlay absolute inset-0 bg-gradient-to-t from-[#c53e8d] via-transparent to-transparent opacity-30"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-6">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="bg-white bg-opacity-30 backdrop-blur-sm p-3 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-white text-2xl font-bold">Real Connections</h3>
                                            <p class="text-white text-sm text-opacity-90">Context over swiping</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medium Card 3 - Latina Woman - Bottom Left -->
                        <div class="person-card absolute bottom-0 left-12 lg:left-16 w-64 lg:w-80 bg-white rounded-3xl shadow-2xl transform rotate-6 hover:rotate-0 card-float overflow-hidden" style="animation-delay: 1.2s; z-index: 16;">
                            <div class="relative h-64 lg:h-80 overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=500&h=700&fit=crop&auto=format&q=80"
                                     alt="Beautiful Latina woman"
                                     class="w-full h-full object-cover transition-all duration-700">
                                <div class="image-overlay absolute inset-0 bg-gradient-to-t from-[#8B5FBF] via-transparent to-transparent opacity-30"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-5">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <div class="bg-white bg-opacity-30 backdrop-blur-sm p-2.5 rounded-xl">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-white text-xl font-bold">Authentic Dating</h3>
                                            <p class="text-white text-xs text-opacity-90">Be yourself</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medium Card 4 - Caucasian Woman - Bottom Right -->
                        <div class="person-card absolute bottom-4 lg:bottom-8 right-8 lg:right-12 w-56 lg:w-72 bg-white rounded-3xl shadow-2xl transform -rotate-6 hover:rotate-0 card-float overflow-hidden" style="animation-delay: 1.6s; z-index: 13;">
                            <div class="relative h-56 lg:h-72 overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=500&h=700&fit=crop&auto=format&q=80"
                                     alt="Smiling Caucasian woman"
                                     class="w-full h-full object-cover transition-all duration-700">
                                <div class="image-overlay absolute inset-0 bg-gradient-to-t from-[#e85d9f] via-transparent to-transparent opacity-30"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <div class="bg-white bg-opacity-30 backdrop-blur-sm rounded-xl p-3">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                            </svg>
                                            <p class="text-white text-sm font-bold">500K+ Connections</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Accent Card 5 - South Asian Man - Center Overlap -->
                        <div class="person-card absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 lg:w-60 bg-white rounded-2xl shadow-2xl rotate-12 hover:rotate-0 card-float overflow-hidden" style="animation-delay: 0.4s; z-index: 17;">
                            <div class="relative h-48 lg:h-60 overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop&auto=format&q=80"
                                     alt="South Asian man"
                                     class="w-full h-full object-cover transition-all duration-700">
                                <div class="image-overlay absolute inset-0 bg-gradient-to-t from-[#6A36A8] to-transparent opacity-25"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-3">
                                    <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded-xl p-2.5 text-center">
                                        <div class="flex items-center justify-center space-x-1.5">
                                            <svg class="w-4 h-4 text-[#6A36A8]" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <p class="text-[#6A36A8] text-sm font-bold">4.9★ Rated</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Accent Card 6 - Multiracial Woman - Top Center -->
                        <div class="person-card absolute top-28 lg:top-36 left-1/2 transform -translate-x-1/2 w-44 lg:w-56 bg-white rounded-2xl shadow-xl -rotate-12 hover:rotate-0 card-float overflow-hidden" style="animation-delay: 2s; z-index: 12;">
                            <div class="relative h-44 lg:h-56 overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&h=600&fit=crop&auto=format&q=80"
                                     alt="Multiracial woman"
                                     class="w-full h-full object-cover transition-all duration-700">
                                <div class="image-overlay absolute inset-0 bg-gradient-to-t from-[#c53e8d] to-transparent opacity-25"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-2.5">
                                    <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded-lg p-2 text-center">
                                        <div class="flex items-center justify-center space-x-1.5">
                                            <svg class="w-4 h-4 text-[#c53e8d]" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <p class="text-[#c53e8d] text-xs font-bold">Verified</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Large Decorative Elements -->
                        <div class="absolute top-1/4 right-1/4 pulse-slow opacity-10 hidden lg:block">
                            <svg class="w-24 h-24 text-[#6A36A8]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="absolute bottom-1/4 left-1/4 pulse-slow opacity-10 hidden lg:block" style="animation-delay: 1.5s;">
                            <svg class="w-20 h-20 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="animate-slide-up">
                    <div class="text-4xl font-bold mb-2" style="color: #6A36A8;">10K+</div>
                    <div class="text-gray-600">Early Signups</div>
                </div>
                <div class="animate-slide-up" style="animation-delay: 0.1s;">
                    <div class="text-4xl font-bold mb-2" style="color: #6A36A8;">25+</div>
                    <div class="text-gray-600">Cities Ready</div>
                </div>
                <div class="animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="text-4xl font-bold mb-2" style="color: #6A36A8;">4.9★</div>
                    <div class="text-gray-600">Beta Rating</div>
                </div>
                <div class="animate-slide-up" style="animation-delay: 0.3s;">
                    <div class="text-4xl font-bold mb-2" style="color: #6A36A8;">500K+</div>
                    <div class="text-gray-600">Shared Moments</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 gradient-hero" id="features">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-4" style="color: #1a202c;">
                    Dating feels better when there's<br>something real to share
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Move beyond endless swiping and start connecting through meaningful experiences
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
                    <h3 class="text-2xl font-bold mb-4" style="color: #1a202c;">Real-World Context</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Moments create context. It's easier to move from chatting to meeting when you have something real to talk about.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lw-light feature-card">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, rgba(197, 62, 141, 0.1), rgba(232, 93, 159, 0.1));">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" style="color: #6A36A8;">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1a202c;">Thoughtful Gestures</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Start with a message, or send a thoughtful gift
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="bg-white py-24" id="how-it-works">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-4" style="color: #1a202c;">
                    How Loversnmore Works
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Three simple steps to more meaningful connections
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-12 max-w-6xl mx-auto">

                <div class="text-center">
                    <div class="text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg" style="background: #6A36A8;">
                        1
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1a202c;">Share Your Moments</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Post about places you've been, things you've done, and experiences that matter to you
                    </p>
                </div>

                <div class="text-center">
                    <div class="text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg" style="background: #6A36A8;">
                        2
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1a202c;">Connect Naturally</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Meet people who share your interests and have experienced the same places as you
                    </p>
                </div>

                <div class="text-center">
                    <div class="text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-6 shadow-lg" style="background: #6A36A8;">
                        3
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: #1a202c;">Meet In Person</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Take conversations offline with context that makes first dates natural and comfortable
                    </p>
                </div>

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

            @if(session('success'))
                <div class="max-w-md mx-auto mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="max-w-md mx-auto mb-6 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-2xl">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('waitlist.signup.process') }}" method="POST" class="max-w-md mx-auto" id="waitlistForm">
                @csrf
                <div class="bg-white rounded-full p-2 shadow-2xl flex">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Enter your email address"
                           class="flex-1 px-6 py-3 rounded-full border-0 focus:ring-0 text-gray-900 @error('email') border-red-500 @enderror"
                           required>
                    <button type="submit" class="text-white px-8 py-3 rounded-full font-semibold transition whitespace-nowrap hover:opacity-90" style="background: #542e85;">
                        Join Waitlist
                    </button>
                </div>
                <p class="text-purple-100 text-sm mt-4">
                    🔒 We respect your privacy. Unsubscribe anytime.
                </p>
            </form>
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
                        Making dating easier through shared experiences.
                    </p>
                </div>

                <!-- Product -->
                <div>
                    <h4 class="font-bold mb-4">Product</h4>
                    <ul class="space-y-2 text-purple-200">
                        <li><a href="#features" class="hover:text-white transition">Features</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition">How It Works</a></li>
                        <li><a href="#" class="hover:text-white transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
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

</body>
</html>
