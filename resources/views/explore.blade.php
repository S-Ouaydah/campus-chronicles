<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot> --}}
    @auth
        <div class="mx-[5%]  3xl:mx-[10%] mt-10">
            <div class="w-full h-[550px] 3xl:h-[600px] flex justify-between select-none">
                <div class="w-[70%] mr-4 h-[550px] 3xl:h-[600px] flex flex-col justify-between">
                    {{-- <div class="bg-[#C0EE9B] h-[44%] mb-4 text-black rounded-3xl p-12 flex flex-col justify-evenly">
                        <h4 class=" text-3xl font-medium">Hey {{ Auth::user()->name }} !</h4>
                        <p class=" text-lg mt-2 ">
                            Welcome to your personalized, specially curated page, designed just for you. Explore and indulge
                            in a tailored selection of captivating content.</p>
                    </div> --}}
                    <div
                        class="h-[44%] w-full  bg-[#C0EE9B]  rounded-3xl  items-center justify-between inline-flex mr-4 p-12">
                        <div class="flex-col justify-center items-start gap-[5px] inline-flex ">
                            <div class=" flex flex-col ">
                                <div class=" text-black font-medium text-2xl xl:text-3xl 2xl:text-3xl tracking-wide">Get<span class="font-bold"> Experientializated</span></div>
                                <div class="font-medium text-xl xl:text-2xl 2xl:text-2xl mt-4  tracking-wide">on<span class="font-bold"> Campus Chronicles</span></div>
                            </div>
                        </div>
                        <div class="justify-center items-center gap-[5px] flex">
                            <div class="w-[419px] h-[237px] relative">
                                <img class="w-[419px] h-[237px] left-0 top-0 absolute"
                                    src="{{ asset('storage/banner/circle.png') }}" />
                                <img class="w-[105px] h-[148px] left-[140px] top-[23px] absolute"
                                    src="{{ asset('storage/banner/arrow.png') }}" />
                            </div>
                            <div class="w-[66px] justify-center items-end gap-2.5 flex">
                                <img class="w-[66px] mt-40 h-6" src="{{ asset('storage/banner/logo-black.png') }}" />
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

        @endauth

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                @if ($categories)
                    @include('partials.explore-categories')
                @else
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <h2 class="text-lg font-medium text-gray-900 p-4">
                            {{ __('There\'s no categories') }}
                        </h2>

                    </div>
                @endif
            </div>

        </div>
</x-app-layout>
