<div class="p-12 w-full">
    <h1 class="text-2xl pb-3">Episodes
        @if (session()->has('message'))

            <div class="alert alert-danger">

                {{ session('message') }}

            </div>

        @endif
    </h1>
    <ul class="">
        @foreach ($episodes as $episode)
            <li class="flex flex-row m-6">
                {{-- <a href="{{ route('episode', ['episode' => $episode->id]) }}" class="text-lg">{{ $episode->title }}</a> --}}
                <div class="relative rounded-lg w-1/8 pb-1/8 mr-6">
                    {{-- <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset('storage/' . $podcast->image_url) }}" alt="podcast image" > --}}
                    <img class="absolute rounded-lg w-full h-full object-cover" src="{{ $podcast->image_url }}" alt="podcast image" >
                    <div class="absolute opacity-30 rounded-lg w-full h-full object-cover bg-white  mix-blend-screen text-7xl font-extrabold text-center pt-1/4"></div>
                    <div class="absolute opacity-60 rounded-lg w-full h-full object-cover bg-black text-white mix-blend-multiply text-7xl font-extrabold text-center pt-1/4">{{ $episode->getSequence()+1 }}</div>

                    <button wire:click="$emit('playAudio','{{$episode->audio_path}}')" class="flex cursor-pointer">
                        <span class="absolute fa-stack fa-lg w-full h-full text-3xl text-center flex items-center">
                            <i class="fa fa-circle fa-stack-2x text-lime-500"></i>
                            <i class="fa fa-play fa-stack-1x fa-inverse pl-1"></i>
                        </span>
                    </button>
                </div>
                <div class="w-2/3">
                    <div  class="text-xl">{{ $episode->title }}</div>
                    <div class="text-sm">{{ $episode->description }}</div>
                </div>
                {{-- TODO livewire functionality (+turn red on click) --}}

                <button wire:click="like({{$episode->id}})" class="max-h-10 px-4 btn ">
                    @if ($episode->isLikedBy(auth()->user()))
                        <i class="fas fa-heart text-red-600"></i>
                    @else
                        <i class="far fa-heart"></i>
                    @endif
                </button>
            </li>
        @endforeach
    </ul>
</div>
