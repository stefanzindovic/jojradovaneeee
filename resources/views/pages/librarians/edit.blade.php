@extends('app')

@section('page_title')
    {{ $librarian->name }} | Izmijeni podatke
@endsection

@section('page_content')
    <x-cropper></x-cropper>
    <div class="card card-body border-0 shadow mb-4">
        <form id="myForm" class="form" action="{{ route('librarians.update', $librarian->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm-4 d-flex justify-content-center">
                    <div class="div">
                        <label for="upload-picture" class="form-label">Izaberi fotografiju</label>
                        <label class="border border-gray-300 d-flex justify-content-center relative"
                            style="max-height: 350px;max-width: 350px">
                            <div id="empty-cover-art" class="overflow-hidden">
                                <img src="{{ $librarian->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . $librarian->picture) : asset('imgs/' . $librarian->picture) }}"
                                    style="object-fit: fill;cursor:pointer;min-height: 350px;width: 350px"
                                    class="w-full h-full" id="image-output" alt="Avatar">
                                <input onchange="cropperFunction(event)" id="upload-picture" value=""
                                    name="picture-raw" type="file" class="d-none" :accept="accept">
                            </div>
                        </label>
                        <div class="text-center">
                            <a class="btn btn-outline-danger btn-sm pt-2 pb-2"
                                onclick="$('#image-output'). attr('src','/imgs/profile-picture-placeholder.jpg');$('[name=\'picture\']').remove()">Ukloni
                                fotografiju</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="row">
                        <h2 class="h5 mb-4">Opšte informacije</h2>
                        <div class="col-md-12 mb-3">
                            <div>
                                <label for="name" class="form-label">Ime i prezime</label>
                                <input minlength="4" maxlength="50" required type="text" name="name"
                                    id="librarianName" value="{{ old('name', $librarian->name) }}" class="form-control"
                                    onkeydown="clearErrorsNameUcenikEdit()" />
                                @error('name')
                                    <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times"></i>
                                        {{ $message }}</p>
                                @enderror
                                <div id="librarianNameValidationMessage"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role_id" class="form-label">Tip korisnika</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="1" @if ($librarian->role_id == 1) selected @endif>
                                    Administrator
                                </option>
                                <option value="2" @if ($librarian->role_id == 2) selected @endif>
                                    Bibliotekar
                                </option>
                                <option value="3" @if ($librarian->role_id == 3) selected @endif>
                                    Učenik
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jmbg" class="form-label">JMBG</label>
                            <input minlength="13" maxlength="13" required type="text" name="jmbg" id="librarianJmbg"
                                value="{{ old('jmbg', $librarian->jmbg) }}" class="form-control"
                                onkeydown="clearErrorsJmbgUcenikEdit()">
                            @error('jmbg')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times"></i> {{ $message }}
                                </p>
                            @enderror
                            <div id="librarianJmbgValidationMessage"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input required type="email" name="email" id="librarianEmail"
                            value="{{ old('email', $librarian->email) }}" class="form-control"
                            onkeydown="clearErrorsEmailUcenikEdit()">
                        @error('email')
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times"></i> {{ $message }}</p>
                        @enderror
                        <div id="librarianEmailValidationMessage"></div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Korisničko ime</label>
                        <input minlength="4" maxlength="18" required type="text" name="username" id="librarianUsername"
                            value="{{ old('username', $librarian->username) }}" class="form-control"
                            onkeydown="clearErrorsUsernameUcenikEdit()">
                        @error('username')
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times"></i> {{ $message }}
                            </p>
                        @enderror
                        <div id="librarianUsernameValidationMessage"></div>
                    </div>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col">
                    <div class="float-end">
                        <button class="btn btn-outline-danger" type="reset">Poništi</button>
                        <button type="submit" class="btn btn-primary">Ažuriraj</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
