jQuery(document).ready(function() {
    const nameInput = jQuery('#studentName');
    const jmbgInput = jQuery('#studentJmbg');
    const usernameInput = jQuery('#studentUsername');
    const emailInput = jQuery('#studentEmail');
    const passwordInput = jQuery('#studentPassword');
    const passwordInputConfirm = jQuery('#studentPasswordConfirm');

    const nameValidationMessage = jQuery('#studentNameValidationMessage');
    const jmbgValidationMessage = jQuery('#studentJmbgValidationMessage');
    const usernameValidationMessage = jQuery('#studentUsernameValidationMessage');
    const passwordValidationMessage = jQuery('#studentPasswordValidationMessage');
    const emailValidationMessage = jQuery('#studentEmailValidationMessage');

    const studentSubmitBtn = jQuery('#saveStudentBtn');

    studentSubmitBtn.on('click', function(e) {
        // Name validation
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
        } else if (!/^([a-zA-Z0-9\s])+$/.test(nameInput.val())) {
            setTimeout(function () {
                nameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja nije u korektnom formatu.</p>');
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                nameValidationMessage.css({"display": "none"});
            });
        }

        // JMBG validation
        if(jmbgInput.val() === null || jmbgInput.val() === undefined ||jmbgInput.val() === false || jmbgInput.val() === '') {
            setTimeout(function () {
                jmbgValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if(jmbgInput.val().length < 13 || jmbgInput.val().length > 13) {
            setTimeout(function () {
                jmbgValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Unesite validan JMBG.</p>');
            }, 200);
            e.preventDefault();
        } else if (!/^([0-9])+$/.test(jmbgInput.val())) {
            setTimeout(function () {
                jmbgValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Unesite validan JMBG.</p>');
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                jmbgValidationMessage.css({"display": "none"});
            });
        }

        // Username validation
        if(usernameInput.val() === null || usernameInput.val() === undefined ||usernameInput.val() === false || usernameInput.val() === '') {
            setTimeout(function () {
                usernameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if(usernameInput.val().length < 3 || usernameInput.val().length > 16) {
            setTimeout(function () {
                usernameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje može sadržati od 4 do 18 karaktera.</p>');
            }, 200);
            e.preventDefault();
        } else if (!/^([a-z0-9])+$/.test(usernameInput.val())) {
            setTimeout(function () {
                usernameValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Možete koristiti samo velika i mala slova.</p>');
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                usernameValidationMessage.css({"display": "none"});
            });
        }

        // Email validation
        if(emailInput.val() === null || emailInput.val() === undefined ||emailInput.val() === false || emailInput.val() === '') {
            setTimeout(function () {
                emailValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
            e.preventDefault();
        } else if (!/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(emailInput.val())) {
            setTimeout(function () {
                emailValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Unesite validnu e-mail adresu.</p>');
            }, 200);
            return e.preventDefault();
        } else {
            setTimeout(function () {
                emailValidationMessage.css({"display": "none"});
            });
        }

        // Password validation
        console.log(passwordInput.length);
        if(passwordInput.length > 0) {
            if(passwordInput.val() === null || passwordInput.val() === undefined ||passwordInput.val() === false || passwordInput.val() === '') {
                setTimeout(function () {
                    passwordValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
                }, 200);
                e.preventDefault();
            } else if (passwordInput.val().length < 8 || passwordInput.val().length > 24) {
                setTimeout(function () {
                    passwordValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Lozinka može sadržati između 8 i 24 karaktera.</p>');
                }, 200);
                return e.preventDefault();
            }else if (passwordInput.val() !== passwordInputConfirm.val()) {
                setTimeout(function () {
                    passwordValidationMessage.css({"display": "block"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Potvrda lozinke nije uspjela. Pokušajte ponovo.</p>');
                }, 200);
                return e.preventDefault();
            } else {
                setTimeout(function () {
                    passwordValidationMessage.css({"display": "none"});
                });
            }
        }
    });
});
