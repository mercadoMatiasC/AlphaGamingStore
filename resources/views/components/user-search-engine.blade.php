@props(['roles'])

<section class="w-4/5 lg:w-3/4 mx-auto justify-center items-center lg:flex-row space-y-6">
    <form action="/Usuarios" method="GET" class="w-full space-y-4 p-5 bg-white/20 grid grid-cols-1 lg:grid-cols-3 lg:space-y-0 lg:gap-4">
        <x-forms.select :value="request('role')" name="role" :nullable="true" :options="$roles" class="col-span-1 w-full" />   
        
        <div class="col-span-2 flex flex-row justify-between lg:gap-4">
            <x-forms.input :value="request('q')" name="q" placeholder="Buscar usuario..." class="w-1/2" /> 
            <div class="flex justify-end items-end">
                <x-forms.button class="w-full ml-5 lg:ml-0" :anchor="0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 flex items-center">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </x-forms.button>   
            </div>
        </div>
    </form>
</section>