<div>
    <form action="{{route('search')}}" method="get" class="form-control">

    <input 
    name="search"
    class="bg-gray-200 rounded-2xl px-5 xl:px-10 py-2.5 flex-auto focus:ring-0 outline-none border-none"
    type="search"
    placeholder="search...."
    wire:model="query"
    wire:keydown.escape="resets"
    wire:keydown.ArrowUp="incrementHighlight"
    wire:keydown.ArrowDown="decrementHighlight"
    >
    </form>
    

    @if(!empty($query))

    <!-- when user clicks outside the dropdown it disappears -->
    <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="resets"></div>

    <div class="absolute z-10 bg-white list-group">
        @if(!empty($podcasts))
            @foreach(array_slice($podcasts, 0, 5) as $i => $podcast)
            <a 
                class="list-item"
                href="{{ route('podcast.show', $podcast['id']) }}">
                {{ $podcast['title'] }} 
            </a>
            @endforeach
        @else
            <div class="list-item">No results!</div>
        @endif
    </div>
    @endif

</div>