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
    var palying;
    var epId;
    var imgUrl;
    var timePlayed;
    var totalTime;
    var isComplete;

    // element.addEventListener('ready', (event) => {
    //     console.log("in ready listner")
    //     const player = event.detail.plyr;
    // });
    // player.on("pause", (event) => {
    //     console.log("inside pause");
    //     palying = false;
    // });
    // player.on("playing", (event) => {
    //     console.log("inside playing");
    //     palying = true;
    // });

    var playInt = setInterval(function() {
            playing = player.playing;
            timePlayed = player.currentTime;
            totalTime = player.duration;
            isComplete = Math.abs(timePlayed - totalTime) <= 1;
            window.livewire.emit('saveProgress', timePlayed, totalTime, isComplete,player.source,epId,imgUrl,player.playing);



            // Check for a certain case
            if (timePlayed >= player.duration) {

                clearInterval(playInt); // Stop the interval
            }
        }, 500);

    document.addEventListener("hello", function(event) {
        console.log("Hello from " +  @js($playing));
        // @this.inited
        if (@js($playing)) {
            player.play();
        }
    });
    Livewire.on('playAudio', (source,episodeId,imageUrl) => {
        console.log("in oplay audio")
        console.log(source)
        epId = episodeId;
        imgUrl = imageUrl;
        var path = location.origin + '/' + source + '.mp3' ;
        player.source = {
            type: 'audio',
            sources: [{
                    src: path,
                    type: 'audio/mp3',

                },
            ],
        };
        // NOTE playing from player.on ready in app.js
        player.play();


    });


    Livewire.on('continueAudio', (audioPath, episodeId, imageUrl, timePlayed) => {


        var path = location.origin + '/' + audioPath;
        player.source = {
            type: 'audio',
            sources: [{
                src: path,
                type: 'audio/mp3',
            }],
        };

        // Play the audio
        setTimeout(function() {
            player.currentTime = timePlayed; // Set the current time to the desired time played
            player.play();
        }, 200);

        var contInt = setInterval(function() {
            timePlayed = player.currentTime;
            totalTime = player.duration;
            isComplete = Math.abs(timePlayed - totalTime) <= 1;

            window.livewire.emit('saveProgress', timePlayed, totalTime, isComplete);
            // Check for a certain case
            if (timePlayed >= player.duration) {
                clearInterval(contInt); // Stop the interval
            }
        }, 1000);
    });

</script>
@endpush
