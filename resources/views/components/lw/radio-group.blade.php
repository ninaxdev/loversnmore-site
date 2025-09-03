{{-- Design System - Radio Group Component (Tailwind CSS) --}}
@props([
    'name' => '',
    'label' => '',
    'options' => [],
    'value' => '',
    'required' => false,
    'disabled' => false,
    'class' => '',
    'layout' => 'vertical' // vertical, horizontal, grid
])

<div class="mb-6 {{ $class }}">
    @if($label)
        <div class="font-lw font-semibold text-sm text-gray-700 mb-4">{{ $label }}</div>
    @endif
    
    <div class="
        @if($layout === 'horizontal') 
            flex flex-wrap gap-6
        @elseif($layout === 'grid') 
            grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4
        @else 
            space-y-2
        @endif
    ">
        @if(is_array($options))
            @foreach($options as $optionValue => $optionLabel)
                <x-lw.radio 
                    :name="$name"
                    :value="$optionValue"
                    :label="$optionLabel"
                    :checked="$value == $optionValue"
                    :required="$required && $loop->first"
                    :disabled="$disabled"
                    class="{{ $layout === 'horizontal' ? 'mb-0' : '' }}"
                />
            @endforeach
        @else
            {{ $slot }}
        @endif
    </div>
</div>