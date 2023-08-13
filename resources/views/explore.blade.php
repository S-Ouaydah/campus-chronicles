<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot> --}}

    <div class="mx-[5%]  3xl:mx-[10%] mt-10">
        @auth
            <div class="w-full h-[550px] 3xl:h-[600px] flex justify-between select-none">
                <div class="w-[70%] mr-4 h-[550px] 3xl:h-[600px] flex flex-col justify-between">

                    <div
                        class="h-[44%] w-full  bg-[#C0EE9B]  rounded-3xl  items-center justify-between inline-flex mb-4 mr-4 p-12">
                        <div class="flex-col justify-center items-start gap-[5px] inline-flex ">
                            <div class=" flex flex-col ">
                                <div class=" text-black font-medium text-2xl xl:text-3xl 2xl:text-3xl tracking-wide">Get<span
                                        class="font-bold"> Experientializated</span></div>
                                <div class="font-medium text-xl xl:text-2xl 2xl:text-2xl mt-4  tracking-wide">on<span
                                        class="font-bold"> Campus Chronicles</span></div>
                            </div>
                        </div>
                        <div class="justify-center items-center gap-[5px] flex">
                            <div class="w-[419px] h-[237px] relative">
                                <img class="w-[419px] h-[237px] left-0 top-0 absolute"
                                    src="{{ asset('storage/banner/circle.png') }}">
                                <img class="w-[105px] h-[148px] left-[140px] top-[23px] absolute"
                                    src="{{ asset('storage/banner/arrow.png') }}">
                            </div>
                            <div class="w-[66px] justify-center items-end gap-2.5 flex">
                                <img class="w-[66px] mt-40 h-6" src="{{ asset('storage/banner/logo-black.png') }}">
                            </div>
                        </div>
                    </div>
                    @livewire('new-episodes', ['lastNewEpisodes' => $lastNewEpisodes])

                </div>



                <div class="w-[30%] ml-4 h-full 3xl:h-[600px] bg-[#D9D9D9] rounded-3xl p-11">
                    <h4 class="text-black text-2xl font-medium">Trending This Week</h4>
                    @livewire('trending-this-week', ['trendingEps' => $trendingEps])

                </div>
            </div>

            @livewire('continue-listening')
            <div class="mt-10 select-none">
                <h1 class="mt-20 text-xl font-medium">Recommended For You</h1>
                <div class="swiper-container mt-5">
                    <div class="swiper-wrapper gap-10">
                        @foreach ($recommendedPodcasts as $podcast)
                            <div class="relative m-0 h-[167px] w-[250px] swiper-slide xl:h-[200px] xl:w-[300px] slide ">
                                <a href="{{ route('podcast.show', $podcast->id) }}">
                                    <div
                                        class="h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] rounded-xl bg-cover px-6 py-6 absolute bg-black">
                                        <p class="relative text-white opacity-70 h-full text-xs xl:text-sm">
                                            {{ $podcast->description }}
                                        </p>
                                    </div>
                                    <div class="h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] rounded-xl bg-cover flex justify-end flex-col px-6 py-6 absolute hover:opacity-0"
                                        style="background-image: url('{{ asset($podcast->image_url) }}');">
                                        <h2 class="relative text-white text-lg xl:text-xl font-medium">
                                            {{ $podcast->title }}
                                        </h2>
                                        <p class="relative text-white text-sm xl:text-xl opacity-80">
                                            {{ $podcast->creator->name }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        @endauth
    </div>

    <div class="mt-10 select-none">
        <h1 class=" text-xl font-medium">Featured Podcast</h1>
        @livewire('featured-podcast')
    </div>
    <div class="mt-10 overflow-hidden select-none">
        <h1 class="text-xl font-medium">Popular Podcasts</h1>
        <div class="swiper-container">
            <div class="swiper-wrapper flex gap-10 mt-5">
                @foreach ($popularPodcasts as $podcast)
                    <div class="swiper-slide relative m-0 h-[167px] w-[250px] xl:h-[200px] xl:w-[300px]">
                        <a href="{{ route('podcast.show', $podcast->id) }}">
                            <div
                                class="h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] rounded-xl bg-cover px-6 py-6 absolute bg-black">
                                <p class="relative text-white opacity-70 h-full text-xs xl:text-sm">
                                    {{ $podcast->description }}
                                </p>
                            </div>
                            <div class="h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] rounded-xl bg-cover flex justify-end flex-col px-6 py-6 absolute hover:opacity-0"
                                style="background-image: url('{{ asset($podcast->image_url) }}');">
                                <h2 class="relative text-white text-lg xl:text-xl font-medium">
                                    {{ $podcast->title }}
                                </h2>
                                <p class="relative text-white text-sm xl:text-xl opacity-80">
                                    {{ $podcast->creator->name }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>



    <div class="mt-20 w-full h-[250px]  bg-[#C0EE9B]  rounded-3xl flex  gap-20 select-none">
        <div class="ml-20 flex flex-col justify-end"><img class="h-[225px] " src="{{ asset('storage/da.png') }}">
        </div>
        <div class="text-2xl font-bold flex flex-col justify-center gap-5">
            <h4>Become a Creator and share your experience on Champus Chronicles now.</h4>
            @auth
                <p class=" text-xl font-medium">Switch your email to isae and start the grind!!</p>
                <div class="inline-block">
                    <a href="{{ route('settings.edit') }}"
                        class="bg-black text-white font-medium text-lg px-6 py-3 rounded-xl">Edit your Email</a>
                </div>
            @endauth
            @guest
                <p class="mt-4 text-xl font-medium">Sign up with your isae account and start the grind!!</p>
                <div class="inline-block">
                    <a href="{{ route('register') }}"
                        class="bg-black text-white font-medium text-lg px-6 py-3 rounded-xl">Register</a>
                </div>
            @endguest
        </div>


    </div>

    @livewire('categories-swiper')


</x-app-layout>
