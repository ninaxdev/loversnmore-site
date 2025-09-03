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

<div>
    <div class="relative w-full">
        <textarea 
            name="{{ $name }}"
            class="w-full min-h-32 bg-white border-2 border-lw-gradient-start rounded-lg p-4 font-lw font-medium text-base text-lw-primary placeholder-lw-secondary focus:border-lw-gradient-end focus:ring-4 focus:ring-pink-500/10 outline-none resize-y leading-relaxed transition-all disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:resize-none {{ $class }}" 
            placeholder="{{ $placeholder }}"
            rows="{{ $rows }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($maxlength) maxlength="{{ $maxlength }}" @endif
            @if($minlength) minlength="{{ $minlength }}" @endif
            {{ $attributes }}
        >{{ $value }}{{ $slot }}</textarea>
        
        @if($maxlength)
            <div class="absolute bottom-2 right-3 font-lw text-xs text-gray-400 font-medium bg-white/90 px-1.5 py-0.5 rounded">
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