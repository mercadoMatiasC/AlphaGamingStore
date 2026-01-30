<x-layout title="Inicio">
    <div class="space-y-12">
        {{-- ADMIN --}}
        <x-admin-bar />

        {{-- Publicidad --}}
        <x-ad-card adTitle="main" href="/Productos" />

        {{-- Productos destacados --}}
        <section class="w-3/4 mx-auto flex flex-col space-y-6">
            <div class="flex flex-row justify-between items-center">
                <x-section-header>
                    ¡Productos destacados!
                </x-section-header>

                <x-a-text href="/Productos">Ver todos</x-a-text>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                @foreach($products as $product)
                    <x-product-card :product="$product"/>
                @endforeach
            </div>
        </section>

        {{-- Categorías --}}
        <x-categories-display :categories="$categories" />

        {{-- PCs armadas --}}
        <section class="w-3/4 mx-auto flex flex-col space-y-6">
            <div class="flex flex-row justify-between items-center">
                <x-section-header>
                    PCs armadas
                </x-section-header>

                <x-a-text href="/Productos?grupo=pcs">Ver todos</x-a-text>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                @foreach($builtPCs as $builtPC)
                    <x-product-card :product="$builtPC"/>
                @endforeach
            </div>
        </section>

        {{-- Arma tu PC --}}
        <x-ad-card href="/Productos" adTitle="armatupc" />
    </div>
</x-layout>