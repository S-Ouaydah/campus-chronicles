<x-guest-layout>
 <h1 class="font-black text-3xl text-center">Forgot your password?</h1>

    <div class="mb-4 text-sm text-gray-600 mt-4">
        {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="bg-black text-white px-5 py-3 font-bold rounded-3xl w-full">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
