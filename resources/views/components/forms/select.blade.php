@props(['label' => 'Empty', 'name' => 'empty', 'options' => [], 'value' => NULL, 'iteration' => 'id', 'nullable' => false])

@php
    $class = 'w-full bg-white/20 border-2 border-pink-600 rounded placeholder-white/60 focus:outline-none focus:ring-0 focus:border-fuchsia-700 *:bg-pink-900 *:text-lg focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-700 sm:text-sm/6';
@endphp

<div class="grid grid-cols-1 gap-4">
    @if ($label != 'Empty')
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <select id="{{ $name }}" name="{{ $name }}" {{ $attributes(['class' => $class]) }}>
        <option value="" {{ (!$nullable) ? 'disabled' :''}} {{ is_null($value) ? 'selected' : '' }}>
            ---
        </option>

        @foreach ($options as $option)
            @php
                $field = match ($iteration) {
                    'id' => $option['id'],
                    'slug' => $option->slug,
                    default => $option,
                };
            @endphp

            <option value="{{ $field }}" {{ ($field === $value) ? 'selected' : '' }}>
                {{ ucfirst($iteration === 'self' ? $option : $option['name']) }}
            </option>
        @endforeach
    </select>
</div>
