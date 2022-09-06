jQuery(document).ready(function () {
    const titleInput = jQuery("#bookTitle");
    const descriptionInput = jQuery("#bookDescription");
    const categoriesInput = jQuery("#bookCategories");
    const genresInput = jQuery("#bookGenres");
    const authorsInput = jQuery("#bookAuthors");
    const publisherInput = jQuery("#bookPublisher");
    const publishedAtInput = jQuery("#bookPublishedAt");
    const totalCopiesInput = jQuery("#bookCopies");

    const totalPagesInput = jQuery("#bookPages");
    const scriptInput = jQuery("#bookScript");
    const formatInput = jQuery("#bookformat");
    const coverInput = jQuery("#bookcover");
    const isbnInput = jQuery("#bookIsbn");

    const titleMessage = jQuery("#bookTitleValidationMessage");
    const descriptionMessage = jQuery("#bookDescriptionValidationMessage");
    const categoriesMessage = jQuery("#bookCategoriesValidationMessage");
    const genresMessage = jQuery("#bookGenresValidationMessage");
    const authorsMessage = jQuery("#bookAuthorsValidationMessage");
    const publisherMessage = jQuery("#bookPublisherValidationMessage");
    const publishedAtMessage = jQuery("#bookPublishedAtValidationMessage");
    const copiesMessage = jQuery("#bookCopiesValidationMessage");
    const pagesMessage = jQuery("#bookPagesValidationMessage");
    const scriptMessage = jQuery("#bookScriptValidationMessage");
    const formatMessage = jQuery("#bookFormatValidationMessage");
    const coverMessage = jQuery("#bookCoverValidationMessage");
    const isbnMessage = jQuery("#bookIsbnValidationMessage");

    const saveBookBtn = jQuery("#saveBookBtn");

    saveBookBtn.click(function (e) {
        // Book title validation
        if (
            titleInput.val() === "" ||
            titleInput.val() === null ||
            titleInput.val() === undefined ||
            titleInput.val() === false
        ) {
            setTimeout(function () {
                titleMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else if (
            titleInput.val().length < 1 ||
            titleInput.val().length > 50
        ) {
            setTimeout(function () {
                titleMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Naslov može sadržati od 1 do 50 karaktera.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            titleMessage.css({ display: "none" });
        }

        // Book description validation
        if (
            descriptionInput.val() === "" ||
            descriptionInput.val() === null ||
            descriptionInput.val() === undefined ||
            descriptionInput.val() === false
        ) {
            setTimeout(function () {
                descriptionMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else if (
            descriptionInput.val().length < 10 ||
            descriptionInput.val().length > 500
        ) {
            setTimeout(function () {
                descriptionMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Naslov može sadržati od 1 do 50 karaktera.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            descriptionMessage.css({ display: "none" });
        }

        // Book categories validation
        if (categoriesInput.val().length < 1) {
            setTimeout(function () {
                categoriesMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Odaberite bar jednu kategoriju kojoj pripada ova knjiga.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            categoriesMessage.css({ display: "none" });
        }

        // Book genres validation
        if (genresInput.val().length < 1) {
            setTimeout(function () {
                genresMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Odaberite bar jedan žanr kojem pripada ova knjiga.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            genresMessage.css({ display: "none" });
        }

        // Book authors validation
        if (authorsInput.val().length < 1) {
            setTimeout(function () {
                authorsMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Odaberite bar jednog autora koji je pisao ovu knjiga.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            authorsMessage.css({ display: "none" });
        }

        // Book publisher validation
        console.log(publisherInput.val());
        if (publisherInput.val().length < 1) {
            setTimeout(function () {
                publisherMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Odaberite bar jednog autora koji je pisao ovu knjiga.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            publisherMessage.css({ display: "none" });
        }

        // Book published year validation
        if (
            publishedAtInput.val() === null ||
            publishedAtInput.val() === undefined ||
            publishedAtInput.val() === false
        ) {
            setTimeout(function () {
                publishedAtMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else if (
            publishedAtInput.val() < 1800 ||
            publishedAtInput.val() > new Date().getFullYear()
        ) {
            setTimeout(function () {
                publishedAtMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Unesite validnu godinu izdavanja knjige.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            publishedAtMessage.css({ display: "none" });
        }

        // Book copies validation
        if (
            totalCopiesInput.val() === null ||
            totalCopiesInput.val() === undefined ||
            totalCopiesInput.val() === false
        ) {
            setTimeout(function () {
                copiesMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else if (totalCopiesInput.val() < 1 || totalCopiesInput.val() > 999) {
            setTimeout(function () {
                copiesMessage
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Unesite validan broj knjiga.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            copiesMessage.css({ display: "none" });
        }
    });

    // Disable inputs when maximum input range is reached
    titleInput.on("keypress", function (e) {
        if (titleInput.val().length >= 50) {
            e.preventDefault();
        }
    });

    descriptionInput.on("keypress", function (e) {
        if (descriptionInput.val().length >= 500) {
            e.preventDefault();
        }
    });

    publishedAtInput.on("keypress", function (e) {
        if (isNaN(e.key)) {
            e.preventDefault();
        }
    });

    totalCopiesInput.on("keypress", function (e) {
        if (isNaN(e.key)) {
            e.preventDefault();
        }
    });
});
