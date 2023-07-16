<div class="select-none">
    <h1 class="mt-20 text-xl font-medium">Discover Categories</h1>
    <div class="flex gap-5 mt-5 items-center">
    <i class="fa-solid fa-bars py-4 px-5 rounded-xl bg-black text-white leading-0"></i>
        @foreach ($categories as $category)
            <button
                class="tablink py-3 px-4 leading-0 rounded-xl @if ($activeTab === $category->id) bg-black font-medium text-white @else bg-gray-200 text-black @endif"
                wire:click="openTab({{ $category->id }})">{{ $category->name }}</button>
        @endforeach
    </div>

    <div class="tab-content">
        @foreach ($categories as $category)
            <div id="{{ $category->id }}" class="tab"
                @if ($activeTab === $category->id) style="display: block;" @else style="display: none;" @endif>
                <div class="swiper-container cat-swiper overflow-hidden mt-5">
                    <div class="swiper-wrapper gap-5">
                        @foreach ($podcasts as $podcast)
                            <div class="relative m-0 h-[167px] w-[250px] swiper-slide xl:h-[200px] xl:w-[300px] ">
                                <a href="{{ route('podcast.show', $podcast->id) }}">
                                    <div
                                        class="h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] rounded-xl bg-cover px-6 py-6 absolute bg-black">
                                        <p class="relative text-white opacity-70 h-full text-xs xl:text-sm">
                                            {{ $podcast->description }}
                                        </p>
                                    </div>
                                    <div class="h-[167px] w-[250px] xl:h-[200px] xl:w-[300px] rounded-xl bg-cover flex justify-end flex-col px-6 py-6 absolute hover:opacity-0"
                                        style="background-image: url('{{ asset($podcast->image_url) }}');">
                                        <h2 class="relative text-white text-lg xl:text-xl font-medium">
                                            {{ $podcast->title }}
                                        </h2>
                                        <p class="relative text-white text-sm xl:text-xl opacity-80">
                                            {{ $podcast->creator->name }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@push('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
document.addEventListener('livewire:load', function () {
  var swipers = {};

  Livewire.hook('message.processed', function () {
    for (var key in swipers) {
      swipers[key].destroy();
    }

    swipers = {};

    var containers = document.getElementsByClassName('swiper-container');

    for (var i = 0; i < containers.length; i++) {
      var container = containers[i];

      var id = container.getAttribute('id');
      swipers[id] = new Swiper(container, {
        slidesPerView: 'auto',
      });
    }
  });

  Livewire.on('tabChanged', function () {
    setTimeout(function () {
      Livewire.hook('message.processed')();
    }, 0);
  });
});

    </script>
@endpush
