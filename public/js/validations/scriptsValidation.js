jQuery(document).ready(function () {
    const nameInput = jQuery('#scriptName');
    const saveScriptBtn = jQuery('#saveScriptBtn');
    const nameValidationMessage = jQuery('#scriptNameValidationMessageByJs');

    saveScriptBtn.on('click', function(e) {
        // check if title is empty
        if(nameInput.val() === null || nameInput.val() === undefined ||nameInput.val() === false || nameInput.val() === '') {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>');
            }, 200);
            e.preventDefault();
        } else if(nameInput.val().length < 4 || nameInput.val().length > 50) {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Vrijednost polja može sadržati od 4 do 50 karaktera.</small>');
            }, 200);
            e.preventDefault();
        } else if (!/^([a-zA-Z0-9-_.,\s])+$/.test(nameInput.val())) {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Vrijednost polja nije u korektnom formatu.</small>');
            }, 200);
            return e.preventDefault();
        }
        setTimeout(function () {
            nameValidationMessage.css({"display": "none"});
        });
    });
});
