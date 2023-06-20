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
                wire:keydown.ArrowUp="incrementHighlight"
                wire:keydown.ArrowDown="decrementHighlight"
            >
        </form>

        @if (!empty($query))
            <!-- when the user clicks outside the dropdown, it disappears -->
            <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="resets"></div>

            <div class="bg-gray-200 absolute z-10  list-group mt-5 rounded-2xl w-full px-5 py-2.5  list-none">
                @if (!empty($podcasts))
                    @foreach (array_slice($podcasts, 0, 5) as $i => $podcast)
                        <a class="list-item  list-none p-1" href="{{ route('podcast.show', $podcast['id']) }}">
                            {{ $podcast['title'] }}
                        </a>
                    @endforeach
                @else
                    <div class="list-item p-2">No results!</div>
                @endif
            </div>
        @endif
    </div>
</div>