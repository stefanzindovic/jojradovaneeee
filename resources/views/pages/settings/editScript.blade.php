@extends('app')

@section('page_title')
    Izmjena pismo
@endsection

@section('page_content')
    <div class="card card-body border-0 shadow mb-4">
        <h2 class="h5 mb-4">Opšte informacije</h2>
        <form method="POST" action="{{route('settings.scripts.update', $script->id)}}">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <div class=" mb-3">
                            <div>
                                <label for="name" class="form-label">Naziv</label>
                                <input  type="text" value="{{$script->name}}" required minlength="4" maxlength="50" name="name" id="scriptName" class="form-control">
                                @error('name')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times text-red"></i> {{ $message }}</p>
                                @enderror
                                <div id="scriptNameValidationMessageByJs"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <div class="float-end">
                        <button class="btn btn-outline-danger" type="reset">Poništi</button>
                        <button id="saveScriptBtn" type="submit" class="btn btn-primary">Ažuriraj</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
