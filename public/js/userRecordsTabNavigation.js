jQuery(document).ready(function () {
    const issuedBooksBtn = jQuery("#issuedBooksBtn");
    const returnedBooksBtn = jQuery("#returnedBooksBtn");
    const breachedBooksBtn = jQuery("#breachedBooksBtn");
    const reservationsBooksBtn = jQuery("#reservationsBooksBtn");
    const archivedBooksBtn = jQuery("#archivedBooksBtn");

    const issuedBooksSection = jQuery("#studentRecords_Issued");
    const returnedBooksSection = jQuery("#studentRecords_Returned");
    const breachedBooksSection = jQuery("#studentRecords_Breached");
    const reservationsBooksSection = jQuery("#studentRecords_Reservations");
    const archivedBooksSection = jQuery("#studentRecords_Archived");

    issuedBooksBtn.click(function (e) {
        issuedBooksSection.removeClass("hidden");
        returnedBooksSection.addClass("hidden");
        breachedBooksSection.addClass("hidden");
        reservationsBooksSection.addClass("hidden");
        archivedBooksSection.addClass("hidden");
    });
    returnedBooksBtn.click(function (e) {
        issuedBooksSection.addClass("hidden");
        returnedBooksSection.removeClass("hidden");
        breachedBooksSection.addClass("hidden");
        reservationsBooksSection.addClass("hidden");
        archivedBooksSection.addClass("hidden");
    });
    breachedBooksBtn.click(function (e) {
        issuedBooksSection.addClass("hidden");
        returnedBooksSection.addClass("hidden");
        breachedBooksSection.removeClass("hidden");
        reservationsBooksSection.addClass("hidden");
        archivedBooksSection.addClass("hidden");
    });
    reservationsBooksBtn.click(function (e) {
        issuedBooksSection.addClass("hidden");
        returnedBooksSection.addClass("hidden");
        breachedBooksSection.addClass("hidden");
        reservationsBooksSection.removeClass("hidden");
        archivedBooksSection.addClass("hidden");
    });
    archivedBooksBtn.click(function (e) {
        issuedBooksSection.addClass("hidden");
        returnedBooksSection.addClass("hidden");
        breachedBooksSection.addClass("hidden");
        reservationsBooksSection.addClass("hidden");
        archivedBooksSection.removeClass("hidden");
    });
});
