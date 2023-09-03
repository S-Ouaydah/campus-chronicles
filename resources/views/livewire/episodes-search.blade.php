<div class="h-[460px] overflow-y-auto scrollbar-right">
        @foreach ($episodes as $episode)
            <li class=" flex flex-row m-6 justify-between items-center ">
                <div class="flex ">
                    <div class="relative w-[45px] h-[45px]"
                        wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}',0)">
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
                <a href="{{route('profile.viewer', $episode->creator->id)}}">
                <h4 class="text-sm opacity-75 w-[150px]text-start">{{ $episode->creator->name }}
                </a>
                </h4>
                <h4 class="text-sm opacity-75 w-[50px] text-start">{{ $episode->getDuration() }}</h4>
                <div class="flex gap-5 items-center">


                    <button wire:click="like({{ $episode->id }})" class="max-h-10 px-4 btn ">
                        @if ($episode->isLikedBy(auth()->user()))
                            <i class="fas fa-heart text-black"></i>
                        @else
                            <i class="far fa-heart"></i>
                        @endif
                    </button>
            </li>
        @endforeach

    </div>