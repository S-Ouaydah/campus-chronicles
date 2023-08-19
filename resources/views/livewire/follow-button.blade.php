<div class="">
    <button wire:click="{{ $followed ? 'unfollow' : 'follow' }}" wire:loading.attr="disabled"
        class="py-2 px-5 rounded text-lg font-medium bg-[#C0EE9B] text-black">
        @if ($followed)
            Unfollow
        @else
            Follow
        @endif
    </button>
</div>
