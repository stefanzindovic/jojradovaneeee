jQuery(document).ready(function () {
    const pictureInput = jQuery('#cropperPicture');
    const outputImage = jQuery('#imageOutput');
    const pictureValidationMessage = jQuery('#pictureValidationMessageByJs');

    pictureInput.on('change', function (e) {
        const uploadedFile = this.files[0];

        const allowedTypes = [
            'image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'image/bim', 'image/webp', 'image/svg'
        ];

        if (!allowedTypes.includes(uploadedFile.type)) {
            setTimeout(function () {
                pictureValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Odabrani fajl nije podržanog formata. Molimo vas da odaberete drugu SLIKU.</p>');
                return e.preventDefault();
            }, 200);
        } else if (uploadedFile > 5 * 1024 * 1024) {
            setTimeout(function () {
                pictureValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Odabrani fajl je prevelik. Molimo vas da odaberete neki manji fajl.</p>');
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                pictureValidationMessage.css({"display": "none"});
                outputImage.attr('src', URL.createObjectURL(uploadedFile));
            });
        }
    });
});
