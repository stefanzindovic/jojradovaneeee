@extends('app')

@section('page_title')
    Aktivnosti
@endsection

@section('page_content')
    <div class="row pb-2">
        <div class="col">
            <div class="card notification-card border-0 shadow">
                <div class="card-header">
                    <div class="row">
                        <small>Filteri</small>
                        <div class="col-md-3 pb-1">
                            <label for="bibliotekari">Izaberite učenika</label>
                            <select class="form-control" id="ucenici" name="student_id" multiple>
                                <option value="1">Marko Markovic</option>
                            </select>
                        </div>
                        <div class="col-md-3 pb-1">
                            <label for="bibliotekari">Izaberite bibliotekara</label>
                            <select class="form-control" id="bibliotekari" name="librarian_id" multiple>
                                <option value="1">Marko Markovic</option>
                            </select>
                        </div>
                        <div class="col-md-3 pb-1">
                            <label for="bibliotekari">Izaberite knjigu</label>
                            <select class="form-control" id="knjige" name="librarian_id" multiple>
                                <option value="1">Na Drini ćuprija</option>

                            </select>
                        </div>
                        <div class="col-md-3 pb-1">
                            <label for="bibliotekari">Izaberite transakciju</label>
                            <select class="form-control" id="transakcije" name="librarian_id" multiple>
                                <option value="1">Izdate</option>

                            </select>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush list-group-timeline">
                        @if ($activities->count() > 0)
                            @foreach ($activities as $activity)
                                <div class="list-group-item border-0">
                                    <div class="row ps-lg-1">
                                        <div class="col-auto z-0">
                                            <div class="icon-shape icon-xs icon-shape-success rounded">
                                                <img src="{{ $activity->librarian->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . $activity->librarian->picture) : asset('imgs/' . $activity->librarian->picture) }}"
                                                     alt="">
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
                                                    </a>dana {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
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
                                                    </a> za datum {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                        <span class="small">
                                                            <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="link-purple">Pogledaj detalje >></a>
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
                                                    </a>za {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
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
                                                    </a>za {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                        <span class="small">
                                                            <a
                                                                href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
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
                                                    </a>dana {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                        <span class="small"><a
                                                                href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                                class="link-purple">Pogledaj detalje >></a></span>
                                                </div>
                                        @elseif ($activity->action_status_id === 6)
                                                <p class="mb-0">
                                                    Rezervacije knjige
                                                    <a href="{{ route('knjige.show', $activity->book_id) }}"
                                                       class="link-purple">
                                                        {{ $activity->book->book->title }}
                                                    </a>

                                                    koju je podnio korisnik
                                                    <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="link-purple">
                                                        {{ $activity->book->student->name }}
                                                    </a>
                                                    za {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }} je istekla.
                                                </p>
                                                <div class="d-flex align-items-center">
                                                            <span class="small">
                                                                <a
                                                                    href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                                    class="link-purple">Pogledaj detalje >>
                                                                </a>
                                                            </span>
                                                    </div>

                                                <div class="d-flex align-items-center">
                                                        <span class="small">
                                                            <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="link-purple">Pogledaj detalje >></a>
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
                                                    </a>dana {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                        <span class="small">
                                                            <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="link-purple">Pogledaj detalje >></a>
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
                                                    </a>dana {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                        <span class="small">
                                                            <a
                                                                href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
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
                                                    </a> dana {{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}
                                                </p>
                                                <div class="d-flex align-items-center">
                                                        <span class="small">
                                                            <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="link-purple">Pogledaj detalje >></a>
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
        let elementi = ["ucenici", "bibliotekari","knjige","transakcije","datum"]

        $.each( elementi, function(key, value ) {
            new Choices(document.getElementById(value), {
            });
        });
    </script>

@endsection




