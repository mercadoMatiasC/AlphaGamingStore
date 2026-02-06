@props(['status'])

<div class="flex flex-col bg-black/50 space-y-3 p-3 lg:space-y-0 lg:flex-row lg:justify-between lg:items-center">
    <div class="flex flex-col gap-2 lg:flex-row"> 
        <p class="font-semibold text-yellow-400">
            {{ $status->created_at.':' }}
        </p>
        <p>
            {{ $status->details }}
        </p>
    </div>
    @anyrole(['owner', 'admin']) 
    <div class="w-full flex mb-3 justify-between lg:gap-2 lg:w-1/2 lg:justify-end">
        <x-forms.button class="w-[30%] lg:w-[20%]" colour="blue" x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-status-{{ $status->id }}')">
            Editar
        </x-forms.button>
        <form class="flex w-1/2 justify-end lg:w-1/4" action="{{ route('ordertrackingstatus.destroy', $status) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-forms.button colour="red" class="w-[30%]" class="ml-3" onclick="return confirm('Esta acción no se puede deshacer. ¿Estás seguro de que querés continuar?')">
                Borrar
            </x-forms.button>
        </form>
    </div>
    @endanyrole
</div>

<x-modal name="edit-status-{{ $status->id }}" focusable class="bg-transparent">
    <form method="POST" action="{{ route('ordertrackingstatus.update', $status) }}" class="p-6 bg-black">
        @csrf
        @method('PATCH')

        <h2 class="text-lg font-medium">
            Actualizar detalle de estado
        </h2>

        <div class="mt-6">
            <x-forms.input name="details" type="text" :value="old('details', $status->details)" required autocomplete="off" placeholder="Orden confirmada..." />
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" colour="red" x-on:click="$dispatch('close')" :anchor="true">
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