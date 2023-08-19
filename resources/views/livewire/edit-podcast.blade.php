<div>
    @if ($editMode)
        <form wire:submit.prevent="save" class="bg-gray-300 max-w-7xl mx-auto rounded-lg flex">
            <div class="relative rounded-lg w-1/3 pb-1/3">
                <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset($podcast->image_url) }}"
                    alt="podcast image">
                {{-- Bind $profilePicture --}}
                <label for="podPic" class="cursor-pointer">
                    <i class="fa-solid fa-camera bg-[#121212] hover:bg-[#151515] leading-none p-3 rounded-full text-white text-2xl m-0 absolute bottom-[20px] right-[20px]"></i>
                </label>
                <input id="podPic" type="file" accept="image/*,image/gif" class="hidden" wire:model="podPic">
            </div>
            <div class="relative w-2/3 px-1/12 flex flex-col ">
                @Auth()
                @if (auth()->user()->isISAE && auth()->user()->id == $podcast->creator_id)
                    <button wire:click="discard" class="absolute right-0 m-12 px-6 btn btn-primary">
                        Discard
                    </button>
                <input wire:model.lazy="title" type="text" class="text-4xl mt-12 mb-3 w-2/3 bg-transparent">
                <div>
                    <textarea wire:model.lazy="description"
                        class="text-md  overflow-hidden truncate md:truncate-none w-[90%] bg-transparent h-52 max-h-52"></textarea>
                </div>
                <p class="text-xl my-3">by {{ $podcast->creator->name }}</p>
                <button wire:click="save" class="btn btn-primary px-2 my-5 bg-primary-base">Save</button>
                @endif
                @endauth
            </div>
        </form>
    @else
        <section class=" bg-gray-300 max-w-7xl mx-auto rounded-lg flex ">

            <div class="relative rounded-lg w-1/3 pb-1/3">
                <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset($podcast->image_url) }}"
                    alt="podcast image">
            </div>
            <div class="relative w-2/3 px-1/12 flex">
                <div class=" flex flex-col" style="flex-grow: 1">
                    <h1 class="text-4xl pt-12 pb-3 font-medium">{{ $podcast->title }}</h1>
                    <div class="mt-3">
                        <p class="text-md h-full overflow-hidden truncate-6 md:truncate-none ">{{ $podcast->description }}</p>
                    </div>
                    {{-- NOTE add profile pic --}}
                    <a class="text-xl my-3" href="{{ route('profile.viewer', $podcast->creator->id) }}">by {{ $podcast->creator->name }}</a>
                    <livewire:subscribe-button :currentPage="'other-page'" :podcastId="$podcast->id" />
                </div>
                <div class="flex-grow-0 flex flex-col ">
                    @Auth
                    @if (auth()->user()->isISAE && auth()->user()->id == $podcast->creator_id)
                        <button wire:click="edit" class=" right-0 mt-10 mx-5 btn btn-primary">
                            Edit
                        </button>

                        <button
                            type="submit"
                            class="right-0 mx-5 mt-10 btn btn-primary bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-podcast-deletion')"
                            >{{ __('Delete Podcast') }}
                        </button>

                    @endif
                    @endauth
                    <!-- Deletion confirmation -->
                    <x-modal name="confirm-podcast-deletion" :show="$errors->podDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('podcast.destroy', $podcast) }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this podcast?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once the podcast is deleted, all of its resources and episodes will be permanently deleted.') }}
                            </p>
                            <!-- potentially write podcast name for more verification -->
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ml-3">
                                    {{ __('Delete Podcast') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
    @endif
    </section>
</div>
