@props(['label' => 'Empty', 'name' => 'empty', 'value' => NULL])

@php
  $class = 'w-full bg-white/20 border-2 border-pink-600 rounded placeholder-white/60 focus:outline-none focus:ring-0 focus:border-fuchsia-700';
@endphp

@if ($label != 'Empty')
  <label for="{{ $name }}">{{ $label }}</label>
@endif

<input type="number" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge([ 'class' => $class, 'step' => '1', 'min' => '0' ]) }} /> 