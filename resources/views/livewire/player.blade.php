<div class="w-full fixed bottom-0 flex flex-nowrap h-12">
    <img src="https://picsum.photos/300" class=" object-contain ">
    <div class="flex-grow  " wire:ignore>
        <audio crossorigin playsinline >
            <source src="{{ $source }}" type="audio/mp3">
        </audio>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('playAudio', source => {
            var path = location.origin + "/storage/" + source;
            player.source = {
                type: 'audio',
                sources: [
                    {
                    src: path,
                    type: 'audio/mp3',
                    },
                ],
            };
            player.play();
        })
    </script>
@endpush
