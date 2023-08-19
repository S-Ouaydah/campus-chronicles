<x-app-layout>
    <div class="bg-black pl-8">
        <div class="relative p-1/12 flex items-center">
            <div class=" bg-cover h-[220px] w-[220px] rounded-full" style="background-image: url('{{ asset($pfpPath) }}');"></div>
            <div class="text-white ml-20">
                <h2 class="text-4xl font-medium"><?= $user->name ?></h2>
            </div>
            <div class="flex items-start p-0 m-0 text-white">
                <p class=" opacity-90 m-0 max-w-[400px] break-all">{!! nl2br(e($userBio)) !!}</p>
            </div>
            {{-- follow button --}}
            <div class="flex items-end">
                @livewire('follow-button', ['creatorId' => $user->id])
            </div>
        </div>
    </div>


    <div class="mx-[3%] 2xl:mx-[5%] 3xl:mx-[8%] ">
        <div>
            <h2 class="text-xl font-semibold mt-20">Podcasts</h2>
            @if (!$podcasts->isEmpty())
                    @foreach ($podcasts as $podcast)
                        <div>
                        <a
                            class="list-item"
                            href="{{ route('podcast.show', $podcast['id']) }}">
                            {{ $podcast['title'] }}
                        </a>
                        </div>

                    @endforeach
                @else
                    <p>No podcasts found !</p>
                @endif
        </div>
    </div>
</x-app-layout>
