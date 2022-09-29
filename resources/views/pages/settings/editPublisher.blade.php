@extends('app')

@section('page_title')
    Izmjena izdavača
@endsection

@section('page_content')
    <div class="card card-body border-0 shadow mb-4">
        <h2 class="h5 mb-4">Opšte informacije</h2>
        <form method="POST" action="{{route('settings.publishers.update', $publisher->id)}}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <div class=" mb-3">
                            <div>
                                <label for="name" class="form-label">Naziv</label>
                                <input  value="{{old('name', $publisher->name)}}" required minlength="4" maxlength="50" name="name" id="publisherName" class="form-control">
                                @error('name')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times text-red"></i> {{ $message }}</p>
                                @enderror
                                <div id="publisherNameValidationMessageByJs"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <div class="float-end">
                        <button class="btn btn-outline-danger" type="reset">Poništi</button>
                        <button id="savePublisherBtn" type="submit" class="btn btn-primary">Ažuriraj</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
