@extends('app')
@section('page_title')
    {{ $book->title }} | Dokumentacija o akciji
@endsection


@section('interaction')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group ms-2 me-2">
            <a href="{{ route('books.issues.writeoffmultiple', $book->id) }}" type="button" class="btn btn-sm btn-outline-primary">Otpiši</a>
            <a href="{{ route('books.issues.issue', $book->id) }}" type="button"
                class="btn btn-sm btn-outline-primary">Izdaj</a>
            <a href="{{route('books.issues.returnmultiple', $book->id)}}" type="button" class="btn btn-sm btn-outline-primary">Vrati</a>
            <a href="{{ route('books.reservations.reservePage', $book->id) }}" type="button"
                class="btn btn-sm btn-outline-primary">Rezerviši</a>
            <div class="dropdown pt-2 ps-4">
                <div class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="icon icon-xs" viewBox="0 0 20 20">
                        <path
                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </div>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('books.edit', $book->id) }}">
                            <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                            Izmijeni knjigu
                        </a>
                    </li>
                    <li>
                        <form class="mb-0" action="{{ route('books.destroy', $book->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item" type="submit">
                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg>
                                Izbriši knjigu
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('page_content')
    <div class="card card-body rounded-0 border-0 shadow mb-4">
        <div class="row">
            <div class="col">
                <div class="mb-4">
                    <label class="text-gray-400">TIP TRANSAKCIJE</label>
                    <p class="p">
                        <span class="p badge badge-lg bg-gray-600">{{ $action->status->name }}</span>
                    </p>
                </div>
                <div class="mb-4">
                    <label class="text-gray-400">DATUM AKCIJE</label>
                    <p class="p">
                        {{ \Carbon\Carbon::parse($action->action_start)->format('d.m.Y') }}
                    </p>
                </div>
                <div class="mb-4">
                    <label class="text-gray-400">TRENUTNO ZADRŽAVANJE KNJIGE</label>
                    <p class="p">
                        @if ($action->status->id == 1 || $action->status->id == 7)
                            <x-current-holding start_date="{{ $action->action_start }}"
                                deadline_date="{{ $action->action_deadline }}" indicator="false">
                            </x-current-holding>
                        @elseif ($action->status->id == 8 || $action->status->id == 9)
                            <x-current-holding current_date="{{ $action->action_start }}"
                                deadline_date="{{ $action->action_deadline }}" indicator="false">
                            </x-current-holding>
                        @else
                            Nema zadržavanja
                        @endif
                    </p>
                </div>
                <div class="mb-4">
                    <label class="text-gray-400">PREKORAČENJE</label>
                    <p class="p">
                        @if ($action->status->id == 1 || $action->status->id == 7)
                            <x-breached-days start_date="{{ $action->action_start }}"
                                deadline_date="{{ $action->action_deadline }}">
                            </x-breached-days>
                        @elseif ($action->status->id == 8 || $action->status->id == 9)
                            <x-breached-days start_date="{{ $action->action_start }}"
                                deadline_date="{{ $action->action_deadline }}">
                            </x-breached-days>
                        @else
                            Nema prekoračenja
                        @endif
                    </p>
                </div>
                <div class="mb-4">
                    <label class="text-gray-400">BIBLIOTEKAR</label>
                    <p class="p"><a class="link-info"
                            href="{{ route('librarians.show', $action->librarian->id) }}">{{ $action->librarian->name }}</a>
                    </p>
                </div>
                <div class="mb-4">
                    <label class="text-gray-400">UČENIK</label>
                    <p class=""><a class="link-info"
                            href="{{ route('students.show', $action->book->student->id) }}">{{ $action->book->student->name }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
