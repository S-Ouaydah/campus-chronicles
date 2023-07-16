<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create Category') }}
        </h2>
    </header>

    <!-- create -->
    <x-primary-button style="margin: 0 5px;" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-category-form')">{{ __('Create') }}</x-primary-button>

    <x-modal name="create-category-form" :show="false" focusable>
        <form method="post" action="{{ route('category.store') }}" class="p-6" enctype="multipart/form-data">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('fill the category details underneath') }}
            </h2>

            <div class="flex flex-col space-y-6 ">

                <!-- name -->
                <x-input-label for="name" value="{{ __('Name') }}" class="sr-only" />

                <input type="text" id="name" name="name" class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" placeholder="Name" required>

                <!--error-->
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


    <!-- view -->
    <x-primary-button style="margin: 0 5px;" x-data="" x-on:click.prevent="$dispatch('open-modal', 'view-category')">{{ __('View') }}</x-primary-button>

    <x-modal name="view-category" :show="false" focusable>

        <h2 class="text-lg font-semibold text-gray-900">
            {{ __('All Categories') }}
        </h2>
        <div class="flex flex-col space-y-6">

            <!-- Categories -->

            @foreach ($categories as $category)
            <div class="flex items-center space-x-2">
                <span>{{ $category->name }}</span>
                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-danger-button type="submit" class="">Delete</x-danger-button>
                </form>
                <a href="" class="text-blue-500">Update</a>
            </div>
            @endforeach

        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
        </div>
    </x-modal>

</section>