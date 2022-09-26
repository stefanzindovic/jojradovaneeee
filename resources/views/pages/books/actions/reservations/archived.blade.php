@extends('app')

@section('page_title')
    Arhivirane rezervacije
@endsection

@section('page_content')
    <div class="col-12 mb-4">
        <div class="row">
            <div class="col-md-3">
                <div class="mb-2">
                    <div class="row py-2 px-2 mx-1 rounded  hoverItem">
                        <a href="{{route('books.issues.issues')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M8.235 1.559a.5.5 0 0 0-.47 0l-7.5 4a.5.5 0 0 0 0 .882L3.188 8 .264 9.559a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882L12.813 8l2.922-1.559a.5.5 0 0 0 0-.882l-7.5-4zm3.515 7.008L14.438 10 8 13.433 1.562 10 4.25 8.567l3.515 1.874a.5.5 0 0 0 .47 0l3.515-1.874zM8 9.433 1.562 6 8 2.567 14.438 6 8 9.433z"/>
                        </svg>
                    </span>
                            <span class="sidebar-text ps-2">Izdate knjige</span>
                        </a>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="row py-2 px-2 mx-1 rounded hoverItem">
                        <a href="{{route('books.issues.returned')}}" class="hoverText nav-link rounded-3">
                        <span class="sidebar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                        </span>
                            <span class="sidebar-text ps-2">Vraćene knjige</span>
                        </a>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="row py-2 px-2 mx-1 rounded hoverItem">
                        <a href="{{ route('books.issues.breached') }}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                        </span>
                            <span class="sidebar-text ps-2">Knjige u prekoračenju</span>
                        </a>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="row py-2 px-2 mx-1 rounded hoverItem">
                        <a href="{{route('books.reservations')}}" class="hoverText nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                        </svg>
                        </span>
                            <span class="sidebar-text ps-2">Aktivne rezervacije</span>
                        </a>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="row py-2 px-2 mx-1 rounded hoverItemActive">
                        <a href="#" class="hoverTextActive nav-link rounded-3">
                    <span class="sidebar-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 7V5H0v5h5a1 1 0 1 1 0 2H0v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9h-6a1 1 0 1 1 0-2h6z"/>
                        </svg>
                        </span>
                            <span class="sidebar-text ps-2">Arhivirane rezervacije</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row bg-white py-2 px-2 mx-1 rounded">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="myTable" class="table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Naziv knjige</th>
                                    <th>Datum rezervacije</th>
                                    <th>Rezervacija ističe</th>
                                    <th>Rezervaciju podnio</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody class="align-middle">
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="">
                                            <img style="width: 35px; height: 35px;"
                                                 class="Image"
                                                 src="@if ($reservation->book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $reservation->book->picture) }} @endif"
                                                 alt="" />
                                            <a href="{{ route('books.show', $reservation->id) }}">
                                                <span class="fw-bold text-center">{{ $reservation->book->title }}</span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($reservation->activeAction->action_start)->format('d.m.Y') }}
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($reservation->activeAction->action_deadline)->format('d.m.Y') }}
                                        </td>
                                        <td class="">
                                            <img class="Avatar rounded-circle"
                                                 src="{{ $reservation->student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/students/' . $reservation->student->picture) : asset('imgs/' . $reservation->student->picture) }}"
                                                 alt="Profilna fotografija" />
                                            <a href="{{ route('students.show', $reservation->student->id) }}"
                                               class="fw-bold">{{ $reservation->student->name }}</a>
                                        </td>
                                        <td class="text-center">
                                            @if ($reservation->activeAction->action_status_id == 7)
                                                <span class="text-success">Knjiga izdata</span>
                                            @else
                                                <span class="text-danger">{{ $reservation->activeAction->status->name }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
