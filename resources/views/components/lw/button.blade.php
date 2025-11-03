{{-- Design System - Button Component (Tailwind CSS) --}}
@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'default',
    'fullWidth' => false,
    'loading' => false,
    'href' => null,
    'class' => ''
])

@php
    // Loversnmore Design System - Button Component
    $baseClasses = 'inline-flex items-center justify-center font-poppins font-medium text-center outline-none relative overflow-hidden transition-all duration-300 ease-in-out';

    $variantClasses = [
        // Primary: Gradient #4F1DA1 → #E78AB0, white text, 12px radius
        'primary' => 'bg-gradient-lw text-white rounded-md hover:bg-gradient-hover hover:shadow-lw active:translate-y-0.5',
        // Secondary: White border 2px solid #4F1DA1, purple text
        'secondary' => 'bg-white text-lw-primary border-2 border-lw-primary rounded-md hover:bg-lw-lavender hover:shadow-lw',
        'link' => 'bg-transparent border-0 text-lw-secondary hover:text-lw-primary hover:underline'
    ];

    $sizeClasses = [
        'default' => 'px-8 py-3 text-base', // Button SM - Poppins Medium 16pt
        'lg' => 'px-12 py-4 text-lg',
        'sm' => 'px-6 py-2 text-sm'
    ];
    
    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . ($sizeClasses[$size] ?? $sizeClasses['default']);
    
    if ($fullWidth) {
        $classes .= ' w-full';
    }
    
    if ($loading) {
        $classes .= ' opacity-70 cursor-not-allowed pointer-events-none';
    }
    
    $classes .= ' ' . $class;
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }}" {{ $attributes->except(['disabled']) }}>
        @if($loading)
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $classes }}" @if($loading) disabled @endif {{ $attributes }}>
        @if($loading)
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </button>
@endif