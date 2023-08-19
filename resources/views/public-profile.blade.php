<x-app-layout>
    <div class="h-[800px] sm:h-[550px] lg:h-[600px] bg-[#0c0c0d]  sm:pl-[6%]">
        <div class="relative p-1/12 flex items-center flex-col justify-center sm:justify-start   sm:flex-row  pt-40 sm:pt-50">
            @if ($pfpPath)
                <div class=" bg-cover h-[150px] w-[150px] lg:h-[180px] lg:w-[180px] xl:h-[220px] xl:w-[220px] rounded-full"
                    style="background-image: url('{{ asset($pfpPath) }}');"></div>
            @else
                <div class=" bg-cover h-[220px] w-[220px] rounded-full"
                    style="background-image: url('{{ asset('storage/user_profiles/default.jpg') }}');"></div>
            @endif
            <div class="sm:ml-20 flex flex-col items-center sm:items-start gap-8 mt-10 sm:mt-0">
                <div class="flex flex-col gap-1 items-center sm:items-start ">
                    <div class="text-white ">
                        <h2 class="text-4xl font-medium"><?= $user->name ?></h2>
                    </div>
                    <span class="text-white opacity-70">{{$followerCount}} @if($followerCount <= 1) follower @else followers @endif</span>
                    <div class="flex items-start p-0 m-0 text-white">
                        <p class=" opacity-90 m-0 max-w-[400px] break-all">{!! nl2br(e($userBio)) !!}</p>
                    </div>
                </div>
                {{-- follow button --}} <div class="flex items-end">
                    @livewire('follow-button', ['creatorId' => $user->id])
                </div>
            </div>

        </div>
    </div>



    <div class="py-12 mx-[6%] ">
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 3xl:grid-cols-5  gap-5 sm:gap-10 w-full mt-10 select-none overflow-x-hidden">
            @if (!$podcasts->isEmpty())
                @foreach ($podcasts as $podcast)
                    <div class="w-full ">
                        <a href="{{ route('podcast.show', $podcast->id) }}" class="block w-full">
                            <div class="relative h-[275px]  bg-black rounded-xl overflow-hidden">
                                <div
                                    class="h-[275px] absolute inset-0 px-4 sm:px-6 py-4 sm:py-6 rounded-xl bg-opacity-70 bg-black">
                                    <p class="text-white text-xs sm:text-sm xl:text-base">{{ $podcast->description }}
                                    </p>
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
            @else
                <p>No podcasts found !</p>
            @endif
        </div>




    </div>
</x-app-layout>
