jQuery(document).ready(function () {
    const nameInput = jQuery("#librarianName");
    const jmbgInput = jQuery("#librarianJmbg");
    const usernameInput = jQuery("#librarianUsername");
    const emailInput = jQuery("#librarianEmail");
    const passwordInput = jQuery("#librarianPassword");
    const passwordInputConfirm = jQuery("#librarianPasswordConfirm");

    const nameValidationMessage = jQuery("#librarianNameValidationMessage");
    const jmbgValidationMessage = jQuery("#librarianJmbgValidationMessage");
    const usernameValidationMessage = jQuery(
        "#librarianUsernameValidationMessage"
    );
    const passwordValidationMessage = jQuery(
        "#librarianPasswordValidationMessage"
    );
    const emailValidationMessage = jQuery("#librarianEmailValidationMessage");

    const librarianSubmitBtn = jQuery("#savelibrarianBtn");

    librarianSubmitBtn.on("click", function (e) {
        // Name validation
        if (
            nameInput.val() === null ||
            nameInput.val() === undefined ||
            nameInput.val() === false ||
            nameInput.val() === ""
        ) {
            setTimeout(function () {
                nameValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
            }, 200);
            e.preventDefault();
        } else if (nameInput.val().length < 4 || nameInput.val().length > 50) {
            setTimeout(function () {
                nameValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Vrijednost polja može sadržati od 4 do 50 karaktera.</small>'
                    );
            }, 200);
            e.preventDefault();
        } else if (!/^([a-zA-Z0-9\s])+$/.test(nameInput.val())) {
            setTimeout(function () {
                nameValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Vrijednost polja nije u korektnom formatu.</small>'
                    );
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                nameValidationMessage.css({ display: "none" });
            });
        }

        // JMBG validation
        if (
            jmbgInput.val() === null ||
            jmbgInput.val() === undefined ||
            jmbgInput.val() === false ||
            jmbgInput.val() === ""
        ) {
            setTimeout(function () {
                jmbgValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
            }, 200);
            e.preventDefault();
        } else if (jmbgInput.val().length < 13 || jmbgInput.val().length > 13) {
            setTimeout(function () {
                jmbgValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Unesite validan JMBG.</small>'
                    );
            }, 200);
            e.preventDefault();
        } else if (!/^([0-9])+$/.test(jmbgInput.val())) {
            setTimeout(function () {
                jmbgValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Unesite validan JMBG.</small>'
                    );
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                jmbgValidationMessage.css({ display: "none" });
            });
        }

        // Username validation
        if (
            usernameInput.val() === null ||
            usernameInput.val() === undefined ||
            usernameInput.val() === false ||
            usernameInput.val() === ""
        ) {
            setTimeout(function () {
                usernameValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
            }, 200);
            e.preventDefault();
        } else if (
            usernameInput.val().length < 3 ||
            usernameInput.val().length > 16
        ) {
            setTimeout(function () {
                usernameValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje može sadržati od 4 do 18 karaktera.</small>'
                    );
            }, 200);
            e.preventDefault();
        } else if (!/^([a-z0-9])+$/.test(usernameInput.val())) {
            setTimeout(function () {
                usernameValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Možete koristiti samo velika i mala slova.</small>'
                    );
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                usernameValidationMessage.css({ display: "none" });
            });
        }

        // Email validation
        if (
            emailInput.val() === null ||
            emailInput.val() === undefined ||
            emailInput.val() === false ||
            emailInput.val() === ""
        ) {
            setTimeout(function () {
                emailValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                    );
            }, 200);
            e.preventDefault();
        } else if (
            !/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
                emailInput.val()
            )
        ) {
            setTimeout(function () {
                emailValidationMessage
                    .css({ display: "block" })
                    .html(
                        '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Unesite validnu e-mail adresu.</small>'
                    );
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                emailValidationMessage.css({ display: "none" });
            });
        }

        // Password validation
        if (passwordInput.length > 0) {
            if (
                passwordInput.val() === null ||
                passwordInput.val() === undefined ||
                passwordInput.val() === false ||
                passwordInput.val() === ""
            ) {
                setTimeout(function () {
                    passwordValidationMessage
                        .css({ display: "block" })
                        .html(
                            '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Polje ne može biti prazno.</small>'
                        );
                }, 200);
                e.preventDefault();
            } else if (
                passwordInput.val().length < 8 ||
                passwordInput.val().length > 24
            ) {
                setTimeout(function () {
                    passwordValidationMessage
                        .css({ display: "block" })
                        .html(
                            '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Lozinka može sadržati između 8 i 24 karaktera.</small>'
                        );
                }, 200);
                return e.preventDefault();
            } else if (passwordInput.val() !== passwordInputConfirm.val()) {
                setTimeout(function () {
                    passwordValidationMessage
                        .css({ display: "block" })
                        .html(
                            '<small class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Potvrda lozinke nije uspjela. Pokušajte ponovo.</small>'
                        );
                }, 200);
                return e.preventDefault();
            } else {
                setTimeout(function () {
                    passwordValidationMessage.css({ display: "none" });
                });
            }
        }
    });

    jmbgInput.on("keypress", function (e) {
        if (
            e.keyCode !== 49 &&
            e.keyCode !== 50 &&
            e.keyCode !== 51 &&
            e.keyCode !== 52 &&
            e.keyCode !== 53 &&
            e.keyCode !== 54 &&
            e.keyCode !== 55 &&
            e.keyCode !== 56 &&
            e.keyCode !== 57 &&
            e.keyCode !== 48
        ) {
            e.preventDefault();
        }
    });
});
