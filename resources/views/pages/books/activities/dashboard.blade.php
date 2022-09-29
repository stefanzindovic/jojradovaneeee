{{-- @php
use Jenssegers\Date\Date;

Date::setLocale('sr');
@endphp --}}

{{-- @extends('app') --}}
{{-- 
@section('page_title')
    Kontrolna tabla
@endsection --}}

{{-- @section('page_content') --}}
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <x-styles></x-styles>
    <x-cropper></x-cropper>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

    <x-sidebar></x-sidebar>

    <main class="content">
        <x-header></x-header>
        <div class="row">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="d-block mb-md-0">
                    <x-breadcrumb></x-breadcrumb>
                    <h2 class="h4">Dashboard</h2>
                </div>
            </div>
        </div>
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
                                    <div class="activity-card flex flex-row mb-[30px]">
                                        <div class="w-[60px] h-[60px]">
                                            @if ($activity->action_status_id == 1 || $activity->action_status_id == 3 || $activity->action_status_id == 4 || $activity->action_status_id == 7 || $activity->action_status_id == 8)
                                                <img class="rounded-full"
                                                    src="{{ $activity->librarian->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . $activity->librarian->picture) : asset('imgs/' . $activity->librarian->picture) }}"
                                                    alt="">
                                            @elseif($activity->action_status_id == 2 || $activity->action_status_id == 9)
                                                <img class="rounded-full"
                                                    src="{{ $activity->book->student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/students/' . $activity->book->student->picture) : asset('imgs/' . $activity->book->student->picture) }}"
                                                    alt="">
                                            @elseif($activity->action_status_id == 5 || $activity->action_status_id == 6)
                                                <img class="rounded-full"
                                                    src="{{ $activity->book->book->picture !== 'book-placeholder.png' ? asset('storage/uploads/books/' . $activity->book->book->picture) : asset('imgs/' . $activity->book->book->picture) }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="ml-[15px] mt-[5px] flex flex-col">
                                            <div class="text-gray-500 mb-[5px]">
                                                <p class="uppercase">
                                                    {{ strtoupper($activity->status->name) }}
                                                    <span class="inline lowercase">
                                                        -
                                                        {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                                    </span>
                                                </p>
                                            </div>
                                            @if ($activity->action_status_id === 1)
                                                <div class="">
                                                    <p>
                                                        <a href="{{ route('librarians.show', $activity->librarian->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->librarian->name }}
                                                        </a>
                                                        je izdala knjigu <a href="{{ route('books.show', $activity->book->book->id) }}" class="text-[#2196f3] hover:text-blue-600"><span
                                                                class="font-medium">{{ $activity->book->book->title }}</a> korisniku
                                                        <a href="{{ route('students.show', $activity->book->student->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a>
                                                        dana <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @elseif ($activity->action_status_id === 2)
                                                <div class="">
                                                    <p>Korisnik
                                                        <a href="{{ route('students.show', $activity->book->student->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a> je zatražio rezervaciju knjige
                                                        <a href="{{ route('books.show', $activity->book->book->id) }}" class="text-[#2196f3] hover:text-blue-600"><span
                                                                class="font-medium">{{ $activity->book->book->title }}</a>
                                                        </span> za <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @elseif ($activity->action_status_id === 3)
                                                <div class="">
                                                    <p>
                                                        <a href="{{ route('librarians.show', $activity->librarian->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->librarian->name }}
                                                        </a>
                                                        je odobrio rezervaciju knjige <a href="{{ route('books.show', $activity->book->book->id) }}" class="text-[#2196f3] hover:text-blue-600"><span
                                                                class="font-medium">{{ $activity->book->book->title }}</a> korisniku
                                                        <a href="{{ route('students.show', $activity->book->student->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a>
                                                        za <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @elseif ($activity->action_status_id === 4)
                                                <div class="">
                                                    <p>
                                                        <a href="{{ route('librarians.show', $activity->librarian->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->librarian->name }}
                                                        </a>
                                                        je odbio rezervaciju knjige <a href="{{ route('books.show', $activity->book->book->id) }}" class="text-[#2196f3] hover:text-blue-600"><span
                                                                class="font-medium">{{ $activity->book->book->title }}</a> korisnika
                                                        <a href="{{ route('students.show', $activity->book->student->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a>
                                                        za <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @elseif ($activity->action_status_id === 5)
                                                <div class="">
                                                    <p>
                                                        Rezervacija knjige <a href="{{ route('books.show', $activity->book->book->id) }}" class="text-[#2196f3] hover:text-blue-600"><span
                                                                class="font-medium">{{ $activity->book->book->title }}</a> koju je ponudio korisnik <a
                                                            href="{{ route('students.show', $activity->book->student->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a> za <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        je istekla.
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @elseif ($activity->action_status_id === 6)
                                                <div class="">
                                                    <p>
                                                        Rezervacija knjige <span class="font-medium">{{ $activity->book->book->title }}
                                                        </span> koju je ponudio korisnik <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                            class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a> za <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        je otkazana.
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @elseif ($activity->action_status_id === 7)
                                                <div class="">
                                                    <p>
                                                        <a href="{{ route('librarians.show', $activity->librarian->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->librarian->name }}
                                                        </a>
                                                        je po rezervaciji izdao knjigu <a href="{{ route('books.show', $activity->book->book->id) }}"
                                                            class="text-[#2196f3] hover:text-blue-600"><span class="font-medium">{{ $activity->book->book->title }}</a> korisniku
                                                        <a href="{{ route('students.show', $activity->book->student->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a>
                                                        dana <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @elseif ($activity->action_status_id === 8)
                                                <div class="">
                                                    <p>
                                                        <a href="{{ route('librarians.show', $activity->librarian->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->librarian->name }}
                                                        </a>
                                                        je po otpisao knjigu <a href="{{ route('books.show', $activity->book->book->id) }}" class="text-[#2196f3] hover:text-blue-600"><span
                                                                class="font-medium">{{ $activity->book->book->title }}</a> koja je bila izdata korisniku
                                                        <a href="{{ route('students.show', $activity->book->student->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a>
                                                        dana <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @elseif ($activity->action_status_id === 9)
                                                <div class="">
                                                    <p>Korisnik
                                                        <a href="{{ route('students.show', $activity->book->student->id) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            {{ $activity->book->student->name }}
                                                        </a> je vratio knjigu
                                                        <span class="font-medium">{{ $activity->book->book->title }}
                                                        </span> dana <span class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                        <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}" class="text-[#2196f3] hover:text-blue-600">
                                                            pogledaj detaljnije >>
                                                        </a>
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <div class="inline-block w-full mt-4">
                                    <a href="{{ route('activities') }}"
                                        class="btn-animation block text-center w-full px-4 py-2 text-sm tracking-wider text-gray-600 transition duration-300 ease-in border-[1px] border-gray-400 rounded hover:bg-gray-200 focus:outline-none focus:ring-[1px] focus:ring-gray-300">
                                        Prikaži više
                                    </a>
                                </div>
                            @else
                                Nema aktivnosti
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <h3 class="uppercase mb-[20px] text-left py-[30px] text-align-center">
                    Statistika
                </h3>
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>

                    </div>
                </div>
            </div>
        </div>
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
        </div>

    </main>

    <!-- Core -->
    <x-scripts></x-scripts>
    {{-- @if ($errors->any()) --}}
    {{-- <script> --}}
    {{-- // @foreach ($errors->all() as $error) --}}
    {{-- // notyf.error("{{ $error }}"); --}}
    {{-- // @endforeach --}}
    {{-- </script> --}}
    {{-- @endif --}}

    {{-- @if (session('createMessage')) --}}
    {{-- <script>
                notyf.success("{{ Session::get('createMessage') }}");
            </script> --}}
    {{-- @endif --}}
    {{-- @if (session('editMessage')) --}}
    {{-- <script>
                    notyf.success("{{ Session::get('editMessage') }}");
                </script> --}}
    {{-- @endif --}}
    {{-- @if (session('deleteMessage')) --}}
    {{-- <script>
                        notyf.success("{{ Session::get('deleteMessage') }}");
                    </script> --}}
    {{-- @endif --}}
    {{-- @if (session('errorMessage')) --}}
    {{-- <script>
                            notyf.error("{{ Session::get('errorMessage') }}");
                        </script> --}}
    {{-- @endif --}}


</body>

</html>
{{-- @endsection --}}
