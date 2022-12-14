@extends('app')

@section('page_title')
    {{ $book->title }} | Izdaj
@endsection

@section('interaction')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group ms-2 me-2">
            <a href="{{ route('books.issues.returnmultiple', $book->id) }}" type="button" class="btn btn-sm btn-outline-primary">Otpiši</a>
            <a href="{{route('books.issues.returnmultiple', $book->id)}}" type="button" class="btn btn-sm btn-outline-primary">Vrati</a>
            <a href="{{ route('books.reservations.reservePage', $book->id) }}" type="button" class="btn btn-sm btn-outline-primary">Rezerviši</a>

        </div>
    </div>

@endsection

@section('page_content')
    <div class="card card-body border-0 shadow mb-4">
        <div class="row">
            <div class="col-md-4 border-end">
                <div class="row pb-5">
                    <div class="col-auto">
                        <img style="height: 110px;width: 80px" src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif" alt="">
                    </div>
                    <div class="col-auto ps-0">
                        <h2>{{$book->title}}</h2>
                        <p>{!! Str::limit($book->description, 25)!!}</p>
                    </div>
                    <div class="row pt-2">
                        <span class="text-gray">
                            <p class="text-sm">
                                @foreach ($book->authors as $author)
                                    {{ $author->full_name }} @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <form method="POST" action="{{ route('books.issues.issue', $book->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Izaberi ucenika koji zaduzuje knjigu <span class="text-red">*</span></label>
                        <select class="form-control" id="multi" name="student_id" id="ucenikIzdavanje">
                            <option value="null" selected>Izaberite ucenika</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" @if (old('student_id') == $student->id) selected @endif>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                        <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times text-red"></i>
                            {{ $message }}</p>
                        @enderror
                        <div id="studentIdValidation"></div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Datum izdavanja <span class="text-red">*</span></label>
                                <input
                                    type="date" name="action_start" id="datumIzdavanja"
                                    min="{{ \Carbon\Carbon::now()->subDay()->format('Y-m-d') }}"
                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                    value="{{ old('action_start', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                    class="form-control"
                                    onchange="funkcijaDatumVracanja();" />
                                @error('action_start')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times"></i>
                                    {{ $message }}</p>
                                @enderror
                                <div id="actionStartValidation"></div>
                            </div>
                            <div class="col">
                                <label class="form-label">Datum vraćanja <span class="text-red">*</span></label>
                                <input type="text" id="datumVracanja"
                                       value="{{ old('action_deadline',\Carbon\Carbon::now()->addDays($policy->value)->format('d/m/Y')) }}"
                                       class="form-control"
                                       name="action_deadline" readonly />
                                <p>Rok vracanja: {{ $policy->value }} dana</p>
                            </div>
                        </div>
                    </div>
                    <input name="book_id" type="number" value="{{ $book->id }}" hidden>
                    <div class="float-end">
                        <button class="btn btn-outline-danger" type="reset">Poništi</button>
                        <button id="issueBookBtn" type="submit" class="btn btn-primary">Izdaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const element = document.querySelector('#multi');
        const choices = new Choices(element);

        function funkcijaDatumVracanja() {
            var selectedDate = new Date(jQuery('#datumIzdavanja').val());
            var oldDate = selectedDate;
            var numberOfDaysToAdd = {{ $policy->value }};

            selectedDate.setDate(selectedDate.getDate() + numberOfDaysToAdd);

            var day = selectedDate.getDate();
            var month = selectedDate.getMonth() + 1;
            var year = selectedDate.getFullYear();

            var newDate = [day, month, year].join('/');

            document.getElementById('datumVracanja').value = newDate;
        }
    </script>
@endsection
