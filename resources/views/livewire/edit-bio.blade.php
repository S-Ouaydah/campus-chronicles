<div class="pt-4 ">
    @if ($editing)
        <textarea maxlength="255" type="text" wire:model="bio" rows="6"
            class="bg-transparent form-control border-none  focus:ring-0  p-0 w-[400px] overflow-hidden resize-none tx"></textarea>

        <i wire:click="cancelEditing" class="fa-regular fa-circle-xmark text-white"></i>
        <i wire:click="saveBio" class=" ml-4 fa-solid fa-circle-check text-white"></i>
    @elseif(empty($user->bio))
        <span wire:click="startEditing" class="opacity-75 hover:opacity-90 cursor-pointer select-none">Add Bio</span>
    @else
        <div class="flex items-start p-0 m-0">
        <p  class=" opacity-90 m-0 max-w-[500px] truncate-6">{!! nl2br(e($bio)) !!}</p>
        <i wire:click="startEditing" class="ml-4 fa-solid fa-pen text-sm "></i>
        </div>
    @endif
</div>
