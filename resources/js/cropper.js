jQuery(document).ready(function () {
    const pictureInput = jQuery('#cropperPicture');
    const outputImage = jQuery('#imageOutput');
    const pictureValidationMessage = jQuery('#pictureValidationMessageByJs');
    const cropperFrame = jQuery('#cropperFrame');
    const form = jQuery('#myForm');
    const cropperPlaceholder = jQuery('#cropper-placeholder');
    const cancelBtn = jQuery('#cancelCropperBtn');
    const confirmBtn = jQuery('#confirmCropperBtn')

    let cropper;

    pictureInput.on('change', function (e) {
        const uploadedFile = this.files[0];

        const allowedTypes = [
            'image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'image/bim', 'image/webp', 'image/svg'
        ];

        if (!allowedTypes.includes(uploadedFile.type)) {
            setTimeout(function () {
                pictureValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Odabrani fajl nije podržanog formata. Molimo vas da odaberete drugu SLIKU.</p>');
            }, 200);
            return e.preventDefault();
        } else if (uploadedFile > 5 * 1024 * 1024) {
            setTimeout(function () {
                pictureValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Odabrani fajl je prevelik. Molimo vas da odaberete neki manji fajl.</p>');
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                // Prepare screen to display cropper frame
                pictureValidationMessage.css({"display": "none"});
                cropperPlaceholder.attr('src', URL.createObjectURL(uploadedFile));

                // Cropper
                console.log(cropperPlaceholder);

                cropper = new Cropper(cropperPlaceholder[0]);
                // Show cropper frame
                cropperFrame.removeClass('hidden');
            }, 200);
        }
    });

    confirmBtn.on('click', function(e) {
        cropper.getCroppedCanvas().toBlob((blob) => {
            let file = new File([blob], Date.now(), {type: blob.type});
            let container = new DataTransfer();

            container.items.add(file);

            let input = document.createElement("input");
            input.name = "picture";
            input.type = "file";
            input.files = container.files;
            input.classList.add("hidden");
            input.readOnly;
            form.append(input);

            outputImage.css({'display': 'block'});
            outputImage.attr('src', URL.createObjectURL(blob));
            outputImage.css({'display': 'block'});

            //outputImage.src = URL.createObjectURL(blob);

            cropperFrame.addClass('hidden');
            cropper.destroy();
            pictureInput.val('');
        });
    });

    cancelBtn.on('click', function(e) {
        cropperFrame.addClass('hidden');
        cropper.destroy();
        pictureInput.val('');
    })
});
