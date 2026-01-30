@props(['label' => 'Empty', 'name' => 'empty', 'value' => 1])

@php
  $class = 'bg-white/20 shrink-0 mt-0.5 border-gray-200 rounded-sm text-pink-600 focus:ring-pink-500 checked:border-pink-500 disabled:opacity-50 disabled:pointer-events-none';
  $checked = old($name, $value) == 1;
@endphp

<div class="flex flex-row items-center gap-4">
  <input type="hidden" name="{{ $name }}" value="0">

  @if ($label !== 'Empty')
    <label for="{{ $name }}">{{ $label }}</label> 
  @endif

  <input type="checkbox" name="{{ $name }}" value="1" class="{{ $class }}" {{ $checked ? 'checked' : '' }} >
</div>