{{-- Design System - Form Field Component (Tailwind CSS) --}}
@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'error' => null,
    'help' => '',
    'class' => ''
])

@php
    $fieldId = 'lwField_' . $name . '_' . uniqid();
@endphp

<div class="mb-4 {{ $class }}">
    @if($label)
        <label for="{{ $fieldId }}" class="block font-lw font-semibold text-sm text-lw-primary mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500 ml-1">*</span>
            @endif
        </label>
    @endif
    
    <div class="relative">
        {{ $slot }}
    </div>
    
    @if($help && !$error)
        <div class="font-lw text-xs text-gray-500 mt-1 leading-relaxed">{{ $help }}</div>
    @endif
    
    @if($error)
        <div class="font-lw font-medium text-xs text-red-500 mt-1 leading-relaxed">{{ $error }}</div>
    @endif
</div>

<style>
/* Error state styling for nested inputs */
.mb-4:has(.text-red-500) input,
.mb-4:has(.text-red-500) select,
.mb-4:has(.text-red-500) textarea {
    border-color: #ef4444 !important;
}

.mb-4:has(.text-red-500) input:focus,
.mb-4:has(.text-red-500) select:focus,
.mb-4:has(.text-red-500) textarea:focus {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
}
</style>