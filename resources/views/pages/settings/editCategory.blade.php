@extends('app')

@section('page_title')
    Nova kategorija
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
                <div class="col-sm-4">
                    <label for="upload-picture" class="form-label">Izaberi fotografiju</label>
                    <label class="border border-gray-300 rounded d-flex justify-content-center">
                        <div id="empty-cover-art" class="overflow-hidden">
                            <div class="text-center">
                                <img src="{{asset($category->picture )}}" style="object-fit: fill;" id="image-output" width="400px" height="400px" @if($category->picture == 'placeholder.png') hidden @endif>
                                @if($category->picture == 'placeholder.png')
                                    <div id="addphototext" class="text-center pb-lg-12">
                                        <svg class="h-100" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                        <span class="mt-2">Add photo</span>
                                    </div>
                                @endif
                                <input onchange="cropperFunction(event)" id="upload-picture" value="" name="picture-raw" type="file" class="d-none" :accept="accept">
                            </div>
                        </div>
                    </label>
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
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
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
                        <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
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

