<div class="w-full fixed bottom-0 flex flex-nowrap h-12">
    <img src="{{ asset($imageUrl) }}" class="contain h-12 w-12">

    <div class="flex-grow " wire:ignore>
        <audio crossorigin playsinline id="audioPlayer">
            <source src="{{ $source }}" type="audio/mp3">
        </audio>
    </div>


</div>

@push('scripts')
    <script>
        var timePlayed;
        var totalTime;
        var isComplete;


        Livewire.on('playAudio', source => {

            var path = location.origin + '/' + source + '.mp3';
            player.source = {
                type: 'audio',
                sources: [{
                        src: path,
                        type: 'audio/mp3',

                    },


                ],
            };
            player.play();




            var playInt = setInterval(function() {
                timePlayed = player.currentTime;
                totalTime = player.duration;
                isComplete = Math.abs(timePlayed - totalTime) <= 1;
                window.livewire.emit('saveProgress', timePlayed, totalTime, isComplete);



                // Check for a certain case
                if (timePlayed >= player.duration) {

                    clearInterval(playInt); // Stop the interval
                }
            }, 1000);
        });


        Livewire.on('continueAudio', (audioPath, episodeId, imageUrl, timePlayed) => {


            var path = location.origin + '/' + audioPath + '.mp3';
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
