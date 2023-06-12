<section class="space-y-6 flex items-center">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Episode') }}
        </h2>
    </header>

    <x-primary-button style="margin: 0 5px;" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-episode-form')">{{ __('Add') }}</x-primary-button>

    <x-modal name="add-episode-form" :show="false" focusable>
        <form method="post" action="{{ route('episode.store') }}" class="p-6" enctype="multipart/form-data">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('fill the episode details underneath') }}
            </h2>

            <div class="flex flex-col space-y-6 ">

                <!-- title -->
                <x-input-label for="title" value="{{ __('Title') }}" class="sr-only" />

                <input type="text" id="title" name="title" class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" placeholder="Title" required>

                <!-- description -->
                <x-input-label for="description" value="{{ __('Description') }}" class="sr-only" />

                <textarea id="description" name="description" class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-textarea mt-1 resize-none" placeholder="Description" required></textarea>

                <!-- audio -->
                <x-input-label for="audio_file" value="{{ __('Audio') }}" class="" />

                <input type="file" id="audio_file" name="audio_file" accept="audio/mp3">

                <!-- podcast -->
                <x-input-label for="podcast_id" value="{{ __('Podcast Name') }}" class="sr-only" />

                <select class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" id="podcast_id" name="podcast_id">
                    @foreach( $podcasts as $podcast )
                    <option value="<?= $podcast->id ?>"><?= $podcast->title ?></option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('Add') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>


</section>