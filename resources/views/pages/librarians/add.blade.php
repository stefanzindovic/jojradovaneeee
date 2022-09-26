@extends('app')

@section('page_title')
   Novi bibliotekar
@endsection

@section('page_content')
    <x-cropper></x-cropper>
    <div class="card card-body border-0 shadow mb-4">
        <form id="form" action="{{ route('librarians.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <h2 class="h5 mb-4">Opšte informacije</h2>
                        <div class="col-md-12 mb-3">
                            <div>
                                <label for="librarianName" class="form-label">Ime i prezime</label>
                                <input minlength="4" maxlength="50" required type="text" placeholder="Ime i prezime" name="name" id="librarianName" value="{{ old('name')}}" class="form-control" onkeydown="clearErrorsNameUcenikEdit()"/>
                                @error('name')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times"></i> {{ $message }}</p>
                                @enderror
                                <div id="librarianNameValidationMessage"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role_id" class="form-label">Tip korisnika</label>
                            <select name="tip_korisnika" id="role_id" class="form-control" disabled>
                                <option value="2">
                                    Bibliotekar
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="librarianJmbg" class="form-label">JMBG</label>
                            <input minlength="13" maxlength="13" required type="text" placeholder="JMBG" name="jmbg" id="librarianJmbg" value="{{old('jmbg')}}" class="form-control" onkeydown="clearErrorsJmbgUcenikEdit()">
                            @error('jmbg')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times"></i> {{ $message }}</p>
                            @enderror
                            <div id="librarianJmbgValidationMessage"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="librarianEmail" class="form-label">Email</label>
                        <input required type="email" name="email" id="librarianEmail"  placeholder="E-mail" value="{{ old('email') }}" class="form-control" onkeydown="clearErrorsEmailUcenikEdit()">
                        @error('email')
                        <p style="color:red;" id="errorMessageByLaravel"><i
                                class="fa fa-times"></i> {{ $message }}</p>
                        @enderror
                        <div id="librarianEmailValidationMessage"></div>
                    </div>

                    <div class="mb-3">
                        <label for="librarianUsername" class="form-label">Korisničko ime</label>
                        <input minlength="4" maxlength="18" required type="text" placeholder="Korisničko ime" name="username" id="librarianUsername" value="{{old('username')}}" class="form-control" onkeydown="clearErrorsUsernameUcenikEdit()">
                        @error('username')
                        <p style="color:red;" id="errorMessageByLaravel"><i
                                class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                        @enderror
                        <div id="librarianUsernameValidationMessage"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="librarianPassword" class="form-label">Šifra</label>
                            <input minlength="8" maxlength="24" required type="password" placeholder="********" name="password" id="librarianPassword" required minlength="8" maxlength="24" class="form-control"/>
                            @error('password')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times"></i> {{ $message }}</p>
                            @enderror
                            <div id="librarianPasswordValidationMessage"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="librarianPasswordConfirm" class="form-label">Ponovi šifru</label>
                            <input minlength="8" maxlength="24" required type="password" placeholder="********" name="password_confirmation" id="librarianPasswordConfirm" required minlength="8" maxlength="24" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label for="upload-picture" class="form-label">Izaberi fotografiju</label>
                    <label class="border border-gray-300 rounded d-flex justify-content-center">
                        <div id="empty-cover-art" class="overflow-hidden">
                            <div class="text-center">
                                <img src="" style="object-fit: fill;" id="image-output" width="400px" height="400px" alt="Avatar" hidden>
                                    <div id="addphototext" class="text-center pb-lg-12">
                                        <svg class="h-100" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                        <span class="mt-2">Add photo</span>
                                    </div>
                                <input onchange="cropperFunction(event)" id="upload-picture" value="" name="picture-raw" type="file" class="d-none" :accept="accept">
                            </div>
                        </div>
                    </label>
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
