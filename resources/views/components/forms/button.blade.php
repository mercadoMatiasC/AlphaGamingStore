@props(['type', 'anchor' => 0, 'colour' => 'pink'])

@php
    $colours = [
        'pink' => 'border-pink-600 bg-pink-600 hover:bg-pink-900',
        'green' => 'border-green-600 bg-green-600 hover:bg-green-900',
        'red' => 'border-red-600 bg-red-600 hover:bg-red-900',
        'purple' => 'border-purple-600 bg-purple-600 hover:bg-purple-900',
        'blue' => 'border-blue-600 bg-blue-600 hover:bg-blue-900',
    ];

    $baseClass = 'p-2 rounded-xl text-center transition-colors duration-300 border-2 w-3/4 '.($colours[$colour] ?? $colours['pink']);
@endphp

@if ($anchor)
    <a {{ $attributes->merge(['href' => '#', 'class' => $baseClass]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $baseClass]) }}>
        {{ $slot }}
    </button>
@endif

