jQuery(document).ready(function () {
    const profileDetailsBtn = jQuery("#profileDetailsBtn");
    const studentRecordsBtn = jQuery("#studentRecordsBtn");

    const profileDetailsSection = jQuery("#profileDetails");
    const studentRecordsSection = jQuery("#studentRecords");

    profileDetailsBtn.click(function (e) {
        profileDetailsSection.removeClass("hidden");
        studentRecordsSection.addClass("hidden");
        profileDetailsBtn.addClass("active-book-nav");
        studentRecordsBtn.removeClass("active-book-nav");
    });

    studentRecordsBtn.click(function (e) {
        profileDetailsSection.addClass("hidden");
        studentRecordsSection.removeClass("hidden");
        studentRecordsSection.addClass("flex");
        studentRecordsBtn.addClass("active-book-nav");
        profileDetailsBtn.removeClass("active-book-nav");
    });
});
