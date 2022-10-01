@extends('app')

@section('page_title')
    Izmijeni kategoriju
@endsection

@section('page_content')
    <x-cropper></x-cropper>
    <div class="card card-body border-0 shadow mb-4">
        <h2 class="h5 mb-4">Opšte informacije</h2>
        <form id="myForm" method="POST" action="{{ route('settings.categories.update', $category->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm-4 d-flex justify-content-center">
                    <div class="div">
                        <label for="upload-picture" class="form-label">Izaberi fotografiju</label>
                        <label class="border border-gray-300 d-flex justify-content-center relative" style="max-height: 350px;max-width: 350px">
                            <div id="empty-cover-art" class="overflow-hidden">
                                <img src="{{$category->picture !== 'placeholder.png' ? asset('storage/uploads/categories/' . $category->picture) : asset('imgs/' . $category->picture)}}" style="object-fit: fill;min-height: 350px;width: 350px" class="w-full h-full" id="image-output" alt="Avatar">
                                <input onchange="cropperFunction(event)" id="upload-picture" value="" name="picture-raw" type="file" class="d-none" :accept="accept">
                            </div>
                        </label>
                        <div class="text-center">
                            <a class="btn btn-outline-danger btn-sm pt-2 pb-2" onclick="$('#image-output'). attr('src','/imgs/placeholder.png');$('[name=\'picture\']').remove()">Ukloni fotografiju</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class=" mb-3">
                            <div>
                                <label for="name" class="form-label">Naziv</label>
                                <input name="title" value="{{$category->title}}" placeholder="Naziv" type="text" class="form-control" id="categoryTitle">
                                @error('name')
                                <div  class="text-red">** {{ $message }}</div>
                                @enderror
                            </div>
                            @error('title')
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times text-red"></i>
                                {{ $message }}</p>
                            @enderror
                            <div id="categoryTitleValidationMessage"></div>

                            <div id="categoryIconValidationMessage"></div>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Opis</label>
                            <textarea name="description" placeholder="Opis" type="text" class="form-control" id="categoryDescription">{{ $category->description}}</textarea>
                            @error('lastname')
                            <div  class="text-red">** {{ $message }}</div>
                            @enderror
                        </div>
                        @error('description')
                        <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times text-red"></i>
                            {{ $message }}</p>
                        @enderror
                        <div id="categoryDescriptionValidationMessage"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="float-end">
                        <button class="btn btn-outline-danger" type="reset">Poništi</button>
                        <button id="saveCategory" type="submit" class="btn btn-primary">Ažuriraj</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

