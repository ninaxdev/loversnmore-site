{{-- Design System - Checkbox Component (Tailwind CSS) --}}
@props([
    'name' => '',
    'label' => '',
    'value' => '1',
    'checked' => false,
    'required' => false,
    'disabled' => false,
    'class' => ''
])

@php
    $checkboxId = 'lwCheckbox_' . $name . '_' . uniqid();
@endphp

<div class="relative flex items-start gap-2 cursor-pointer mb-4 {{ $class }}">
    @if($name)
        <input type="hidden" name="{{ $name }}" value="0">
    @endif
    
    <input 
        type="checkbox" 
        id="{{ $checkboxId }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if($checked) checked @endif
        @if($required) required @endif
        @if($disabled) disabled @endif
        class="appearance-none w-5 h-5 border-2 border-gray-300 rounded-sm bg-white cursor-pointer relative transition-all mt-0.5 flex-shrink-0 hover:border-lw-gradient-start focus:outline-none focus:ring-4 focus:ring-pink-500/10 checked:bg-gradient-lw checked:border-lw-gradient-start disabled:opacity-60 disabled:cursor-not-allowed"
        {{ $attributes }}
    >
    
    @if($label)
        <label for="{{ $checkboxId }}" class="font-lw text-sm text-lw-secondary leading-relaxed cursor-pointer flex-1">
            {!! $label !!}
        </label>
    @endif
    
    @if($slot->isNotEmpty())
        <label for="{{ $checkboxId }}" class="font-lw text-sm text-lw-secondary leading-relaxed cursor-pointer flex-1">
            {{ $slot }}
        </label>
    @endif
</div>

<style>
/* Custom checkbox checkmark using CSS since Tailwind can't handle ::after */
.appearance-none:checked::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
}
</style>