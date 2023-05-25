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
                    <div class="max-w-xl">
                        <h1 class="text-2xl font-bold mb-6">Submit Form</h1>

                        <form method="POST" action="/submit-create-form">
                            @csrf

                            <div class="mb-4">
                                <label for="title" class="block font-medium">Title:</label>
                                <input type="text" id="title" name="title" class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block font-medium">Description:</label>
                                <textarea id="description" name="description" class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-textarea mt-1 resize-none" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="category_id" class="block font-medium">Category ID:</label>
                                <input type="number" id="category_id" name="category_id" class="rounded-lg border-gray-300 focus:outline-none focus:border-transparent form-input mt-1" required>
                            </div>

                            <x-primary-button type="submit">
                                Submit
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>