@props(['icon', 'class' => ''])

@php
    $iconPath = public_path("assets/svg/icons/{$icon}.svg");
@endphp

@if(file_exists($iconPath))
    <span {{ $attributes->merge(['class' => 'icon ' . $class]) }} aria-hidden="true">
        {!! file_get_contents($iconPath) !!}
    </span>
@else
    <!-- Fallback: icon not found -->
    <span class="icon-missing" title="Missing icon: {{ $icon }}">
        <!-- Optional fallback text or SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="1em" height="1em" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="red" stroke-width="2" fill="none"/>
            <line x1="8" y1="8" x2="16" y2="16" stroke="red" stroke-width="2"/>
            <line x1="16" y1="8" x2="8" y2="16" stroke="red" stroke-width="2"/>
        </svg>
    </span>
@endif
