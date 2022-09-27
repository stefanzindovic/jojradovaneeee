@extends('app')

@section('page_title')
    Novi povez
@endsection

@section('page_content')
    <!-- Content -->
    <div class="card card-body border-0 shadow mb-4">
        <h2 class="h5 mb-4">Opšte informacije</h2>
        <form id="form" class="form" action="{{route('settings.covers.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <div class=" mb-3">
                            <div>
                                <label for="name" class="form-label">Naziv</label>
                                <input type="text" value="{{old('name')}}" required minlength="4" maxlength="50" name="name" id="coverName" class="form-control">
                                @error('name')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times "></i> {{ $message }}</p>
                                @enderror
                                <div id="coverNameValidationMessageByJs"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <div class="float-end">
                        <button class="btn btn-outline-danger" type="button">Poništi</button>
                        <button id="saveCoverBtn" type="submit" class="btn btn-primary">Kreiraj</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
