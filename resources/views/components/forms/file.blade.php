@props(['label' => 'Empty', 'name' => 'empty', 'fprompt' => 'EMPTY PROMPT'])
@php
  $class = 'block w-full bg-white/20 border-2 border-pink-600 rounded shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:text-white file:bg-pink-600/50 file:border-0 file:me-4 file:py-3 file:px-4';
@endphp

@if ($label != 'Empty')
  <label for="{{ $name }}">{{ $label }}</label>
@endif

<input type="file" name="{{ $name }}" id="{{ $name }}" class="{{ $class }}">
<p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{ $fprompt }}</p>

