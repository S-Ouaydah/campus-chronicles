<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <div class=" h-[1000px] sm:h-[550px] lg:h-[600px] bg-[#0c0c0d]  pl-[6%]">
        <div class="relative top-[200px] flex items-center gap-10 flex-wrap">

            <div
                class="w-[250px] h-[150px]  flex flex-col items-center justify-center bg-[#e5e2ff]  font-medium text-black  rounded-3xl text-3xl shadow-md">
                {{ $users->count() }}<span class="text-base ">Users</span>
                <p class="text-sm opacity-70"><span class="">+ {{ $usersThisWeek->count() }}</span> new users this
                    week</p>
            </div>
            <div
                class="w-[250px] h-[150px]  flex flex-col items-center justify-center bg-[#ffe2fb]  font-medium text-black  rounded-3xl text-3xl shadow-md">
                {{ $listenCount }}<span class="text-base ">Total Listens</span>
                <p class="text-sm opacity-70"><span class="">{{ $listensPastWeek }}</span> new listens this week
                </p>
            </div>
        </div>

    </div>

    <div class="py-12 ">
        <div class="mx-[6%] sm:px-6 lg:px-8 space-y-6">

            <h1 class="text-4xl font-medium  flex items-center justify-center"><i class="fa-solid fa-gear text-2xl mr-4 leading-none "></i>Administration Tools</h1>

            
                <div class=" mt-4">
                    @include('admin.categories')
                </div>
            

            
                <div class="max-w-xl">
                    @include('admin.users')
                </div>
            

        </div>
    </div>
</x-app-layout>
