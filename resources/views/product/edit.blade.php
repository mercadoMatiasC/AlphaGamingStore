<x-layout title="Editar producto">
    {{-- TITLE --}}
    <div class="flex flex-col w-full p-3 mx-auto lg:px-0 lg:w-3/5">
        <x-section-header>
            Editar producto
        </x-section-header>    
    </div>

    <div class="grid grid-cols-1 justify-center mx-auto w-full h-full p-2 lg:w-3/5 xl:grid-cols-2">
        {{-- EDIT SECTION --}}
        <section class="border-pink-700 bg-white/10 p-8 space-y-2 w-full">
            <form action="/Producto/{{ $product->id }}/Actualizar" method="POST" class="grid grid-cols-1 gap-3" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <x-forms.select :value="old('product_type_id', $product->product_type_id)" label="Tipo de producto" name="product_type_id" :options="$types" required />
                <x-forms.select :value="old('product_category_id', $product->product_category_id)" label="Categoría" name="product_category_id" :options="$categories" required  />
                <x-forms.input :value="old('sku', $product->sku)" label="SKU" name="sku" placeholder="GPU-AMD-RX570##-GIG-RGB#" required />
                <x-forms.input :value="old('brand', $product->brand)" label="Marca" name="brand" placeholder="Corsair" required />
                <x-forms.input :value="old('name', $product->name)" label="Nombre" name="name" placeholder="Procesador i7-7700k Socket LGA-1151 ..." required />
                <x-forms.textarea :value="old('description', $product->description)" label="Descripción" name="description" placeholder="Tamaño memoria=8GB, Núcleos=6, ..." class="h-32" required />
                <x-forms.file label="Imágenes" name="image" fprompt="PNG, JPG o WEBP."/>
                <x-divider />
                <x-forms.number :value="old('price', $product->price)" step="0.01" label="Precio ($)" name="price" placeholder="146900" required />
                <x-forms.number :value="old('discount', $product->discount*100)" max="100" label="Descuento (%)" name="discount" placeholder="50" required />
                <x-forms.number :value="old('stock', $product->stock)" label="Stock (unidades)" name="stock" placeholder="15" required />
                <x-forms.checkbox :value="old('active', $product->active)" label="Activo" name="active" />
            
                <div class="flex flex-row justify-between gap-5">
                    <x-forms.button href="/Producto/{{ $product->id }}" colour="green" :anchor="1">
                        Volver
                    </x-forms.button>
                    <x-forms.button colour="purple" :anchor="0">
                        Actualizar
                    </x-forms.button>
                </div>
            </form>
            <x-errors-display />
        </section>

        <x-divider class="xl:hidden" />

        {{-- PREVIEW SECTION --}}
        <section class="border-pink-700 bg-white/10 p-8 space-y-2 w-full">
            <p>
                Vista previa
            </p>
            <div class="flex flex-col p-10">
                <img class="mx-auto" src="{{ asset('storage/'.$product->imagesRoute) }}" width="512" alt="{{ $product->sku }}" />
            </div>
            <x-tag-display>{{ old('sku', $product->sku) }} <br> ID: {{ $product->id }}</x-tag-display>
            <h1 class="text-xl">
                {{ old('name', $product->name) }}
            </h1>

            <div class="flex flex-row gap-2">
                <p class="text-2xl font-bold">
                    ${{ $product['fFinal'] }}
                </p>
                @if ($product->discount > 0)
                    <p class="text-white/50 line-through">
                        ${{ $product['fPrice'] }}   
                    </p>
                    <p class="text-green-500">
                        - ${{ $product['fDiscounted'] }}
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
            @endif
            <x-forms.toggle-enable class="w-full flex justify-center items-center" :product="$product" /> 
        </section>
    </div>
</x-layout>