@php
    $style = "border-left: 2px solid white; height: 100%; margin: 0 10px;";
    $class = ''
@endphp

<div style="{{ $style }}" {{ $attributes(['class' => $class]) }}></div>