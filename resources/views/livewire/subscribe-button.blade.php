<div class="">
    <button wire:click="{{ $subscribed ? 'unsubscribe' : 'subscribe' }}" wire:loading.attr="disabled"
        class="py-2 px-5 rounded text-lg font-medium {{ $buttonClass }}"> 
        @if ($subscribed)
            Unsubscribe
        @else
            Subscribe
        @endif
    </button>
</div>
