@extends('app')

@section('page_title')
{{$book->title}}
@endsection

@section('page_content')
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="osnovniDetalji" data-bs-toggle="tab" href="#osnovniDetalji-tab" role="tab" aria-controls="osnovniDetalji" aria-selected="true">Osnovni detalji</a>
            <a class="nav-link" id="specifikacije" data-bs-toggle="tab" href="#specifikacije-tab" role="tab" aria-controls="specifikacije" aria-selected="false">Specifikacije</a>
            <a class="nav-link" id="multimedija" data-bs-toggle="tab" href="#multimedija-tab" role="tab" aria-controls="nav-contact" aria-selected="false">Multimedija</a>
        </div>
    </nav>
    <div class="card card-body border-0 shadow mb-4">
        <form id="bookEditForm" action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="osnovniDetalji-tab" role="tabpanel" aria-labelledby="osnovniDetalji">
                <section>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nazivKnjiga" class="form-label">Naziv</label>
                                <input required minlength="1" maxlength="50" type="text" name="title"
                                       id="bookTitle" value="{{ old('title' ,$book->title) }}" class="form-control" />
                                @error('title')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                                <div id="bookTitleValidationMessage"></div>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Kratki Sadržaj</label>
                                <textarea minlength="10" maxlength="2048" name="description" id="bookDescription">{{ old('description', $book->description) }}</textarea>
                                <div id="bookDescriptionValidationMessage"></div>
                                @error('description')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kategorijaInput" class="form-label">Izaberite kategorije</label>
                                <select required class="form-control" id="bookCategories" name="categories[]" multiple="multiple" multiple>

                                    @php
                                        $categoryIds = [];
                                        foreach ($book->categories as $category) {
                                            array_push($categoryIds, $category->id);
                                        }
                                    @endphp
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ collect(old('categories', $categoryIds))->contains($category->id) ? 'selected' : '' }}>
                                            {{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('categories[]')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="kategorijaInput" class="form-label">Izaberite žanrove</label>
                                <select class="form-control" required id="bookGenres" name="genres[]" multiple="multiple" multiple>
                                    @php
                                        $genreIds = [];
                                        foreach ($book->genres as $genre) {
                                            array_push($genreIds, $genre->id);
                                        }
                                    @endphp

                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}"
                                            {{ collect(old('genres', $genreIds))->contains($genre->id) ? 'selected' : '' }}>
                                            {{ $genre->title }}</option>
                                    @endforeach
                                </select>
                                <div id="bookGenresValidationMessage"></div>
                                @error('genres[]')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="autoriInput" class="form-label">Izaberite autore</label>
                                <select required class="form-control" required id="bookAuthors" name="authors[]" multiple="multiple" multiple>
                                    @php
                                        $authorIds = [];
                                        foreach ($book->authors as $author) {
                                            array_push($authorIds, $author->id);
                                        }
                                    @endphp

                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}"
                                            {{ collect(old('authors', $authorIds))->contains($author->id) ? 'selected' : '' }}>
                                            {{ $author->full_name }}</option>
                                    @endforeach
                                </select>
                                <div id="bookAuthorsValidationMessage"></div>
                                @error('authors[]')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                    {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="izdavacInput" class="form-label">Izdavač</label>
                                <select required class="form-control" name="publisher" id="bookPublisher" id="bookPublishers">
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}"
                                            {{ old('publisher', $book->publisher->id) == $publisher->id ? 'selected' : '' }}>
                                            {{ $publisher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="bookPublisherValidationMessage"></div>
                                @error('publisher')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                    {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="godinaIzdanja" class="form-label">Godina izdavanja</label>
                                <input type="number" required name="published_at" min="1800" value="{{ old('title' ,$book->published_at) }}"
                                       id="bookPublishedAt" class="form-control">
                                <div id="bookPublishedAtValidationMessage"></div>
                                @error('published_at')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                    {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="godinaIzdanja" class="form-label">Količina</label>
                                <input required min="1" max="999" value="{{ old('title' ,$book->total_copies) }}" type="number" name="total_copies"
                                       id="bookCopies" class="form-control">
                                <div id="bookCopiesValidationMessage"></div>
                                @error('total_copies')
                                <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                    {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade hidden" id="specifikacije-tab" role="tabpanel" aria-labelledby="specifikacije">
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="brStrana" class="form-label">Broj strana</label>
                                <input type="text" minlength="1" maxlength="4" value="{{ old('title' ,$book->total_pages) }}"
                                       name="total_pages" id="bookPages"
                                       class="form-control"
                                       onkeydown="clearErrorsBrStrana()" />
                                <div id="bookPagesValidationMessage"></div>
                                @error('total_pages')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pismoInput" class="form-label">Pismo</label>
                                <select required
                                        class="form-control"
                                        name="script" id="bookScript">
                                    <option selected></option>
                                    @foreach ($scripts as $script)
                                        <option value="{{ $script->id }}"
                                            {{ old('script', $book->script->id) == $script->id ? 'selected' : '' }}>
                                            {{ $script->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="bookScriptValidationMessage"></div>
                                @error('script')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jezikInput" class="form-label">Jezik</label>
                                <select required
                                        class="form-control"
                                        name="language" id="bookLanguage">
                                    <option selected></option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}"
                                            {{ old('language', $book->language->id) == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }}</option>
                                    @endforeach
                                </select>
                                <div id="bookLanguageValidationMessage"></div>
                                @error('language')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="povezInput" class="form-label">Povez</label>
                                <select required
                                        class="form-control"
                                        name="cover" id="bookCover" onclick="clearErrorsPovez()">
                                    @foreach ($covers as $cover)
                                        <option value="{{ $cover->id }}"
                                            {{ old('cover', $book->cover->id) == $cover->id ? 'selected' : '' }}>
                                            {{ $cover->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="bookCoverValidationMessage"></div>
                                @error('cover')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="formatInput" class="form-label">Format</label>
                                <select required
                                        class="form-control"
                                        name="format" id="bookFormat" onclick="clearErrorsFormat()">
                                    <option selected></option>
                                    @foreach ($formats as $format)
                                        <option value="{{ $format->id }}"
                                            {{ old('format', $book->format->id) == $format->id ? 'selected' : '' }}>
                                            {{ $format->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="bookFormatValidationMessage"></div>
                                @error('format')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="isbn" class="form-label">International Standard Book Num</label>
                                <input required minlength="13" maxlength="13" type="text" name="isbn"
                                       id="bookIsbn"
                                       class="form-control"
                                       value="{{ old('title' ,$book->isbn) }}"
                                       onkeydown="clearErrorsIsbn()" />
                                <div id="bookIsbnValidationMessage"></div>
                                @error('isbn')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="multimedija-tab" role="tabpanel" aria-labelledby="multimedija">
                <section id="addBookTab_Multimedia">
                    <div class="scroll height-content section-content">

                        <div class="w-9/12 mx-auto bg-white rounded p7 mt-[40px] mb-[150px]">
                            <div x-data="dataFileDnD()"
                                 class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                                <div x-ref="dnd"
                                     class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                                    <input id="multimediaInput" name="pictures[]" accept="*" type="file" multiple
                                           class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                                           @change="addFiles($event)"
                                           @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                                           @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                           @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                           title="" />

                                    <div class="flex flex-col items-center justify-center py-10 text-center">

                                        <p class="m-0">Drag your files here or click in this area.</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-4 mt-4 2xl:grid-cols-4" @drop.prevent="drop($event)"
                                     @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                                    <!-- Image 1 -->
                                    @foreach ($book->gallery as $picture)
                                        <div picture="{{ $picture->picture }}"
                                             class="relative flex flex-col text-xs bg-white bg-opacity-50 hiddenImage1">
                                            <img src="{{ asset('storage/uploads/books/' . $picture->picture) }}"
                                                 alt="" class="h-[322px]">
                                            <!-- Checkbox -->
                                            <input id="isCoverBtn"
                                                   class="absolute top-[10px] right-[10px] z-50 p-1 bg-white rounded-bl focus:outline-none"
                                                   type="radio" name="cover_picture" value="{{ $picture->picture }}"
                                                   @if ($book->picture == $picture->picture) checked @endif />
                                            <!-- End checkbox -->
                                            <button
                                                class="absolute bottom-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                                type="button"
                                                onclick="deletePicture('{{ $picture->picture }}', {{ $picture->id }})">
                                                <svg class="w-[25px] h-[25px] text-gray-700"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     nviewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                            <div
                                                class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs text-center bg-white bg-opacity-50">
                                                <span
                                                    class="w-full font-bold text-gray-900 truncate">{{ $picture->picture }}</span>
                                                <span class="text-xs text-gray-900">{{ rand(50, 5120) }}kB</span>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- End of image 1 -->

                                    <template x-for="(_, index) in Array.from({ length: files.length })">
                                        <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
                                             style="padding-top: 100%;" @dragstart="dragstart($event)"
                                             @dragend="fileDragging = null"
                                             :class="{ 'border-blue-600': fileDragging == index }" draggable="true"
                                             :data-index="index">
                                            <!-- Checkbox -->
                                            <input id="isCoverBtn"
                                                   class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                                   type="radio" name="cover_picture"
                                                   x-bind:value="loadCoverPicture(files[index])" />
                                            <!-- End checkbox -->
                                            <button
                                                class="absolute bottom-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                                type="button" @click="remove(index);">
                                                <svg class="w-[25px] h-[25px] text-gray-700"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     nviewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                            <template x-if="files[index].type.includes('audio/')">
                                                <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                </svg>
                                            </template>
                                            <template
                                                x-if="files[index].type.includes('application/') || files[index].type === ''">
                                                <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            </template>
                                            <template x-if="files[index].type.includes('image/')">
                                                <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                                     x-bind:src="loadFile(files[index])" />
                                            </template>
                                            <template x-if="files[index].type.includes('video/')">
                                                <video
                                                    class="absolute inset-0 object-cover w-full h-full border-4 border-white pointer-events-none preview">
                                                    <fileDragging x-bind:src="loadFile(files[index])" type="video/mp4">
                                                </video>
                                            </template>

                                            <div
                                                class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                                                <span class="w-full font-bold text-gray-900 truncate"
                                                      x-text="files[index].name">Loading</span>
                                                <span class="text-xs text-gray-900"
                                                      x-text="humanFileSize(files[index].size)">...</span>
                                            </div>

                                            <div class="absolute inset-0 z-40 transition-colors duration-300"
                                                 @dragenter="dragenter($event)" @dragleave="fileDropping = null"
                                                 :class="{
                                                    'bg-blue-200 bg-opacity-80': fileDropping == index &&
                                                        fileDragging !=
                                                        index
                                                }">
                                            </div>

                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
            <div class="row">
                <div class="col">
                    <div class="float-end">
                        <button class="button btn btn-outline-danger" type="button" id="prev">Poništi</button>
                        <button id="saveBookBtn" class="button btn btn-primary" type="submit">Ažuriraj</button>
                    </div>
                </div>
            </div>
    </form>




@endsection


@section('scripts')
    <script>
        let elementi = ["bookCategories", "bookGenres", "bookAuthors", "bookPublishers", "bookScript", "bookLanguage", "bookCover", "bookFormat"]

        $.each( elementi, function(key, value ) {
            new Choices(document.getElementById(value));
        });

        ClassicEditor
            .create( document.querySelector( '#bookDescription' ) )
            .then( newEditor => {
                editor = newEditor;
            } )
            .catch( error => {
                console.error( error );
            } );


        function dataFileDnD() {
            return {
                files: [],
                fileDragging: null,
                fileDropping: null,
                humanFileSize(size) {
                    const i = Math.floor(Math.log(size) / Math.log(1024));
                    return (
                        (size / Math.pow(1024, i)).toFixed(2) * 1 +
                        " " + ["B", "kB", "MB", "GB", "TB"][i]
                    );
                },
                remove(index) {
                    const input = jQuery('#multimediaInput');
                    let files = [...this.files];
                    files.splice(index, 1);

                    this.files = createFileList(files);
                    input[0].files = this.files;
                },
                drop(e) {
                    let removed, add;
                    let files = [...this.files];

                    removed = files.splice(this.fileDragging, 1);
                    files.splice(this.fileDropping, 0, ...removed);

                    this.files = createFileList(files);

                    this.fileDropping = null;
                    this.fileDragging = null;
                },
                dragenter(e) {
                    let targetElem = e.target.closest("[draggable]");

                    this.fileDropping = targetElem.getAttribute("data-index");
                },
                dragstart(e) {
                    this.fileDragging = e.target
                        .closest("[draggable]")
                        .getAttribute("data-index");
                    e.dataTransfer.effectAllowed = "move";
                },
                loadFile(file) {
                    const preview = document.querySelectorAll(".preview");
                    const blobUrl = URL.createObjectURL(file);

                    preview.forEach(elem => {
                        elem.onload = () => {
                            URL.revokeObjectURL(elem.src); // free memory
                        };
                    });


                    return blobUrl;
                },
                loadCoverPicture(file) {
                    return file.name;

                },
                addFiles(e) {
                    const files = createFileList([...this.files], [...e.target.files]);
                    this.files = files;
                    e.target.files = files
                    //this.form.formData.files = [...files];
                }
            };
        }
        function deletePicture(picture, pictureId) {
            const selectedPicture = jQuery("div[picture='" + picture + "']");
            selectedPicture.css({
                display: 'none',
            });

            // remove chacked state from isCoverBtn if picutre was cover
            const isCoverBtn = selectedPicture.find("input");
            const isCheckedCheck = isCoverBtn.is(':checked');
            if (isCheckedCheck) {
                isCoverBtn.removeAttr('checked');
            }

            // send backend request witj ajax
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });


            jQuery.ajax({
                type: "POST",
                url: "/books/" + {{ $book->id }} + "/" + pictureId,
                data: jQuery('#bookEditForm').serialize(),
                success: function() {

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endsection
