
 <div class="w-[100%] overflow-x-hidden swp">
        <h4 class="text-black text-2xl font-medium">Continue Podcast</h4>
        <div class="swiper-container pickup-swiper-container">
            <div class="swiper-wrapper gap-2">
                @if (count($nextEpisodes) > 0)
                    @foreach ($nextEpisodes as $episode)
                        <div class="swiper-slide mr-0 w-[375px]">
                            <div wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}',0)" class="bg-[#D9D9D9] w-[375px] h-[250px] mt-3 rounded-3xl bg-cover p-4 flex flex-col justify-between cursor-pointer" style="background-image: url('{{ asset($episode->podcast->image_url) }}');">
                                <div>
                                    @if ($this->isNewEp($episode->id))
                                        <span class="bg-black text-white w-[55px] px-3 py-1 rounded-lg text-center">New</span>
                                    @endif
                                </div>
                                <div class="flex gap-3 items-center">
                                    <div class="bg-black p-4 !h-12 !w-12 flex justify-center items-center rounded-lg">
                                        <i class="leading-0 fa-solid fa-play text-white text-center opacity-90 hover:opacity-100 text-lg" ></i>
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
