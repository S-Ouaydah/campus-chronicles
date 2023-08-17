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

                    @include('partials.podcast-bubble')

                @endforeach
                @else
                <li>No podcasts found !</li>
                @endif
            </ul>

            <h2>Episodes</h2>
           
            <ul>
                @if (!$episodes->isEmpty())

                    @livewire('podcast-episodes',['podcast' => null ,'episodes'=>$episodes])

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