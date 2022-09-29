jQuery(document).ready(function () {
    var notyf = new Notyf();
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
    const formatInput = jQuery("#bookFormat");
    const coverInput = jQuery("#bookCover");
    const languageInput = jQuery("#bookLanguage");
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
    const languageMessage = jQuery("#bookLanguageValidationMessage");

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
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
               notyf.error('Naslov knjige ne može biti prazan');
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
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Naslov može sadržati od 1 do 50 karaktera.</small>'
                    );
               notyf.error('Naslov knjige može sadržati od 1 do 50 karaktera.');
            }, 200);
            e.preventDefault();
        } else {
            titleMessage.css({ display: "none" });
        }

        // Book description validation
        console.log(descriptionInput.val() !== null);
        if (
            descriptionInput.val() !== "" &&
            descriptionInput.val() !== null &&
            descriptionInput.val() !== undefined &&
            descriptionInput.val() !== false &&
            descriptionInput.val().length > 0
        ) {
            if (
                descriptionInput.val().length < 10 ||
                descriptionInput.val().length > 2048
            ) {
                setTimeout(function () {
                    descriptionMessage
                        .css({ display: "block" })
                        .html(
                            '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Opis može sadržati od 10 do 2048 karaktera.</small>'
                        );
                   notyf.error('Opis može sadržati od 10 do 2048 karaktera.');
                }, 200);
                e.preventDefault();
            } else {
                descriptionMessage.css({ display: "none" });
            }
        }

        // Book categories validation
        if (categoriesInput.val().length < 1) {
            setTimeout(function () {
                categoriesMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odaberite bar jednu kategoriju kojoj pripada ova knjiga.</small>'
                    );
               notyf.error('Odaberite bar jednu kategoriju kojoj pripada ova knjiga.');
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
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odaberite bar jedan žanr kojem pripada ova knjiga.</small>'
                    );
               notyf.error('Odaberite bar jedan žanr kojem pripada ova knjiga.');
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
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odaberite bar jednog autora koji je pisao ovu knjiga.</small>'
                    );
               notyf.error('Odaberite bar jednog autora koji je pisao ovu knjiga.');
            }, 200);
            e.preventDefault();
        } else {
            authorsMessage.css({ display: "none" });
        }

        // Book publisher validation
        console.log(coverInput.val());
        if (publisherInput.val().length < 1) {
            setTimeout(function () {
                publisherMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odaberite izdavača ove knjige.</small>'
                    );
               notyf.error('Odaberite izdavača ove knjige.');
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
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
               notyf.error('Odaberite godinu izdavanja');
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
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Unesite validnu godinu izdavanja knjige.</small>'
                    );
               notyf.error('Unesite validnu godinu izdavanja ove knjige.');
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
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
               notyf.error('Količina knjiga ne može biti prazna.');
            }, 200);
            e.preventDefault();
        } else if (totalCopiesInput.val() < 1 || totalCopiesInput.val() > 999) {
            setTimeout(function () {
                copiesMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Unesite validan broj knjiga.</small>'
                    );
               notyf.error('Unesite validan broj knjiga.');
            }, 200);
            e.preventDefault();
        } else {
            copiesMessage.css({ display: "none" });
        }

        // Book pages validation
        if (
            totalPagesInput.val() === null ||
            totalPagesInput.val() === undefined ||
            totalPagesInput.val() === false
        ) {
            setTimeout(function () {
                pagesMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
               notyf.error('Broj stranica ne može biti prazan');
            }, 200);
            e.preventDefault();
        } else if (totalPagesInput.val() < 1 || totalPagesInput.val() > 2000) {
            setTimeout(function () {
                pagesMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Unesite validan broj knjiga.</small>'
                    );
               notyf.error('Unesite validan broj stranica.');
            }, 200);
            e.preventDefault();
        } else {
            pagesMessage.css({ display: "none" });
        }

        // Book script validation
        if (scriptInput.val().length < 1) {
            setTimeout(function () {
                scriptMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Izaberite pismo kojim je ova knjiga napisana.</small>'
                    );
               notyf.error('Izaberite pismo kojim je ova knjiga napisana.');
            }, 200);
            e.preventDefault();
        } else {
            scriptMessage.css({ display: "none" });
        }

        // Book cover validation
        if (coverInput.val().length < 1) {
            setTimeout(function () {
                coverMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Izaberite vrstu poveza ove knjige</small>'
                    );
               notyf.error('Izaberite vrstu poveza ove knjige');
            }, 200);
            e.preventDefault();
        } else {
            coverMessage.css({ display: "none" });
        }

        // Book format validation
        if (languageInput.val().length < 1) {
            setTimeout(function () {
                languageMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Izaberite vrstu formata ove knjige</small>'
                    );
               notyf.error('Izaberite vrstu formata ove knjige.');
            }, 200);
            e.preventDefault();
        } else {
            languageMessage.css({ display: "none" });
        }

        // Book language validation
        if (formatInput.val().length < 1) {
            setTimeout(function () {
                formatMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Izaberite jezik na kojem je knjiga napisana.</small>'
                    );
               notyf.error('Izaberite jezik na kojem je knjiga napisana.');
            }, 200);
            e.preventDefault();
        } else {
            formatMessage.css({ display: "none" });
        }

        // Book isbn validation
        if (
            isbnInput.val() === null ||
            isbnInput.val() === undefined ||
            isbnInput.val() === false
        ) {
            setTimeout(function () {
                isbnMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
               notyf.error('ISBN ne može biti prazan.');
            }, 200);
            e.preventDefault();
        } else if (isbnInput.val().length < 13 || isbnInput.val().length > 13) {
            setTimeout(function () {
                isbnMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Unesite validan ISBN kod.</small>'
                    );
               notyf.error('Unesite validan ISBN kod.');
            }, 200);
            e.preventDefault();
        } else {
            isbnMessage.css({ display: "none" });
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

    totalPagesInput.on("keypress", function (e) {
        if (isNaN(e.key)) {
            e.preventDefault();
        }
    });

    isbnInput.on("keypress", function (e) {
        if (isNaN(e.key) || isbnInput.val().length >= 13) {
            e.preventDefault();
        }
    });
});
