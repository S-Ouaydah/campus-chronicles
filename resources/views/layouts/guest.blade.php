<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center  sm:pt-6 bg-gray-100">
        {{-- <div>
            <a href="/">
                <img src="{{ asset('logo-black.png') }}">
            </a>
        </div> --}}

        <div class="flex flex-col w-full sm:flex-row sm:w-[90%] lg:w-[70%] xl:w-[55%] 3xl:w-[45%] sm:h-[700px] sm:mt-6 shadow-md rounded-none sm:rounded-3xl">
            <img class="w-full sm:w-[50%]  sm:rounded-s-3xl object-cover"
             src="{{ asset('auth-pic5.jpg') }}">
            <div class="w-full sm:w-[50%]  px-[8%] py-16 bg-white  overflow-hidden rounded-none sm:rounded-e-3xl flex flex-col justify-center ">
            
                {{ $slot }}
            </div>
        </div>


    </div>
    {{-- <div class="container w-[30%] ">
        <audio crossorigin playsinline>
            <source src="{{ asset('storage/Broken Elegance - I Need You.mp3') }}" type="audio/mp3">
        </audio>
    </div> --}}
</body>

</html>
