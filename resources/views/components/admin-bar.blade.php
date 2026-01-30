@anyrole(['owner', 'admin'])
    <div class="w-full grid grid-cols-1 justify-between mx-auto gap-4 items-center bg-black/50 p-6 md:w-3/4 lg:grid-cols-2">
        <p class="font-semibold text-{{ auth()->user()->role->colour() }}-600">
            {{ ucfirst(auth()->user()->role->name) }}: {{ auth()->user()->name }} 
        </p>
        <div class="flex justify-between gap-3">
            <x-forms.button :anchor="1" href="{{ route('product.create') }}">Registrar producto</x-forms.button>
            <x-forms.button :anchor="1" href="{{ route('profile.index') }}">Ver usuarios</x-forms.button>
        </div>
    </div>
@endanyrole