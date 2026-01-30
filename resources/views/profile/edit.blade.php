@php
    $class = "bg-white/10 p-8 w-full flex flex-col justify-center items-center";
@endphp

<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="flex flex-col justify-center mx-auto items-center mb-10 w-full md:w-3/4 lg:w-3/5 xl:w-2/5">
        <section class="{{ $class }}">
            @include('profile.partials.update-profile-information-form')
        </section>
        <x-divider />
        <section class="{{ $class }}">
            @include('profile.partials.add-shipping-address-form')
        </section>
        <x-divider />
        <section class="{{ $class }}">
            @include('profile.partials.update-password-form')
        </section>
        <x-divider />
        <section class="{{ $class }}">
            @include('profile.partials.delete-user-form')
        </section>
    </div>
</x-layout>
