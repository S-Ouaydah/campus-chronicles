<div class="mt-3">

 @if ($subscribed)
        <button wire:click="unsubscribe" class="text-white bg-black py-2 px-5 rounded text-normal">Unsubscribe</button>
    @else
    <button wire:click="subscribe" class="text-white bg-black py-2 px-5 rounded text-normal">Subscribe</button>
    @endif
</div>
