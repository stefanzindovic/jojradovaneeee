jQuery(document).ready(function () {
    const actionStartInput = jQuery("#datumRezervisanja");

    const studentIdValidation = jQuery("#studentIdValidation");
    const actionStartValidation = jQuery("#actionStartValidation");

    const reserveBookBtn = jQuery("#reserveBookBtn");

    reserveBookBtn.click(function (e) {
        // validate student id input
        if (
            element.value == "null"
        ) {
            setTimeout(function () {
                studentIdValidation
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odaberite učenika kojem želite da izdate ovu knjigu.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            studentIdValidation.css({ display: "none" });
        }

        // validate date input

        const selectedDate = new Date(actionStartInput.val());
        const currentDate = new Date();

        if (isNaN(selectedDate.getTime())) {
            setTimeout(function () {
                actionStartValidation
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odaberite datum za kada zelite da zakažete ovu rezervaciju.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            actionStartValidation.css({ display: "none" });
        }

        if (
            selectedDate.setHours(0, 0, 0, 0) < currentDate.setHours(0, 0, 0, 0)
        ) {
            setTimeout(function () {
                actionStartValidation
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odabrani datum ne može biti u prošlosti.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            actionStartValidation.css({ display: "none" });
        }
    });
});
