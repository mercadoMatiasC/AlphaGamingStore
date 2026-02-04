@props(['item'])

<div class="flex flex-row bg-black/40 items-center gap-5 rounded-lg p-5">
    <a href="/Producto/{{ $item['product']->id }}">
        <img class="mx-auto w-12 h-12 lg:w-[128px] lg:h-[128px]" src="{{ asset('storage/'.$item['product']->imagesRoute) }}" alt="{{ $item['product']->sku }}" />
    </a>
    <div class="flex flex-col w-full space-y-3">
        <div class="flex justify-between">
            <a href="/Producto/{{ $item['product']->id }}">
                <p class="font-semibold">
                    {{ $item['product']->name }} 
                </p>
            </a>
            <div class="flex flex-col gap-2">
                <p class="text-white/50">
                    (x{{ $item['quantity'] }}) ${{ number_format($item['finalPrice'], 0, '.', ','); }}
                </p>
                <p class="font-semibold text-2xl">
                    ${{ number_format(($item['quantity']*$item['finalPrice']), 0, '.', ',') }} 
                </p>
            </div>
        </div>
        <div class="flex flex-row justify-between items-center">
            <form class="flex flex-row gap-2" action="{{ route('cart.updateItemQuantity') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="relative flex items-center max-w-[9rem] shadow-xs rounded-base">
                    <x-forms.input name="quantity" type="number" id="quantity-input" data-input-counter value="{{ $item['quantity'] }}" min="0" max="{{ $item['product']->stock }}" class="border-none" required />
                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}" />
                </div>
                <x-forms.button class="mx-auto">
                    Actualizar
                </x-forms.button>
            </form>
            <form class="flex flex-row gap-2" action="{{ route('cart.removeCartItem') }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="product_id" value="{{ $item['product']->id }}" />
                <x-forms.button class="w-full" colour="red">
                    Quitar
                </x-forms.button>
            </form>
        </div>
    </div>
</div>