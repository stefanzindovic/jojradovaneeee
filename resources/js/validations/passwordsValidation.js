jQuery(document).ready(function () {
    const passwordInput = jQuery("#newPassword");
    const passwordConfirmationInput = jQuery("#newPasswordConfirmation");

    const passwordValidationMessage = jQuery("#passwordValidationMessage");

    const savePasswordBtn = jQuery("#savePasswordBtn");

    savePasswordBtn.click(function (e) {
        // Password validation
        if (passwordInput.length > 0) {
            if (
                passwordInput.val() === null ||
                passwordInput.val() === undefined ||
                passwordInput.val() === false ||
                passwordInput.val() === ""
            ) {
                passwordInput.val(null);
                passwordConfirmationInput.val(null);
                setTimeout(function () {
                    passwordInput.val(null);
                    passwordValidationMessage
                        .css({ display: "block" })
                        .html(
                            '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                        );
                }, 200);
                e.preventDefault();
            } else if (
                passwordInput.val().length < 8 ||
                passwordInput.val().length > 24
            ) {
                passwordInput.val(null);
                passwordConfirmationInput.val(null);
                setTimeout(function () {
                    passwordValidationMessage
                        .css({ display: "block" })
                        .html(
                            '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Lozinka može sadržati između 8 i 24 karaktera.</p>'
                        );
                }, 200);
                return e.preventDefault();
            } else if (
                passwordInput.val() !== passwordConfirmationInput.val()
            ) {
                passwordInput.val(null);
                passwordConfirmationInput.val(null);
                setTimeout(function () {
                    passwordValidationMessage
                        .css({ display: "block" })
                        .html(
                            '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Potvrda lozinke nije uspjela. Pokušajte ponovo.</p>'
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
});
