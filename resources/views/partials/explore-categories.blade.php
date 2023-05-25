<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <header class="pt-6 pl-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Category') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Choose your favorite category and explore whats new!") }}
        </p>
    </header>
    <div class="p-6 text-gray-900">

        <div class="flex flex-wrap">
        @foreach ($categories as $category)
            <div class="w-full md:w-1/5 p-4 ">
                <button class="w-full bg-gray-200 rounded-lg p-4 truncate">
                    <h5 class="text-gray-900"> {{ $category->name }} </h5>
                </button>
            </div>
        @endforeach
        </div>

    </div>
</div>