<x-guest-layout >
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 " :status="session('status')"  />
    <h1 class="font-extrabold text-3xl text-center">Welcome back!</h1>
    <img class="w-[20%] mt-5 mx-auto"src="{{ asset('logo-black.png') }}">

    <form method="POST" action="{{ route('login') }}" class="mt-4" >
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#71C719] shadow-sm focus:ring-[#71C719]" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4 flex-col">
         

            <button class="ml-3 bg-black text-white px-5 py-3 font-medium rounded-3xl w-full">
                {{ __('Log in') }}
            </button>
               @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none   mt-4" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
 
            <p class="mt-4 font-bold">New here? <a class="  text-[#71C719] font-bold hover:text-gray-900 rounded-md focus:outline-none " href="{{ route('register') }}">
                {{ __('Register') }}
            </a></p>
        </div>
    </form>
</x-guest-layout>
