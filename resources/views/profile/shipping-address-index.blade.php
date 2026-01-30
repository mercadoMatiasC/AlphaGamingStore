<x-layout title="Domicilios">
    <div class="space-y-12">
        {{-- ADMIN --}}
        <x-admin-bar />
        
        {{-- SEARCH ENGINE --}}
        <x-user-search-engine :roles="$roles" />
        
        {{-- USERS --}}
        <section class="w-full mx-auto flex flex-col space-y-6 lg:w-3/4">
            <div class="flex flex-row justify-between items-center">
                <x-section-header>
                    Domicilios de entrega
                </x-section-header>
            </div>
            
            <div class="mt-6 flex flex-col gap-3">
                {{-- DOMICILIOS --}}
                @foreach($users as $user) 
                    <x-user-card :user="$user" :roles="$roles" />
                @endforeach
            </div>

            {{ $users->links(); }}
        </section>
    </div>
</x-layout>