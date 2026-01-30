<x-layout title="Recuperar Contraseña">
    {{-- SESSION STATUS --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- TITLE --}}
    <div class="flex flex-col w-full p-3 mx-auto md:w-3/4 lg:px-0 lg:w-2/5">
        <x-section-header>
            Recuperar Cuenta
        </x-section-header>    
    </div>

    <div class="flex flex-col justify-center mx-auto mb-10 md:w-3/4 lg:w-2/5">
        <section class="border-pink-700 bg-white/10 p-8 w-full">
            <div class="mb-4 text-lg">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
            <form method="POST" action="{{ route('password.email') }}" class="grid grid-cols-1 gap-4 space-y-2" enctype="multipart/form-data">
                @csrf
                <x-forms.input :value="old('email')" label="Email" type="email" name="email" required autofocus />
            
                <div class="flex flex-row justify-end items-end">
                    <div class="flex items-center justify-end mt-4">
                        <x-forms.button class="w-full" :anchor="false">
                            Recuperar Cuenta
                        </x-forms.button>                        
                    </div>
                </div>

            </form>
            <x-errors-display />
        </section>
    </div>
</x-layout>