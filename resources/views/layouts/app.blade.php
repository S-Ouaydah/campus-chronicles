<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/made-tommy-soft-outline" rel="stylesheet">
    {{-- TODO check why default css in npm not taken, vite? --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            font-family: 'MADE Tommy Soft', sans-serif !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('ico.ico')}}">
<link rel="manifest" href="/site.webmanifest">

    <!-- Scripts -->

    @vite(['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class=" antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        {{-- <div class=" mt-20 bg-black mx-[5%]  3xl:mx-[10%]  h-[300px] rounded-t-3xl"></div> --}}
    </div>

    
    @livewire('player')
    @livewireScripts
    @stack('scripts')


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto',
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
    <style>
        .swiper-pagination-bullet-active {
            background-color: black;
            width: 16px;
            border-radius: 5px;
        }

        .scrollbar-right::-webkit-scrollbar {
            width: 6px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;

        }

    
        .scrollbar-right::-webkit-scrollbar-thumb {

            background-color: #888;
            border-radius: 4px;
        }

        .scrollbar-right::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }

        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</body>

</html>
