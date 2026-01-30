<header>
    <h2 class="text-lg font-medium">
        Desactivar Cuenta
    </h2>

    <p class="mt-1 text-sm">
        Una vez que su cuenta ha sido desactivada no podrá activarla nuevamente, tendrá que contactarnos para cualquier proceso o informacion relacionada a su cuenta.
    </p>
</header>

<div class="flex items-end justify-end mt-4">
    <x-forms.button class="w-full" colour="red" :anchor="false" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        Desactivar Cuenta
    </x-forms.button>                        
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable class="bg-transparent">
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-black">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium">
            ¿Está seguro que desea desactivar su cuenta?
        </h2>

        <p class="mt-1 text-sm">
            Una vez que su cuenta ha sido desactivada no podrá activarla nuevamente. Ingrese su contraseña para confirmar que desea desactivar su cuenta de forma permanente.
        </p>

        <div class="mt-6">
            <x-forms.input :label="__('Password')" name="password" type="password" required autocomplete="off" />
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" colour="white" x-on:click="$dispatch('close')" :anchor="true">
                    Cancelar
                </x-forms.button>   
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" colour="red" :anchor="false">
                    Desactivar Cuenta
                </x-forms.button>   
            </div>
        </div>
    </form>
</x-modal>
