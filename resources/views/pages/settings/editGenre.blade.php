@extends('app')

@section('page_title')
    Izmijeni žanr
@endsection

@section('page_content')
    <div class="card card-body border-0 shadow mb-4">
        <h2 class="h5 mb-4">Opšte informacije</h2>
        <form method="POST" action="{{route('settings.genres.update', $genre->id)}}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <div class=" mb-3">
                            <div>
                                <label for="name" class="form-label">Naziv</label>
                                <input name="title" value="{{$genre->title}}" placeholder="Naziv" type="text" class="form-control" id="genreTitle">
                                @error('title')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                                <div id="genreTitleValidationMessageByJs"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
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
