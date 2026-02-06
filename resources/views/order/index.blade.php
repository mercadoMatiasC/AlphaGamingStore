<x-layout title="Pedidos">
    {{-- ADMIN --}}
    <x-admin-bar />

    @if (session('message'))
        <script>
            alert("{{ session('message') }}");
        </script>
    @endif
    <div class="space-y-12">        
         <div class="mx-auto w-full gap-3 p-5 xl:w-3/4">  
            <x-section-header>
                Pedidos
                    @anyrole(['owner', 'admin']) 
                        ({{ 'ID: '.$user->id.' - '.$user->name }})
                    @endanyrole
            </x-section-header>      
            <x-divider class="lg:hidden" />

            {{-- ORDERS --}}
            <section class="lg:col-span-2">
                <div class="mt-6 flex flex-col gap-3">
                    @if ($orders->isNotEmpty())
                        @foreach($orders as $order)
                            <x-order-card :order="$order" :statuses="$statuses" />
                        @endforeach

                        {{ $orders->links() }}
                    @else      {{-- NO ORDERS! --}}  
                        <div class="col-span-4 mb-20 text-center">        
                            <h1 class="text-2xl font-bold">¡Aún no ha hecho ordenes de compra!</h1>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</x-layout>