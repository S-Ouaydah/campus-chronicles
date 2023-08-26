<div class="mt-4 h-[800px] bg-[#D9D9D9] rounded-xl px-2 py-5">
    <div class="w-full h-full inner-likes overflow-y-auto scrollbar-right pt-4 px-8">


        @if ($historyTable->all() === [])


            <div class="w-[98%] h-full flex justify-center items-center">
                <h4 class="text-xl opacity-80">It seems like you haven't listened to any episodes yet!</h4>
            </div>
        @else
            @foreach ($sortedHistory as $hepisode)
                <div class="w-full h-[80px]  flex  justify-between items-center">
                    <div class="flex ">
                        <div class="relative w-[45px] h-[45px]"
                            wire:click="$emit('playAudio', '{{ $hepisode->episode->audio_path }}', {{ $hepisode->episode_id }}, '{{ $hepisode->episode->podcast->image_url }}',0)">
                            <div
                                class="w-[45px] h-[45px]  rounded bg-cover absolute bg-black flex items-center justify-center  ">
                                <i class="fa fa-play fa-stack-1x fa-inverse text-white pl-1"></i>
                            </div>

                            <div class="w-[45px] h-[45px] bg-[#868686] rounded bg-cover absolute  hover:opacity-0"
                                style="background-image: url('{{ asset($hepisode->episode->podcast->image_url) }}');">
                            </div>
                        </div>


                        <div class="pl-4  w-[200px] ">
                            <a href="{{ route('podcast.show', $hepisode->episode->podcast->id) }}">
                            <h4 class="font-medium truncate">{{ $hepisode->episode->title }}</h4>
                                <p class="opacity-75 text-sm truncate">
                                    {{ $hepisode->episode->podcast->title }}
                                </p>
                            </a>

                        </div>
                    </div>
                    <h4 class="text-sm opacity-75 w-[80px] text-start">
                        {{ $hepisode->getHistoryDate() }}</h4>

                    <h4 class="text-sm opacity-75 w-[70px] text-start">{{ $hepisode->getFormattedTimePlayed() }}
                    </h4>
                    <i wire:click="removeEpisodeH({{ $hepisode->id }})" class="fa-solid fa-xmark opacity-80 hover:opacity-100"></i>


                </div>
            @endforeach
        @endif
    </div>
</div>
