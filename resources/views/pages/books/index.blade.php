@extends('app')

@section('page_title')
    Knjige
@endsection

@section('interaction')
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('books.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nova knjiga
        </a>
    </div>
@endsection

@section('page_content')
    <div class="row bg-white py-2 px-2 mx-1 rounded">
        <div class="col">
            <div class="table-responsive">
                <table id="myTable" class="table" style="width:100%">
                    <thead>
                    <tr>
                        <th>Naziv knjige</th>
                        <th>Autor</th>
                        <th>Kategorija</th>
                        <th>Na raspolaganju</th>
                        <th>Rezervisano</th>
                        <th>Izdato</th>
                        <th>U prekoračenju</th>
                        <th>Ukupna količina</th>
                        <th>Akcija</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">
                    @foreach ($books as $book)
                        <tr style="white-space: pre-line;">
                            <td class="flex flex-row items-center px-4 py-4">
                                <img style="width: 35px; height: 35px;"
                                     class="Image"
                                     src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif"
                                     alt="" />
                                <a href="{{ route('books.show', $book->id) }}">
                                    <span class="font-medium text-center">{{ $book->title }}</span>
                                </a>
                            </td>
                            <td style="white-space: pre-line;">
                                <p class="text-center">@foreach ($book->authors as $author)
                                        {{ $author->full_name }} @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach</p>
                            </td>
                            <td style="white-space: pre-line;">
                                <p class="text-center">
                                    @foreach ($book->categories as $category)
                                        {{ $category->title }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                            <td class="text-center">
                                {{ $book->total_copies - ((($reservedBooksPendingCount[$book->id] ?? 0) + ($reservedBooksActiveCount[$book->id] ?? 0) ?? 0) + ($writtenOffBooks[$book->id] ?? 0) + ($issuedBooksCount[$book->id] ?? 0)) }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('books.reservations', ['books' => $book->id]) }}">{{ ($reservedBooksPendingCount[$book->id] ?? 0) + ($reservedBooksActiveCount[$book->id] ?? 0) ?? 0 }}</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('books.issues.issues', ['books' => $book->id]) }}">{{ $issuedBooksCount[$book->id] ?? 0 }}</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('books.issues.breached', ['books' => $book->id]) }}">{{ $booksWithBreachedDeadlines[$book->id] ?? 0 }}</a>
                            </td>
                            <td class="text-center">
                                {{ $book->total_copies - ($writtenOffBooks[$book->id] ?? 0) }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <div class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon icon-xs" viewBox="0 0 20 20">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('books.show', $book->id) }}">
                                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                </svg>
                                                Detalji
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('books.edit', $book->id) }}">
                                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                                Izmijeni
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">
                                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                                Otpiši
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('books.issues', $book->id) }}">
                                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z" />
                                                </svg>
                                                Izdaj
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">
                                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                                </svg>
                                                Vrati
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('books.reservations.reservePage', $book->id) }}">
                                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                                </svg>
                                                Rezerviši
                                            </a>
                                        </li>
                                        <div role="separator" class="dropdown-divider my-1"></div>
                                        <li>
                                            <a type="button" class="dropdown-item" data-bs-toggle="modal" href="#delete{{ $book->id }}">
                                                <svg class="dropdown-icon text-danger me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                                Izbriši
                                            </a>
                                        </li>
                                    </ul>
                                    {{-- Modal --}}
                                    <div class="modal fade" id="delete{{ $book->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-md-5">
                                                    <h2 class="h4 text-center">Brisanje</h2>
                                                    <p class="text-center mb-4">Da li ste sigurni?</p>
                                                    <form class="mb-0" action="{{ route('books.destroy', $book->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-danger">Obriši</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
