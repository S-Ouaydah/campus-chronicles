<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Manage Users') }}
        </h2>
    </header>

    <!-- view -->
    <x-primary-button style="margin: 0 5px;" x-data="" x-on:click.prevent="$dispatch('open-modal', 'view-users')">{{ __('View') }}</x-primary-button>

    <x-modal name="view-users" :show="false" focusable>

        <div class="p-4 space-y-6">
            <h2 class="text-lg font-semibold text-gray-900">
                {{ __('All Users') }}
            </h2>

            <div class="grid grid-cols-2 gap-4">
                @foreach ($users as $user)
                <div class="flex items-center justify-between border border-gray-300 p-4 rounded-md shadow-md">
                    <span>{{ $user->name }}</span>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit">Delete</x-danger-button>
                    </form>
                </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </div>
        </div>

    </x-modal>

</section>