jQuery.noConflict();
jQuery("document").ready(function () {
    const table = jQuery("table#myTable");
    table.DataTable({
        length: 5,
        lengthMenu: [
            [5, 10, 20, 100, -1],
            [5, 10, 20, 100, "Sve"],
        ],

        language: {
            url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/sr-SP.json",
        },

        columnDefs: [
            {
                targets: [0, -1],
                searchable: true,
                orderable: false,
            },
        ],

        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    let that = this;

                    jQuery("input", this.footer()).on(
                        "keyup change clear",
                        function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        }
                    );
                });
        },
    });

    jQuery("#myTable tfoot th")
        .slice(1, -1)
        .each(function () {
            var title = jQuery(this).text();
            jQuery(this).html(
                '<input class="w-full h-10" type="text" placeholder="Pretražite..." />'
            );
        });
});
