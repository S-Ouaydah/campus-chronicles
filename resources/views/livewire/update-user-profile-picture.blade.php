
<div   class="relative m-0 p-0">
    <label for="profilePicture" class="cursor-pointer" wire:click="openProfilePictureUpload">
        <i wire:click="openProfilePictureUpload"
            class="fa-solid fa-camera bg-black leading-none p-3 rounded-full text-white text-2xl m-0 absolute top-[75%] left-[75%]"></i>

    </label>
    <input id="profilePicture"  type="file" class="hidden" wire:model="profilePicture"  >

    
    <div id="profile-picture-upload" class=" bg-cover h-[220px] w-[220px] rounded-full" style="background-image: url('{{ asset($pfpPath) }}');">

    </div>

</div>

