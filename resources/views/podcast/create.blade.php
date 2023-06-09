<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create Podcast') }}
        </h2>
    </header>

    <x-primary-button style="margin: 0 5px;" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-podcast-form')">{{ __('Create') }}</x-primary-button>

    <x-modal name="create-podcast-form" :show="false" focusable>
        <form method="post" action="{{ route('podcast.store') }}" class="p-6"  enctype="multipart/form-data">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('fill the Podcast details underneath') }}
            </h2>

            <div class="flex flex-col space-y-6 ">
                <!-- image  -->
                  <x-input-label for="pod_pic" value="{{ __('Image') }}" class="sr-only" />
                <input id="pod_pic" name="pod_pic" type="file" enctype="multipart/form-data" required>


                <!-- title -->
                <x-input-label for="title" value="{{ __('Title') }}" class="sr-only" />

                <input type="text" id="title" name="title" class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" placeholder="Title" required>

                <!-- description -->
                <x-input-label for="description" value="{{ __('Description') }}" class="sr-only" />

                <textarea id="description" name="description" class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-textarea mt-1 resize-none" placeholder="Description" required></textarea>

                

            

                <!-- category -->
                <x-input-label for="category_id" value="{{ __('Category ID') }}" class="sr-only" />
                @if($categories)
                <select class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" id="category_id" name="category_id">

                    @foreach ($categories as $category)
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    @endforeach
                </select>
                @else
                <select disabled class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1"> </select>
                @endif

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" /> 
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

</section>