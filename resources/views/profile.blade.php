<x-app-layout>


    <div class="bg-black pl-8">
        <div class="relative p-1/12 flex items-center">

            @livewire('update-user-profile-picture')

            <div class="text-white ml-20">
                <h2 class="text-4xl font-medium">{{ Auth::user()->name }}</h2>
                {{-- <h4 class="text-base font-medium opacity-50">leolorenzi#9087</h4> --}}

                <p class="font-normal text-sm pt-4 opacity-90">{{ Auth::user()->bio }}</p>
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
        <div>
            <h2 class="text-xl font-semibold mt-20">Top Podcast this month </h2>
            <div class="pt-5 flex">

                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>
                <div class="h-[200px] w-[300px] mr-5 bg-[#D9D9D9] rounded-xl"></div>

            </div>
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
                                        <p class="opacity-75 text-sm">{{ $episode->getPodcastName() }}</p>
                                    </div>
                                </div>
                                <h4 class="text-sm opacity-75 w-[150px] text-start">{{ $episode->creator()->name }}
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
