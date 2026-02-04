<x-layout title="Orden">
    <div class="space-y-12">        
         <div class="mx-auto w-full gap-3 p-5 lg:grid lg:grid-cols-3 xl:w-3/4">        
            <x-divider class="lg:hidden" />

            {{-- ORDERITEMS --}}
            <section class="lg:col-span-2">
                <x-section-header>
                    Orden - {{ $order->id }}
                </x-section-header> 
                <div class="mt-6 flex flex-col gap-3">
                    @foreach($items as $item)
                        <x-order-product-card :item="$item" />
                    @endforeach
                </div>
            </section>

            <x-divider class="lg:hidden" />

            {{-- ORDER --}}
            <section class="col-span-1">
                <div class="h-full flex flex-col bg-white/10 p-8 space-y-5 lg:w-full">
                    <h1 class="text-xl">
                        Detalles de orden
                    </h1>

                    <x-divider/>

                    <div class="flex flex-col gap-2 text-lg space-y-2">
                        <div class="flex justify-between">
                            <p class="font-bold">
                                Subtotal
                            </p>
                            <p> 
                                ${{ number_format($order->getTotal(), 0, '.', ',') }}
                            </p>
                        </div>
                        <div class="flex justify-start">
                            <p class="font-bold">
                                Costo de envío
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <p> 
                                {{ $order->address_city.': '.$order->address }}
                            </p>
                            <p> 
                                ${{ number_format($order->shipping_cost) }}
                            </p>
                        </div>

                        <x-divider/>
                        
                        <div class="flex justify-between">
                            <p class="font-bold">
                                Total final
                            </p>
                            <p class="font-bold"> 
                                ${{ number_format($order->getTotalAndShipping(), 0, '.', ',') }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-layout>