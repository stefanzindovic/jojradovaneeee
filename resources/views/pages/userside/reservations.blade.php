@extends('layouts.user')

@section('title')
    Rezervacije
@endsection



@section('main')
    <main id="main" style="padding-top: 3%; !important;">

        <section id="books" class="values">
            <div class="container-xxl" data-aos="fade-up">
                <div class="container">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Rezervacije</h3>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Knjiga</th>
                                        <th scope="col">Datum rezervacije</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Akcija</th>
                                    </tr>
                                </thead>
                                <tbody class="list">

                                    @foreach ($pending as $pendingRes)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center mb-1 mt-1">
                                                    <a href="#" class="avatar mr-3">
                                                        <img alt="Image placeholder"
                                                            src="@if ($pendingRes->book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $pendingRes->book->picture) }} @endif">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="{{ route('knjige.show', $pendingRes->book->id) }}"
                                                            target="_blank">
                                                            <span
                                                                class="name mb-0 text-sm">{{ $pendingRes->book->title }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="row">
                                                {{ \Carbon\Carbon::parse($pendingRes->activeAction->action_start)->format('d.m.Y') }}
                                            </th>
                                            <td>
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-warning"></i>
                                                    <span class="text-warning">rezervacija u toku</span>
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('rezervacija.otkazi', $pendingRes->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-sm">Otkaži</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach ($active as $activeRes)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center mb-1 mt-1">
                                                    <a href="#" class="avatar mr-3">
                                                        <img alt="Image placeholder"
                                                            src="@if ($activeRes->book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $activeRes->book->picture) }} @endif">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="{{ route('knjige.show', $activeRes->book->id) }}"
                                                            target="_blank">
                                                            <span
                                                                class="name mb-0 text-sm">{{ $activeRes->book->title }}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </th>
                                            <th scope="row">
                                                {{ \Carbon\Carbon::parse($activeRes->activeAction->action_start)->format('d.m.Y') }}
                                            </th>
                                            <td>
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-info"></i>
                                                    <span class="text-info">rezervacija prihvaćena</span>
                                                </span>
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    @foreach ($reservations as $reservation)
                                        @if ($reservation->activeAction->action_status_id != 7)
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center mb-1 mt-1">
                                                        <a href="#" class="avatar mr-3">
                                                            <img alt="Image placeholder"
                                                                src="@if ($reservation->book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $reservation->book->picture) }} @endif">
                                                        </a>
                                                        <div class="media-body">
                                                            <a href="{{ route('knjige.show', $reservation->book->id) }}"
                                                                target="_blank">
                                                                <span
                                                                    class="name mb-0 text-sm">{{ $reservation->book->title }}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    {{ \Carbon\Carbon::parse($reservation->activeAction->action_start)->format('d.m.Y') }}
                                                </th>
                                                <td>
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="bg-danger"></i>
                                                        <span class="text-danger">rezervacija odbijena</span>
                                                    </span>
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Moje knjige</h3>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Knjiga</th>
                                        <th scope="col">Knjiga izdata</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($reservations as $reservation)
                                        @if ($reservation->activeAction->action_status_id == 7)
                                            <tr>
                                                <th scope="row">
                                                    <div class="media align-items-center mb-1 mt-1">
                                                        <a href="#" class="avatar mr-3">
                                                            <img class="Avatar rounded-circle"
                                                                @if ($reservation->student->role_id == 1 || $reservation->student->role_id == 2) src="{{ $reservation->student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . $reservation->student->picture) : asset('imgs/' . $reservation->student->picture) }}"
                                                @else
                                                src="{{ $reservation->student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/students/' . $reservation->student->picture) : asset('imgs/' . $reservation->student->picture) }}" @endif
                                                                alt="Profilna fotografija" />
                                                        </a>
                                                        <div class="media-body">
                                                            <a href="{{ route('knjige.show', $reservation->book->id) }}"
                                                                target="_blank">
                                                                <span
                                                                    class="name mb-0 text-sm">{{ $reservation->book->title }}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="row">
                                                    {{ \Carbon\Carbon::parse($reservation->activeAction->action_start)->format('d.m.Y') }}
                                                </th>
                                                <td>
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="bg-success"></i>
                                                        <span class="text-success">knjiga izdata</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>
@endsection
