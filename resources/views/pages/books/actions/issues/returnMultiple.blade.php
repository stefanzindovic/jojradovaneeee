@extends('app')

@section('page_title')
    Vrati Knjigu
@endsection


@section('page_content')
    <form class="mb-0" id="multiForma" action="#" method="POST">
        @csrf
        @method('PATCH')
        <div class="row bg-white py-2 px-2 mx-1 rounded">
            <div class="col">
                <div class="table-responsive">
                    <table id="myTableMulti" class="table" style="width:100%">
                        <thead>
                        <tr>
                            <input type="checkbox" id="checkAll">
                            <th>Izdato učeniku</th>
                            <th>Datum izdavanja</th>
                            <th>Trenutno zadržavanje</th>
                            <th>Prekoračenje u danima</th>
                            <th>Knjigu izdao</th>
                        </tr>
                        </thead>
                        <tbody class="align-middle">
                            <td><input type="checkbox" id="checkAll"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')

    <script>
        $('#myTableMulti').DataTable({
            responsive: true,
            buttons: [{
                text: 'Vrati knjigu',
                attr: {
                    id: 'submitbtn',
                    disabled: true
                },
                className: 'btn btn-primary',
                action: function(e, dt, node, config) {
                    $('form#multiForma').submit();
                }
            }, ],
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }],
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'p>>",
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/sr-SP.json",
            },
        });
    </script>
    <script>
        $("#checkbox").change(function() {
            var ischecked = $(this).is(':checked');
            if (ischecked) {
                $('#submitbtn').removeAttr('disabled')
            } else {
                $('#submitbtn').attr('disabled', true)
            }
        });

        $("#checkAll").click(function() {
            $('#checkbox').not(this).prop('checked', this.checked);
            var ischecked = $(this).is(':checked');
            if (ischecked) {
                $('#submitbtn').removeAttr('disabled')
            } else {
                $('#submitbtn').attr('disabled', true)
            }
        });
    </script>

@endsection
