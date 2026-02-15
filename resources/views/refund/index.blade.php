<x-layout title="Reembolsos">
    {{-- ADMIN --}}
    <x-admin-bar />

    <div class="space-y-12">        
         <div class="mx-auto w-full gap-3 p-5 xl:w-3/4">  
            <x-section-header>
                Reembolsos ID: ({{ 'Orden #'.$order->id }})
            </x-section-header>      

            <x-divider class="lg:hidden" />

            {{-- REFUNDS --}}
            <section class="lg:col-span-2">
                <div class="mt-6 flex flex-col gap-3">
                    @if ($refunds->isNotEmpty())
                        @foreach($refunds as $refund)
                        {{-- AS REFUND-CARD --}}
                        <div class="flex flex-row bg-black/40 items-center gap-5 rounded-lg p-5">
                            <div class="flex flex-col w-full space-y-3">
                                <div class="flex justify-between">
                                    <p class="font-semibold">
                                        Reembolso: #{{ $refund->id }} | {{ $refund->created_at }}
                                    </p>
                                    <div class="flex flex-row justify-between gap-1">
                                        <p>
                                            Monto: ${{ number_format($refund->amount, 0, '.', ',') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <p class="font-semibold">
                                        Pago: #{{ $refund->payment_id }}
                                    </p>
                                    <p class="text-{{ $payment_base_statuses[$refund->payment->status]['colour'] }}-600">
                                                {{ $payment_base_statuses[$refund->payment->status]['status'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        {{ $refunds->links() }}
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-layout>