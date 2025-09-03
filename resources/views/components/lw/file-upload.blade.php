{{-- Design System - File Upload Component (Tailwind CSS) --}}
@props([
    'name' => '',
    'accept' => '',
    'multiple' => false,
    'maxSize' => null,
    'required' => false,
    'disabled' => false,
    'class' => '',
    'label' => 'Choose File',
    'dropText' => 'Drag and drop files here or click to browse',
    'preview' => true
])

@php
    $fileId = 'lwFile_' . $name . '_' . uniqid();
@endphp

<div class="mb-6 {{ $class }}">
    <div class="relative w-full min-h-40 bg-white border-2 border-dashed border-lw-gradient-start rounded-lg flex flex-col items-center justify-center cursor-pointer transition-all hover:border-lw-gradient-end hover:bg-pink-500/5 focus-within:border-lw-gradient-end focus-within:bg-pink-500/10 p-6 text-center {{ $disabled ? 'opacity-60 cursor-not-allowed bg-gray-50' : '' }}" 
         id="drop-area-{{ $fileId }}">
        
        <input 
            type="file" 
            id="{{ $fileId }}"
            name="{{ $name }}"
            @if($accept) accept="{{ $accept }}" @endif
            @if($multiple) multiple @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            class="absolute opacity-0 w-full h-full cursor-pointer z-10"
            {{ $attributes }}
        >
        
        <div class="pointer-events-none z-0">
            <div class="text-lw-secondary mb-4">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto">
                    <path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.89 22 5.99 22H18C19.1 22 20 21.1 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 2V8H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 13H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 9H9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="mb-6">
                <p class="font-lw font-medium text-base text-lw-primary mb-1">{{ $dropText }}</p>
                @if($maxSize)
                    <p class="font-lw text-sm text-lw-secondary">Maximum file size: {{ $maxSize }}</p>
                @endif
            </div>
        </div>
        
        <div class="pointer-events-none">
            <span class="inline-flex items-center justify-center bg-transparent text-lw-primary border-2 border-lw-primary rounded-full px-6 py-3 font-lw font-semibold text-base transition-all">{{ $label }}</span>
        </div>
    </div>
    
    @if($preview)
        <div class="mt-4 p-4 bg-gray-50 rounded-lg hidden" id="preview-{{ $fileId }}">
            <div class="file-list space-y-2"></div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('{{ $fileId }}');
    const dropArea = document.getElementById('drop-area-{{ $fileId }}');
    const preview = document.getElementById('preview-{{ $fileId }}');
    
    if (!fileInput || !dropArea) return;
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });
    
    // Handle dropped files
    dropArea.addEventListener('drop', handleDrop, false);
    
    // Handle file selection
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight() {
        dropArea.classList.add('border-lw-gradient-end', 'bg-pink-500/10', 'transform', 'scale-105');
    }
    
    function unhighlight() {
        dropArea.classList.remove('border-lw-gradient-end', 'bg-pink-500/10', 'transform', 'scale-105');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        handleFiles(files);
    }
    
    function handleFiles(files) {
        if (!preview) return;
        
        const fileList = preview.querySelector('.file-list');
        fileList.innerHTML = '';
        
        if (files.length > 0) {
            preview.classList.remove('hidden');
            
            Array.from(files).forEach(file => {
                const fileItem = createFileItem(file);
                fileList.appendChild(fileItem);
            });
        } else {
            preview.classList.add('hidden');
        }
    }
    
    function createFileItem(file) {
        const item = document.createElement('div');
        item.className = 'flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg';
        
        const fileSize = file.size > 1024 * 1024 
            ? (file.size / 1024 / 1024).toFixed(1) + ' MB'
            : (file.size / 1024).toFixed(1) + ' KB';
        
        item.innerHTML = `
            <div class="flex items-center gap-2">
                <span class="font-lw font-medium text-sm text-lw-primary">${file.name}</span>
                <span class="font-lw text-xs text-lw-secondary">${fileSize}</span>
            </div>
            <button type="button" class="text-red-500 hover:bg-red-50 p-1 rounded transition-all" onclick="this.parentElement.remove()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        `;
        
        return item;
    }
});
</script>