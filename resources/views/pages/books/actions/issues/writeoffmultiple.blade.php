@extends('app')

@section('page_title')
    Otpiši knjigu | {{ $book->title }}
@endsection


@section('page_content')
    <form class="mb-0" id="multiForma" action="{{ route('books.issues.writeoffmultiplebooks') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row bg-white py-2 px-2 mx-1 rounded">
            <div class="col">
                <div class="table-responsive">
                    <table id="myTableMulti1" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>
                                    @if (!$books->isEmpty())
                                        <input type="checkbox" id="checkAll" class="form-check-input">
                                    @endif
                                </th>
                                <th>Izdato učeniku</th>
                                <th>Datum izdavanja</th>
                                <th>Trenutno zadržavanje</th>
                                <th>Prekoračenje u danima</th>
                                <th>Knjigu izdao</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($books as $book)
                                <tr>
                                    <td><input type="checkbox" id="checkbox" name="id[]" value="{{ $book->id }}" class="form-check-input"></td>
                                    <td>{{ $book->student->name }}</td>
                                    <td> {{ \Carbon\Carbon::parse($book->activeAction->action_start)->format('d.m.Y') }}
                                    </td>
                                    <td>
                                        <x-current-holding start_date="{{ $book->activeAction->action_start }}"
                                            deadline_date="{{ $book->activeAction->action_deadline }}">
                                        </x-current-holding>
                                    </td>
                                    <td>
                                        <x-breached-days start_date="{{ $book->activeAction->action_start }}"
                                            deadline_date="{{ $book->activeAction->action_deadline }}">
                                        </x-breached-days>
                                    </td>
                                    <td>{{ $book->activeAction->librarian->name }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script>
        $("input#checkbox").click(function() {
            var checkbox = $('#myTableMulti1 tbody').find(':checkbox').length;
            var checked = $('#myTableMulti1 tbody').find(':checked').length
            console.log('checkbox', checkbox, 'checked', checked);
            if (checkbox === checked) {
                document.getElementById('checkAll').checked = true;
            } else {
                document.getElementById('checkAll').checked = false;
            }
            if ($(this).is(':checked')) {
                $('#submitbtn2').removeAttr('disabled')
            } else {
                if (checked === 0) {
                    $('#submitbtn2').attr('disabled', true)
                }
            }
        });

        $('#checkAll').click(function () {
            $('input#checkbox').prop('checked', this.checked);
            if ($(this).is(':checked')) {
                $('#submitbtn2').removeAttr('disabled')
            } else {
                $('#submitbtn2').attr('disabled', true)
            }
        });


        $('#myTableMulti1').DataTable({
            responsive: false,
            buttons: [{
                text: 'Otpiši knjigu',
                attr: {
                    id: 'submitbtn2',
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
@endsection
