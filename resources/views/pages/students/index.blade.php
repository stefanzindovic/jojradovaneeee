@php
use Jenssegers\Date\Date;

Date::setLocale('sr');
@endphp

@extends('app')

@section('page_title')
    Učenici
@endsection

@section('interaction')
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('students.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Novi učenik
        </a>
    </div>
@endsection

@section('page_content')
    {{-- Modal --}}
    <div class="modal fade" id="deleteSingleStudent" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center">Brisanje</h2>
                    <p class="text-center mb-4">Da li ste sigurni?</p>
                    <form class="mb-0" action="" method="post">
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
    <div class="row bg-white py-2 px-2 mx-1 rounded">
        <form action="{{ route('students.destroyMultiple') }}" id="multiDeleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="col">
                <div class="table-responsive">
                    <table id="myTable" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>
                                    @if (!$students->isEmpty())
                                        <input type="checkbox" id="checkAll" class="form-check-input checkbox">
                                    @endif
                                </th>
                                <th class="border-bottom">Ime i Prezime</th>
                                <th class="border-bottom">Tip korisnika</th>
                                <th class="border-bottom">Zadnji pristup sistemu</th>
                                <th class="border-bottom">Akcija</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($students as $student)
                                <tr>
                                    <td><input type="checkbox" id="checkbox" name="id[]" value="{{ $student->id }}"
                                            class="form-check-input"></td>
                                    <td>
                                        <a href="{{ route('students.show', $student->id) }}"
                                            class="d-flex align-items-center">
                                            <img src="{{ $student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/students/' . $student->picture) : asset('imgs/' . $student->picture) }}"
                                                class="avatar rounded-circle me-3" alt="Avatar">
                                            <div class="d-block"><span class="fw-bold">{{ $student->name }}
                                                    {{ $student->lastname }}</span>
                                                <div class="small text-gray"><span
                                                        class="__cf_email__">{{ $student->email }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td><span class="d-flex align-items-center">{{ $student->role->name }}</span></td>
                                    <td><span class="d-flex align-items-center">
                                            @if ($student->logins->isNotEmpty())
                                                {{ $student->logins[$student->logins->count() - 1]->created_at->diffForHumans() }}
                                            @else
                                                Nikada se nije ulogovao
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <div class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    class="icon icon-xs" viewBox="0 0 20 20">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </div>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('students.show', $student->id) }}">
                                                        <svg class="dropdown-icon text-gray-400 me-2"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                            <path
                                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                        </svg>
                                                        Detalji
                                                    </a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('students.edit', $student->id) }}">
                                                        <svg class="dropdown-icon text-gray-400 me-2"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                        </svg>
                                                        Izmijeni
                                                    </a>
                                                </li>
                                                <div role="separator" class="dropdown-divider my-1"></div>
                                                <li>
                                                    <a type="button" class="dropdown-item"
                                                        data-student-id='{{ $student->id }}' href="#"
                                                        onclick="pullDeleteStudentModal(this)">
                                                        <svg class="dropdown-icon text-danger me-2"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                        </svg>
                                                        Izbriši
                                                    </a>
                                                </li>
                                            </ul>
                                            {{-- Modal --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
@endsection
