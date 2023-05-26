<x-app-layout>
    <section>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col">
            <div class="flex flex-row">
                <div class="flex flex-col w-1/3">
                    <img src="{{ $podcast->image_url }}" alt="podcast image" class="w-1/2">
                    <h1 class="text-2xl">{{ $podcast->title }}</h1>
                    <p class="text-lg">{{ $podcast->description }}</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col">
                <div class="flex flex-row">
                    <div class="flex flex-col w-2/3">
                        <h1 class="text-2xl">Episodes</h1>
                        <ul class="flex flex-col">
                            {{-- $episodes = $podcast->getEpisodes(); --}}
                            @foreach ($episodes as $episode)
                                <li class="flex flex-row">
                                    {{-- <a href="{{ route('episode', ['episode' => $episode->id]) }}" class="text-lg">{{ $episode->title }}</a> --}}
                                    <div  class="text-lg">{{ $episode->title }}</div>
                                    <div class="text-sm">{{ $episode->description }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
