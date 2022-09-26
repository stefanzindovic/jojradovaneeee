@extends('app')

@section('page_title')
    Knjiga
@endsection


@section('interaction')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group ms-2 me-2">
            <a href="#" type="button" class="btn btn-sm btn-outline-primary">Otpiši</a>
            <a href="#" type="button" class="btn btn-sm btn-outline-primary">Izdaj</a>
            <a href="#" type="button" class="btn btn-sm btn-outline-primary">Vrati</a>
            <a href="#" type="button" class="btn btn-sm btn-outline-primary">Rezerviši</a>
            <div class="dropdown pt-2 ps-4">
                <div class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="icon icon-xs"  viewBox="0 0 20 20">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                </div>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('books.edit', $book->id)}}">
                            <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor"  viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                            Izmijeni
                        </a>
                    </li>
                    <li>
                        <form class="mb-0" action="{{ route('books.destroy', $book->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item" type="submit">
                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                </svg>
                                Izbriši
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('page_content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="osnovniDetalji-tab" data-bs-toggle="tab" data-bs-target="#osnovniDetalji" type="button" role="tab" aria-controls="home" aria-selected="true">Osnovni detalji</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="specifikacije-tab" data-bs-toggle="tab" data-bs-target="#specifikacije" type="button" role="tab" aria-controls="profile" aria-selected="false">Specifikacije</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="multimedija-tab" data-bs-toggle="tab" data-bs-target="#multimedija" type="button" role="tab" aria-controls="profile" aria-selected="false">Multimedija</button>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-8">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="osnovniDetalji" role="tabpanel" aria-labelledby="osnovniDetalji-tab">
                    <div class="card card-body rounded-0 border-0 shadow mb-4">
                        <div class="row">
                            <div class="col">
                                <div class="mb-4">
                                    <label class="text-gray-400">NAZIV KNJIGE</label>
                                    <p class="p">{{$book->title}}</p>
                                </div>
                                <div class="mb-4">
                                    <label class="text-gray-400">KATEGORIJE</label>
                                    <p class="p">
                                        @foreach ($book->categories as $category)
                                            {{ $category->title }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <label class="text-gray-400">ŽANROVI</label>
                                    <p class="p">
                                        @foreach ($book->genres as $genre)
                                            {{ $genre->title }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <label class="text-gray-400">AUTORI</label>
                                    <p class="p">
                                        @foreach ($book->authors as $author)
                                            {{ $author->full_name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <label class="text-gray-400">IZDAVAČ</label>
                                    <p class="p">
                                        {{ $book->publisher->name }}
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <label class="text-gray-400">GODINA IZDAVANJA</label>
                                    <p class="p">{{ $book->published_at }}</p>
                                </div>
                            </div>
                            <div class="col scroll">
                                <label class="text-gray-400">OPIS</label>
                                <div style="overflow: scroll;height: 50vh;" class="scroll">
                                    <p class="">
                                        {!! $book->description  !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="specifikacije" role="tabpanel" aria-labelledby="specifikacije-tab">
                    <div class="card card-body rounded-0 border-0 shadow mb-4">
                        <div class="row">
                            <div class="col">
                                <div class="mb-4">
                                    <label class="text-gray-400">BROJ STRANA</label>
                                    <p class="p">{{ $book->total_pages }}</p>
                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-400">PISMO</label>
                                    <p class="p">{{ $book->script->name }}</p>
                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-400">JEZIK</label>
                                    <p class="p">{{ $book->language->name }}</p>
                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-400">POVEZ</label>
                                    <p class="p">{{ $book->cover->name }}</p>
                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-400">FORMAT</label>
                                    <p class="p">{{ $book->format->name }}</p>
                                </div>

                                <div class="mb-4">
                                    <label class="text-gray-400">ISBN</label>
                                    <p class="p">{{ $book->isbn }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="multimedija" role="tabpanel" aria-labelledby="multimedija-tab">
                    <div class="card card-body rounded-0 border-0 shadow mb-4">
                        <div class="grid">
                            @if ($book->gallery->isEmpty())
                                Nema dostupne multimedije.
                            @else
                                <div style="display: grid;  grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr; gap: 1rem;">
                                    @foreach ($book->gallery as $pciture)
                                        <img style="width: 100%; aspect-ratio: 1 / 1;"
                                             src="{{ asset('storage/uploads/books/' . $pciture->picture) }}"
                                             alt="">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body rounded-0 border-0 shadow mb-4">
                <div class="row">
                    <div class="col">
                        <div class="mb-2">
                            <div class="d-flex align-middle justify-content-between">
                                <p class="text-gray-400">NA RASPOLAGANJU</p>
                                <p class="p border border-green rounded-3 w-50 text-center">{{ $availableCopiesCount }}</p>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="d-flex align-middle justify-content-between">
                                <p class="text-gray-400">REZERVISANO</p>
                                <p class="p border border-yellow rounded-3 w-50 text-center"> {{ $pendingReservations->count() + $activeReservations->count() }}</p>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="d-flex align-middle justify-content-between">
                                <p class="text-gray-400">IZDATO</p>
                                <p class="p border border-blue rounded-3 w-50 text-center"> {{ $issuedRecords->count() }}</p>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="d-flex align-middle justify-content-between">
                                <p class="text-gray-400">U PREKORAČENJU</p>
                                <p class="p border text-white bg-danger rounded-3 w-50 text-center">{{ $booksWithBreachDeadline->count() }}</p>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="d-flex align-middle justify-content-between">
                                <p class="text-gray-400">UKUPNA KOLIČINA</p>
                                <p class="p border bg-success text-white rounded-3 w-50 text-center">{{ $book->total_copies }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 pb-5">
                <a href="#" class="btn btn-secondary">
                    <i class="icon icon-xxs me-2 fas fa-history"></i>Evidencija iznajmljivanja
                </a>
            </div>
        </div>
    </div>
@endsection
