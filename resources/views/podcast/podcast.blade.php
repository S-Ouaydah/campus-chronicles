<x-app-layout>
    @livewire('edit-podcast', ['podcast' => $podcast])

    <section class=" bg-gray-200 max-w-7xl mx-auto rounded-lg flex ">
        <div class="p-12 w-full">
            <ul class="">
                <h1 class="text-2xl pb-3">Episodes
                </h1>
                @livewire('podcast-episodes',['podcast' => $podcast,'episodes'=>$episodes])

            </ul>
        </div>
    </section>
</x-app-layout>