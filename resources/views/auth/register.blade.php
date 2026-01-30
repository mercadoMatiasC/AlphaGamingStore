<x-layout title="Register">
    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- TITLE --}}
    <div class="flex flex-col w-full p-3 mx-auto md:w-3/4 lg:px-0 lg:w-2/5">
        <x-section-header>
            Registrarse
        </x-section-header>    
    </div>

    <div class="flex flex-col justify-center mx-auto mb-10 md:w-3/4 lg:w-2/5">
        <section class="bg-white/10 p-8 w-full">
            <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 gap-4 space-y-2" enctype="multipart/form-data">
                @csrf
                <x-forms.input :value="old('name')" label="Nombre" name="name" required />
                <x-forms.input :value="old('email')" label="Email" type="email" name="email" required />
                <x-forms.input label="Contraseña" name="password" type="password" required />
                <x-forms.input label="Confirmar contraseña" name="password_confirmation" type="password" required />
                
                <div class="flex flex-row justify-between items-center">
                    <div class="mt-4">
                        <a class="underline text-sm hover:text-white/20 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-forms.button class="w-full" :anchor="false">
                            Registrarse
                        </x-forms.button>                        
                    </div>
                </div>
            </form>
            <x-errors-display />
        </section>
    </div>
</x-layout>