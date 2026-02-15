<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#000000"> 
        <title>Mercado Pago - Checkout</title>

        <link rel="icon" href="{{ asset('images/mercadopago/mpfavicon.png') }}" type="image/x-icon">
        <link href='fonts.googleapis.com' rel='stylesheet'>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-yellow-400 font-serif font-semibold min-h-screen flex flex-col justify-between items-center">
        <main class="mt-5 flex-1 w-4/5 justify-center mx-auto space-y-2 text-sm md:text-lg lg:w-1/4">
            <section class="bg-white/90 rounded-md p-6 space-y-6">
                <div class="flex flex-row justify-between">
                    <img src="{{ asset('images/mercadopago/mplogo.png') }}" width="128" alt="mp_logo" />
                    <div class="flex flex-row justify-between gap-2">
                        <img class="object-cover rounded-full" src="{{ $user->profile_imageRoute ? asset('storage/'.$user->profile_imageRoute) : asset('images/avatar-placeholder.png') }}" width="32" alt="profile_picture" />
                        <p>
                            {{ $user->name }}
                        </p>
                    </div>
                </div>
                <div class="flex mx-auto justify-center items-center gap-2">
                    <img src="{{ asset('images/brand/icon.png') }}" width="48" alt="app_logo" />
                    <p class="font">
                        AlphaGaming Store
                    </p>
                </div>

                <x-divider class="border-black/20" />

                <div class="flex flex-row justify-between text-md">
                    <p>
                        Producto
                    </p>
                    <p>
                        ${{ number_format($order->getTotalAndShipping(), 0, '.', ',') }}
                    </p>
                </div>
            </section>

             <section class="flex flex-col bg-gray-100/90 rounded-md p-6 space-y-6 text-sm md:text-lg">
                <div class="flex flex-row justify-between">
                    <p>
                        ¿Cómo quieres pagar?
                    </p>
                </div>
                <form method="POST" action="{{ route('payment.store', $order) }}" data-idempotent>
                    @csrf
                    <input name="payment_method" type="hidden" value="mercadopago" />
                    <input name="issued_amount" type="hidden" value="{{ $order->getTotalAndShipping() }}" />

                    <button class="flex flex-row justify-between bg-white/90 rounded-md p-4 items-center w-full" type="submit">
                        <div class="flex items-center justify-center">
                            <img class="object-cover rounded-full" src="{{ asset('images/mercadopago/mpblogo.png') }}" width="56" alt="mp_logo" />
                        </div>
                        <div class="flex flex-col justify-start items-start">
                            <p>
                                Disponible en Mercado Pago
                            </p>
                            <p class="text-black/40 font-medium">
                                Saldo: ${{ number_format($order->getTotalAndShipping(), 0, '.', ',') }}
                            </p>
                        </div>
                        <div class="flex items-center justify-center">
                            <img src="{{ asset('images/mercadopago/rchevron.png') }}" width="16" alt="r_chevron" />
                        </div>
                    </button>
                </form>
            </section>
        </main>
    </body>
</html>