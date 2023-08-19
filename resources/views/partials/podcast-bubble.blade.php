<div class=" relative  h-[275px] ">
<a href="{{ route('podcast.show', $podcast->id) }}" class="block w-full h-full">
    <div class="relative h-[275px]  bg-black rounded-xl overflow-hidden">
        <div class="h-[275px] absolute inset-0 px-4 sm:px-6 py-4 sm:py-6 rounded-xl bg-opacity-70 bg-black">
            <p class="text-white text-xs sm:text-sm xl:text-base">{{ $podcast->description }}</p>
        </div>
        <div class="h-[275px] flex justify-end flex-col  absolute inset-0 px-4 sm:px-6 py-4 sm:py-6 rounded-xl bg-cover bg-no-repeat bg-center transition-opacity duration-300 hover:opacity-0"
            style="background-image: url('{{ asset($podcast->image_url) }}');">
            <h2 class="text-white text-base sm:text-lg xl:text-xl font-medium">
                {{ $podcast->title }}
            </h2>
            <p class="relative text-white text-sm xl:text-xl opacity-80">
                {{ $podcast->creator->name }}
            </p>
        </div>
    </div>
</a>

</div>

