<div >
    @foreach ($trendingEps as $episode)
        <div class="w-full h-[80px] my-2 flex  justify-between items-center">
            <div class="flex items-center">
                <div class="relative w-[45px] h-[45px]"
                    wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}',0)">
                    <div
                        class="w-[45px] h-[45px]  rounded bg-cover absolute bg-black flex items-center justify-center  ">
                        <i class="fa fa-play fa-stack-1x fa-inverse text-white pl-1"></i>
                    </div>

                    <div class="w-[45px] h-[45px] bg-[#868686] rounded bg-cover absolute  hover:opacity-0"
                        style="background-image: url('{{ asset($episode->podcast->image_url) }}');">
                    </div>
                </div>


                <div class="pl-4  w-[200px] ">
                    <h4 class="font-medium truncate">{{ $episode->title }}</h4>
                    <a href="{{ route('podcast.show', $episode->podcast->id) }}">
                        <p class="opacity-75 text-sm truncate">
                            {{ $episode->podcast->title }}
                        </p>
                    </a>

                </div>

            </div>
            <div class=" opacity-75"><Span class="text-base font-medium">{{ $episode->listen_count }} listening
                </Span><Span class=" text-base "></Span>
            </div>





        </div>
    @endforeach
</div>
