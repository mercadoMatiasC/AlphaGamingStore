@props(['order'])

<div class="flex flex-row bg-black/40 items-center gap-5 rounded-lg p-5">
    <div class="flex flex-col w-full space-y-3">
        <div class="flex justify-between">
            <p class="font-semibold">
                Número de orden: {{ $order->id }} | {{ $order->created_at }}
            </p>
            <p>
                Estado: {{ $order->status }}
            </p>
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
            <form class="flex flex-row gap-2" action="{{ route('order.show', $order->id) }}" method="POST">
                @csrf
                <x-forms.button class="w-full">
                    Ver orden
                </x-forms.button>
            </form>
        </div>
    </div>
</div>