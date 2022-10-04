@extends('layouts.user')
@section('title')
    Izmijeni profil
@endsection

@section('styles')
    <link href="{{ asset('assets/css/cropper.min.css') }}" rel="stylesheet">
@endsection

@section('main')
    <link type="text/css" href="{{ asset('dashboardfiles/css/cropper.min.css') }}" rel="stylesheet">
    <x-cropper></x-cropper>


    <main id="main" style="padding-top: 3%; !important;">

        <section id="profile" class="values">

            <div class="container-xxl" data-aos="fade-up">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <form id="myForm" action="{{ route('profil.update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            <div class="form-group text-center">
                                                <label for="upload-picture" class="form-control-label">Izaberi
                                                    fotografiju</label>
                                                <label
                                                    class="border border-gray-300 rounded d-flex justify-content-center flex-column"
                                                    style="height: 150px;width: 150px;">
                                                    <div id="empty-cover-art" class="overflow-hidden">
                                                        <div class="text-center">
                                                            <img src="{{ Auth::user()->picture !== 'profile-picture-placeholder.jpg' ? (Auth::user()->role_id == 3 ? asset('storage/uploads/students/' . Auth::user()->picture) : asset('storage/uploads/librarians/' . Auth::user()->picture)) : asset('imgs/' . Auth::user()->picture) }}"
                                                                style="object-fit: fill;cursor: pointer" id="image-output"
                                                                width="150px" height="150px">
                                                            @if (Auth::user()->picture == null)
                                                                <div id="addphototext" class="text-center pb-lg-12">
                                                                    <svg class="h-100" xmlns="http://www.w3.org/2000/svg"
                                                                        width="40" height="40" viewBox="0 0 24 24"
                                                                        fill="none" stroke="currentColor"
                                                                        stroke-width="1" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <rect x="3" y="3" width="18"
                                                                            height="18" rx="2" ry="2">
                                                                        </rect>
                                                                        <circle cx="8.5" cy="8.5"
                                                                            r="1.5"></circle>
                                                                        <polyline points="21 15 16 10 5 21"></polyline>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                            <input onchange="cropperFunction(event)" id="upload-picture"
                                                                value="" name="picture-raw" accept="image/*"
                                                                type="file" class="d-none" :accept="accept">
                                                        </div>
                                                    </div>
                                                </label>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-outline-danger btn-sm pt-2 pb-2"
                                                        onclick="$('#image-output'). attr('src','/imgs/profile-picture-placeholder.jpg');$('[name=\'picture\']').remove(); destroyImage();">Ukloni
                                                        fotografiju</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Ime</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    placeholder="Ime" value="{{ Auth::user()->name }}">
                                                @error('name')
                                                    <div class="text-red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Korisničko
                                                    ime</label>
                                                <input type="text" id="username" name="username" class="form-control"
                                                    placeholder="Korisničko ime" value="{{ Auth::user()->username }}">
                                                @error('username')
                                                    <div class="text-red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ Auth::user()->email }}" placeholder="Email">
                                                @error('email')
                                                    <div class="text-red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="password">Šifra</label>
                                                <input onkeyup="checkPasswordMatch();" name="password" type="password"
                                                    placeholder="********" class="form-control border-gray-300"
                                                    id="password">
                                                <div class="invalid-feedback">
                                                    Šifre se ne poklapaju!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="password_confirm">Ponovite
                                                    šifru</label>
                                                <input onkeyup="checkPasswordMatch();" name="password_confirmation"
                                                    equalto="#password" type="password" placeholder="********"
                                                    class="form-control border-gray-300" id="password_confirm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary">Sačuvaj</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- End Values Section -->




    </main><!-- End #main -->
@endsection

@section('scripts-pre')
    <script src="{{ asset('assets/js/cropper.min.js') }}"></script>
@endsection

@section('scripts')
    <script>
        var cropperFunction = function(e) {
            var cropperOverlay = document.getElementById("cropper-wrapper");
            var cropperPreview = document.getElementById("cropper-preview");
            var croppedOutput = document.getElementById("image-output");
            var cropperCropBtn = document.getElementById("cropper-crop-btn");
            var cropperCancleBtn = document.getElementById("cropper-cancle-btn");
            var form = document.getElementById("myForm");

            var cropper;

            // load cropper overlay and crop image
            if (e.target.files && e.target.files[0]) {
                console.log(e.target.files[0].type)
                if (e.target.files[0].type === 'image/jpeg' || e.target.files[0].type === 'image/png' || e.target.files[
                        0].type === 'image/jpg' || e.target.files[0].type === 'image/gif') {
                    // file reader API
                    var reader = new FileReader();
                    reader.readAsDataURL(e.target.files[0]);
                    reader.onload = function(e) {
                        // setup cropper
                        cropperPreview.src = e.target.result;
                        var options = {
                            aspectRatio: 1,
                        };
                        cropperOverlay.style.display = "block";
                        cropper = new Cropper(cropperPreview, options);
                    };
                }

                // save cropped data
                cropperCropBtn.addEventListener("click", function(e) {
                    // get cropped data from cropper && display cropped image into output block
                    cropper.getCroppedCanvas().toBlob((blob) => {
                        $('input[type="file"]').val("");
                        var file = new File([blob], Date.now(), {
                            type: blob.type
                        });
                        var container = new DataTransfer();

                        container.items.add(file);

                        var input = document.createElement("input");
                        input.name = "picture";
                        input.type = "file";
                        input.files = container.files;
                        input.classList.add("visually-hidden");
                        form.appendChild(input);

                        croppedOutput.style.display = "block";
                        croppedOutput.src = URL.createObjectURL(blob);
                        var imageStudent = document.getElementById("image-output");
                        var addPhotoText = document.getElementById("addphototext");
                        imageStudent.style.display = "block";
                        addPhotoText.style.display = "none";
                        imageStudent.src = URL.createObjectURL(blob);
                    });

                    // destroy cropper and cropper overlay
                    cropper.destroy();
                    cropper = null;
                    cropperOverlay.style.display = "none";
                    var placeholder = document.getElementById("addphototext");
                    croppedOutput.removeAttribute("hidden");

                    placeholder.style.display = "none";
                    $('input[type="file"]').val("");
                });

                // reject cropped data
                cropperCancleBtn.addEventListener("click", function(e) {
                    cropper.destroy();
                    cropper = null;
                    cropperOverlay.style.display = "none";
                    $('input[type="file"]').val("");
                });
            }
        };
    </script>

    <script>
        function destroyImage() {
            jQuery.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });

            jQuery.ajax({
                type: "POST",
                url: "/profil/{{ Auth::user()->id }}/deletePicture/",
                data: jQuery("#myForm").serialize(),
                success: function() {

                },
                error: function(xhr, ajaxOptions, thrownError) {},
            });
        }
    </script>
@endsection
