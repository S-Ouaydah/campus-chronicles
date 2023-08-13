<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Results') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2>Podcasts</h2>
            <ul>
                @if (!$podcasts->isEmpty())
                @foreach ($podcasts as $podcast)
                <li>
                    <a class="list-item" href="{{ route('podcast.show', $podcast['id']) }}">
                        {{ $podcast['title'] }}
                    </a>
                </li>
                @endforeach
                @else
                <li>No podcasts found !</li>
                @endif
            </ul>

            <h2>Episodes</h2>
            <ul>

                @if (!$episodes->isEmpty())
                @foreach ($episodes as $episode)
                <li class="flex flex-row m-6">
                    <div class="relative rounded-lg w-1/8 pb-1/8 mr-6">
                        <img class="absolute rounded-lg w-full h-full object-cover" src="<?= $episode->podcast->image_url ?>" alt="podcast image">
                        <div class="absolute opacity-30 rounded-lg w-full h-full object-cover bg-white  mix-blend-screen text-7xl font-extrabold text-center pt-1/4"></div>
                        <div class="absolute opacity-60 rounded-lg w-full h-full object-cover bg-black text-white mix-blend-multiply text-7xl font-extrabold text-center pt-1/4">{{ $episode->getSequence()+1 }}</div>

                        <button wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}')" class="flex cursor-pointer">
                            <span class="absolute fa-stack fa-lg w-full h-full text-3xl text-center flex items-center">
                                <i class="fa fa-circle fa-stack-2x text-black"></i>
                                <i class="fa fa-play fa-stack-1x fa-inverse pl-1 text-lime-500"></i>
                            </span>
                        </button>
                    </div>
                    <div class="w-2/3">
                        <div class="text-xl">{{ $episode->title }}</div>
                        <div class="text-sm">{{ $episode->description }}</div>
                    </div>

                    <button wire:click="like({{$episode->id}})" class="max-h-10 px-4 btn ">
                        @if ($episode->isLikedBy(auth()->user()))
                        <i class="fas fa-heart text-black"></i>
                        @else
                        <i class="far fa-heart"></i>
                        @endif
                    </button>
                </li>
                @endforeach
                @else
                <li>No episodes found !</li>
                @endif
            </ul>

            <h2>Creators</h2>
            <ul>
                @if (!$users->isEmpty())
                @foreach ($users as $user)
                @if($currentuser)
                    @if($user->id != $currentuser->id)
                    <li>
                        <a class="list-item" href="{{ route('profile.viewer', $user['id']) }}">
                            {{ $user['name'] }}
                        </a>
                    </li>
                    @endif
                @else
                <li>
                    <a class="list-item" href="{{ route('profile.viewer', $user['id']) }}">
                        {{ $user['name'] }}
                    </a>
                </li>
                @endif
                @endforeach
                @else
                <li>No creators found !</li>
                @endif
            </ul>
        </div>

    </div>
</x-app-layout>