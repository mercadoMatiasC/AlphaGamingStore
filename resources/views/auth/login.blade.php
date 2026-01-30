<x-layout title="Login">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- TITLE --}}
    <div class="flex flex-col w-full p-3 mx-auto md:w-3/4 lg:px-0 lg:w-2/5">
        <x-section-header>
            Iniciar sesión
        </x-section-header>    
    </div>

    <div class="flex flex-col justify-center mx-auto mb-10 md:w-3/4 lg:w-2/5">
        <section class="border-pink-700 bg-white/10 p-8 w-full">
            <form action="{{ route('login') }}" method="POST" class="grid grid-cols-1 gap-4 space-y-2" enctype="multipart/form-data">
                @csrf
                <x-forms.input :value="old('email')" label="Email" type="email" name="email" required autofocus />
                <x-forms.input label="Contraseña" name="password" type="password" required />
            
                <div class="flex flex-row justify-between items-center">
                    <div class="mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <x-forms.checkbox id="remember_me" name="remember" />
                            <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-forms.button class="w-full" :anchor="false">
                            Iniciar sesión
                        </x-forms.button>                        
                    </div>
                </div>

                <div class="flex justify-end w-full">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm hover:text-white/20 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>
            <x-errors-display />
        </section>
    </div>
</x-layout>