@props(['product'])
<a href="/Producto/{{ $product->id }}">
    <div class="flex flex-col h-full bg-white/10 p-3 pt-5 transition duration-300 hover:-translate-y-1">
        <img class="mx-auto w-full max-w-[256px] h-auto" src="{{ asset('storage/'.$product->imagesRoute) }}" alt="{{ $product->name }}"/>

        <p class="text-center line-clamp-2 min-h-[3rem] mt-2">
            {{ $product->name }}
        </p>

        <div class="flex gap-2 justify-center mt-2">
            <p class="text-3xl font-bold">
                ${{ number_format($product->finalPrice(), 0, '.', ',') }}
            </p>

            @if ($product->discount > 0)
                <p class="text-white/50 line-through">
                    ${{ number_format($product->price, 0, '.', ',') }}
                </p>
            @endif
        </div>

        <div class="flex justify-center p-2 mt-auto">
            <x-forms.button :anchor="0">Agregar al Carrito</x-forms.button>
        </div>
    </div>
</a>
