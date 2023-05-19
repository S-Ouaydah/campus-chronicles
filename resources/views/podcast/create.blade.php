<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create Podcast') }}
        </h2>
    </header>

    <a href="{{ route('podcast-create-form') }}">
        <x-primary-button>{{ __('Create') }}</x-primary-button>
    </a>

</section>