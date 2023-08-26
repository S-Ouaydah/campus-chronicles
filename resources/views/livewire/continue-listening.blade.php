<div class="mt-10 flex justify-between gap-10 select-none box-border p-2">
    <div>
        <h4 class="text-black text-2xl font-medium ">Continue Listening</h4>
        @if ($epsToContinue->all() === [])
            <div class="bg-[#D9D9D9] w-[600px] h-[250px] mt-3 rounded-3xl flex justify-center items-center">
                <h4 class="font-medium opacity-80">You dont have any episode on your continue list !</h4>

            </div>
        @else
            @foreach ($epsToContinue as $episode)
                @if ($episode->podcast)

                <div class="bg-[#D9D9D9] w-[600px] h-[250px] mt-3 rounded-3xl flex">
                    <div class="w-[40%] bg-black rounded-s-3xl bg-cover"
                        style="background-image: url('{{ asset($episode->podcast->image_url) }}');"
                        wire:click="$emit('playAudio','{{ $episode->audio_path }}', {{ $episode_id }}, '{{ $episode->podcast->image_url }}', {{ $episode->time_played}})">
                    </div>
                    <div class=" w-[60%]">
                        <div class="p-5 flex flex-col justify-between h-full">
                            <div class=" flex flex-col justify-between">
                                <div class="flex justify-between w-[100%]">
                                    <h4 class="font-medium text-lg">Episode {{ $episode->episode->sequence }} :</h4>
                                    {{-- <i wire:click="removeFromContinue({{ $episode->id }})"
                                        class="fa-solid fa-xmark leading-none opacity-80 hover:opacity-100"></i> --}}
                                </div>

                                <h4 class="font-medium text-lg ">{{ $episode->title }}</h4>
                                <h4 class="font-medium">{{ $episode->podcast->title }}<br>By
                                    {{ $episode->creator->name }}</h4>
                            </div>
                            <div>
                                <h4 class="font-medium opacity-80 ">{{ $episode->time_played }} out of
                                    {{ $episode->getFromattedDuration() }}</h4>
                                <div class="w-[100%] h-2 flex justify-start bg-[#C0EE9B] mt-2 ">

                                    <div class="h-2 bg-black  "
                                        {{-- style="width: {{$listen->ratio * 100 }}%;" --}}
                                        >
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                @endif
            @endforeach
        @endif


    </div>
 <div class="w-[100%] overflow-x-hidden swp">
        <h4 class="text-black text-2xl font-medium">Pick up what you left behind</h4>
        <div class="swiper-container pickup-swiper-container">
            <div class="swiper-wrapper gap-2">
                @if (count($nextEpisodes) > 0)
                    @foreach ($nextEpisodes as $episode)
                        <div class="swiper-slide mr-0 w-[375px]">
                            <div class="bg-[#D9D9D9] w-[375px] h-[250px] mt-3 rounded-3xl bg-cover p-4 flex flex-col justify-between" style="background-image: url('{{ asset($episode->podcast->image_url) }}');">
                                <div>
                                    @if ($this->isNewEp($episode->id))
                                        <span class="bg-black text-white w-[55px] px-3 py-1 rounded-lg text-center">New</span>
                                    @endif
                                </div>
                                <div class="flex gap-3 items-center">
                                    <div class="bg-black p-4 !h-12 !w-12 flex justify-center items-center rounded-lg">
                                        <i class="leading-0 fa-solid fa-play text-white text-center opacity-90 hover:opacity-100 text-lg" wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}',0)"></i>
                                    </div>
                                    <div>
                                        <p class="text-white text-lg font-medium w-[275px] truncate">{{ $episode->podcast->title }}</p>
                                        <p class="text-white text-lg font-medium w-[275px] truncate">Ep{{ $episode->sequence }} - {{ $episode->title }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-[#D9D9D9] w-[100%] h-[250px] mt-3 rounded-3xl flex justify-center items-center">
                        <p class="font-medium opacity-80">No episodes to watch.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
{{-- @push('scripts') CAUSES ERRORS, SWIPER SHOULD BE REMOVED ANYWAYS
    <script>
        setInterval(function() {
            var excludeContainer = document.querySelector('.pickup-swiper-container');
            window.livewire.emit('render', { exclude: excludeContainer });
        }, 455);

        var swiper = new Swiper('.pickup-swiper-container', {
            slidesPerView: 'auto',

            // Add more options as needed
        });
    </script>
@endpush --}}
