{{-- Design System - Radio Button Component (Tailwind CSS) --}}
@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'checked' => false,
    'required' => false,
    'disabled' => false,
    'class' => ''
])

@php
    $radioId = 'lwRadio_' . $name . '_' . $value . '_' . uniqid();
@endphp

<div class="relative flex items-start gap-2 cursor-pointer mb-4 {{ $class }}">
    <input 
        type="radio" 
        id="{{ $radioId }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if($checked) checked @endif
        @if($required) required @endif
        @if($disabled) disabled @endif
        class="appearance-none w-5 h-5 border-2 border-gray-300 rounded-full bg-white cursor-pointer relative transition-all mt-0.5 flex-shrink-0 hover:border-lw-gradient-start focus:outline-none focus:ring-4 focus:ring-pink-500/10 checked:border-lw-gradient-start disabled:opacity-60 disabled:cursor-not-allowed"
        {{ $attributes }}
    >
    
    @if($label)
        <label for="{{ $radioId }}" class="font-lw text-sm text-lw-secondary leading-relaxed cursor-pointer flex-1">
            {{ $label }}
        </label>
    @endif
    
    @if($slot->isNotEmpty())
        <label for="{{ $radioId }}" class="font-lw text-sm text-lw-secondary leading-relaxed cursor-pointer flex-1">
            {{ $slot }}
        </label>
    @endif
</div>

<style>
/* Custom radio dot using CSS since Tailwind can't handle ::after */
.appearance-none:checked::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 8px;
    height: 8px;
    background: linear-gradient(135deg, #c53e8d, #8b5cf6);
    border-radius: 50%;
}
</style>