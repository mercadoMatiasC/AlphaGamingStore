@php
    $class = 'text-white hover:text-pink-600 transition-all duration-300';
@endphp

<a {{ $attributes(['class' => $class, 'href' => '#']) }}>
    {{ $slot }}
</a>