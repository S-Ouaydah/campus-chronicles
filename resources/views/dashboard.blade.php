<x-app-layout>
    <div class="h-[1000px] sm:h-[550px] lg:h-[600px] bg-[#0c0c0d]  pl-[6%]">
        <div class="relative  flex  items-center h-full">

            <div class="flex flex-col mt-10 sm:mt-0 lg:mt-5 w-full">
                <div class="text-white text-xl w-full">Analytics Overview</div>
                <div class="flex flex-col sm:flex-row sm:flex-wrap gap-5 items-center select-none mt-5 w-full justify-center sm:justify-start ">

                    <div
                        class="w-[250px] h-[150px]  flex flex-col items-center justify-center bg-[#ffefe2] font-medium text-black  rounded-3xl text-3xl shadow-md">
                        {{ $countPods }}<span class="text-base ">Podcasts</span>
                    </div>
                    <div
                        class="w-[250px] h-[150px]  flex flex-col  items-center justify-center text-center bg-[#effcef] font-medium text-black  rounded-3xl text-3xl shadow-md">
                        {{ $totalListensThisWeek }}<span class="text-base ">Listens This Week</span>
                        <p class="text-sm opacity-70"><span class="">{{ $percentageChange }}%</span> diff from the
                            last week</p>
                    </div>


                    <div
                        class=" w-[250px] h-[150px] flex flex-col items-center justify-center bg-[#e6f5f9] font-medium text-black rounded-3xl text-2xl ">
                        {{ $totalSubscriptions }}
                        <span class="text-base ">Subscriptions</span><span class="text-sm opacity-70"> +
                            {{ $totalSubscriptionsThisWeek }} subscriptions this week</span>
                    </div>

                    <div
                        class=" w-[250px] h-[150px] flex flex-col items-center justify-center bg-[#f4f6fa] font-medium text-black rounded-3xl text-2xl ">
                        {{ $totalLikes }}
                        <span class="text-base ">Total Likes</span><span class="text-sm opacity-70"> +
                            {{ $totalLikesThisWeek }} likes this week</span>
                    </div>


                </div>
            </div>

            <div class="text-black font-bold text-lg absolute  rounded-xl bg-[#C0EE9B] right-[25%] -bottom-14 sm:right-80">
                @include('podcast.create')</div>

        </div>
    </div>

    <div class="py-12 mx-[6%] ">





        <div class="max-w-xl mt-20">
            @include('episode.add')
        </div>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 3xl:grid-cols-5  gap-5 sm:gap-10 w-full mt-10 select-none overflow-x-hidden">
            @foreach ($podcasts as $podcast)
                <div class="w-full ">
                    <a href="{{ route('podcast.show', $podcast->id) }}" class="block w-full">
                        <div class="relative h-[275px]  bg-black rounded-xl overflow-hidden">
                            <div
                                class="h-[275px] absolute inset-0 px-4 sm:px-6 py-4 sm:py-6 rounded-xl bg-opacity-70 bg-black">
                                <p class="text-white text-xs sm:text-sm xl:text-base">{{ $podcast->description }}</p>
                            </div>
                            <div class="h-[275px]  absolute inset-0 px-4 sm:px-6 py-4 sm:py-6 rounded-xl bg-cover bg-no-repeat bg-center transition-opacity duration-300 hover:opacity-0"
                                style="background-image: url('{{ asset($podcast->image_url) }}');">
                                <h2 class="text-white text-base sm:text-lg xl:text-xl font-medium">
                                    {{ $podcast->title }}
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>




    </div>
</x-app-layout>
