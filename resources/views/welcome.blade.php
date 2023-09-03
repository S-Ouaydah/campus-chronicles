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
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('ico.ico')}}">
<link rel="manifest" href="/site.webmanifest">

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

<body class="antialiased mdx:h-screen">
    <div
        class="relative sm:flex flex-col sm:justify-start sm:items-center min-h-screen  bg-center bg-trueGray-200  dark:trueGray-20  selection:text-white h-full ">


        @if (Route::has('login'))

            <div
                class="flex items-center  px-[4%] sm:gap-1 xl:gap-16 w-full relative sm:top-0 sm:left-0 pt-8 text-left font-medium text-sm xl:text-base leading-none  ">



                <img class="h-4 mdx:h-6" src="{{ asset('logo-black.png') }}">
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">

                    @if (auth()->check() && auth()->user()->isAdmin)
                        <x-nav-link :href="route('admindashboard')" :active="request()->routeIs('admindashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                    @endif

                    @if (auth()->check() && auth()->user()->isISAE)
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('My Studio') }}
                        </x-nav-link>
                    @endif


                    <x-nav-link  :href="route('explore')" :active="request()->routeIs('explore')">
                        {{ __('Explore') }}
                    </x-nav-link>


                </div>



                @livewire('search-bar')
                <div class="nav4">
                    @auth

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6 h-[42px]">
                        <x-dropdown align="right" width="48">


                        @if (Request()->route()->getName() == 'profile' ||
                        Request()->route()->getName() == 'dashboard' || Request()->route()->getName() == 'admindashboard'
                        )
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{-- <div class="bg-white h-8 w-8 rounded-full"> --}}
                                <div {{-- TODO add profile pic to  XD --}} class="bg-cover h-8 w-8 rounded-full" style="background-image: url('{{ asset(Auth::user()->profile_pic()) }}');">
                                </div>
                                <div class="text-white pl-5">{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        @else
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                {{-- <div class="bg-black h-8 w-8 rounded-full"> --}}
                                <div class="bg-cover h-8 w-8 rounded-full" style="background-image: url('{{ asset(Auth::user()->pfp_path) }}');">
                                </div>
                                <div class="text-black pl-5">{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4 text-balck" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        @endif






                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('settings.edit')">
                                {{ __('Account Settings') }}
                            </x-dropdown-link>


                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>


                     


                        </div>
                    @else
                        <a href="{{ route('login') }}" class="  text-white rounded-2xl bg-black px-4  text-sm mdx:text-base mdx:px-6  py-2.5  ml-1 mdx:ml-5">Log
                            in</a>


                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class=" bg-[#71C719] px-4   text-sm  mdx:text-base  mdx:px-6  py-2.5 rounded-2xl ml-1 mdx:ml-5 text-black hover:text-gray-900 dark:text-black  ">Register</a>
                        @endif
                    @endauth

                </div>

        @endif

    </div>

    <div class="landing flex mdx:flex-row flex-col-reverse  mdx:gap-40 items-center justify-evenly  h-full w-full select-none">


        <div class='left py-28 mdx:py-0'>
            <!-- New Episode -->
            <h3 class="font-medium"><span class="bg-black text-white py-1 px-2 mr-2">NEW</span> Knowledge Junction -
                Ep2.</h3>


            <div class="relative mt-7">
                <img class="absolute right-[25%] sm:right-[0%]  h-[4rem] sm:h-[6rem]"
                    src="{{ asset('arrow-landing.png') }}">
                <h1 class="text-3xl sm:text-5xl font-bold"><span class="tracking-widest">Educational</span><br>podcasts
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
        <div class='right py-32 mdx:py-0'>
            <img class=" h-[20rem] sm:h-[25rem] md:h-[30rem] xl:h-[35rem]" src="{{ asset('landing-pic.png') }}">
        </div>

    </div>
    </div>
    </div>
    @livewireScripts
</body>

</html>
