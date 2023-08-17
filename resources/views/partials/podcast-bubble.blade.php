<div class="swiper-slide relative h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] mb-5">
    <a href="{{ route('podcast.show', $podcast->id) }}">
        <div class="h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] rounded-xl bg-cover px-6 py-6 absolute bg-black">
            <p class="relative text-white opacity-70 h-full text-xs xl:text-sm">
                {{ $podcast->description }}
            </p>
        </div>
        <div class="h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] rounded-xl bg-cover flex justify-end flex-col px-6 py-6 absolute hover:opacity-0" style="background-image: url('{{ asset($podcast->image_url) }}');">
            <h2 class="relative text-white text-lg xl:text-xl font-medium">
                {{ $podcast->title }}
            </h2>
            <p class="relative text-white text-sm xl:text-xl opacity-80">
                {{ $podcast->creator->name }}
            </p>
        </div>
    </a>
</div>