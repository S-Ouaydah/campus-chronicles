<div class="w-full fixed bottom-0 flex flex-nowrap h-12 z-10" >
    <img src="{{ asset($imageUrl) }}" class="contain h-12 w-12">
    <h4 class="font-medium p-3 max-w-[200px] truncate-1 bg-white">{{ $episodeTitle }}</h4>

    <div class="flex-grow " wire:ignore>
        <audio crossorigin playsinline id="audioPlayer">
            <source src="{{ $source }}" type="audio/mp3">
        </audio>
    </div>


</div>

@push('scripts')
<script>
    var playInt;
    function interval() {
        playInt = setInterval(function() {
            window.livewire.emit('saveProgress',
                player.duration,
                player.source,
                @js($episodeId),
                @js($imageUrl),
                player.playing,
                player.currentTime
            );
            // console.log("epid:" + @js($episodeId))
            // console.log("current:" + player.currentTime)
            // console.log("dura:" + player.duration)
        }, 500);
    }

    document.addEventListener("Pready", function(event) {
        console.log("Hello from " +  @js($playing));
        player.forward(@js($position))
        if (@js($playing)) {
            player.play();
        }
    });
    document.addEventListener("Pplay", function(event) {
        // console.log("Hello from pplay");
        interval();
    });
    document.addEventListener("Ppause", function(event) {
        // console.log("Hello from ppause");
        clearInterval(playInt);
        window.livewire.emit('saveProgress', player.duration, player.source,@js($episodeId),@js($imageUrl),player.playing,player.currentTime);
    });
    document.addEventListener("Pended", function(event) {
        // console.log("Hello from pended");
        clearInterval(playInt);
        // save to db as completed
    });

    Livewire.on('playAudio', (source,episodeId,imageUrl,position) => {
        console.log("in oplay audio")
        // console.log(source)
        var path = location.origin + '/' + source + '.mp3' ;
        player.source = {
            type: 'audio',
            sources: [{
                    src: path,
                    type: 'audio/mp3',

                },
            ],
        };

        player.play();
             setTimeout(function() {
                player.currentTime = position; // Set the current time to the desired time played
                player.play();
            }, 100);

    });
</script>
@endpush
