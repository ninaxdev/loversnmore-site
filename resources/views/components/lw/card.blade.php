{{-- Design System - Card Component (Tailwind CSS) --}}
@props([
    'type' => 'default',
    'title' => null,
    'subtitle' => null,
    'class' => ''
])

@php
    $cardClasses = [
        'default' => 'bg-white border border-gray-200 rounded-xl shadow-lw',
        'glass' => 'bg-white/95 backdrop-blur-lw border border-white/20 rounded-xl shadow-lw',
        'profile' => 'bg-white border border-gray-200 rounded-xl shadow-lw overflow-hidden',
        'stats' => 'bg-gradient-lw text-white rounded-xl shadow-lw-gradient'
    ];
    
    $classes = ($cardClasses[$type] ?? $cardClasses['default']) . ' ' . $class;
@endphp

<div class="{{ $classes }}" {{ $attributes }}>
    @if($title || $subtitle)
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 {{ $type === 'stats' ? 'bg-white/10 border-white/10' : '' }}">
            @if($title)
                <h3 class="font-lw font-semibold text-xl text-lw-primary mb-2 {{ $type === 'stats' ? 'text-white' : '' }}">{{ $title }}</h3>
            @endif
            @if($subtitle)
                <p class="font-lw text-lw-secondary {{ $type === 'stats' ? 'text-white/80' : '' }}">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    
    <div class="p-6">
        {{ $slot }}
    </div>
</div>