{{-- Design System - Textarea Component (Tailwind CSS) --}}
@props([
    'name' => '',
    'placeholder' => '',
    'value' => '',
    'rows' => '4',
    'required' => false,
    'disabled' => false,
    'class' => '',
    'maxlength' => null,
    'minlength' => null
])

{{-- Loversnmore Design System - Textarea Component --}}
{{-- Border #9B8AAE, placeholder #C6B9D8, 8px radius --}}
<div>
    <div class="relative w-full">
        <textarea
            name="{{ $name }}"
            class="w-full min-h-32 bg-white border border-lw-gray-inactive rounded-sm p-4 font-poppins font-normal text-sm text-lw-text-primary placeholder-lw-placeholder focus:border-lw-primary focus:ring-2 focus:ring-lw-primary/20 outline-none resize-y leading-relaxed transition-all disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:resize-none {{ $class }}"
            placeholder="{{ $placeholder }}"
            rows="{{ $rows }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($maxlength) maxlength="{{ $maxlength }}" @endif
            @if($minlength) minlength="{{ $minlength }}" @endif
            {{ $attributes }}
        >{{ $value }}{{ $slot }}</textarea>

        @if($maxlength)
            <div class="absolute bottom-2 right-3 font-poppins text-xs text-lw-gray-inactive font-medium bg-white/90 px-1.5 py-0.5 rounded">
                <span class="lw-counter-current text-lw-primary">0</span>/<span class="lw-counter-max">{{ $maxlength }}</span>
            </div>
        @endif
    </div>
</div>

@if($maxlength)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('textarea[name="{{ $name }}"]');
    const counter = textarea?.parentElement.querySelector('.lw-counter-current');
    
    if (textarea && counter) {
        function updateCounter() {
            counter.textContent = textarea.value.length;
        }
        
        textarea.addEventListener('input', updateCounter);
        updateCounter(); // Initial count
    }
});
</script>
@endif