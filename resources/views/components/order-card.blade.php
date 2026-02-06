@props(['order', 'statuses'])

<div class="flex flex-row bg-black/40 items-center gap-5 rounded-lg p-5">
    <div class="flex flex-col w-full space-y-3">
        <div class="flex justify-between">
            <p class="font-semibold">
                Orden: #{{ $order->id }} | {{ $order->created_at }}
            </p>
            <div class="flex flex-row justify-between gap-1">
                <p>
                    Estado:
                </p>
                <p class="font-semibold text-{{ $statuses[$order->status]['colour'] }}-600">
                    {{ $statuses[$order->status]['status'] }}
                </p>
            </div>
        </div>
        <div class="flex justify-between">
            <p>
                Dirección: {{ $order->address_city.' - '.$order->address }}
            </p>
        </div>
        <div class="flex flex-row justify-between items-center">
            <p class="font-bold text-xl">
                Total: ${{ number_format($order->getTotalAndShipping(), 0, '.', ',') }}                
            </p>  
            <x-forms.button class="lg:w-[20%]" :anchor="1" href="/Orden/{{ $order->id }}">
                Ver orden
            </x-forms.button>
        </div>
    </div>
</div>