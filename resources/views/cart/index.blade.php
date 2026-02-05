<x-layout title="Carrito">
    <div class="space-y-12">        
         <div class="mx-auto w-full gap-3 p-5 lg:grid lg:grid-cols-3 xl:w-3/4">        
            <x-divider class="lg:hidden" />

            {{-- CART --}}
            <section class="lg:col-span-2">
                <x-section-header>
                    Carrito
                </x-section-header> 
                <div class="mt-6 flex flex-col gap-3">
                    @if (!empty($items))
                        @foreach($items as $item)
                            <x-cart-product-card :item="$item" />
                        @endforeach
                    @else      {{-- NO PRODUCTS! --}}  
                        <div class="col-span-4 mb-20 text-center">        
                            <h1 class="text-2xl font-bold">¡Aún no hay productos en tu carrito!</h1>
                        </div>
                    @endif
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
                        @if (!empty($items))
                        <div class="flex justify-between">
                            <p class="font-bold">
                                Subtotal
                            </p>
                            <p> 
                                ${{ number_format($prices['before_discount'], 0, '.', ',') }}
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <p class="font-bold">
                                Descuento
                            </p>
                            <p class="text-white/50"> 
                                - ${{ number_format($prices['discounted'], 0, '.', ',') }}
                            </p>
                        </div>
                        <div class="flex justify-start">
                            <p class="font-bold">
                                Costo de envío
                            </p>
                        </div>
                        <div class="flex justify-between">
                              <form class="w-1/2" method="POST" action="{{ route('cart.updatePreferredAddress') }}">
                                @csrf
                                @method('PATCH')
                                <select name="shipping_address_id" onchange="this.form.submit()" required class="w-full bg-white/20 border-2 border-pink-600 rounded placeholder-white/60 focus:outline-none focus:ring-0 focus:border-fuchsia-700 *:bg-pink-900 *:text-lg focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-700 sm:text-sm/6">
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}" {{ ($activeAddress === $address->id) ? 'selected' : '' }}>
                                            {{ $address->city.': '.$address->address_street.' '.$address->address_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <p> 
                                ${{ number_format($prices['shipment_cost']) }}
                            </p>
                        </div>

                        <x-divider/>
                        
                        <div class="flex justify-between">
                            <p class="font-bold">
                                Total final
                            </p>
                            <p class="font-bold"> 
                                ${{ number_format($prices['final'], 0, '.', ',') }}
                            </p>
                        </div>
    
                        <div>
                            <form class="flex justify-end" method="POST" action="{{ route('order.store') }}">
                                @csrf
                                <x-forms.button class="w-full" href="#" colour="purple" class="col-span-1">
                                    Pagar
                                </x-forms.button>
                            </form>
                        <div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-layout>