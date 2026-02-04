@props(['item'])


<div class="flex flex-row bg-black/40 items-center gap-5 rounded-lg p-5">
    <a href="/Producto/{{ $item->product_id }}">
        <img class="mx-auto w-12 h-12 lg:w-[128px] lg:h-[128px]" src="{{ asset('storage/'.$item->product->imagesRoute) }}" alt="{{ $item->product->sku }}" />
    </a>
    <div class="flex flex-col w-full space-y-3">
        <div class="flex justify-between">
            <a href="/Producto/{{ $item->product_id }}">
                <p class="font-semibold">
                    {{ $item->product->name }} 
                </p>
            </a>
            <div class="flex flex-col gap-2">
                <p class="text-white/50">
                    (x{{ $item->quantity }}) ${{ number_format($item->snapshot_price, 0, '.', ','); }}
                </p>
                <p class="font-semibold text-2xl">
                    ${{ number_format(($item->quantity*$item->snapshot_price), 0, '.', ',') }} 
                </p>
            </div>
        </div>
    </div>
</div>