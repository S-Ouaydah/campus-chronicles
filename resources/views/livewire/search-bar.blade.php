<?php

use App\Models\Podcast;
?>
<div class="relative flex-auto">
    <div class="">
        <form action="{{ route('search') }}" method="get" class="form-control">
            <input 
                name="search"
                class="bg-gray-200 rounded-2xl px-5 xl:px-10 py-2.5 flex-auto focus:ring-0 outline-none border-none w-full"
                type="search"
                placeholder="search...."
                wire:model="query"
                wire:keydown.escape="resets"
            >
        </form>

        @if (!empty($query))
            <!-- when the user clicks outside the dropdown, it disappears -->
            <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="resets"></div>

            <div class="bg-gray-200 absolute z-10  list-group mt-5 rounded-2xl w-full px-5 py-2.5  list-none">
                <!-- podcasts -->
                <h5 style="text-decoration:underline;">Podcasts:</h5>
                @if (!empty($podcasts))
                    @foreach (array_slice($podcasts, 0, 5) as $i => $podcast)
                        <a class="list-item  list-none p-1" href="{{ route('podcast.show', $podcast['id']) }}">
                            {{ $podcast['title'] }}
                        </a>
                    @endforeach
                @else
                    <div class="list-item p-2">No results!</div>
                @endif
                <!-- episodes -->
                <h5 style="text-decoration:underline;">Episodes:</h5>
                @if (!empty($episodes))
                    @foreach (array_slice($episodes, 0, 5) as $i => $episode)
                        <a class="list-item  list-none p-1" href="{{ route('podcast.show', $episode['podcast_id']) }}">
                            {{ $episode['title']. " - " . Podcast::getPodTitle($episode['podcast_id']) }}
                        </a>
                    @endforeach
                @else
                    <div class="list-item p-2">No results!</div>
                @endif
                <!-- accounts -->
                <h5 style="text-decoration:underline;">Creators:</h5>
                @if (!empty($creators))
                    @foreach (array_slice($creators, 0, 5) as $i => $creator)
                        <a class="list-item  list-none p-1" href="{{ route('profile.viewer', $creator['id']) }}">
                            {{ $creator['name'] }}
                        </a>
                    @endforeach
                @else
                    <div class="list-item p-2">No results!</div>
                @endif
            </div>
        @endif
    </div>
</div>