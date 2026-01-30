@props(['label' => 'Empty', 'name' => 'empty'])

@php
  $class = 'w-full bg-white/20 border-2 border-pink-600 rounded placeholder-white/60 focus:outline-none focus:ring-0 focus:border-fuchsia-700 disabled:bg-black/40 disabled:text-white/60';
@endphp

@if ($label != 'Empty')
  <label for="{{ $name }}">{{ $label }}</label>
@endif
<input name="{{ $name }}" {{ $attributes(['class' => $class, 'type' => 'text']) }} />
