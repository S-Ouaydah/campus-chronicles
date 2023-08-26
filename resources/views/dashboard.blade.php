<x-app-layout>
    <div class="h-[1000px] sm:h-[550px] lg:h-[600px] bg-[#0c0c0d]  pl-[6%]">
        <div class="relative  flex  items-center h-full">

            <div class="flex flex-col mt-10 sm:mt-0 lg:mt-5 w-full">
                <div class="text-white text-2xl w-full">Analytics Overview</div>
                <div class="flex flex-col sm:flex-row sm:flex-wrap gap-5 items-center select-none mt-5 w-full justify-center sm:justify-start ">
                    <x-stat-card class="bg-red-100"  text="Podcasts" sub="" :count="$countPods" />
                    <x-stat-card class="bg-blue-100"  text="Episodes" :sub="$totalEpisodesThisWeek .' uploded this week'" :count="$totalEpisodes" />
                    <x-stat-card class="bg-green-100"  text="Listens This Week" :sub="$percentageChange . ' % diff from the last week' " :count="$totalListensThisWeek" />
                    <x-stat-card class="bg-yellow-50"  text="Subscriptions" :sub="$totalSubscriptionsThisWeek . ' subscriptions this week' " :count="$totalSubscriptions" />
                    <x-stat-card class="bg-purple-100"  text="Total Likes" :sub="$totalLikesThisWeek . ' likes this week' " :count="$totalLikes" />
                    <x-stat-card class="bg-pink-100"  text="Total Followers" :sub="$totalFollowersThisWeek . ' followers this week' " :count="$totalFollowers" />
                </div>
            </div>

            <div class="text-black font-bold text-lg absolute  rounded-xl bg-[#C0EE9B] right-[25%] -bottom-14 sm:right-80">
                @include('episode.add')
            </div>

        </div>
    </div>

    <div class="py-12 mx-[6%] ">

        <div class="max-w-xl mt-20">
            @include('podcast.create')
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
