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

{{-- Loversnmore Design System - Input Component --}}
{{-- Border #9B8AAE, placeholder #C6B9D8, 8px radius --}}
<div>
    @if($icon)
        <div class="relative">
            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-lw-gray-inactive z-10 text-lg">
                @if(str_starts_with($icon, 'fa'))
                    <i class="{{ $icon }}"></i>
                @else
                    {!! $icon !!}
                @endif
            </span>
            <input
                type="{{ $type }}"
                name="{{ $name }}"
                class="w-full h-12 bg-white border border-lw-gray-inactive rounded-sm pl-12 pr-4 font-poppins font-normal text-sm text-lw-text-primary placeholder-lw-placeholder focus:border-lw-primary focus:ring-2 focus:ring-lw-primary/20 outline-none transition-all {{ $class }}"
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
                class="w-full h-12 bg-white border border-lw-gray-inactive rounded-sm px-4 font-poppins font-normal text-sm text-lw-text-primary placeholder-lw-placeholder focus:border-lw-primary focus:ring-2 focus:ring-lw-primary/20 outline-none transition-all {{ $class }}"
                placeholder="{{ $placeholder }}"
                value="{{ $value }}"
                @if($required) required @endif
                {{ $attributes }}
            >
        </div>
    @endif
</div>