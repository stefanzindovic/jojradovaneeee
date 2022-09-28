function checkPasswordMatchRegister() {
    var password = $("#password").val();
    var confirmPassword = $("#password_confirm").val();

    if(password.length >= 8 || confirmPassword.length >= 8){
        if (password != confirmPassword) {
            $("#passwordMessage").html("Lozinke se ne poklapaju!");
            $("#passwordMessage").css('display','flex');
            $("#submitDugme").prop("disabled", true);
            return false;
        } else {
            $("#passwordMessage").css('display','none');
            $("#passwordMessage").removeClass('d-flex');
            $("#submitDugme").prop("disabled", false);
            return true;
        }
    }
    else{
        $("#submitDugme").prop("disabled", true);
        $("#passwordMessage").html("Lozinka treba da sadrži više od 8 karaktera!");
        $("#passwordMessage").addClass("d-flex");
    }
}
