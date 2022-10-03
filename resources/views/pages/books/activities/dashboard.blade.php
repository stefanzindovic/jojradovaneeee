@extends('app')

@section('page_title')
    Dashboard
@endsection

@section('page_content')
    <div class="row">
        <div class="col-12 col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="">
                                <h2 class="h6 text-gray-400 mb-0"><a href="{{ route('students.index') }}">Učenici</a>
                                </h2>
                                <h3 class="fw-extrabold mb-2">{{ count($students) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-12 col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="">
                                <h2 class="h6 text-gray-400 mb-0"><a href="{{ route('books.index') }}">Knjige</a>
                                </h2>
                                <h3 class="fw-extrabold mb-2">{{ count($books) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="">
                                <h2 class="h6 text-gray-400 mb-0"><a href="{{ route('librarians.index') }}">Bibliotekari</a>
                                </h2>
                                <h3 class="fw-extrabold mb-2">{{ count($librarians) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                                <img height="70%" src="https://img.icons8.com/ios/344/login-rounded-right--v1.png" alt="login-icon">
                                {{-- <svg class="icon" fill="currentColor" viewBox="0 0 20 20" xmlns="https://www.svgrepo.com/show/128929/author-sign.svg">
                                    <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z" />
                                </svg> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <h2 class="h6 text-gray-400 mb-0">Prijavljivanja</h2>
                                <h3 class="fw-extrabold mb-2">{{ count($logins) }}</h3>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row pb-2">
        <div class="col">
            <div class="card notification-card border-0 shadow">
                <div class="card-header d-flex align-items-center">
                    <h2 class="fs-5 fw-bold mb-0">Aktivnosti</h2>
                    <div class="ms-auto">
                        <a class="fw-normal d-inline-flex align-items-center" href="{{ route('activities') }}"> <svg class="icon icon-xxs me-2" fill="currentColor" viewBox="0 0 20 20"
                                                                                                                     xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                                <path fill-rule="evenodd"
                                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd">
                                </path>
                            </svg>
                            Pogledaj sve
                        </a>
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
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="fs-5 fw-bold mb-0">Statistika</h2>
                </div>
                <div class="card-body">
                    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const labels = ["Izdate knjige", "U prekoračenju", "Rezervisane"]
        const data = {
            labels: labels,
            datasets: [{
                label: "Broj knjiga",
                data: [{{ $issuedBooksCounter }}, {{ $breachedBooksCounter }}, {{ $reservationsCounter }}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(36, 108, 160, 0.7)',
                    'rgba(18, 54, 79, 0.7)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 0.1)',
                    'rgba(36, 108, 160, 0.1)',
                    'rgba(18, 54, 79, 0.1)',
                ],
                borderWidth: 1,
            }]
        };
        const config = {
            type: 'bar',
            data,
            options: {
                ticks: {
                    precision: 0
                },
                indexAxis: 'y',
                scales: {
                    x: {
                        grid: {
                            // beginAtZero: true,
                            color: "rgba(235,235,235)",
                            borderWidth: 1,
                            // borderOffset: 2,
                            borderColor: "rgba(120,120,120)"
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            borderWidth: 1,
                            // borderOffset: 2,
                            borderColor: "rgba(120,120,120)"
                        }
                    }
                }
            }
        };
        const myChart = new Chart(document.getElementById('myChart'), config);
    </script>
@endsection
