let timeoutId;

// reservation autosave
$('#reservationDeadline').on('input propertychange change', function() {
    clearTimeout(timeoutId);
    setTimeout(function () {

        let value = $('#reservationDeadline').val();
        let id = $('#reservationPolicyId').val();

        // check if inputted value is empty
        if(value === '' || value === null || value === undefined || value === false) {
            return setTimeout(function () {
                $("#reservationMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
        }

        // check if inputted value is number and if inputted value is in allowed range (1-100)
        if(isNaN(value) || value < 1 || value > 100) {
            return setTimeout(function () {
                $("#reservationMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja mogže biti cijeli broj čija je vrijednost između 1 i 100.</p>');
            }, 200);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: "POST",
            url: "/settings/policies/" + id,
            data: $('#reservationDeadlineForm').serialize(),
            success:function(){
                setTimeout(function () {
                    $("#reservationMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-green-500 align-middle"><i class="fa fa-check text-green-500 mr-[5px] mt-[10px]"></i> Polje je uspješno izmijenjeno</p>');
                }, 200);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                setTimeout(function () {
                    $("#reservationMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-red-500"><i class="fa fa-times fa-check text-red-500 mr-[5px] mt-[10px]"></i> ' + xhr.responseJSON.message+'</p>');
                }, 200);
            }
        });


    }, 500);
});

// return autosave
$('#returnDeadline').on('input propertychange change', function() {
    clearTimeout(timeoutId);
    setTimeout(function() {
        const returnDeadlineInputEl = $('#returnDeadline');
        let value = returnDeadlineInputEl.val();

        // validation start

        // check if inputted value is empty
        if(value === '' || value === null || value === undefined || value === false) {
            return setTimeout(function () {
                $("#returnMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
        }

        // check if inputted value is number and if inputted value is in allowed range (1-100)
        if(isNaN(value) || value < 1 || value > 100) {
            return setTimeout(function () {
                $("#returnMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja mogže biti cijeli broj čija je vrijednost između 1 i 100.</p>');
            }, 200);
        }

        // validation end

        let id = $('#returnPolicyId').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: "POST",
            url: "/settings/policies/" + id,
            data: $('#returnDeadlineForm').serialize(),
            success:function(){
                setTimeout(function () {
                    $("#returnMessageByJs").css({"display":"block"}).html('<p class="text-green-500 align-middle"><i class="fa fa-check text-green-500 mr-[5px] mt-[10px]"></i> Polje je uspješno izmijenjeno</p>');
                }, 200);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                setTimeout(function () {
                    $("#returnMessageByJs").css({"display":"block"}).html('<p class="text-red-500"><i class="fa fa-times fa-check text-red-500 mr-[5px] mt-[10px]"></i> ' + xhr.responseJSON.message+'</p>');
                }, 200);
            }
        });


    }, 500);
});

// conflict autosave
$('#conflictDeadline').on('input propertychange change', function() {
    clearTimeout(timeoutId);
    setTimeout(function() {

        let value = $('#conflictDeadline').val();

        // check if inputted value is empty
        if(value === '' || value === null || value === undefined || value === false) {
            return setTimeout(function () {
                $("#conflictMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>');
            }, 200);
        }

        // check if inputted value is number and if inputted value is in allowed range (1-100)
        if(isNaN(value) || value < 1 || value > 100) {
            return setTimeout(function () {
                $("#conflictMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja mogže biti cijeli broj čija je vrijednost između 1 i 100.</p>');
            }, 200);
        }

        let id = $('#conflictPolicyId').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: "POST",
            url: "/settings/policies/" + id,
            data: $('#conflictDeadlineForm').serialize(),
            success:function(){
                setTimeout(function () {
                    $("#conflictMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-green-500 align-middle"><i class="fa fa-check text-green-500 mr-[5px] mt-[10px]"></i> Polje je uspješno izmijenjeno</p>');
                }, 200);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                setTimeout(function () {
                    $("#conflictMessageByJs").css({"display":"block", "max-width": "250px"}).html('<p class="text-red-500"><i class="fa fa-times fa-check text-red-500 mr-[5px] mt-[10px]"></i> ' + xhr.responseJSON.message+'</p>');
                }, 200);
            }
        });


    }, 500);
});
