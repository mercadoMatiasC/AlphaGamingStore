@props(['user', 'roles'])

<div class="flex flex-row bg-black/40 items-center gap-5 rounded-lg p-3">
    <img class="w-24 h-24 object-cover rounded-full lg:w-32 lg:h-32" src="{{ $user->profile_imageRoute ? asset('storage/'.$user->profile_imageRoute) : asset('images/avatar-placeholder.png') }}" alt="profile_picture" />
    <div class="flex flex-col w-full space-y-3">
        <div class="flex justify-between">
            <p class="font-semibold text-{{ $user->role->colour() }}-600">
                {{ ucfirst($user->role->name) }}: {{ $user->name }} 
            </p>
            <p class="font-semibold text-{{ ($user->account_status) ? 'green':'red' }}-600">
                {{ ($user->account_status) ? 'Activo':'Inactivo' }}
            </p>
        </div>
        <div class="flex justify-between">
            <p>
                Email: {{ $user->email; }} 
            </p>
        </div>
        <div class="flex flex-col space-y-6 lg:flex-row lg:space-y-0 lg:justify-between">
            <x-forms.button class="lg:w-[20%]" colour="blue" :anchor="1" href="/Ordenes/{{ $user->id }}" >
                Ordenes
            </x-forms.button>
            @role('owner')
                <form method="POST" action="{{ route('profile.roleswap', $user->id) }}" class="grid grid-cols-1 gap-3">
                    @csrf
                    @method('PATCH')
                    <x-forms.select :value="$user->role_id" name="role_id" :options="$roles" onchange="this.form.submit()" required />
                </form>
            @endrole
            {{-- KEEP THE QUERY --}}
            <input type="hidden" name="q" value="{{ request('q') }}">
        </div>
    </div>
</div>