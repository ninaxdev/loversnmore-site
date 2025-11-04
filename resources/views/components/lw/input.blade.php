{{-- Design System - Input Component (Tailwind CSS) --}}
@props([
    'type' => 'text',
    'placeholder' => '',
    'name' => '',
    'value' => '',
    'icon' => null,
    'required' => false,
    'class' => ''
])

<div>
    @if($icon)
        <div class="relative">
            <span class="absolute left-5 top-1/2 transform -translate-y-1/2 text-lw-secondary font-semibold z-10 text-lg">
                @if(str_starts_with($icon, 'fa'))
                    <i class="{{ $icon }}"></i>
                @else
                    {!! $icon !!}
                @endif
            </span>
            <input 
                type="{{ $type }}" 
                name="{{ $name }}"
                class="w-full h-12 bg-white border-2 border-lw-gradient-start rounded-full pl-12 pr-5 font-lw font-medium text-base text-lw-primary placeholder-lw-secondary focus:border-lw-gradient-end focus:ring-4 focus:ring-pink-500/10 outline-none transition-all {{ $class }}" 
                placeholder="{{ $placeholder }}"
                value="{{ $value }}"
                @if($required) required @endif
                {{ $attributes }}
            >
        </div>
    @else
        <div class="relative">
            <input 
                type="{{ $type }}" 
                name="{{ $name }}"
                class="w-full h-12 bg-white border-2 border-lw-gradient-start rounded-full px-5 font-lw font-medium text-base text-lw-primary placeholder-lw-secondary focus:border-lw-gradient-end focus:ring-4 focus:ring-pink-500/10 outline-none transition-all {{ $class }}" 
                placeholder="{{ $placeholder }}"
                value="{{ $value }}"
                @if($required) required @endif
                {{ $attributes }}
            >
        </div>
    @endif
</div>