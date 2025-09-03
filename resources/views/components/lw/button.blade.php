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
    $baseClasses = 'inline-flex items-center justify-center font-lw font-semibold text-center outline-none relative overflow-hidden transition-all duration-300 ease-in-out';
    
    $variantClasses = [
        'primary' => 'bg-gradient-lw text-white rounded-full hover:-translate-y-0.5 hover:shadow-lw-gradient active:translate-y-0',
        'secondary' => 'bg-transparent text-lw-primary border-2 border-lw-primary rounded-full hover:bg-lw-primary hover:text-white hover:-translate-y-0.5 hover:shadow-lg',
        'link' => 'bg-transparent border-0 text-lw-secondary hover:text-lw-primary hover:underline'
    ];
    
    $sizeClasses = [
        'default' => 'px-8 py-4 text-base',
        'lg' => 'px-12 py-5 text-lg h-16 rounded-full',
        'sm' => 'px-6 py-3 text-sm'
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