<x-app-layout>
        @livewire('edit-podcast', ['podcast' => $podcast])

    <section class=" bg-gray-200 max-w-7xl mx-auto rounded-lg flex ">
        @livewire('podcast-episodes',['podcast' => $podcast,'episodes'=>$episodes])
    </section>
</x-app-layout>
