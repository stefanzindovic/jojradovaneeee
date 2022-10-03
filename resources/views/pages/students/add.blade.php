@extends('app')

@section('page_title')
    Novi učenik
@endsection

@section('page_content')
    <x-cropper></x-cropper>
    <div class="card card-body border-0 shadow mb-4">
        <form id="myForm" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-sm-4 d-flex justify-content-center">
                    <div class="div">
                        <label for="upload-picture" class="form-label">Izaberi fotografiju</label>
                        <label class="border border-gray-300 d-flex justify-content-center relative" style="max-height: 350px;max-width: 350px">
                            <div id="empty-cover-art" class="overflow-hidden">
                                <img src="{{asset('imgs/profile-picture-placeholder.jpg')}}" style="object-fit: fill;cursor:pointer;min-height: 350px;width: 350px" class="w-full h-full" id="image-output" alt="Avatar">
                                <input onchange="cropperFunction(event)" id="upload-picture" value="" name="picture-raw" accept="image/*" type="file" class="d-none" :accept="accept">
                            </div>
                        </label>
                        <div class="text-center">
                            <a class="btn btn-outline-danger btn-sm pt-2 pb-2" onclick="$('#image-output'). attr('src','/imgs/profile-picture-placeholder.jpg');$('[name=\'picture\']').remove()">Ukloni fotografiju</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="row">
                        <h2 class="h5 mb-4">Opšte informacije</h2>
                        <div class="col-md-12 mb-3">
                            <div>
                                <label for="studentName" class="form-label">Ime i prezime</label>
                                <input minlength="4" maxlength="50" required type="text" placeholder="Ime i prezime" name="name" id="studentName" value="{{ old('name')}}" class="form-control" onkeydown="clearErrorsNameUcenikEdit()"/>
                                @error('name')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times"></i> {{ $message }}</p>
                                @enderror
                                <div id="studentNameValidationMessage"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role_id" class="form-label">Tip korisnika</label>
                            <select name="tip_korisnika" id="role_id" class="form-control" disabled>
                                <option value="3">
                                    Učenik
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="studentJmbg" class="form-label">JMBG</label>
                            <input minlength="13" maxlength="13" required type="text" placeholder="JMBG" name="jmbg" id="studentJmbg" value="{{old('jmbg')}}" class="form-control" onkeydown="clearErrorsJmbgUcenikEdit()">
                            @error('jmbg')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times"></i> {{ $message }}</p>
                            @enderror
                            <div id="studentJmbgValidationMessage"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="studentEmail" class="form-label">Email</label>
                        <input required type="email" name="email" id="studentEmail"  placeholder="E-mail" value="{{ old('email') }}" class="form-control" onkeydown="clearErrorsEmailUcenikEdit()">
                        @error('email')
                        <p style="color:red;" id="errorMessageByLaravel"><i
                                class="fa fa-times"></i> {{ $message }}</p>
                        @enderror
                        <div id="studentEmailValidationMessage"></div>
                    </div>

                    <div class="mb-3">
                        <label for="studentUsername" class="form-label">Korisničko ime</label>
                        <input minlength="4" maxlength="18" required type="text" placeholder="Korisničko ime" name="username" id="studentUsername" value="{{old('username')}}" class="form-control" onkeydown="clearErrorsUsernameUcenikEdit()">
                        @error('username')
                        <p style="color:red;" id="errorMessageByLaravel"><i
                                class="fa fa-times"></i> {{ $message }}</p>
                        @enderror
                        <div id="studentUsernameValidationMessage"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="studentPassword" class="form-label">Šifra</label>
                            <input minlength="8" maxlength="24" required type="password" placeholder="********" name="password" id="studentPassword" required minlength="8" maxlength="24" class="form-control"/>
                            @error('password')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times"></i> {{ $message }}</p>
                            @enderror
                            <div id="studentPasswordValidationMessage"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="studentPasswordConfirm" class="form-label">Ponovi šifru</label>
                            <input minlength="8" maxlength="24" required type="password" placeholder="********" name="password_confirmation" id="studentPasswordConfirm" required minlength="8" maxlength="24" class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="float-end">
                        <button class="btn btn-outline-danger" type="reset">Poništi</button>
                        <button type="submit" class="btn btn-primary">Kreiraj</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
