<x-layout title="Orden">
    <div class="space-y-12">        
         <div class="mx-auto w-full gap-3 p-5 xl:w-3/4">        
            <x-divider class="lg:hidden" />

            {{-- ORDERITEMS --}}
            <section class="lg:col-span-2">
                <x-section-header>
                    Orden - #{{ $order->id }}
                </x-section-header> 
                <div class="mt-6 flex flex-col gap-3">
                    @foreach($items as $item)
                        <x-order-product-card :item="$item" />
                    @endforeach
                    {{ $items->links() }}
                </div>
            </section>

            <x-divider class="lg:hidden" />

            {{-- ORDER --}}
            <section class="col-span-1 mt-5">
                <div class="h-full flex flex-col bg-white/10 p-8 space-y-5 lg:w-full">
                    @can('cancel', $order)
                    <div class="flex justify-between">
                        <h1 class="text-xl">
                            Detalles de orden
                        </h1>                        
                        <form method="POST" action="{{ route('order.cancel', $order) }}" data-idempotent>
                            @csrf
                            <x-forms.button class="w-full" colour="red" onclick="return confirm('¿Esta seguro de que quiere cancelar esta orden?')">
                                Cancelar orden
                            </x-forms.button>
                        </form>
                    </div>
                    @else
                        <div class="flex justify-start">
                            <h1 class="text-xl">
                                Detalles de orden
                            </h1>       
                        </div>
                    @endcan

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

                        <div class="flex justify-between">
                            <p class="font-bold">
                                Estado:
                            </p>
                            <p class="font-semibold text-{{ $statuses[$order->status]['colour'] }}-600 text-xl">
                                {{ $statuses[$order->status]['status']  }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <x-divider class="lg:hidden" />

            {{-- TRACKING --}}
            <section class="col-span-3 mt-5">
                <div class="w-full flex flex-col bg-white/10 p-8 gap-3">
                    <div class="flex flex-col space-y-6 lg:flex-row lg:justify-between lg:items-center">
                        <x-section-header>
                            Seguimiento
                        </x-section-header>
                        @anyrole(['owner', 'admin'])
                        <div class="flex flex-col justify-end gap-2 items-center lg:flex-row">
                            <x-forms.button class="w-full whitespace-nowrap" colour="purple" x-data="" x-on:click.prevent="$dispatch('open-modal', 'set-tracking-url')">
                                Configurar Link de Seguimiento
                            </x-forms.button>
                            <x-forms.button class="w-full" colour="blue" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-order-status')">
                                Añadir estado
                            </x-forms.button>
                        </div>
                        @endanyrole
                    </div>

                    <x-divider />

                    @if ($order->shipping_tracking_url !== NULL)
                    <div class="flex flex-col gap-2 items-center lg:flex-row">
                        <p>
                            A partir de ahora podrás seguir tu envío desde acá:
                        </p>
                        <x-forms.button class="w-full lg:w-[20%]" colour="purple" target="_blank" :anchor="1" href="{{ $order->shipping_tracking_url }}">
                            Seguir
                        </x-forms.button>                   
                    </div>
                    @endif

                    <div class="flex flex-col gap-2">
                        @foreach($tracking_statuses as $status)
                            <x-tracking-status-card :status="$status" />
                        @endforeach
                    </div> 
                </div>
            </section>
        </div>
    </div>
</x-layout>

<x-modal name="set-tracking-url" focusable class="bg-transparent">
    <form method="POST" action="{{ route('order.setTrackingURL', $order) }}" class="p-6 bg-black" data-idempotent>
        @csrf
        @method('PATCH')

        <h2 class="text-lg font-medium">
            Ingrese una URL para que el usuario siga su envío
        </h2>

        <div class="mt-6">
            <x-forms.input name="shipping_tracking_url" :value="old('shipping_tracking_url', $order->shipping_tracking_url)" type="text" autocomplete="off" placeholder="https://tracking.com/000000XXXX..." />
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" colour="red" x-on:click="$dispatch('close')" :anchor="true">
                    Cancelar
                </x-forms.button>   
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" :anchor="false">
                    Confirmar
                </x-forms.button>   
            </div>
        </div>
    </form>
</x-modal>

<x-modal name="add-order-status" focusable class="bg-transparent">
    <form method="POST" action="{{ route('ordertrackingstatus.store', $order) }}" class="p-6 bg-black" data-idempotent>
        @csrf
        <h2 class="text-lg font-medium">
            Ingrese nuevo estado actual
        </h2>

        <div class="mt-6">
            <x-forms.input name="details" type="text" required autocomplete="off" placeholder="Orden confirmada..." />
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" colour="red" x-on:click="$dispatch('close')" :anchor="true">
                    Cancelar
                </x-forms.button>   
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-forms.button class="w-full" :anchor="false">
                    Confirmar
                </x-forms.button>   
            </div>
        </div>
    </form>
</x-modal>