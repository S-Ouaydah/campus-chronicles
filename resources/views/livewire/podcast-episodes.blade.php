@if ((strpos(url()->current(), url('search')) === 0 && request()->has('search')) ||  Request::route()->getName() == "search")
    <div class="h-[460px] overflow-y-auto scrollbar-right">
        <!-- the div is important -->
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
@else
    <div>
        <!-- the div is important -->
        @foreach ($episodes as $episode)
            <li class="flex flex-row m-6">
                <div class="relative rounded-lg w-1/8 pb-1/8 mr-6">
                    <img class="absolute rounded-lg w-full h-full object-cover"
                        src="{{ $podcast ? '../' . $episode->podcast->image_url : $episode->podcast->image_url }}"
                        alt="podcast image">
                    <div
                        class="absolute opacity-30 rounded-lg w-full h-full object-cover bg-white  mix-blend-screen text-7xl font-extrabold text-center pt-1/4">
                    </div>
                    <div
                        class="absolute opacity-60 rounded-lg w-full h-full object-cover bg-black text-white mix-blend-multiply text-7xl font-extrabold text-center pt-1/4">
                        {{ $episode->getSequence() + 1 }}</div>

                    <button
                        wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}',0)"
                        class="flex cursor-pointer">
                        <span
                            class="absolute fa-stack fa-lg w-full h-full text-3xl text-center flex items-center opacity-0 hover:opacity-100">
                            <i class="fa fa-circle fa-stack-2x text-black"></i>
                            <i class="fa fa-play fa-stack-1x fa-inverse pl-1 text-white"></i>
                        </span>
                    </button>
                </div>
                <div class="w-2/3">
                    <div class="text-xl">{{ $episode->title }}</div>
                    <div class="text-sm">{{ $episode->description }}</div>
                </div>
                {{-- TODO livewire functionality (+turn red on click) --}}

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
@endif