@extends('app')

@section('page_title')
    {{ $author->full_name }}
@endsection

@section('interaction')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group ms-2 me-2">
            <a href="{{route('authors.edit', $author->id)}}" type="button" class="btn btn-sm btn-outline-primary">Izmijeni autora</a>
        </div>
        <form class="mb-0" id="delete-form" action="{{route('authors.destroy', $author->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">Obriši</button>
        </form>
    </div>

@endsection

@section('page_content')
    <div class="card card-body rounded-0 border-0 shadow">
        <div class="row">
            <div class="col-md-2 pb-2">
                    <div class="text-center">
                        <img style="height: 250px;width: 250px;" @if($author->picture === 'profile-picture-placeholder.jpg') src="{{asset('imgs/profile-picture-placeholder.jpg')}} @else src="{{asset('storage/uploads/authors/' . $author->picture)}} @endif" alt="Author Image">
                    </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <p class="form-label">Ime</p>
                            <p class="h6">{{$author->full_name}}</p>
                        </div>
                        <li role="separator" class="dropdown-divider mt-2 mb-3 border-gray-200"></li>
                        <div class="mb-3">
                            <p class="form-label">Opis</p>
                            <p>{!! $author->bio !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
