let timeoutId;

// reservation autosave
jQuery("#reservationDeadline").on("input propertychange change", function () {
    clearTimeout(timeoutId);
    setTimeout(function () {
        let value = jQuery("#reservationDeadline").val();
        let id = jQuery("#reservationPolicyId").val();

        // check if inputted value is empty
        if (
            value === "" ||
            value === null ||
            value === undefined ||
            value === false
        ) {
            return setTimeout(function () {
                jQuery("#reservationMessageByJs")
                    .css({ display: "block", "max-width": "250px" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                    );
            }, 200);
        }

        // check if inputted value is number and if inputted value is in allowed range (1-100)
        if (isNaN(value) || value < 1 || value > 100) {
            return setTimeout(function () {
                jQuery("#reservationMessageByJs")
                    .css({ display: "block", "max-width": "250px" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja mogže biti cijeli broj čija je vrijednost između 1 i 100.</p>'
                    );
            }, 200);
        }

        jQuery.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        jQuery.ajax({
            type: "POST",
            url: "/settings/policies/" + id,
            data: jQuery("#reservationDeadlineForm").serialize(),
            success: function () {
                setTimeout(function () {
                    jQuery("#reservationMessageByJs")
                        .css({ display: "block", "max-width": "250px" })
                        .html(
                            '<p class="text-green-500 align-middle"><i class="fa fa-check text-green-500 mr-[5px] mt-[10px]"></i> Polje je uspješno izmijenjeno</p>'
                        );
                }, 200);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                setTimeout(function () {
                    jQuery("#reservationMessageByJs")
                        .css({ display: "block", "max-width": "250px" })
                        .html(
                            '<p class="text-red-500"><i class="fa fa-times fa-check text-red-500 mr-[5px] mt-[10px]"></i> ' +
                                xhr.responseJSON.message +
                                "</p>"
                        );
                }, 200);
            },
        });
    }, 500);
});

// return autosave
jQuery("#returnDeadline").on("input propertychange change", function () {
    clearTimeout(timeoutId);
    setTimeout(function () {
        const returnDeadlineInputEl = jQuery("#returnDeadline");
        let value = returnDeadlineInputEl.val();

        // validation start

        // check if inputted value is empty
        if (
            value === "" ||
            value === null ||
            value === undefined ||
            value === false
        ) {
            return setTimeout(function () {
                jQuery("#returnMessageByJs")
                    .css({ display: "block", "max-width": "250px" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                    );
            }, 200);
        }

        // check if inputted value is number and if inputted value is in allowed range (1-100)
        if (isNaN(value) || value < 1 || value > 100) {
            return setTimeout(function () {
                jQuery("#returnMessageByJs")
                    .css({ display: "block", "max-width": "250px" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja mogže biti cijeli broj čija je vrijednost između 1 i 100.</p>'
                    );
            }, 200);
        }

        // validation end

        let id = jQuery("#returnPolicyId").val();

        jQuery.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        jQuery.ajax({
            type: "POST",
            url: "/settings/policies/" + id,
            data: jQuery("#returnDeadlineForm").serialize(),
            success: function () {
                setTimeout(function () {
                    jQuery("#returnMessageByJs")
                        .css({ display: "block" })
                        .html(
                            '<p class="text-green-500 align-middle"><i class="fa fa-check text-green-500 mr-[5px] mt-[10px]"></i> Polje je uspješno izmijenjeno</p>'
                        );
                }, 200);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                setTimeout(function () {
                    jQuery("#returnMessageByJs")
                        .css({ display: "block" })
                        .html(
                            '<p class="text-red-500"><i class="fa fa-times fa-check text-red-500 mr-[5px] mt-[10px]"></i> ' +
                                xhr.responseJSON.message +
                                "</p>"
                        );
                }, 200);
            },
        });
    }, 500);
});

// conflict autosave
jQuery("#conflictDeadline").on("input propertychange change", function () {
    clearTimeout(timeoutId);
    setTimeout(function () {
        let value = jQuery("#conflictDeadline").val();

        // check if inputted value is empty
        if (
            value === "" ||
            value === null ||
            value === undefined ||
            value === false
        ) {
            return setTimeout(function () {
                jQuery("#conflictMessageByJs")
                    .css({ display: "block", "max-width": "250px" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                    );
            }, 200);
        }

        // check if inputted value is number and if inputted value is in allowed range (1-100)
        if (isNaN(value) || value < 1 || value > 100) {
            return setTimeout(function () {
                jQuery("#conflictMessageByJs")
                    .css({ display: "block", "max-width": "250px" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja mogže biti cijeli broj čija je vrijednost između 1 i 100.</p>'
                    );
            }, 200);
        }

        let id = jQuery("#conflictPolicyId").val();

        jQuery.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        jQuery.ajax({
            type: "POST",
            url: "/settings/policies/" + id,
            data: jQuery("#conflictDeadlineForm").serialize(),
            success: function () {
                setTimeout(function () {
                    jQuery("#conflictMessageByJs")
                        .css({ display: "block", "max-width": "250px" })
                        .html(
                            '<p class="text-green-500 align-middle"><i class="fa fa-check text-green-500 mr-[5px] mt-[10px]"></i> Polje je uspješno izmijenjeno</p>'
                        );
                }, 200);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                setTimeout(function () {
                    jQuery("#conflictMessageByJs")
                        .css({ display: "block", "max-width": "250px" })
                        .html(
                            '<p class="text-red-500"><i class="fa fa-times fa-check text-red-500 mr-[5px] mt-[10px]"></i> ' +
                                xhr.responseJSON.message +
                                "</p>"
                        );
                }, 200);
            },
        });
    }, 500);
});

// max books per user autosave
jQuery("#maxBooksPerUser").on("input propertychange change", function () {
    clearTimeout(timeoutId);
    setTimeout(function () {
        let value = jQuery("#maxBooksPerUser").val();
        console.log(value);

        // check if inputted value is empty
        if (
            value === "" ||
            value === null ||
            value === undefined ||
            value === false
        ) {
            return setTimeout(function () {
                jQuery("#maxBooksPerUserMessageByJs")
                    .css({ display: "block", "max-width": "250px" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Polje ne može biti prazno.</p>'
                    );
            }, 200);
        }

        // check if inputted value is number and if inputted value is in allowed range (1-100)
        if (isNaN(value) || value < 1 || value > 5) {
            return setTimeout(function () {
                jQuery("#maxBooksPerUserMessageByJs")
                    .css({ display: "block", "max-width": "250px" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red-500 mr-[5px] mt-[10px]"></i> Vrijednost polja može biti cijeli broj čija je vrijednost između 1 i 5.</p>'
                    );
            }, 200);
        }

        let id = jQuery("#maxBooksPerUserPolicyId").val();

        jQuery.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        jQuery.ajax({
            type: "POST",
            url: "/settings/policies/" + id,
            data: jQuery("#maxBooksPerUserForm").serialize(),
            success: function () {
                setTimeout(function () {
                    jQuery("#maxBooksPerUserMessageByJs")
                        .css({ display: "block", "max-width": "250px" })
                        .html(
                            '<p class="text-green-500 align-middle"><i class="fa fa-check text-green-500 mr-[5px] mt-[10px]"></i> Polje je uspješno izmijenjeno</p>'
                        );
                }, 200);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                setTimeout(function () {
                    jQuery("#maxBooksPerUserMessageByJs")
                        .css({ display: "block", "max-width": "250px" })
                        .html(
                            '<p class="text-red-500"><i class="fa fa-times fa-check text-red-500 mr-[5px] mt-[10px]"></i> ' +
                                xhr.responseJSON.message +
                                "</p>"
                        );
                }, 200);
            },
        });
    }, 500);
});

// multiple book copies per user autosave
jQuery("#multipleBookCopiesPerUser").on(
    "input propertychange change",
    function () {
        clearTimeout(timeoutId);
        setTimeout(function () {
            let isChecked = jQuery("#multipleBookCopiesPerUser")[0].checked;
            let value = 1;

            // set value based on isChecked
            if (isChecked) {
                value = 2;
            }

            // set value to checkbox
            let data = jQuery(
                "#multipleBookCopiesPerUserForm"
            ).serializeArray();
            data.push({ name: "value5", value });

            let id = jQuery("#multipleBookCopiesPerUserPolicyId").val();

            jQuery.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            jQuery.ajax({
                type: "POST",
                url: "/settings/policies/" + id,
                data: data,
                success: function () {
                    setTimeout(function () {
                        jQuery("#multipleBookCopiesPerUserMessageByJs")
                            .css({ display: "block", "max-width": "250px" })
                            .html(
                                '<p class="text-green-500 align-middle"><i class="fa fa-check text-green-500 mr-[5px] mt-[10px]"></i> Polje je uspješno izmijenjeno</p>'
                            );
                    }, 200);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    setTimeout(function () {
                        jQuery("#multipleBookCopiesPerUserMessageByJs")
                            .css({ display: "block", "max-width": "250px" })
                            .html(
                                '<p class="text-red-500"><i class="fa fa-times fa-check text-red-500 mr-[5px] mt-[10px]"></i> ' +
                                    xhr.responseJSON.message +
                                    "</p>"
                            );
                    }, 200);
                },
            });
        }, 500);
    }
);
