<div>
    <!-- the root div is important -->
    <?php $i = 1; ?>
    @foreach ($episodes as $episode)
    <li class="flex flex-row m-6">
        <div class="relative rounded-lg w-1/8 pb-1/8 mr-6">
            <img class="absolute rounded-lg w-full h-full object-cover" src="{{ $podcast ? '../' . $episode->podcast->image_url : $episode->podcast->image_url }}" alt="podcast image">
            <div class="absolute opacity-30 rounded-lg w-full h-full object-cover bg-white  mix-blend-screen text-7xl font-extrabold text-center pt-1/4"></div>
            <div class="absolute opacity-60 rounded-lg w-full h-full object-cover bg-black text-white mix-blend-multiply text-7xl font-extrabold text-center pt-1/4">{{ $i++ }}</div>

            <button wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}',0)" class="flex cursor-pointer opacity-0 hover:opacity-100 transition-opacity">
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
            <i class="fas fa-heart text-red-500"></i>
            @else
            <i class="far fa-heart  text-gray-800 hover:text-red-700  transition ease-in-out duration-250"></i>
            @endif
        </button>

        <!-- Delete button -->
        @Auth()
        @if (auth()->user()->isISAE && (isset($podcast) && auth()->user()->id == $podcast->creator_id))
            <button type="submit" class="max-h-10 px-4 btn font-semibold text-gray-800 hover:text-gray-900  transition ease-in-out duration-150" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-episode-deletion-{{ $episode->id }}')">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        @endif
        @endauth
        <!-- Deletion confirmation -->
        <x-modal name="confirm-episode-deletion-{{ $episode->id }}" :show="$errors->epDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('episode.destroy', $episode) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete this episode?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once the episode is deleted, all of its resources will be permanently deleted.') }}
                </p>
                <!-- potentially write episode name for more verification -->
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Delete Episode') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </li>
    @endforeach

</div>
