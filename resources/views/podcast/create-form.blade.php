<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create A Podcast') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-7xl">
                        <h1 class="text-2xl font-bold mb-6">Submit Form</h1>

                        <form method="POST" action="/submit-create-form" class="flex w-full">
                            @csrf
                            <div class="relative rounded-lg w-1/3 pb-1/3 mr-12">
                                <img class="absolute rounded-lg w-full h-full object-cover" src="{{ asset('storage/upload_image_placeholder.png')}}" alt="podcast image" >
                            </div>
                            <div class="w-1/3">
                                <div class="mb-6">
                                    <label for="title" class="block font-medium">Title:</label>
                                    <input type="text" id="title" name="title" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" required>
                                </div>

                                <div class="mb-6">
                                    <label for="description" class="block font-medium">Description:</label>
                                    <textarea id="description" name="description" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-textarea mt-1 resize-none" required></textarea>
                                </div>
                                {{-- TODO make this a selection from existing categs --}}
                                <div class="mb-6">
                                    <label for="category_id" class="block font-medium">Category ID:</label>
                                    <input type="number" id="category_id" name="category_id" class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" required>
                                </div>

                                <x-primary-button type="submit">
                                    Submit
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
