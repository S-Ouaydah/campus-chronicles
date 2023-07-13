<div class="mt-4 h-[800px] bg-[#D9D9D9] rounded-xl px-2 py-5">
    <div class="w-full h-full inner-likes overflow-y-auto scrollbar-right pt-4 px-8">

        @if ($episodes->all() === [])

            <div class="w-[98%] h-full flex justify-center items-center">
                <h4 class="text-xl opacity-80">It seems like you haven't liked any episodes yet!</h4>
            </div>
        @else
            @foreach ($sortedEpisodes as $episode)
                <div class="w-full h-[80px]  flex  justify-between items-center">
                    <div class="flex ">
                        <div class="relative w-[45px] h-[45px]" wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->episode_id}}, '{{ $episode->podcast->image_url }}')">
                            <div  
                                class="w-[45px] h-[45px]  rounded bg-cover absolute bg-black flex items-center justify-center ">
                                <i class="fa fa-play fa-stack-1x fa-inverse text-white leading-0 pl-1"></i>
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

                        <i wire:click="unlikeEpisode({{ $episode->episode_id }})"
                            class="max-h-10 px-4 btn  fas fa-heart text-black cursor-pointer"></i>


                    </div>
                </div>
            @endforeach

        @endif
    </div>
</div>
