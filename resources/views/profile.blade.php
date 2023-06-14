<x-app-layout>
    <div class="bg-black pl-8">
        <div class="relative p-1/12 flex items-center">

            @livewire('update-user-profile-picture')

            <div class="text-white ml-20">
                <h2 class="text-4xl font-medium">{{ Auth::user()->name }}</h2>
                {{-- <h4 class="text-base font-medium opacity-50">leolorenzi#9087</h4> --}}

                @livewire('edit-bio')

            </div>
        </div>
    </div>


    <div class="mx-[8%] ">

        <div>
            <h2 class="text-xl font-semibold mt-20">Top Podcaster this month </h2>
            <div class="pt-5 flex">

                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>

            </div>
        </div>
        {{-- <div>
            <h2 class="text-xl font-semibold mt-20">Subscribtions</h2>
            <div class="pt-5 flex">

                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>

            </div>
        </div> --}}

        <div>
            <h2 class="text-xl font-semibold mt-20">Subscriptions</h2>
            @if ($subscriptions->isEmpty())
                  <div
                        class="h-[200px] w-[300px] mr-4 bg-black rounded-xl bg-cover text-white   flex flex-col	 items-start justify-center shrink-0  mt-5 select-none	pl-10">
                        <h4 class="text-3xl font-bold">Your Subscriptions :</h4>
                        <h4 class="text-2xl opacity-75" >{{ $subscriptions->count() }} Podcast</h4>
                    </div>
            @else
                <div class="flex items-center">
                    <div
                        class="h-[200px] w-[300px] mr-4 bg-black rounded-xl bg-cover text-white   flex flex-col	 items-start justify-center shrink-0  mt-5 select-none	pl-10">
                        <h4 class="text-3xl font-bold">Podcasts You Subscribe :</h4>
                        <h4 class="text-2xl opacity-75" >{{ $subscriptions->count() }} Podcasts</h4>
                    </div>

                    <div class="swiper-container mt-5 overflow-x-hidden w-full	">
                        <div class="swiper-wrapper">
                         
                            @foreach ($subscriptions as $subscription)
                                <div class="swiper-slide w-auto mr-4">
                                    <a href="{{ route('podcast.show', $subscription->podcast->id) }}">
                                        <div class="h-[200px] w-[300px] mr-4 !hover:bg-[#D9D9D9] rounded-xl bg-cover"
                                            style="background-image: url('{{ asset($subscription->podcast->image_url) }}');">

                                            
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination  relative mt-10"></div>


            @endif
        </div>



        <div class="flex justify-between mt-20">
            <div class="w-1/2">
                <h2 class=" text-xl font-semibold">Likes</h2>
                <div class="mt-4 h-[800px] bg-[#D9D9D9] rounded-xl">



                    @if ($items === [])

                        <div class="w-full h-full flex justify-center items-center">
                            <h4 class="text-xl opacity-80">Seems Like You Don't Like Us!</h4>
                        </div>
                    @else
                        @foreach ($sortedEpisodes as $episode)
                            <div class="w-full h-[80px] pt-8 px-10 flex justify-between items-center">
                                <div class="flex ">
                                    <div class="w-[45px] h-[45px] bg-[#868686] rounded"></div>
                                    <div class="pl-4 w-[200px]">
                                        <h4 class="font-medium ">{{ $episode->title }}</h4>
                                        <p class="opacity-75 text-sm">{{ $episode->podcast->title }}</p>
                                    </div>
                                </div>
                                <h4 class="text-sm opacity-75 w-[150px] text-start">{{ $episode->creator->name }}
                                </h4>
                                <h4 class="text-sm opacity-75 w-[150px] text-start">{{ $episode->getLikeDate() }}</h4>
                                <div class="flex gap-10 items-center">
                                    <h4 class="text-sm opacity-75  text-start">duration</h4>
                                    <i class="text-xl fa-solid fa-heart"></i>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>





            <div class="w-[49%]">

                <h2 class=" text-xl font-semibold">History</h2>
                <div class="mt-4 h-[800px] bg-[#D9D9D9] rounded-xl">
                    <div class="w-full h-[80px] py-14 px-10 flex justify-between items-center">
                        <div class="flex">
                            <div class="w-[45px] h-[45px] bg-[#868686] rounded"></div>
                            <div class="pl-4 ">
                                <h4 class="font-medium">Lorem Ipsum</h4>
                                <p class="opacity-75 text-sm">Episode 5
                                </p>
                            </div>
                        </div>
                        <h4 class="text-sm opacity-75">Emma Grace</h4>
                        <h4 class="text-sm opacity-75">16/5/2023</h4>
                        <div class="flex gap-10 items-center">
                            <h4 class="text-sm opacity-75">21:15</h4><i class="text-xl fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>

            </div>



        </div>








        <div>
            <h2 class="text-xl font-semibold mt-20">Following </h2>
            <div class="pt-5 flex">


                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>
                <div
                    class="bg-[url('https://i.ibb.co/BtDyWFb/5770f01a32c3c53e90ecda61483ccb08.jpg')] bg-contain h-[150px] w-[150px] xl:h-[200px] xl:w-[200px] mr-5  bg-[#D9D9D9] rounded-full">
                </div>

            </div>
        </div>








    </div>
</x-app-layout>
