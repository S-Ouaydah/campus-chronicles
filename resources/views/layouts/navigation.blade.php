<nav x-data="{ open: false }" class=" select-none ">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-[2%] mx-auto py-8 sm:px-6 lg:px-8 <?php if (
        Request()
            ->route()
            ->getName() == 'profile' ||
        Request()
            ->route()
            ->getName() == 'dashboard' ||
        Request()
            ->route()
            ->getName() == 'admindashboard' ||
        Request()
            ->route()
            ->getName() == 'profile.viewer'
    ) {
        echo 'absolute z-10';
    } ?>">
        <div class="flex justify-between gap-16 items-center mx-[2%] ">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex ">
                    @auth
                        @if (Request()->route()->getName() == 'profile' ||
                                Request()->route()->getName() == 'dashboard' ||
                                Request()->route()->getName() == 'admindashboard' ||
                                Request()->route()->getName() == 'profile.viewer')
                            <img class="h-6" src="{{asset('logo-white.png')}}">
                        @else
                            <img class="h-6" src="{{asset('logo-black.png')}}">
                        @endif
                    @endauth
                    @guest
                        <img class="h-6" src="{{asset('logo-black.png')}}">
                    @endguest
                </div>


            </div>
            <!-- Navigation Links -->
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


                <x-nav-link :href="route('explore')" :active="request()->routeIs('explore')">
                    {{ __('Explore') }}
                </x-nav-link>


            </div>


            @livewire('search-bar')



            @php
                use App\Models\User;
            @endphp




            @guest
                <div>
                    <a href="{{ route('login') }}"
                        class=" font-medium text-white rounded-2xl bg-black px-6  py-2.5  ml-5">Log
                        in</a>


                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class=" bg-[#71C719] px-6  py-2.5 font-medium  rounded-2xl ml-4 text-black hover:text-gray-900 dark:text-black  ">Register</a>
                    @endif
                </div>
            @endguest



            @auth

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6 h-[42px]">

                    <x-dropdown align="right" width="48">


                        @if (Request()->route()->getName() == 'profile' ||
                                Request()->route()->getName() == 'dashboard' ||
                                Request()->route()->getName() == 'admindashboard' ||
                                Request()->route()->getName() == 'profile.viewer')
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{-- <div class="bg-white h-8 w-8 rounded-full"> --}}
                                    <div {{-- TODO add profile pic to  XD --}} class="bg-cover h-8 w-8 rounded-full"
                                        style="background-image: url('{{ asset(Auth::user()->profile_pic()) }}');">
                                    </div>
                                    <div class="text-white pl-5">{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                        @else
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{-- <div class="bg-black h-8 w-8 rounded-full"> --}}
                                    @if (Auth::user()->pfp_path)
                                        <div class="bg-cover h-8 w-8 rounded-full"
                                            style="background-image: url('{{ asset(Auth::user()->pfp_path) }}');">
                                    @else
                                        <div class="bg-cover h-8 w-8 rounded-full"
                                            style="background-image: url('{{ asset('storage/user_profiles/default.jpg') }}');">
                                    @endif
                </div>
                <div class="text-black pl-5">{{ Auth::user()->name }}</div>

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4 text-balck" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
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

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
                </x-dropdown>


            </div>
        @endauth

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">


                    <x-dropdown-link :href="route('profile')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <x-responsive-nav-link :href="route('settings.edit')">
                        {{ __('Settings') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
