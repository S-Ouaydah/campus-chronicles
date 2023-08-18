<x-app-layout>
    <div class="bg-[#0c0c0d] pl-8">
        <div class="relative p-1/12 flex items-center">

            @livewire('update-user-profile-picture')

            <div class="text-white ml-20">
                <h2 class="text-4xl font-medium">{{ Auth::user()->name }}</h2>
                {{-- <h4 class="text-base font-medium opacity-50">leolorenzi#9087</h4> --}}

                @livewire('edit-bio')

            </div>
        </div>
    </div>


    <div class="mx-[3%] 2xl:mx-[5%] 3xl:mx-[8%] ">

        <div>
            <h2 class="text-xl font-semibold mt-20">Your Favorite Creators this month </h2>
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
            <h2 class="text-xl font-semibold mt-20">Subscriptions</h2>
            @if ($subscriptions->isEmpty())
                <div class="m-0 flex h-[200px] w-full items-center justify-center">

                    <h4 class="text-lg select-none">Seems like you haven't subscribed to any podcast yet! <a
                            class="font-medium" href="{{ route('explore') }}">Browse Podcasts</a> & enjoy educational
                        enlightenment.</h4>

                </div>
            @else
                <div class="flex items-center">
                    <div
                        class="h-[167px] w-[250px]   xl:h-[200px] xl:w-[300px] mr-4 bg-black rounded-xl bg-cover text-white   flex flex-col	 items-start justify-center shrink-0  mt-5 select-none	pl-10">
                        <h4 class="text-2xl xl:text-3xl font-bold">Your Subscrip-<br>tions List</h4>
                        <h4 class="text-lg xl:text-xl opacity-75">Contain {{ $subscriptions->count() }} Podcasts</h4>
                    </div>

                    <div class="swiper-container mt-5 overflow-x-hidden w-full	overflow-y-hidden">
                        <div class="swiper-wrapper">

                            @foreach ($subscriptions as $subscription)
                                <div class="swiper-slide w-auto mr-4">
                                    <a href="{{ route('podcast.show', $subscription->podcast->id) }}">
                                        <div class="relative m-0 h-[167px] w-[250px]   xl:h-[200px] xl:w-[300px]">


                                            <div
                                                class="h-[167px] w-[250px]   xl:h-[200px] xl:w-[300px] mr-4  rounded-xl bg-cover  px-6 py-6 absolute  bg-black">
                                                

                                                <p class="relative text-white opacity-70 h-full text-xs xl:text-sm ">
                                                    {{ $subscription->podcast->description }}
                                                </p>


                                            </div>
                                            <div class="h-[167px] w-[250px]   xl:h-[200px] xl:w-[300px] mr-4  rounded-xl bg-cover flex justify-end flex-col px-6 py-6 absolute hover:opacity-0 "
                                                style="background-image: url('{{ asset($subscription->podcast->image_url) }}');">

                                                <h2 class="relative text-white text-lg xl:text-xl  font-medium ">
                                                    {{ $subscription->podcast->title }}</h2>
                                                <p class="relative text-white text-sm xl:text-xl  opacity-80">
                                                    {{ $subscription->podcast->creator->name }}
                                                </p>


                                            </div>

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
            <div class="w-[58%]">
                {{-- <h2 class=" text-xl font-semibold">Likes</h2> --}}
                <livewire:likes-list :items="$items" :sortedEpisodes="$sortedEpisodes" />
            </div>
            <div class="w-[41%]">

                {{-- <h2 class=" text-xl font-semibold">History</h2> --}}
                <livewire:history-list  :sortedHistory="$sortedHistory" />
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
