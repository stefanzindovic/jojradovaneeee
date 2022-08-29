jQuery(document).ready(function () {
    const nameInput = jQuery('#authorName');
    const nameValidationMessage = jQuery('#authorNameValidationMessageByJs');
    const bioInput = jQuery('#authorBio');
    const bioValidationMessage = jQuery('#authorBioValidationMessageByJs');
    const saveAuthorBtn = jQuery('#saveAuthorBtn');

    saveAuthorBtn.on('click', function(e) {
        // name validation
        if(nameInput.val() === null || nameInput.val() === undefined ||nameInput.val() === false || nameInput.val() === '') {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if(nameInput.val().length < 4 || nameInput.val().length > 50) {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja može sadržati od 4 do 50 karaktera.</p>');
            }, 200);
            e.preventDefault();
        } else if (!/^([a-zA-Z-._\s])+$/.test(nameInput.val())) {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja nije u korektnom formatu.</p>');
            }, 200);
            return e.preventDefault();
        }
        setTimeout(function () {
            nameValidationMessage.css({"display": "none"});
        });

        // bio validation
        if(bioInput.val() === null || bioInput.val() === undefined ||bioInput.val() === false || bioInput.val() === '') {
            setTimeout(function () {
                bioValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if(bioInput.val().length < 10 || bioInput.val().length > 500) {
            setTimeout(function () {
                bioValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja može sadržati od 10 do 500 karaktera.</p>');
            }, 200);
            e.preventDefault();
        }

        setTimeout(function () {
            bioValidationMessage.css({"display": "none"});
        });
    });
});
