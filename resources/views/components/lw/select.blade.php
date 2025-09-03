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

<div>
    <div class="relative w-full">
        <select 
            name="{{ $name }}"
            class="w-full h-12 bg-white border-2 border-lw-gradient-start rounded-full px-5 pr-12 font-lw font-medium text-base text-lw-primary focus:border-lw-gradient-end focus:ring-4 focus:ring-pink-500/10 outline-none cursor-pointer transition-all disabled:opacity-60 disabled:cursor-not-allowed {{ $multiple ? 'h-auto min-h-32 rounded-lg py-2 appearance-none' : '' }} {{ $class }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($multiple) multiple @endif
            {{ $attributes }}
        >
            @if(!$multiple && $placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            
            @if(is_array($options))
                @foreach($options as $optionValue => $optionLabel)
                    <option 
                        value="{{ $optionValue }}" 
                        @if($value == $optionValue) selected @endif
                        class="text-lw-primary bg-white py-2"
                    >
                        {{ $optionLabel }}
                    </option>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </select>
        
        @if(!$multiple)
            <div class="absolute right-5 top-1/2 transform -translate-y-1/2 text-lw-secondary pointer-events-none" style="display: none;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 10L12 15L17 10H7Z" fill="currentColor"/>
                </svg>
            </div>
        @endif
    </div>
</div>