<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if($categories)
            @include('partials.explore-categories')
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 p-4">
                    {{ __('There\'s no categories') }}
                </h2>

            </div>
            @endif
        </div>

    </div>
</x-app-layout>
