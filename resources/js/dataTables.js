jQuery.noConflict();
jQuery('document').ready(function () {
    const table = jQuery('#myTable');
    table.DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/sr-SP.json',
        }
    });
});
