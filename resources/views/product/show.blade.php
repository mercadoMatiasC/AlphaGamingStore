<x-layout title="Producto">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="$breadcrumbs" />

        <div class="lg:grid lg:grid-cols-3 gap-1">
        
            <x-divider class="lg:hidden" />

            {{-- Imagenes --}}
            <section class="lg:col-span-2">
                <div class="w-full h-full flex flex-col bg-white/10 p-10">
                    <img class="mx-auto" src="{{ asset('storage/'.$product->imagesRoute) }}" width="512" alt="{{ $product->sku }}" />
                </div>
            </section>

            <x-divider class="lg:hidden" />

            {{-- Opciones de compra --}}
            <section class="col-span-1">
                <div class="h-full flex flex-col bg-white/10 p-8 space-y-5 lg:w-full">
                    <x-tag-display>{{ $product->sku }} <br> ID: {{ $product->id }}</x-tag-display>
                    <h1 class="text-xl">
                        {{ $product->name }}
                    </h1>

                    <div class="flex flex-row gap-2">
                        <p class="text-2xl font-bold">
                            ${{ $product->fFinal }}
                        </p>
                        @if ($product->discount > 0)
                            <p class="text-white/50 line-through">
                                ${{ $product->fPrice }}   
                            </p>
                            <p class="text-green-500">
                                - ${{ $product->fDiscounted }}
                            </p>
                        @endif
                    </div>

                    @if (!$product->active)
                        <x-error-message>Este producto no está disponible.</x-error-message>
                    @elseif (!$product->stock)
                        <x-error-message>Este producto está temporalmente agotado.</x-error-message>
                    @else
                        <table class="table-auto w-full border-separate border-spacing-y-2">
                            @for($i=3; $i<=18; $i+=3)
                                <tr>
                                    <td class="{{ ($i % 2 == 0) ? 'bg-black/20' : '' }} px-2 py-1">
                                        {{ $i }} cuota/s fija/s de ${{ number_format(($product->finalPrice() / $i) * (1 + ($i * 0.05))) }}
                                    </td>
                                    <td class="{{ ($i % 2 == 0) ? 'bg-black/20' : '' }} px-2 py-1">${{ number_format($product->finalPrice()*(1 + ($i * 0.05))) }}</td>
                                </tr>
                            @endfor
                        </table> 
                        <p class="text-green-500">
                            {{ $product->stock }} unidad/es disponible/s.
                        </p>
                        <form class="flex flex-row h-1/2 gap-2" action="{{ route('cart.addCartItem') }}" method="POST">
                            @csrf
                            <div class="relative flex items-center max-w-[9rem] shadow-xs rounded-base">
                                <x-forms.number-button id="decrement-button" data-input-counter-decrement="quantity-input">-</x-forms.number-button>
                                <x-forms.input name="quantity" type="number" id="quantity-input" data-input-counter value="1" min="1" max="{{ $product['stock'] }}" class="border-none" required />
                                <x-forms.number-button id="increment-button" data-input-counter-increment="quantity-input">+</x-forms.number-button>
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            </div>
                            <x-forms.button class="mx-auto">
                                Agregar al Carrito
                            </x-forms.button>
                        </form>
                    @endif
                    
                    {{-- ADMIN --}}
                    @anyrole(['owner', 'admin'])
                        <div class="flex flex-row justify-between bg-black/50 p-6">
                            <x-forms.toggle-enable :product="$product" />
                        
                            <x-forms.button href="/Producto/{{ $product->id }}/Editar" colour="purple" class="col-span-1" :anchor="1">
                                Editar
                            </x-forms.button>
                        </div>
                    @endanyrole
                </div>
            </section>

            <x-divider class="lg:hidden" />

            {{-- Especificaciones --}}
            <section class="col-span-3">
                <div class="w-full flex flex-col bg-white/10 p-10">
                    <x-section-header>
                        Especificaciones
                    </x-section-header>
                    <x-divider />
                    <h1 class="text-lg px-2 py-1">
                        Marca: {{ $product->brand }}
                    </h1>
                    <table class="table-auto w-full border-separate border-spacing-y-2">
                        @foreach($product->normalizedDescription() as $description)
                            @php $eachDesc = explode('=', $description); @endphp

                            @if(count($eachDesc) === 2)
                                <tr>
                                    <td class="bg-black/20 px-2 py-1">{{ ucfirst($eachDesc[0]) }}</td>
                                    <td class="font-bold px-2 py-1">{{ ucfirst($eachDesc[1]) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table> 
                </div>
            </section>

            <x-divider class="lg:hidden" />

            {{-- Preguntas --}}
            <section class="col-span-3">
                <div class="w-full flex flex-col bg-white/10 p-5">
                    <x-section-header>
                        Preguntas sobre el producto
                    </x-section-header>
                    <x-divider />
                    @role('customer')
                        <form action="/Preguntar/{{ $product->id }}/" method="POST" data-idempotent>
                            @csrf
                            <x-forms.textarea placeholder="Preguntanos lo que quieras sobre el producto..." name="question" class="h-32" required></x-forms.textarea>
                            <div class="w-full flex items-end justify-end mt-4">
                                <x-forms.button class="w-2/5 lg:w-1/4" :anchor="false">
                                    Preguntar
                                </x-forms.button>                        
                            </div>
                        </form>
                        <x-errors-display />
                    @endrole
                    <section class="flex flex-col border-separate border-spacing-y-2 mt-5">
                        @if ($product->questions->isNotEmpty())
                            @foreach ($product->questions as $question)
                                <x-question-card :question="$question" />
                            @endforeach
                        @else
                            <h1 class="text-xl font-bold">Aún no hay preguntas relacionadas a este producto. ¡Sé el primero!</h1>
                        @endif
                    </section>
                </div>
            </section>
        </div>
    </div>
</x-layout>