{{-- Design System - Select Component (Tailwind CSS) --}}
@props([
    'name' => '',
    'placeholder' => 'Select an option',
    'options' => [],
    'value' => '',
    'required' => false,
    'disabled' => false,
    'class' => '',
    'multiple' => false
])

{{-- Loversnmore Design System - Select Component --}}
{{-- Border #9B8AAE, placeholder #C6B9D8, 8px radius --}}
<div>
    <div class="relative w-full">
        <select
            name="{{ $name }}"
            class="w-full h-12 bg-white border border-lw-gray-inactive rounded-sm px-4 pr-10 font-poppins font-normal text-sm text-lw-text-primary focus:border-lw-primary focus:ring-2 focus:ring-lw-primary/20 outline-none cursor-pointer transition-all disabled:opacity-60 disabled:cursor-not-allowed {{ $multiple ? 'h-auto min-h-32 py-2 appearance-none' : '' }} {{ $class }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($multiple) multiple @endif
            {{ $attributes }}
        >
            @if(!$multiple && $placeholder)
                <option value="" class="text-lw-placeholder">{{ $placeholder }}</option>
            @endif

            @if(is_array($options))
                @foreach($options as $optionValue => $optionLabel)
                    <option
                        value="{{ $optionValue }}"
                        @if($value == $optionValue) selected @endif
                        class="text-lw-text-primary bg-white py-2"
                    >
                        {{ $optionLabel }}
                    </option>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </select>

        @if(!$multiple)
            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-lw-gray-inactive pointer-events-none">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 10L12 15L17 10H7Z" fill="currentColor"/>
                </svg>
            </div>
        @endif
    </div>
</div>