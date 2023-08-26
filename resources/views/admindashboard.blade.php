<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    <div class=" h-[1000px] sm:h-[550px] lg:h-[600px] bg-[#0c0c0d]  pl-[6%]">
        <div class="relative top-[200px] flex items-center gap-10 flex-wrap">
            <x-stat-card class="bg-purple-100" text="Users" :sub="$usersThisWeek->count() .
                ' new users this
                                week'" :count="$users->count()" />

            <x-stat-card class="bg-pink-100" text="Total Listens" :sub="$listensPastWeek . ' new listens this week'" :count="$listenCount" />

        </div>

    </div>

    <div class="py-12 ">
        <div class="mx-[6%] sm:px-6 lg:px-8 space-y-6">

            <h1 class="text-4xl font-medium  flex items-center justify-center"><i
                    class="fa-solid fa-gear text-2xl mr-4 leading-none "></i>Administration Tools</h1>


            <div class=" mt-4">
                @include('admin.categories')
            </div>



            <div class="max-w-xl">
                @include('admin.users')
            </div>


        </div>
    </div>
</x-app-layout>
