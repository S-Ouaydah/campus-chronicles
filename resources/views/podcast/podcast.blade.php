<x-app-layout>
    <section class=" bg-gray-300 max-w-7xl mx-auto rounded-lg flex ">
        <div class="relative rounded-lg w-1/3 pb-1/3">
            <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset('storage/' . $podcast->image_url) }}" alt="podcast image" >
        </div>
        <div class="relative w-2/3 px-1/12 flex flex-col ">
            {{--TODO livewire ajax in place editing --}}
            @auth
                @if(auth()->user()->isISAE)
                    <button class="absolute right-0 m-12 px-6 btn btn-primary">
                        Edit
                    </button>
                @endif
            @endauth
            <h1 class="text-4xl pt-12 pb-3">{{ $podcast->title }}</h1>
            <div>
                <p class="text-md h-full overflow-hidden truncate md:truncate-none">{{ $podcast->description }}</p>
            </div>
            {{--NOTE replace static profile pic --}}
            <p class="text-xl">~{{ $podcast->creator->name}}~</p>
        </div>
    </section>
    <section class=" bg-gray-200 max-w-7xl mx-auto rounded-lg flex ">
        <div class="p-12 w-full">
            <h1 class="text-2xl pb-3">Episodes</h1>
            <ul class="">
                @foreach ($episodes as $episode)
                    <li class="flex flex-row m-6">
                        {{-- <a href="{{ route('episode', ['episode' => $episode->id]) }}" class="text-lg">{{ $episode->title }}</a> --}}
                        <div class="relative rounded-lg w-1/8 pb-1/8 mr-6">
                            <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset('storage/' . $podcast->image_url) }}" alt="podcast image" >
                            <div class="absolute opacity-30 rounded-lg w-full h-full object-cover bg-white  mix-blend-screen text-7xl font-extrabold text-center pt-1/4"></div>
                            <div class="absolute opacity-60 rounded-lg w-full h-full object-cover bg-black text-white mix-blend-multiply text-7xl font-extrabold text-center pt-1/4">{{ $episode->getSequence() }}</div>
                        </div>
                        <div class="w-2/3">
                            <div  class="text-xl">{{ $episode->title }}</div>
                            <div class="text-sm">{{ $episode->description }}</div>
                        </div>
                        {{-- TODO livewire functionality (+turn red on click) --}}
                        <button class="max-h-10 px-4 btn ">
                            <i class="far fa-heart"></i>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</x-app-layout>
