<x-layout title="Pedidos">
    <div class="space-y-12">        
         <div class="mx-auto w-full gap-3 p-5 xl:w-3/4">  
            <x-section-header>
                Pedidos
            </x-section-header>      
            <x-divider class="lg:hidden" />

            {{-- ORDERS --}}
            <section class="lg:col-span-2">
                <div class="mt-6 flex flex-col gap-3">
                    @if ($orders->isNotEmpty())
                        @foreach($orders as $order)
                            <x-order-card :order="$order" />
                        @endforeach

                        {{ $orders->links() }}
                    @else      {{-- NO ORDERS! --}}  
                        <div class="col-span-4 mb-20 text-center">        
                            <h1 class="text-2xl font-bold">¡Aún no has hecho ordenes de compra!</h1>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-layout>