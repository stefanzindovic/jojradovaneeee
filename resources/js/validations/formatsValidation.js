jQuery(document).ready(function () {
    const nameInput = jQuery('#formatName');
    const saveFormatBtn = jQuery('#saveFormatBtn');
    const nameValidationMessage = jQuery('#formatNameValidationMessageByJs');

    saveFormatBtn.on('click', function(e) {
        // check if title is empty
        if(nameInput.val() === null || nameInput.val() === undefined ||nameInput.val() === false || nameInput.val() === '') {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if(nameInput.val().length < 2 || nameInput.val().length > 25) {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja može sadržati od 2 do 25 karaktera.</p>');
            }, 200);
            e.preventDefault();
        } else if (!/^([a-zA-Z0-9-./_\s])+$/.test(nameInput.val())) {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja nije u korektnom formatu.</p>');
            }, 200);
            return e.preventDefault();
        }
        setTimeout(function () {
            nameValidationMessage.css({"display": "none"});
        });
    });
});
