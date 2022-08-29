@props(['picture' => 'profile-picture-placeholder.jpg', 'stage' => null])

<label class="mt-6 cursor-pointer">
    <div style="width: 220px; height: 220px;" id="empty-cover-art" class="relative py-[48px] text-center border-2 border-gray-300 border-solid">
        <div class="py-4">
            @if($picture === 'profile-picture-placeholder.jpg')
                <img id="img-place-holder" class="absolute w-full h-full bottom-0" src="{{asset('imgs/profile-picture-placeholder.jpg')}}">
            @else
                <img id="img-place-holder" class="absolute w-full h-full bottom-0" src="{{asset('storage/uploads/' . $stage . '/' . $picture)}}">
            @endif
            <input type="file" name="picture" class="hidden" accept="image/png,image/gif,image/jpg,image/jpeg,image/bim,image/webp,image/svg">
        </div>
        <img id="image-output-student" class="hidden absolute w-48 h-[188px] bottom-0">
    </div>
</label>
@error("picture")
<p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
@enderror

