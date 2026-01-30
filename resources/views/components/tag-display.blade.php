@props(['class', 'style'])

@php
    $class = "bg-black/50 rounded-md px-3 font-semibold text-white/75 text-center";
    $style = "font-family: 'Space Mono', monospace;";
@endphp

<div {{ $attributes(['class' => $class, 'style' => $style]) }}>
    {{ $slot }}
</div>