<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Results') }}
        </h2>
    </x-slot> --}}
    <div class="py-12 ">
        <div class="mx-[3%] 2xl:mx-[5%] 3xl:mx-[8%]    sm:px-6 lg:px-8 space-y-6">


            <div class="flex flex-col lg:flex-row gap-24">
                <div class="w-full lg:w-[40%]">
                    <h2 class="font-medium text-xl">Top Result</h2>
                    @if ($topResult)
                        <a href="{{ route('profile.viewer', $topResult->id) }}">
                            <div
                                class="bg-[#0c0c0d] w-full h-[500px] mt-4 rounded-xl hover:opacity-95 flex items-center justify-center flex-col">

                                <div class="rounded-full bg-gray-200 h-[250px] w-[250px] bg-cover"
                                    style="background-image: url('{{ asset($topResult->pfp_path) }}');"></div>
                                <h3 class="mt-4 text-white text-xl">{{ $topResult->name }}</h3>
                            </div>
                        </a>
                    @else
                        <div
                            class="bg-[#0c0c0d] w-full h-[500px] mt-4 rounded-xl hover:opacity-95 flex items-center justify-center flex-col">

                            <div class="rounded-full bg-gray-200 h-[250px] w-[250px] bg-cover"></div>
                            <h3 class="mt-4 text-white text-xl"> not found</h3>
                        </div>
                    @endif
                </div>
                <div class="w-full lg:w-[60%] ">
                    <h2 class="font-medium text-xl">Episodes</h2>

                    <ul class="mt-4">
                        @if (!$episodes->isEmpty())
                            <div class="h-[500px] bg-gray-200 p-1 sm:p-4 rounded-xl w-full ">

                                @livewire('podcast-episodes', ['podcast' => null, 'episodes' => $episodes])
                            </div>
                        @else
                            <li>No episodes found !</li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="mt-10">
                <h2 class="font-medium text-xl">Podcasts</h2>
                <ul
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 3xl:grid-cols-5  gap-5 sm:gap-10  select-none mt-4">
                    @if (!$podcasts->isEmpty())
                        @foreach ($podcasts as $podcast)
                            @include('partials.podcast-bubble')
                        @endforeach
                    @else
                        <li>No podcasts found !</li>
                    @endif
                </ul>
            </div>

            <h2 class="font-medium text-xl">Creators</h2>
            <ul>
                @if (!$users->isEmpty())
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 3xl:grid-cols-5  gap-5 sm:gap-10  select-none mt-4">
                        @foreach ($users as $user)
                            @if ($currentuser)
                                @if ($user->id != $currentuser->id)
                                    <li class="">
                                        <a class=" flex flex-col  items-center" href="{{ route('profile.viewer', $user['id']) }}">
                                            <div class="h-[250px] w-[250px] bg-gray-500 rounded-full bg-cover"
                                                style="background-image: url('{{ asset($user->pfp_path) }}');"></div>
                                                <h2>
                                            {{ $user['name'] }}</h2>
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
                    </div>
                @else
                    <li>No creators found !</li>
                @endif
            </ul>
        </div>

    </div>
</x-app-layout>