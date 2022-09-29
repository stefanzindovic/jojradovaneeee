jQuery(document).ready(function () {
    const actionStartInput = jQuery("#datumIzdavanja");

    const studentIdValidation = jQuery("#studentIdValidation");
    const actionStartValidation = jQuery("#actionStartValidation");

    const issueBookBtn = jQuery("#issueBookBtn");

    issueBookBtn.click(function (e) {
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

        let minAllowedDate = new Date();
        minAllowedDate.setDate(minAllowedDate.getDate() - 1);

        if (isNaN(selectedDate.getTime())) {
            setTimeout(function () {
                actionStartValidation
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odaberite datum kada je knjiga izdata.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            actionStartValidation.css({ display: "none" });
        }
        console.log(
            selectedDate.setHours(0, 0, 0, 0) <
                minAllowedDate.setHours(0, 0, 0, 0),
            selectedDate.setHours(0, 0, 0, 0),
            minAllowedDate.setHours(0, 0, 0, 0)
        );
        if (
            selectedDate.setHours(0, 0, 0, 0) <
                minAllowedDate.setHours(0, 0, 0, 0) ||
            selectedDate.setHours(0, 0, 0, 0) > currentDate.setHours(0, 0, 0, 0)
        ) {
            setTimeout(function () {
                actionStartValidation
                    .css({ display: "block" })
                    .html(
                        '<p class="text-red-500 align-middle"><i class="fa fa-times text-red"></i> Odabrani datum može današnji ili jučerašnji.</p>'
                    );
            }, 200);
            e.preventDefault();
        } else {
            actionStartValidation.css({ display: "none" });
        }
    });
});
