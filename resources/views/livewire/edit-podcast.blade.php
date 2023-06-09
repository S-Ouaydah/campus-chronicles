<div>
    @if ($editMode)
        <form wire:submit.prevent="save" class="bg-gray-300 max-w-7xl mx-auto rounded-lg flex">
            <div class="relative rounded-lg w-1/3 pb-1/3">
                {{-- <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset('storage/' . $podcast->image_url) }}" alt="podcast image" > --}}


                <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset($podcast->image_url) }}"
                    alt="podcast image">
            </div>
            <div class="relative w-2/3 px-1/12 flex flex-col ">
                @auth
                    @if (auth()->user()->isISAE && auth()->user()->id == $podcast->creator_id)
                        <button wire:click="discard" class="absolute right-0 m-12 px-6 btn btn-primary">
                            Discard
                        </button>
                    @endif
                @endauth
                <input wire:model.lazy="title" type="text" class="text-4xl mt-12 mb-3 w-2/3 bg-transparent">
                <div>
                    <textarea wire:model.lazy="description"
                        class="text-md  overflow-hidden truncate md:truncate-none w-[90%] bg-transparent h-52 max-h-52"></textarea>
                </div>
                <input wire:model.lazy="pod_pic" type="file" class="text-4xl mt-12 mb-3 w-2/3 bg-transparent">
                {{-- NOTE add profile pic --}}
                <p class="text-xl">{{ $podcast->creator->name }}</p>
                <button wire:click="save" class="btn btn-primary px-2 my-2 bg-primary-base">Save</button>
            </div>

        </form>
    @else
        <section class=" bg-gray-300 max-w-7xl mx-auto rounded-lg flex ">

            <div class="relative rounded-lg w-1/3 pb-1/3">
                {{-- <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset('storage/' . $podcast->image_url) }}" alt="podcast image" > --}}
                <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset($podcast->image_url) }}"
                    alt="podcast image">
            </div>
            <div class="relative w-2/3 px-1/12 flex flex-col ">
                @auth
                    @if (auth()->user()->isISAE && auth()->user()->id == $podcast->creator_id)
                        <button wire:click="edit" class="absolute right-0 m-12 px-6 btn btn-primary">
                            Edit
                        </button>
                    @endif
                @endauth
                <h1 class="text-4xl pt-12 pb-3 font-medium">{{ $podcast->title }}</h1>
                <div class="mt-3">
                    <p class="text-md h-full overflow-hidden truncate md:truncate-none ">{{ $podcast->description }}</p>
                </div>
                {{-- NOTE add profile pic --}}
                <p class="text-xl mt-3">{{ $podcast->creator->name }}</p>
                <livewire:subscribe-button :podcastId="$podcast->id" />
            </div>
    @endif
    </section>
</div>
