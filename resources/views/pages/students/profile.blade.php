@php
    use Jenssegers\Date\Date;

    Date::setLocale('sr');
@endphp

@extends('app')

@section('page_title')
    {{ $student->name }}
@endsection

@section('interaction')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group ms-2 me-2">
            <a href="{{route('students.edit', $student->id)}}" type="button" class="btn btn-sm btn-outline-primary">Izmijeni</a>
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalSignUp">Resetuj šifru</button>
            <div class="modal fade" id="modalSignUp" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-md-5">
                            <h2 class="h4 text-center">Resetuj šifru</h2>
                            <p class="text-center mb-4">Resetovanje šifre za {{$student->name}} {{$student->lastname}}</p>
                            <form id="validateForm" method="POST" action="{{ route('students.password', $student->id) }}">
                                @method('PATCH')
                                @csrf
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Šifra</label>
                                        <div class="input-group">
                                                    <span class="input-group-text border-gray-300" id="basic-addon4">
                                                        <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                                    </span>
                                            <input onkeyup="checkPasswordMatch();" name="password" type="password" placeholder="Šifra" class="form-control border-gray-300" id="password" required>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="confirm_password">Ponovite Šifru</label>
                                        <div class="input-group">
                                                    <span class="input-group-text border-gray-300" id="basic-addon5">
                                                        <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                                    </span>
                                            <input onkeyup="checkPasswordMatch();" name="password_confirmation" equalto="#password" type="password" placeholder="Ponovite Šifru" class="form-control border-gray-300" id="password_confirm" required>
                                            <div class="invalid-feedback">
                                                Lozinke se ne poklapaju!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button id="submitDugme" type="submit" class="btn btn-primary" disabled>Resetuj</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete{{$student->id}}">Obriši</button>
        {{--Modal--}}
        <div class="modal fade" id="delete{{$student->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-md-5">
                        <h2 class="h4 text-center">Brisanje</h2>
                        <p class="text-center mb-4">Da li ste sigurni?</p>
                        <form class="mb-0" action="{{ route('students.destroy', $student->id) }}" method="post">
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

@endsection

@section('page_content')
    <div class="col-12 mb-4">
        <div class="card shadow border-0">
            <div class="text-center p-0">
                <div class="profile-cover rounded-top bg-gray-900"></div>
                <div class="card-body pb-5">
                    <img class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" src="{{$student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . $student->picture) : asset('imgs/' . $student->picture)}}" alt="Profile Image">
                    <h4 class="h3">{{$student->name}}</h4>
                    <p class="text-gray mb-4">{{$student->email}}</p>
                    <a class="btn btn-sm btn-primary" href="mailto:{{$student->email}}"><i class="icon icon-xxs me-2 fas fa-envelope"></i>E-mail kontakt</a>
                </div>
            </div>
            <div class="row pb-5">
                <div class="d-flex justify-content-center">
                    <div class="col-md-11">
                        <div class="accordion" id="informacije">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Informacije o korisniku
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#informacije">
                                    <div class="accordion-body">
                                        <div class="mb-4">
                                            <p class="fw-bold">Username</p>
                                            <p class="p">{{$student->username}}</p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="fw-bold">JMBG</p>
                                            @if($student->jmbg)
                                                <p class="p">{{$student->jmbg}}</p>
                                            @else
                                                <span class="text-danger">Podatak nije dostupan</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <p class="fw-bold">Broj logovanja</p>
                                            <p class="p">{{count($student->logins)}}</p>
                                        </div>
                                        <div class="mb-4">
                                            <p class="fw-bold">Poslednji login</p>
                                            <p class="p">
                                                @if($student->logins->isEmpty())
                                                    Nikad nije ulogovan
                                                @else
                                                    {{\Carbon\Carbon::parse($student->logins->last()->time)->diffForHumans()}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
