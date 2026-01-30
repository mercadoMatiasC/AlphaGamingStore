<x-layout title="Añadir dirección">
    <div class="flex flex-col w-full p-3 mx-auto lg:px-0 lg:w-1/2 gap-4">
        <x-section-header>
            Nueva dirección
        </x-section-header>    
        <p>
            Debes proporcionar al menos una dirección antes de poder comprar productos.
        </p>
    </div>

    <div class="flex flex-col justify-center mx-auto w-full h-full bg-white/10 p-8 space-y-2 lg:w-1/2">
        <form action="/Direccion" method="POST" class="grid grid-cols-1 gap-3">
            @csrf
            <x-forms.select :value="old('province_id')" label="Provincia" name="province_id" :options="$provinces" required />
            <x-forms.input :value="old('city')" label="Ciudad" name="city" required />
            <x-forms.input :value="old('postal_code')" label="Código postal" name="postal_code" required />
            <x-forms.input :value="old('address_street')" label="Calle" name="address_street" required />
            <x-forms.input :value="old('address_number')" label="Altura" name="address_number" required />
            <x-forms.textarea :value="old('information')" label="Detalle" maxlength="128" name="information" placeholder="Casa azul, Tocar timbre verde, casa en la esquina..." class="h-32" />
        
            <div class="flex flex-row justify-end">
                <x-forms.button class="w-full xl:w-2/5 mt-5" :anchor="0" onclick="return confirm('¿La información proporcionada es correcta?')">
                    Confirmar
                </x-forms.button>
            </div>
        </form>

        <x-errors-display />
    </div>
</x-layout>