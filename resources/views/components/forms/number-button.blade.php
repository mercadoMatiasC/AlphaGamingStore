@props(['id', 'counter'])

<button type="button" id="{{ $id }}" class="focus:outline-none text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium leading-5 rounded-s-base text-sm px-3 h-10">
    {{ $slot }}
</button>