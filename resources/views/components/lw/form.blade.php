{{-- Design System - Form Component (Tailwind CSS) --}}
@props([
    'method' => 'POST',
    'action' => '',
    'class' => '',
    'ajax' => false,
    'callback' => '',
    'showProcessing' => true,
    'secured' => true,
    'unsecuredFields' => '',
    'enctype' => null
])

@php
    $formClasses = 'font-lw';
    
    if ($ajax) {
        $formClasses .= ' lw-ajax-form';
    }
    
    $formClasses .= ' ' . $class;
@endphp

<form 
    method="{{ $method }}" 
    action="{{ $action }}"
    class="{{ $formClasses }}"
    @if($ajax && $callback) data-callback="{{ $callback }}" @endif
    @if($ajax && $showProcessing) data-show-processing="true" @endif
    @if($ajax && $secured) data-secured="true" @endif
    @if($ajax && $unsecuredFields) data-unsecured-fields="{{ $unsecuredFields }}" @endif
    @if($enctype) enctype="{{ $enctype }}" @endif
    {{ $attributes }}
>
    @if($method !== 'GET')
        @csrf
    @endif
    
    @if(in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
        @method($method)
    @endif
    
    {{ $slot }}
</form>

<style>
/* Form Processing States - Custom CSS needed for processing animations */
.lw-form-processing {
    pointer-events: none;
    opacity: 0.7;
}

.lw-form-processing button {
    cursor: not-allowed;
}

.lw-form-processing button::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: lw-spin 1s linear infinite;
}

@keyframes lw-spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}
</style>