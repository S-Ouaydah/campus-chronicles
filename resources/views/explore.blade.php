<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot> --}}
    @auth
        <div class="mx-[9%] 3xl:mx-[10%] mt-4">
            <div class="w-full h-[550px] 3xl:h-[600px] flex justify-between select-none">
                <div class="w-[70%] mr-4 h-[550px] 3xl:h-[600px] flex flex-col justify-between">
                    <div class=" h-[44%] mb-4 bg-black rounded-3xl p-12 flex flex-col justify-evenly">
                        <h4 class="text-white text-3xl font-medium">Welcome Back<br>{{ Auth::user()->name }}</h4>
                        <p class="text-white text-lg mt-2 ">
                            Welcome to your personalized, specially curated page, designed just for you. Explore and indulge
                            in a tailored selection of captivating content.</p>
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
