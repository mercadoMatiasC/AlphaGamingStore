<header class="w-full mb-4">
    <div class="w-full flex justify-between">
        <h2 class="text-lg font-medium">
            Direcciones de entrega
        </h2>

        <x-forms.button class="w-[25%]" :anchor="1" href="{{ route('address.create') }}">
            Añadir
        </x-forms.button>
    </div>

    <p class="mt-1 text-sm">
        Puedes agregar y revisar tus direcciones de entrega
    </p>
</header>

<div class="w-full space-y-4">
    @foreach ($addresses as $address)
        <x-shipping-address-card :address="$address" />
    @endforeach

    {{ $addresses->links() }}
</div>

