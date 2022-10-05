@extends('app')

@section('page_title')
    Aktivnosti
@endsection

@section('page_content')
    <div class="row pb-2">
        <div class="col">
            <div class="card notification-card border-0 shadow">
                <div class="card-header">
                    <form action="" method="GET">
                        <div class="row">
                            <small>Filteri</small>
                            <div class="col-md-3 pb-1">
                                <label for="bibliotekari">Izaberite učenika</label>
                                <select onchange="this.form.submit()" multiple class="form-control" id="ucenici"
                                    name="student_id[]" multiple>
                                    @foreach ($students as $student)
                                        <option
                                            @if (request()->filled('student_id')) @foreach (request()->student_id as $key => $value)
                                            @if ($value == $student->id)
                                                selected @endif
                                            @endforeach
                                    @endif
                                    value="{{ $student->id }}">
                                    {{ $student->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pb-1">
                                <label for="bibliotekari">Izaberite bibliotekara</label>
                                <select onchange="this.form.submit()" multiple class="form-control" id="bibliotekari"
                                    name="librarian_id[]" multiple>
                                    @foreach ($librarians as $librarian)
                                        <option
                                            @if (request()->filled('librarian_id')) @foreach (request()->librarian_id as $key => $value)
                                            @if ($value == $librarian->id)
                                                selected @endif
                                            @endforeach
                                    @endif value="{{ $librarian->id }}">{{ $librarian->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pb-1">
                                <label for="bibliotekari">Izaberite knjigu</label>
                                <select onchange="this.form.submit()" class="form-control" id="knjige" name="book_id[]"
                                    multiple>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}"
                                            @if (request()->filled('book_id')) @foreach (request()->book_id as $key => $value)
                                            @if ($value == $book->id)
                                                selected @endif
                                            @endforeach
                                    @endif>{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pb-1">
                                <label for="bibliotekari">Izaberite transakciju</label>
                                <select onchange="this.form.submit()" class="form-control" id="transakcije"
                                    name="action_id[]" multiple>
                                    @foreach ($actions as $action)
                                        <option value="{{ $action->id }}"
                                            @if (request()->filled('action_id')) @foreach (request()->action_id as $key => $value)
                                            @if ($value == $action->id)
                                                selected @endif
                                            @endforeach
                                    @endif>{{ $action->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush list-group-timeline">
                        @if ($activities->count() > 0)
                            @foreach ($activities as $activity)
                                <div class="list-group-item border-0">
                                    <div class="row ps-lg-1">
                                        <div class="col-auto z-0">
                                            <div class="icon-shape icon-xs icon-shape-success rounded">
                                                @if ($activity->action_status_id == 1 ||
                                                    $activity->action_status_id == 3 ||
                                                    $activity->action_status_id == 4 ||
                                                    $activity->action_status_id == 7 ||
                                                    $activity->action_status_id == 8)
                                                    <img src="{{ $activity->librarian->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . $activity->librarian->picture) : asset('imgs/' . $activity->librarian->picture) }}"
                                                        alt="">
                                                @elseif($activity->action_status_id == 2 || $activity->action_status_id == 9)
                                                    <img src="{{ $activity->book->student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/students/' . $activity->book->student->picture) : asset('imgs/' . $activity->book->student->picture) }}"
                                                        alt="">
                                                @elseif($activity->action_status_id == 5 || $activity->action_status_id == 6)
                                                    <img src="{{ $activity->book->book->picture !== 'book-placeholder.png' ? asset('storage/uploads/books/' . $activity->book->book->picture) : asset('imgs/' . $activity->book->book->picture) }}"
                                                        alt="">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col ms-n2 mb-3">
                                            <h3 class="fs-6 fw-bold mb-1"> {{ strtoupper($activity->status->name) }}</h3>
                                            @if ($activity->action_status_id === 1)
                                                <p class="mb-0"><a
                                                        href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->librarian->name }}</a>
                                                    je izdao/la knjigu
                                                    <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a>
                                                    korisniku
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>dana
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small"><a
                                                            href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >></a></span>
                                                </div>
                                            @elseif ($activity->action_status_id === 2)
                                                <p class="mb-0">
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>
                                                    je rezervisao/la knjigu
                                                    <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a> za datum
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small">
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >></a>
                                                    </span>
                                                </div>
                                            @elseif ($activity->action_status_id === 3)
                                                <p class="mb-0"><a
                                                        href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->librarian->name }}</a>
                                                    je odobrio rezervaciju knjige
                                                    <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a>
                                                    korisniku
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>za
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small"><a
                                                            href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >></a></span>
                                                </div>
                                            @elseif ($activity->action_status_id === 4)
                                                <p class="mb-0"><a
                                                        href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->librarian->name }}</a>
                                                    je odbio rezervaciju knjige
                                                    <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a>
                                                    korisniku
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>za
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small">
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >>
                                                        </a>
                                                    </span>
                                                </div>
                                            @elseif ($activity->action_status_id === 5)
                                                <p class="mb-0"><a
                                                        href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->librarian->name }}</a>
                                                    je izdao/la knjigu
                                                    <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a>
                                                    korisniku
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>dana
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small"><a
                                                            href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >></a></span>
                                                </div>
                                            @elseif ($activity->action_status_id === 6)
                                                <p class="mb-0">
                                                    Rezervacije knjige
                                                    <a href="{{ route('books.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a>

                                                    koju je podnio korisnik
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>
                                                    za
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                    je istekla.
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small">
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >>
                                                        </a>
                                                    </span>
                                                </div>

                                                <div class="d-flex align-items-center">
                                                    <span class="small">
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >></a>
                                                    </span>
                                                </div>
                                            @elseif ($activity->action_status_id === 7)
                                                <p class="mb-0"><a
                                                        href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->librarian->name }}</a>
                                                    je po rezervaciji izdao/la knjigu
                                                    <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a>
                                                    korisniku
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>dana
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small">
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >></a>
                                                    </span>
                                                </div>
                                            @elseif ($activity->action_status_id === 8)
                                                <p class="mb-0"><a
                                                        href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->librarian->name }}</a>
                                                    je otpisao knjigu
                                                    <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a>
                                                    koja je bila izdata korisniku
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>dana
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small">
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >>
                                                        </a>
                                                    </span>
                                                </div>
                                            @elseif ($activity->action_status_id === 9)
                                                <p class="mb-0">
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>
                                                    je vratio/la knjigu
                                                    <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                        class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a> dana
                                                    {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                    <span class="small">
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                            class="link-purple">Pogledaj detalje >></a>
                                                    </span>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            Nema aktivnosti
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let elementi = ["ucenici", "bibliotekari", "knjige", "transakcije", "datum"]

        $.each(elementi, function(key, value) {
            new Choices(document.getElementById(value), {});
        });
    </script>
@endsection
