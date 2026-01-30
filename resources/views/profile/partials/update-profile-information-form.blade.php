<header class="w-full mb-4">
    <h2 class="text-lg font-medium">
        {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</header>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="POST" action="{{ route('profile.update') }}" class="w-full grid grid-cols-1 gap-3" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="flex flex-row bg-black/40 items-center gap-5 rounded-lg p-5">
        <img class="w-24 h-24 object-cover rounded-full lg:w-32 lg:h-32" src="{{ $user->profile_imageRoute ? asset('storage/'.$user->profile_imageRoute) : asset('images/avatar-placeholder.png') }}" alt="profile_picture" />
        <div class="flex flex-col w-full space-y-3">
            <p class="font-semibold">
                {{ $user->name; }} 
            </p>
            <p>
                DNI: {{ $user->personal_id; }} 
            </p>
            <p>
                Email: {{ $user->email; }} 
            </p>
        </div>
    </div>

    <x-forms.input :value="old('name', $user->name)" label="Nombre" name="name" required />
    <x-forms.input :value="old('email', $user->email)" label="Correo electrónico" name="email" type="email" required />
    <x-forms.input :value="old('personal_id', $user->personal_id)" label="DNI" name="personal_id" required :disabled="($user->personal_IDSet() && !auth()->user()->hasAnyRole(['owner', 'admin']))" />
    <x-forms.file label="Imágen de perfil" name="image" fprompt="PNG, JPG o WEBP"/>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <div>
            <p class="text-sm mt-2">
                {{ __('Your email address is unverified.') }}

                <button form="send-verification" class="underline text-sm hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        </div>
    @endif

    <div class="flex items-center gap-4">
        <div class="flex items-center justify-end mt-4">
            <x-forms.button class="w-full" :anchor="false">
                {{ __('Save') }}
            </x-forms.button>                        
        </div>

        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 items-center">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>
<x-errors-display />
