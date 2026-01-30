<header class="w-full mb-4">
    <h2 class="text-lg font-medium">
        {{ __('Update Password') }}
    </h2>

    <p class="mt-1 text-sm">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
</header>

<form method="POST" action="{{ route('password.update') }}" class="w-full grid grid-cols-1 gap-3">
    @csrf
    @method('PUT')

    <x-forms.input :label="__('Current Password')" name="current_password" type="password" required autocomplete="off" />
    <x-forms.input :label="__('New Password')" name="password" type="password" required autocomplete="off" />
    <x-forms.input :label="__('Confirm Password')" name="password_confirmation" type="password" required autocomplete="off" />

    <div class="flex items-center gap-4">
        <div class="flex items-center justify-end mt-4">
            <x-forms.button class="w-full" :anchor="false">
                {{ __('Save') }}
            </x-forms.button>                        
        </div>

        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm" >
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
