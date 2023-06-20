<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Campus Chronicles</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> --}}
    <link href="https://fonts.cdnfonts.com/css/made-tommy-soft-outline" rel="stylesheet">
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        html {
            font-family: 'MADE Tommy Soft', sans-serif !important;
        }
    </style>




    <!-- Styles -->

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles


</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen  bg-center bg-trueGray-200  dark:trueGray-20  selection:text-white ">


        @if (Route::has('login'))

            <div
                class="flex items-center px-[2%] sm:gap-1 xl:gap-16 w-full sm:fixed sm:top-0 sm:left-0 pt-8 text-left font-medium text-sm xl:text-base leading-none">



                <a href="/"><img class="h-6" src="https://i.ibb.co/stTsyMP/logo-black.png"></a>
                <div class="nav2">

                    <a href="{{ route('explore') }}"
                        class="  text-black rounded-2xl  xl:px-6  py-2  xl:ml-5">Explore</a>
                        
                </div>


                <!-- <input
                    class="bg-gray-200 rounded-2xl px-5 xl:px-10 py-2.5 flex-auto focus:ring-0 outline-none border-none"
                    type="search" placeholder="search...."> -->
                @livewire('search-bar')
                <div class="nav4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="text-black hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="  text-white rounded-2xl bg-black px-6  py-2.5  ml-5">Log
                            in</a>


                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class=" bg-[#71C719] px-6  py-2.5 rounded-2xl ml-4 text-black hover:text-gray-900 dark:text-black  ">Register</a>
                        @endif
                    @endauth

                </div>

        @endif

    </div>

    <div class="landing flex gap-40 items-center justify-evenly w-full select-none">


        <div class='left'>
            <!-- New Episode -->
            <h3 class="font-medium"><span class="bg-black text-white py-1 px-2 mr-2">NEW</span> Knowledge Junction -
                Ep2.</h3>


            <div class="relative mt-7">
                <img
                    class="absolute right-[0%] h-[6rem]"src="https://i.ibb.co/hRHqgLy/3847936-arrow-arrow-wraps-bottom-bottom-line-nope-icon.png">
                <h1 class="text-5xl font-bold"><span class="tracking-widest">Educational</span><br>podcasts
                    that<br>inspire you to <span
                        class="underline decoration-8 underline-offset-auto  decoration-[#71C719]">grow</span></h1>
            </div>

            <p class="mt-3 font-medium"><span class="text-[#71C719]">Join</span> and <span
                    class="text-[#71C719]">Learn</span> from the most experienced<br>
                seniors in your educational field....</p>

            <button class="bg-black text-white font-medium mt-8 py-3 px-5 leading-none"><a
                    href="{{ route('explore') }}">Browse Podcasts<i
                        class="fa-solid fa-arrow-right  ml-5 mr-3 text-[#71C719] leading-none"></i></a></button>

            <div class="mt-5 flex">

                <div class="mr-20 flex relative">

                    <div class="w-[3.5rem] h-[3.5rem] bg-gray-200 rounded-[50%] border-4 border-[#fdfdfd]"></div>
                    <div
                        class="w-[3.5rem] h-[3.5rem] bg-gray-200 rounded-[50%] absolute left-[30px] border-4 border-[#fdfdfd]">
                    </div>
                    <div
                        class="w-[3.5rem] h-[3.5rem] bg-gray-200 rounded-[50%] absolute left-[60px] border-4 border-[#fdfdfd] ">
                    </div>

                </div>
                <div class=" font-medium ">50k+ Listeners<br>in Lebanon and the Middle East</div>

            </div>

        </div>
        <div class='right'>
            <img class="h-[30rem] xl:h-[35rem]"src="https://i.ibb.co/LPLmkPz/gd.png">
        </div>

    </div>
  </div>
</div>
@livewireScripts
</body>

</html>
