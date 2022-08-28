jQuery(document).ready(function () {
    const titleInput = jQuery('#genreTitle');
    const saveGenreBtn = jQuery('#saveGenreBtn');
    const titleValdiationMessage = jQuery('#genreTitleValdiationMessageByJs');

    saveGenreBtn.on('click', function(e) {
        // check if title is empty
        if(titleInput.val() === null || titleInput.val() === undefined ||titleInput.val() === false || titleInput.val() === '') {
            setTimeout(function () {
                titleValdiationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if(titleInput.val().length < 4 || titleInput.val().length > 50) {
            setTimeout(function () {
                titleValdiationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja može sadržati od 10 do 50 karaktera.</p>');
            }, 200);
            e.preventDefault();
        } else if (!/^([a-zA-Z0-9-,\s])+$/.test(titleInput.val())) {
            setTimeout(function () {
                titleValdiationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja nije u korektnom formatu.</p>');
            }, 200);
            return e.preventDefault();
        }
        setTimeout(function () {
            titleValdiationMessage.css({"display": "none"});
        });
    });
});
