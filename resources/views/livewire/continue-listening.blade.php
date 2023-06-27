<div class="mt-10 flex justify-between gap-10">
    <div>
        <h4 class="text-black text-2xl font-medium ">Continue Listening</h4>
        @if ($epsToContinue->all() === [])
            <div class="bg-[#D9D9D9] w-[600px] h-[250px] mt-3 rounded-3xl flex justify-center items-center">
                <h4 class="font-medium opacity-80">You dont have any episode on your continue list !</h4>

            </div>
        @else
            @foreach ($epsToContinue as $episode)
                <div class="bg-[#D9D9D9] w-[600px] h-[250px] mt-3 rounded-3xl flex">
                    <div class="w-[40%] bg-black rounded-s-3xl bg-cover"
                        style="background-image: url('{{ asset($episode->episode->podcast->image_url) }}');"
                        wire:click="$emit('continueAudio','{{ $episode->episode->audio_path }}', {{ $episode->episode_id }}, '{{ $episode->episode->podcast->image_url }}', {{ strtotime($episode->time_played) - strtotime('00:00:00') }})">
                    </div>
                    <div class=" w-[60%]">
                        <div class="p-5 flex flex-col justify-between h-full" >
                            <div class=" flex flex-col justify-between">
                                <div class="flex justify-between w-[100%]">
                                    <h4 class="font-medium text-lg">Episode {{ $episode->episode->sequence }} :</h4>
                                    <i wire:click="removeFromContinue({{ $episode->id }})"
                                        class="fa-solid fa-xmark leading-none opacity-80 hover:opacity-100"></i>
                                </div>

                                <h4 class="font-medium text-lg ">{{ $episode->episode->title }}</h4>
                                <h4 class="font-medium">{{ $episode->episode->podcast->title }}<br>By
                                    {{ $episode->episode->creator->name }}</h4>
                            </div>
                            <div>
                                <h4 class="font-medium opacity-80 ">{{ $episode->time_played }} out of
                                    {{ $episode->episode->getDuration() }}</h4>
                                <div class="w-[100%] h-2 flex justify-start bg-black mt-2 ">

                                    <div class="h-2 bg-[#C0EE9B]  "
                                        style="width: {{ ((strtotime($episode->time_played) - strtotime('00:00:00')) / (strtotime($episode->episode->getDuration()) - strtotime('00:00:00'))) * 100 }}%;">
                                    </div>


                                </div>
                            </div>

                        </div>




                    </div>


                </div>
            @endforeach
        @endif


    </div>
    <div class="w-[100%]">

        <h4 class="text-black text-2xl font-medium ">Pickup what you left behind</h4>
        <div class="bg-[#D9D9D9] w-[100%] h-[250px] mt-3 rounded-3xl ">


        </div>



    </div>


</div>
@push('scripts')
    <script>
        setInterval(function() {

            window.livewire.emit('render');
        }, 455);
    </script>
@endpush
