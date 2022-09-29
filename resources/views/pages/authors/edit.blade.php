@extends('app')

@section('page_title')
    Izmijeni autora {{$author->full_name}}
@endsection


@section('style')
    <x-cropper></x-cropper>
@endsection

@section('page_content')

    <div class="card card-body border-0 shadow mb-4">
        <form id="myForm" method="POST" action="{{ route('authors.update', $author->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="upload-picture" class="form-label">Izaberi fotografiju</label>
                            <label class="border border-gray-300 rounded d-flex justify-content-center">
                                <div id="empty-cover-art" class="overflow-hidden">
                                    <div class="text-center">
                                        <img src="{{asset($author->picture)}}" style="object-fit: fill;" id="image-output" width="400px" height="400px" @if($author->picture == null) hidden @endif>
                                        @if($author->picture == null)
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
                        <div class="col-8">
                            <div class=" mb-3">
                                <div>
                                    <label for="name" class="form-label">Naziv autora</label>
                                    <input name="full_name" value="{{$author->full_name}}" placeholder="Ime i prezime" type="text" class="form-control" id="authorName">
                                    @error('full_name')
                                    <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times text-red"></i>
                                        {{ $message }}</p>
                                    @enderror
                                    <div id="authorNameValidationMessageByJs"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Opis</label>
                                <textarea name="bio" placeholder="Opis" type="text" class="form-control" id="authorBio">{{$author->bio}}</textarea>
                                @error('bio')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times text-red"></i>
                                    {{ $message }}</p>
                                @enderror
                                <div id="authorBioValidationMessageByJs"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="float-end">
                        <button class="btn btn-outline-danger" type="reset">Poništi</button>
                        <button type="submit" id="saveAuthorBtn" class="btn btn-primary">Ažuriraj</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector( '#authorBio' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
