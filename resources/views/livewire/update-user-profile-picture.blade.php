{{-- <div>
    <label for="profilePicture" class="cursor-pointer">
        <i class="fas fa-edit"></i>
    </label>
    <input type="file" id="profilePicture" class="hidden" wire:model="profilePicture">
</div> --}}
<div   class="relative m-0 p-0">
    <label for="profilePicture" class="cursor-pointer" wire:click="openProfilePictureUpload">
        <i wire:click="openProfilePictureUpload"
            class="fa-solid fa-camera bg-[#131313] leading-none p-3 rounded-full text-white text-xl m-0 absolute top-[75%] left-[75%]"></i>

    </label>
    <input id="profilePicture"  type="file" class="hidden" wire:model="profilePicture"  >

    {{-- @livewire('profile-picture-upload') --}}
    <div id="profile-picture-upload" class=" bg-cover h-[200px] w-[200px] rounded-full" style="background-image: url('{{ asset($pfpPath) }}');">
    
    </div>
    
</div>
@push('scripts')
    <script>
        window.addEventListener('openProfilePictureUpload', () => {
            document.getElementById('profilePicture').click();
        });
    </script>
@endpush
