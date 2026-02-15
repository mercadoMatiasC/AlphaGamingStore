@props(['title' => 'Bienvenido', 'categories'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#000000"> 
    <title>Alpha Gaming - {{ $title }}</title>

    <style>
        html, body {
            background-color: #1A001A;
        }
    </style>

    <link rel="icon" href="{{ asset('images/brand/favicon.png') }}" type="image/x-icon">
    <link href='fonts.googleapis.com' rel='stylesheet'>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>

<body style="background-image: url('/images/background.jpg')" class="bg-cover text-white min-h-screen flex flex-col justify-between items-center">
    {{-- HEADER --}}
    <header style="background-image: url('/images/header.png')" class="gap-3 bg-cover bg-no-repeat w-full px-8 flex flex-col justify-between items-center lg:flex-row ">
        <div class="flex justify-center w-full lg:justify-start lg:items-start lg:w-1/4">
            <a href="/">
                <img src="/images/brand/logo.png" class="w-3/5 mx-auto mt-4 md:w-1/3 lg:w-3/4 lg:mx-0" alt="Alpha Gaming Store Logo" />
            </a>
        </div>

        <div class="flex w-full mx-auto justify-center items-center lg:w-1/2 p-2">
            <form action="/Productos" method="GET" class="w-full mx-auto">
                @csrf
                <x-forms.input name="q" class="bg-white" placeholder="Buscar productos..." />
            </form>
        </div>
        <x-nav-login class="hidden lg:flex" />
    </header>

    {{-- Nav Bar --}}
    <nav class="w-full bg-white/20 p-3">
        <div class="flex items-center justify-between xl:justify-center">
            <button id="menu-btn" class="font-bold lg:hidden text-3xl">☰</button>
            <x-nav-login class="lg:hidden" />
        </div>
        <ul id="menu" class="whitespace-nowrap w-full hidden flex-col gap-5 font-semibold mt-4 lg:w-3/4 lg:mx-auto lg:flex lg:flex-row lg:gap-5 lg:mt-0 lg:justify-center xl:w-3/5">
            <x-li><a href="/Productos?ofertas=1">Ofertas</a></x-li>
            <x-li><a href="/Productos?grupo=componentes">Componentes</a></x-li>
            <x-li><a href="/Productos?grupo=pcs">Computadoras</a></x-li>
            <x-li><a href="/Productos?builder=1">Armá tu PC</a></x-li>
            <x-li><a href="/Productos?categoria=notebooks">Notebooks</a></x-li>
            <x-li><a href="/Productos?categoria=gpu">Tarjetas de video</a></x-li>
            <x-li><a href="/Productos?categoria=cpu">Procesadores</a></x-li>
        </ul>
    </nav>

    {{-- Sección principal --}}
    <main class="mt-5 flex-1 w-full justify-center">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer />
</body>
</html>