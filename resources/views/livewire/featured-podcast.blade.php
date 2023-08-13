<div class="mt-5 p-14 bg-black overflow-hidden select-none h-[800px] rounded-3xl">
    <div class="flex gap-20 mt-5 items-start">
        <!-- Display featured podcast details -->
        <div class="flex flex-col w-[35%]">
        <a  href="{{ route('podcast.show', $featuredPodcast->id) }}">
            <img class="m-0 h-[425px] w-full bg-cover rounded-xl " src="{{ asset($featuredPodcast->image_url) }}"></a>
            <div class="text-white mt-8 p-2">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-medium text-xl"> <a
                                href="{{ route('podcast.show', $featuredPodcast->id) }}">{{ $featuredPodcast->title }}</a>
                        </h4>
                        <h4 class="font-medium text-xl"><span class="opacity-70">By</span>
                            {{ $featuredPodcast->creator->name }}</h4>
                    </div>
                    {{-- <button class="bg-[#C0EE9B] text-lg text-black px-4 py-2 rounded-xl">Subscribe</button> --}}
                    <livewire:subscribe-button :currentPage="'explore'" :podcastId="$featuredPodcast->id" />
                </div>

                <p class="mt-5 opacity-70 ">{{ $featuredPodcast->description }}</p>
            </div>
        </div>
        <div class="w-[65%]">
            @foreach ($featuredPodcastEps as $episode)
                <div class="w-full h-[80px]  flex  justify-between items-center text-white">
                    <div class="flex ">
                        <div class="relative w-[45px] h-[45px]"
                            wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}',0)">
                            <div
                                class="w-[45px] h-[45px]  rounded bg-cover absolute bg-[#C0EE9B] flex items-center justify-center ">
                                <i class="fa fa-play fa-stack-1x fa-inverse text-black leading-0 "></i>
                            </div>

                            <div class="w-[45px] h-[45px] bg-[#868686] rounded bg-cover absolute  hover:opacity-0"
                                style="background-image: url('{{ asset($episode->podcast->image_url) }}');">
                            </div>
                        </div>
                        <div class="pl-4  w-[150px]  2xl:w-[400px] 3xl:w-[400px]">
                            <h4 class="font-medium truncate">{{ $episode->title }}</h4>
                            <a href="{{ route('podcast.show', $episode->podcast->id) }}">
                                <p class="opacity-75 text-sm truncate">{{ $episode->podcast->title }}
                                </p>
                            </a>

                        </div>
                    </div>
                    <h4 class="text-sm opacity-75 w-[150px]text-start">{{ $episode->creator->name }}
                    </h4>
                    <h4 class="text-sm opacity-75 w-[150px] text-start">{{ $episode->getLikeDate() }}
                    </h4>
                    <h4 class="text-sm opacity-75 w-[50px] text-start">{{ $episode->getDuration() }}</h4>
                    <div class="flex gap-5 items-center">

                        <button wire:click="like({{ $episode->id }})" class="max-h-10 px-4 btn ">
                            @if ($episode->isLikedBy(auth()->user()))
                                <i class="fas fa-heart text-white"></i>
                            @else
                                <i class="far fa-heart text-white"></i>
                            @endif
                        </button>


                    </div>
                </div>
            @endforeach
        </div>




    </div>
</div>
