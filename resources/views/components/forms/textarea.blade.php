@props(['label' => 'Empty', 'name' => 'empty', 'value' => null])

@php
  $class = 'w-full bg-white/20 border-2 border-pink-600 rounded placeholder-white/60 placeholder-font-semibold focus:outline-none focus:ring-0 focus:border-fuchsia-700';
@endphp

@if ($label !== 'Empty')
  <label for="{{ $name }}">{{ $label }}</label>
@endif

<textarea name="{{ $name }}" {{ $attributes->merge(['class' => $class]) }}>{{ $value }}</textarea>