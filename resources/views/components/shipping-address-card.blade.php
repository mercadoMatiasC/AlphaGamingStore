@props(['address'])

<div class="flex flex-row bg-black/40 rounded-lg p-3 w-full">
    <div class="flex flex-col w-full">
        <div class="flex justify-between items-center">
            <p class="font-semibold">
                {{ ucfirst($address->address_street).' '.$address->address_number }} 
            </p>
            
            <div class="w-1/2 flex mb-3 justify-between lg:w-1/4">
                <x-forms.button colour="blue" x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-address-{{ $address->id }}')">
                    Editar
                </x-forms.button>
                 <form {{ $attributes(['class' => 'w-full']) }} action="/Direccion/{{ $address->id }}/Estado" method="POST">
                    @csrf
                    @method('PATCH')
                    <x-forms.button colour="red" class="ml-3" onclick="return confirm('Esta acción no se puede deshacer. ¿Estás seguro de que querés continuar?')">
                        Borrar
                    </x-forms.button>
                </form>
            </div>
        </div>
        <div class="flex flex-col">
            <p>
                {{ $address->getProvinceName().' - '.$address->city.' ('.$address->postal_code .')' }} 
            </p>
            <p>
                Detalle: {{ $address->information }} 
            </p>
        </div>
    </div>
</div>

<x-modal name="edit-address-{{ $address->id }}" focusable class="bg-transparent">
    <form method="POST" action="/Direccion/{{ $address->id }}/Actualizar" class="p-6 bg-black">
        @csrf
        @method('PATCH')

        <h2 class="text-lg font-medium">
            Actualizar informacion de direccíon
        </h2>

        <p class="mt-1 text-sm">
            Solo podrá modificar el campo de detalles, si desea generar nueva información deberá crear una nueva dirección. (máx. 128 caracteres)
        </p>

        <div class="mt-6">
            <x-forms.textarea label="Detalle" name="new_information" maxlength="128" :value="old('new_information', $address->information)" required autocomplete="off" placeholder="Casa azul, Tocar timbre verde, casa en la esquina..." />
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" colour="red" x-on:click="$dispatch('close')" :anchor="1">
                    Cancelar
                </x-forms.button>   
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" :anchor="false">
                    Confirmar
                </x-forms.button>   
            </div>
        </div>
    </form>
</x-modal>
