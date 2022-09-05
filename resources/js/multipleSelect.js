jQuery(document).ready(function () {
    const select2Form = jQuery(".select2Form");

    select2Form.select2({
        theme: "classic",
        closeOnSelect: false,
        placeholder: "Odaberite opcije...",
    });
});
