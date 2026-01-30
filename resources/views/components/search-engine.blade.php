@props(['categories'])

{{-- SEARCH ENGINE --}}
<section class="w-4/5 lg:w-3/4 mx-auto justify-center items-center lg:flex-row space-y-6">
    <form action="/Productos" method="GET" class="w-full p-4 bg-white/20 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-3">
        <div class="grid grid-cols-3 items-center gap-3">
            <p class="col-span-1 flex justify-center items-center">
                En oferta
            </p>
            <x-forms.checkbox :value="request('ofertas')" name="ofertas" />
        </div>
        <div class="grid grid-cols-3 items-center gap-3">
            <p class="col-span-1 flex justify-center items-center">
                Precio ($)
            </p>
            <x-forms.number :value="request('min')" name="min" placeholder="mín" />
            <x-forms.number :value="request('max')" name="max" placeholder="máx" />
        </div>
        <div class="grid grid-cols-3 items-center gap-3">
            <p class="col-span-1 flex justify-center items-center" >
                Categoría
            </p>
            <div class="col-span-2">
                <x-forms.select :value="request('categoria')" name="categoria" iteration="slug" :nullable="true" :options="$categories" />   
            </div>
        </div>
        <div class="grid grid-cols-3 items-center gap-3 w-full">
            <div class="col-span-2">
                <x-forms.input :value="request('q')"  name="q" placeholder="Buscar productos..." /> 
            </div>
            <x-forms.button class="mx-auto flex items-center" :anchor="0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-auto flex items-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </x-forms.button>
        </div>       
    </form>
</section>