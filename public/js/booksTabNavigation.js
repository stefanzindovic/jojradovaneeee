jQuery(document).ready(function () {
    const bookDetailsBtn = jQuery("#bookDetailsBtn");
    const bookSpecificationsBtn = jQuery("#bookSpecificationsBtn");
    const bookRecordBtn = jQuery("#bookRecordBtn");
    const bookMultimediaBtn = jQuery("#bookMultimediaBtn");

    const bookDetailsSection = jQuery("#addBookTab_Basics");
    const bookSpecificationsSection = jQuery("#addBookTab_Specifications");
    const bookRecordSection = jQuery("#addBookTab_Records");
    const bookMultimediaSection = jQuery("#addBookTab_Multimedia");

    bookDetailsBtn.click(function (e) {
        bookDetailsSection.removeClass("hidden");
        bookSpecificationsSection.addClass("hidden");
        bookRecordSection.addClass("hidden");
        bookMultimediaSection.addClass("hidden");

        bookDetailsBtn.addClass("active-book-nav");
        bookSpecificationsBtn.removeClass("active-book-nav");
        bookRecordBtn.removeClass("active-book-nav");
        bookMultimediaBtn.removeClass("active-book-nav");
    });

    bookSpecificationsBtn.click(function (e) {
        bookDetailsSection.addClass("hidden");
        bookSpecificationsSection.removeClass("hidden");
        bookRecordSection.addClass("hidden");
        bookMultimediaSection.addClass("hidden");

        bookDetailsBtn.removeClass("active-book-nav");
        bookSpecificationsBtn.addClass("active-book-nav");
        bookRecordBtn.removeClass("active-book-nav");
        bookMultimediaBtn.removeClass("active-book-nav");
    });

    bookMultimediaBtn.click(function (e) {
        bookDetailsSection.addClass("hidden");
        bookSpecificationsSection.addClass("hidden");
        bookRecordSection.addClass("hidden");
        bookMultimediaSection.removeClass("hidden");

        bookDetailsBtn.removeClass("active-book-nav");
        bookSpecificationsBtn.removeClass("active-book-nav");
        bookRecordBtn.removeClass("active-book-nav");
        bookMultimediaBtn.addClass("active-book-nav");
    });

    bookRecordBtn.click(function (e) {
        bookDetailsSection.addClass("hidden");
        bookSpecificationsSection.addClass("hidden");
        bookRecordSection.removeClass("hidden");
        bookMultimediaSection.addClass("hidden");

        bookDetailsBtn.removeClass("active-book-nav");
        bookSpecificationsBtn.removeClass("active-book-nav");
        bookRecordBtn.addClass("active-book-nav");
        bookMultimediaBtn.removeClass("active-book-nav");
    });
});
