<div class="pt-4 ">
    @if ($editing)

        <textarea type="text" wire:model="bio" rows="3" id="bio-textarea" wire:keydown="checkLines"
            class="bg-transparent form-control border-none  focus:ring-0  p-0 w-[400px] overflow-hidden resize-none textarea-limit-3 tx"></textarea>

        <i wire:click="cancelEditing" class="fa-regular fa-circle-xmark text-white"></i>
        <i wire:click="saveBio" class=" ml-4 fa-solid fa-circle-check text-white"></i>
    @elseif(empty($user->bio))
        <span wire:click="startEditing" class="opacity-75 hover:opacity-90 cursor-pointer select-none	">Add Bio</span>
    @else
        <div class="flex items-start p-0 m-0">

        <p class=" opacity-90 m-0 max-w-[400px] break-all">{!! nl2br(e($bio)) !!}</p>

        <i wire:click="startEditing" class="ml-4 fa-solid fa-pen text-sm "></i>
        </div>
    @endif
</div>









@push('styles')
    <style>
        .textarea-limit-3 {
            max-height: calc(1.5em * 3);

        }
    </style>
@endpush
