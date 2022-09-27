jQuery(document).ready(function () {
    // Sections
    const issuedBooksRecordsSection = jQuery("#issuedBooks_Records");
    const returnedBooksRecordsSection = jQuery("#returnedBooks_Records");
    const deadlineBooksRecordsSection = jQuery("#deadlineBooks_Records");
    const reservedBooksRecordsSection = jQuery("#reservedBooks_Records");
    const archivedReservationsBooksRecordsSection = jQuery(
        "#archivedReservationsBooks_Records"
    );

    // Btns
    const issuedBooksRecordsBtn = jQuery("#issuedBooks_Btn");
    const returnedBooksRecordsBtn = jQuery("#returnedBooks_Btn");
    const deadlineBooksRecordsBtn = jQuery("#deadlineBooks_Btn");
    const reservedBooksRecordsBtn = jQuery("#reservedBooks_Btn");
    const archivedReservationsBooksRecordsBtn = jQuery(
        "#archivedReservationsBooks_Btn"
    );

    issuedBooksRecordsBtn.click(function (e) {
        issuedBooksRecordsSection.removeClass("hidden");
        returnedBooksRecordsSection.addClass("hidden");
        deadlineBooksRecordsSection.addClass("hidden");
        reservedBooksRecordsSection.addClass("hidden");
        archivedReservationsBooksRecordsSection.addClass("hidden");
    });

    returnedBooksRecordsBtn.click(function (e) {
        issuedBooksRecordsSection.addClass("hidden");
        returnedBooksRecordsSection.removeClass("hidden");
        deadlineBooksRecordsSection.addClass("hidden");
        reservedBooksRecordsSection.addClass("hidden");
        archivedReservationsBooksRecordsSection.addClass("hidden");
    });

    deadlineBooksRecordsBtn.click(function (e) {
        issuedBooksRecordsSection.addClass("hidden");
        returnedBooksRecordsSection.addClass("hidden");
        deadlineBooksRecordsSection.removeClass("hidden");
        reservedBooksRecordsSection.addClass("hidden");
        archivedReservationsBooksRecordsSection.addClass("hidden");
    });

    reservedBooksRecordsBtn.click(function (e) {
        issuedBooksRecordsSection.addClass("hidden");
        returnedBooksRecordsSection.addClass("hidden");
        deadlineBooksRecordsSection.addClass("hidden");
        reservedBooksRecordsSection.removeClass("hidden");
        archivedReservationsBooksRecordsSection.addClass("hidden");
    });

    archivedReservationsBooksRecordsBtn.click(function (e) {
        issuedBooksRecordsSection.addClass("hidden");
        returnedBooksRecordsSection.addClass("hidden");
        deadlineBooksRecordsSection.addClass("hidden");
        reservedBooksRecordsSection.addClass("hidden");
        archivedReservationsBooksRecordsSection.removeClass("hidden");
    });
});
