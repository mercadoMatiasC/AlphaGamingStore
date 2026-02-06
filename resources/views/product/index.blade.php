<x-layout title="Inicio">
    <div class="space-y-12">
        {{-- ADMIN --}}
        <x-admin-bar />
        
        {{-- SEARCH ENGINE --}}
        <x-search-engine :categories="$categories" />

        {{-- Productos --}}
        <section class="w-3/4 mx-auto flex flex-col space-y-6">
            @if ($category)
                <div class="flex flex-row justify-between items-center">
                    <x-section-header>
                        Categoría:  {{ $category->name }}
                    </x-section-header>
                </div>
            @endif

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                @if ($products->isNotEmpty())
                    @foreach($products as $product)
                        <x-product-card :product="$product"/>
                    @endforeach
                @else      {{-- NO RESULTS! --}}  
                    <div class="col-span-4 mb-20 mx-auto">        
                        <h1 class="text-2xl font-bold">¡Aún no hay productos con esa descripción!</h1>
                    </div>
                @endif
            </div>
            {{ $products->links(); }}
        </section>

        {{-- Categorías --}}
        <x-categories-display :categories="$categories" />
    </div>
</x-layout>