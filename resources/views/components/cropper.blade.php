@props(['picture' => 'profile-picture-placeholder.jpg', 'stage' => null])

<div class="flex flex-col">
    <label class="mt-6 cursor-pointer">
        <div style="width: 220px; height: 220px;" id="empty-cover-art"
            class="relative py-[48px] text-center border-2 border-gray-300 border-solid">
            <div class="py-4">
                <img id="imageOutput" class="absolute w-full h-full bottom-0"
                    @if ($picture === 'profile-picture-placeholder.jpg') src="{{ asset('imgs/profile-picture-placeholder.jpg') }} @else src="{{ asset('storage/uploads/' . $stage . '/' . $picture) }} @endif">
                <input type="file" id="cropperPicture" class="hidden"
                    accept="image/png,image/gif,image/jpg,image/jpeg,image/bim,image/webp,image/svg">
            </div>
        </div>
    </label>
    @error('picture')
        <p style="color:red; max-width: 220px;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
            {{ $message }}</p>
    @enderror
    <div style="max-width: 220px;" id="pictureValidationMessageByJs"></div>
</div>
