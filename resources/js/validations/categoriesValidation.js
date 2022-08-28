jQuery(document).ready(function () {
    const title = jQuery('#categoryTitle');
    const description = jQuery('#categoryDescription');
    const icon = jQuery('#categoryIcon');
    const titleValidationMessage = jQuery('#categoryTitleValidationMessage');
    const descriptionValidationMessage = jQuery('#categoryDescriptionValidationMessage')
    const iconValidationMessage = jQuery('#categoryIconValidationMessage');
    const saveCategoryBtn = jQuery('#saveCategory');

    // Validate on button submit
    saveCategoryBtn.on('click', function (e) {

        // title validation
        if (title.val() === null || title.val() === undefined || title.val() === false || title.val() === '') {
            setTimeout(function () {
                titleValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if (title.val().length < 4 || title.val().length > 50) {
            setTimeout(function () {
                titleValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja može sadržati od 4 do 50 karaktera.</p>');
            }, 200);
            return e.preventDefault();
        } else if (!/^([a-zA-Z0-9-,\s])+$/.test(title.val())) {
            setTimeout(function () {
                titleValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja nije u korektnom formatu.</p>');
            }, 200);
            return e.preventDefault();
        }

        setTimeout(function () {
            titleValidationMessage.css({"display": "none"});
        });

        // description validation
        if (description.val() === null || description.val() === undefined || description.val() === false || description.val() === '') {
            setTimeout(function () {
                descriptionValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if (description.val().length < 10 || description.val().length > 512) {
            setTimeout(function () {
                descriptionValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja može sadržati od 10 do 500 karaktera.</p>');
            }, 200);
            return e.preventDefault();
        }

        setTimeout(function () {
            descriptionValidationMessage.css({"display": "none"});
        });
    });

    icon.on('change', function (e) {
        const file = this.files[0];
        jQuery('#icon-output').text(file.name);
    });
});
