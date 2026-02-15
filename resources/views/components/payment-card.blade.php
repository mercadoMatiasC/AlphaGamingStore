@props(['payment', 'payment_base_statuses'])

<div class="flex flex-col bg-white rounded-md p-3 w-full">
    <div class="flex justify-between text-black/60 font-bold">
        <p>
            Pago #{{ $payment->id }}
        </p>
        <p class="text-{{ $payment_base_statuses[$payment->status]['colour'] }}-600">
            {{ $payment_base_statuses[$payment->status]['status'] }}
        </p>
    </div>
    <p class="text-black">
        Fecha: {{ $payment->created_at }}
    </p>
    <div class="flex justify-between items-center">
        <p class="text-black w-full">
            Monto: ${{ number_format($payment->amount, 0, '.', ',') }}
        </p>
        @anyrole(['owner', 'admin']) 
            @if ($payment->canChangeStatus())
            <form method="POST" action="{{ route('payment.changeStatus', $payment) }}" class="flex flex-row w-full justify-end gap-3">
                @csrf
                <x-forms.select class="text-black w-full" :value="$payment->status" name="status_id" :options="$paymentStatuses" required />
                <x-forms.button class="w-[50%]" type="submit">
                    Confirmar
                </x-forms.button>
            </form>
            @endif
        @endanyrole
    </div>
</div>