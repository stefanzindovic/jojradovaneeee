@extends('app')

@section('page_title')
    Nova knjiga
@endsection

@section('page_content')
    <div class="card card-body border-0 shadow mb-4">
        <form id="form" action="{{route('books.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div id="svg_wrap"></div>
            <section class="mt-5">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="nazivKnjiga" class="form-label">Naziv</label>
                            <input required minlength="1" maxlength="50" type="text" name="title"
                                   id="bookTitle" value="{{ old('title') }}" class="form-control" />
                            @error('title')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                            <div id="bookTitleValidationMessage"></div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Kratki Sadržaj</label>
                            <textarea minlength="10" maxlength="2048" name="description" id="bookDescription">{{ old('description') }}</textarea>
                            <div id="bookDescriptionValidationMessage"></div>
                            @error('description')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategorijaInput" class="form-label">Izaberite kategorije</label>
                            <select required class="form-control" id="bookCategories" name="categories[]" multiple="multiple" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
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
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ collect(old('genres'))->contains($genre->id) ? 'selected' : '' }}>
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
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}"
                                        {{ collect(old('authors'))->contains($author->id) ? 'selected' : '' }}>
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
                                        {{ old('publisher') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}
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
                            <input type="number" required name="published_at" min="1800" value="2022"
                                    id="bookPublishedAt" class="form-control">
                            <div id="bookPublishedAtValidationMessage"></div>
                            @error('published_at')
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="godinaIzdanja" class="form-label">Količina</label>
                            <input required min="1" max="999" value="1" type="number" name="total_copies"
                                   id="bookCopies" class="form-control">
                            <div id="bookCopiesValidationMessage"></div>
                            @error('total_copies')
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <button class="button btn btn-outline-secondary" type="button" id="prev" disabled>Nazad</button>
                            <button class="button btn btn-primary" type="button" id="next">Dalje</button>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="brStrana" class="form-label">Broj strana</label>
                            <input type="text" minlength="1" maxlength="4" value="10"
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
                                        {{ old('script') == $script->id ? 'selected' : '' }}>{{ $script->name }}
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
                                        {{ old('language') == $language->id ? 'selected' : '' }}>
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
                                        {{ old('cover') == $cover->id ? 'selected' : '' }}>{{ $cover->name }}
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
                                        {{ old('format') == $format->id ? 'selected' : '' }}>{{ $format->name }}
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
                                   onkeydown="clearErrorsIsbn()" />
                            <div id="bookIsbnValidationMessage"></div>
                            @error('isbn')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <button class="button btn btn-outline-secondary" type="button" id="prev">Nazad</button>
                            <button class="button btn btn-primary" type="button" id="next">Dalje</button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="addBookTab_Multimedia" class="hidden">
                <div class="scroll height-content section-content">
                    <div class="w-9/12 mx-auto bg-white rounded p7 mt-[40px] mb-[150px]">
                        <div x-data="dataFileDnD()"
                             class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                            <div x-ref="dnd"
                                 class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                                <input name="pictures[]" accept="*" type="file" multiple id="multimediaInput"
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

                            <template x-if="files.length > 0">
                                <div class="grid grid-cols-4 gap-4 mt-4" @drop.prevent="drop($event)"
                                     @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
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
                                                type="button" @click="remove(index)">
                                                <svg class="w-[25px] h-[25px] text-gray-700"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     nviewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                            <template x-if="files[index].type.includes('audio/')">
                                                <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                </svg>
                                            </template>
                                            <template
                                                x-if="files[index].type.includes('application/') || files[index].type === ''">
                                                <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
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
                                                    <fileDragging x-bind:src="loadFile(files[index])"
                                                                  type="video/mp4">
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
                            </template>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <button class="button btn btn-outline-secondary" type="button" id="prev">Nazad</button>
                            <button id="saveBookBtn" class="button btn btn-primary" type="submit">Kreiraj</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>

@endsection


@section('scripts')
    <script>
        let elementi = ["bookCategories", "bookGenres", "bookAuthors", "bookPublishers", "bookScript", "bookLanguage", "bookCover", "bookFormat"]

         $.each( elementi, function(key, value ) {
            new Choices(document.getElementById(value), {
                removeItems: true,
                removeItemButton: true,
            });
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
    </script>
    <script>
        $( document ).ready(function() {
            var base_color = "rgb(230,230,230)";
            var active_color = "rgb(19,22,50)";



            var child = 1;
            var length = $("section").length - 1;
            $("#prev").addClass("disabled");
            $("#submit").addClass("disabled");

            $("section").not("section:nth-of-type(1)").hide();
            $("section").not("section:nth-of-type(1)").css('transform','translateX(100px)');

            var svgWidth = length * 200 + 24;
            $("#svg_wrap").html(
                '<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
                svgWidth +
                ' 24" xml:space="preserve"></svg>'
            );

            function makeSVG(tag, attrs) {
                var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
                for (var k in attrs) el.setAttribute(k, attrs[k]);
                return el;
            }

            for (i = 0; i < length; i++) {
                var positionX = 12 + i * 200;
                var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
                document.getElementById("svg_form_time").appendChild(rect);
                // <g><rect x="12" y="9" width="200" height="6"></rect></g>'
                var circle = makeSVG("circle", {
                    cx: positionX,
                    cy: 12,
                    r: 12,
                    width: positionX,
                    height: 6
                });
                document.getElementById("svg_form_time").appendChild(circle);
            }

            var circle = makeSVG("circle", {
                cx: positionX + 200,
                cy: 12,
                r: 12,
                width: positionX,
                height: 6
            });
            document.getElementById("svg_form_time").appendChild(circle);

            $('#svg_form_time rect').css('fill',base_color);
            $('#svg_form_time circle').css('fill',base_color);
            $("circle:nth-of-type(1)").css("fill", active_color);


            $(".button").click(function () {
                $("#svg_form_time rect").css("fill", active_color);
                $("#svg_form_time circle").css("fill", active_color);
                var id = $(this).attr("id");
                if (id == "next") {
                    child++;
                } else if (id == "prev") {
                    child--;
                }
                var circle_child = child + 1;
                $("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
                    "fill",
                    base_color
                );
                $("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
                    "fill",
                    base_color
                );
                var currentSection = $("section:nth-of-type(" + child + ")");
                currentSection.fadeIn();
                currentSection.css('transform','translateX(0)');
                currentSection.prevAll('section').css('transform','translateX(-100px)');
                currentSection.nextAll('section').css('transform','translateX(100px)');
                $('section').not(currentSection).hide();
            });

        });

    </script>
@endsection
