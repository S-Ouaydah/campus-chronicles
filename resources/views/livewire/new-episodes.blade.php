
                <div class="h-[56%] mt-4">
                    <div class="flex justify-between h-full">
                        @foreach ($lastNewEpisodes as $index => $episode)
                            <div
                                class="w-[64%] h-full mr-4 bg-black rounded-3xl p-12 flex flex-col justify-evenly {{ $index !== $activeEpisodeIndex ? 'hidden' : '' }}">
                                <h2 class="text-[#71C719] text-4xl font-medium">New Episodes</h2>
                                <h4 class="text-white text-2xl mt-2 font-medium">{{ $episode->podcast->title }}<br><span
                                        class="text-[#5A5A5A]">By </span>{{ $episode->creator->name }}</h4>
                                <h4 class="text-white text-xl mt-2 font-medium">Ep{{ $episode->sequence }} -
                                    {{ $episode->title }}</h4>
                                <div class="flex justify-start mt-4">
                                    @foreach ($lastNewEpisodes as $paginationIndex => $paginationEpisode)
                                        <button wire:click="showEpisode({{ $paginationIndex }})"
                                            class="ml-1 focus:outline-none {{ $paginationIndex === $activeEpisodeIndex ? 'bg-[#71C719] w-4 h-2 rounded' : 'w-2 h-2 bg-[#5A5A5A] rounded-full' }}"></button>
                                    @endforeach





                                </div>
                            </div>
                            <div class="relative w-[36%] ml-4 {{ $index !== $activeEpisodeIndex ? 'hidden' : '' }}">
                                <div class="absolute w-full h-full bg-black rounded-3xl">
                                    <div class="relative w-full h-full bg-cover saturate-0 rounded-3xl"
                                        style="background-image: url('{{ asset($episode->podcast->image_url) }}');"
                                       >
                                    </div>
                                </div>
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                    <i class="fa-solid fa-play text-[#71C719]  opacity-95 hover:opacity-100 text-6xl"  wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id }}, '{{ $episode->podcast->image_url }}')"></i>
                                </div>
                            </div>



                            {{-- <div class="w-[36%] ml-4 bg-black rounded-3xl justify-center flex items-center p-12 bg-cover grayscale {{ $index !== $activeEpisodeIndex ? 'hidden' : '' }}"
                                style="background-image: url('{{ asset($episode->podcast->image_url) }}');" wire:click="$emit('playAudio', '{{ $episode->audio_path }}', {{ $episode->id}}, '{{ $episode->podcast->image_url }}')">
                                <i class="fa-solid fa-play text-[#71C719] text-6xl"></i></div> --}}
                        @endforeach
                    </div>
                </div>

                @push('scripts')
                    <script>
                        document.addEventListener('livewire:load', function() {
                            setInterval(function() {
                                @this.call('rotateEpisode');
                            }, 10000);
                        });
                    </script>
                @endpush
