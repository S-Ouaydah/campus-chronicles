<div class="w-full fixed bottom-0 flex flex-nowrap h-12 z-10" >
    <img src="{{ asset($imageUrl) }}" class="contain h-12 w-12">

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
        // starting from a position is not working... (so i have not bothered fixing **continue-listening.blade.php**)
        player.currentTime = position+30;
        player.forward(position+30);
        console.log(position+30 + "pos")
        console.log(player.currentTime + "currtime")
        player.play();
    });
</script>
@endpush
