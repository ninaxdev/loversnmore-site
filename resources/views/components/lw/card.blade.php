{{-- Design System - Card Component (Tailwind CSS) --}}
@props([
    'type' => 'default',
    'title' => null,
    'subtitle' => null,
    'class' => ''
])

{{-- Loversnmore Design System - Card Component --}}
{{-- White background, 12px radius, shadow #E7DFF2, padding 16px --}}
@php
    $cardClasses = [
        'default' => 'bg-white rounded-md shadow-lw-card',
        'glass' => 'bg-white/95 backdrop-blur-lw border border-white/20 rounded-md shadow-lw',
        'profile' => 'bg-white rounded-md shadow-lw-card overflow-hidden',
        'stats' => 'bg-gradient-lw text-white rounded-md shadow-lw'
    ];

    $classes = ($cardClasses[$type] ?? $cardClasses['default']) . ' ' . $class;
@endphp

<div class="{{ $classes }}" {{ $attributes }}>
    @if($title || $subtitle)
        <div class="px-4 py-4 border-b border-lw-lavender {{ $type === 'stats' ? 'bg-white/10 border-white/10' : 'bg-lw-lavender/30' }}">
            @if($title)
                <h3 class="font-poppins font-semibold text-xl text-lw-text-primary mb-1 {{ $type === 'stats' ? 'text-white' : '' }}">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="font-poppins text-sm text-lw-gray-inactive {{ $type === 'stats' ? 'text-white/80' : '' }}">{{ $subtitle }}</p>
            @endif
        </div>
    @endif

    <div class="p-4">
        {{ $slot }}
    </div>
</div>