@extends('app')

@section('page_title')
    {{ $book->title }}
@endsection

@section('page_content')
    <div>
        <form id="bookEditForm" action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            {{ $book->picture }}
            <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
                <section>
                    <div class="heading">
                        <div class="flex border-b-[1px] border-[#e4dfdf]">
                            <div class="pl-[30px] py-[10px] flex flex-col">
                                <div>
                                    <h1>
                                        Izmijeni podatke
                                    </h1>
                                </div>
                                <div>
                                    <nav class="w-full rounded">
                                        <ol class="flex list-reset">
                                            <li>
                                                <a href="{{ route('books.index') }}"
                                                    class="text-[#2196f3] cursor-pointer hover:text-blue-600">
                                                    Evidencija knjiga
                                                </a>
                                            </li>
                                            <li>
                                                <span class="mx-2">/</span>
                                            </li>
                                            <li>
                                                <p class="text-gray-400">
                                                    Izmijeni podatke
                                                </p>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="py-4
                                                    text-gray-500 border-b-[1px] border-[#e4dfdf] pl-[30px]">
                        <a id="bookDetailsBtn" class="inline active-book-nav cursor-pointer hover:text-blue-800">
                            Osnovni detalji
                        </a>
                        <a id="bookSpecificationsBtn" class="inline ml-[70px] cursor-pointer hover:text-blue-800 ">
                            Specifikacija
                        </a>
                        <a id="bookMultimediaBtn" class="inline ml-[70px] cursor-pointer hover:text-blue-800">
                            Multimedija
                        </a>
                    </div>
                </section>
                <section id="addBookTab_Basics">
                    <div class="scroll height-content section-content">
                        <div class="flex flex-row ml-[30px] mb-[150px]">
                            <div class="w-[50%]">
                                <div class="mt-[20px]">
                                    <p>Naslov knjige <span class="text-red-500">*</span></p>
                                    <input required minlength="1" maxlength="50" type="text" name="title"
                                        id="bookTitle" value="{{ old('title', $book->title) }}"
                                        class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" />
                                    @error('title')
                                        <p style="color:red;" id="errorMessageByLaravel"><i
                                                class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                    @enderror
                                    <div id="bookTitleValidationMessage"></div>
                                </div>

                                <div class="mt-[20px]">
                                    <p class="inline-block mb-2">Kratki sadržaj</p>
                                    <textarea required minlength="10" maxlength="500" name="description" id="bookDescription"
                                        class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">{{ old('description', $book->description) }}</textarea>
                                    <div id="bookDescriptionValidationMessage"></div>
                                    @error('description')
                                        <p style="color:red;" id="errorMessageByLaravel"><i
                                                class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-[20px]">
                                    <p>Izaberite kategorije <span class="text-red-500">*</span></p>
                                    <select required id="bookCategories" name="categories[]" multiple="multiple"
                                        class="select2Form flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">
                                        {{-- Convert collection of categories into categories id arrays --}}
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

                                    <div x-init="loadOptions()" class="flex flex-col w-[90%]" style="display: none">
                                        <input name="values" id="kategorijaInput" type="hidden"
                                            x-bind:value="selectedValues()">
                                        <div class="relative inline-block w-[100%]">
                                            <div class="relative flex flex-col items-center">
                                                <div x-on:click="open" class="w-full svelte-1l8159u">
                                                    <div class="flex p-1 my-2 bg-white border border-gray-300 shadow-sm svelte-1l8159u focus-within:ring-2 focus-within:ring-[#576cdf]"
                                                        onclick="clearErrorsKategorija()">
                                                        <div class="flex flex-wrap flex-auto">
                                                            <template x-for="(option,index) in selected"
                                                                :key="options[option].value">
                                                                <div
                                                                    class="flex items-center justify-center px-[6px] py-[2px] m-1 text-blue-800 bg-blue-200 rounded-[10px] ">
                                                                    <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                                        options[option] x-text="options[option].text"></div>
                                                                    <div class="flex flex-row-reverse flex-auto">
                                                                        <div x-on:click="remove(index,option)">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        </template>
                                                        <div x-show="selected.length    == 0" class="flex-1">
                                                            <input
                                                                class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none"
                                                                x-bind:value="selectedValues()">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 svelte-1l8159u">
                                                        <button type="button" x-show="isOpen() === true" x-on:click="open"
                                                            class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                                        </button>
                                                        <button type="button" x-show="isOpen() === false" @click="close"
                                                            class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">

                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full">
                                                <div x-show.transition.origin.top="isOpen()"
                                                    class="z-40 w-full overflow-y-auto bg-white rounded shadow max-h-select svelte-5uyqqj"
                                                    x-on:click.away="close">
                                                    <div class="flex flex-col w-full">
                                                        <template x-for="(option,index) in options" :key="option">
                                                            <div>
                                                                <div class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-teal-100"
                                                                    @click="select(index,$event)">
                                                                    <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                                                        class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                                                                        <div class="flex items-center w-full">
                                                                            <div class="mx-2 leading-6" x-model="option"
                                                                                x-text="option.text"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="bookCategoriesValidationMessage"></div>
                                @error('categories[]')
                                    <p style="color:red;" id="errorMessageByLaravel"><i
                                            class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-[20px]">
                                <p>Izaberite žanrove <span class="text-red-500">*</span></p>
                                <select required id="bookGenres" name="genres[]" multiple="multiple"
                                    class="select2Form flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">
                                    {{-- Convert collection of genres into genres id arrays --}}
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

                                <div x-init="loadOptions()" class="flex flex-col w-[90%]" style="display: none">
                                    <input name="values" id="kategorijaInput" type="hidden"
                                        x-bind:value="selectedValues()">
                                    <div class="relative inline-block w-[100%]">
                                        <div class="relative flex flex-col items-center">
                                            <div x-on:click="open" class="w-full svelte-1l8159u">
                                                <div class="flex p-1 my-2 bg-white border border-gray-300 shadow-sm svelte-1l8159u focus-within:ring-2 focus-within:ring-[#576cdf]"
                                                    onclick="clearErrorsKategorija()">
                                                    <div class="flex flex-wrap flex-auto">
                                                        <template x-for="(option,index) in selected"
                                                            :key="options[option].value">
                                                            <div
                                                                class="flex items-center justify-center px-[6px] py-[2px] m-1 text-blue-800 bg-blue-200 rounded-[10px] ">
                                                                <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                                    options[option] x-text="options[option].text"></div>
                                                                <div class="flex flex-row-reverse flex-auto">
                                                                    <div x-on:click="remove(index,option)">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    </template>
                                                    <div x-show="selected.length    == 0" class="flex-1">
                                                        <input
                                                            class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none"
                                                            x-bind:value="selectedValues()">
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 svelte-1l8159u">
                                                    <button type="button" x-show="isOpen() === true" x-on:click="open"
                                                        class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                                    </button>
                                                    <button type="button" x-show="isOpen() === false" @click="close"
                                                        class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <div x-show.transition.origin.top="isOpen()"
                                                class="z-40 w-full overflow-y-auto bg-white rounded shadow max-h-select svelte-5uyqqj"
                                                x-on:click.away="close">
                                                <div class="flex flex-col w-full">
                                                    <template x-for="(option,index) in options" :key="option">
                                                        <div>
                                                            <div class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-teal-100"
                                                                @click="select(index,$event)">
                                                                <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                                                    class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                                                                    <div class="flex items-center w-full">
                                                                        <div class="mx-2 leading-6" x-model="option"
                                                                            x-text="option.text"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bookGenresValidationMessage"></div>
                            @error('genres[]')
                                <p style="color:red;" id="errorMessageByLaravel"><i
                                        class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="w-[50%]">
                        <div class="mt-[20px]">
                            <p>Izaberite autore <span class="text-red-500">*</span></p>
                            <select required id="bookAuthors" name="authors[]" multiple="multiple"
                                class="select2Form flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">
                                {{-- Convert collection of authors into authors id arrays --}}
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

                            <div x-init="loadOptions()" class="flex flex-col w-[90%]" style="display: none">
                                <input name="values" id="kategorijaInput" type="hidden"
                                    x-bind:value="selectedValues()">
                                <div class="relative inline-block w-[100%]">
                                    <div class="relative flex flex-col items-center">
                                        <div x-on:click="open" class="w-full svelte-1l8159u">
                                            <div class="flex p-1 my-2 bg-white border border-gray-300 shadow-sm svelte-1l8159u focus-within:ring-2 focus-within:ring-[#576cdf]"
                                                onclick="clearErrorsKategorija()">
                                                <div class="flex flex-wrap flex-auto">
                                                    <template x-for="(option,index) in selected"
                                                        :key="options[option].value">
                                                        <div
                                                            class="flex items-center justify-center px-[6px] py-[2px] m-1 text-blue-800 bg-blue-200 rounded-[10px] ">
                                                            <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                                options[option] x-text="options[option].text"></div>
                                                            <div class="flex flex-row-reverse flex-auto">
                                                                <div x-on:click="remove(index,option)">

                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                </template>
                                                <div x-show="selected.length    == 0" class="flex-1">
                                                    <input
                                                        class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none"
                                                        x-bind:value="selectedValues()">
                                                </div>
                                            </div>
                                            <div class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 svelte-1l8159u">
                                                <button type="button" x-show="isOpen() === true" x-on:click="open"
                                                    class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                                </button>
                                                <button type="button" x-show="isOpen() === false" @click="close"
                                                    class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <div x-show.transition.origin.top="isOpen()"
                                            class="z-40 w-full overflow-y-auto bg-white rounded shadow max-h-select svelte-5uyqqj"
                                            x-on:click.away="close">
                                            <div class="flex flex-col w-full">
                                                <template x-for="(option,index) in options" :key="option">
                                                    <div>
                                                        <div class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-teal-100"
                                                            @click="select(index,$event)">
                                                            <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                                                class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                                                                <div class="flex items-center w-full">
                                                                    <div class="mx-2 leading-6" x-model="option"
                                                                        x-text="option.text"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="bookAuthorsValidationMessage"></div>
                        @error('authors[]')
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-[20px]">
                        <p>Izdavač <span class="text-red-500">*</span></p>
                        <select required
                            class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            name="publisher" id="bookPublisher" id="izdavac">
                            <option selected></option>
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

                    <div class="mt-[20px]">
                        <p>Godina izdavanja <span class="text-red-500">*</span></p>
                        <input
                            class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            type="number" required name="published_at" min="1800"
                            value="{{ old('published_at', $book->published_at) }}" id="bookPublishedAt">
                        <div id="bookPublishedAtValidationMessage"></div>
                        @error('published_at')
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-[20px]">
                        <p>Kolicina <span class="text-red-500">*</span></p>
                        <input required min="1" max="999"
                            value="{{ old('total_copies', $book->total_copies) }}" type="number" name="total_copies"
                            id="bookCopies"
                            class="flex w-[45%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" />
                        <div id="bookCopiesValidationMessage"></div>
                        @error('total_copies')
                            <p style="color:red;" id="errorMessageByLaravel"><i class="fa fa-times  mr-[5px] mt-[10px]"></i>
                                {{ $message }}</p>
                        @enderror
                    </div>
                </section>
                <section id="addBookTab_Specifications" class="hidden">
                    <div class="scroll height-content section-content">
                        <div class="flex flex-row ml-[30px]">
                            <div class="w-[50%] mb-[150px]">
                                <div class="mt-[20px]">
                                    <p>Broj strana <span class="text-red-500">*</span></p>
                                    <input type="text" minlength="1" maxlength="4"
                                        value="{{ old('total_pages', $book->total_pages) }}" name="total_pages"
                                        id="bookPages"
                                        class="flex w-[45%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        onkeydown="clearErrorsBrStrana()" />
                                    <div id="bookPagesValidationMessage"></div>
                                    @error('total_pages')
                                        <p style="color:red;" id="errorMessageByLaravel"><i
                                                class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-[20px]">
                                    <p>Pismo <span class="text-red-500">*</span></p>
                                    <select required
                                        class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
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

                                <div class="mt-[20px]">
                                    <p>Povez <span class="text-red-500">*</span></p>
                                    <select required
                                        class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        name="cover" id="bookCover" onclick="clearErrorsPovez()">
                                        <option selected></option>
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

                                <div class="mt-[20px]">
                                    <p>Jezik <span class="text-red-500">*</span></p>
                                    <select required
                                        class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
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

                                <div class="mt-[20px]">
                                    <p>Format <span class="text-red-500">*</span></p>
                                    <select required
                                        class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
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

                                <div class="mt-[20px]">
                                    <p>International Standard Book Num <span class="text-red-500">*</span></p>
                                    <input required minlength="13" maxlength="13" type="text" name="isbn"
                                        id="bookIsbn" value="{{ old('isbn', $book->isbn) }}"
                                        class="flex w-[45%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        onkeydown="clearErrorsIsbn()" />
                                    <div id="bookIsbnValidationMessage"></div>
                                    @error('isbn')
                                        <p style="color:red;" id="errorMessageByLaravel"><i
                                                class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                                    @enderror
                                </div>
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
                                    <input name="pictures[]" accept="*" type="file" multiple
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
        </form>
    </div>
    </section>
    <div class="absolute bottom-0 w-full">
        <div class="flex flex-row">
            <div class="inline-block w-full text-white text-right py-[7px] mr-[100px]">
                <button type="reset"
                    class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                    Ponisti <i class="fas fa-times ml-[4px]"></i>
                </button>
                <button id="saveBookBtn" type="submit"
                    class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                    Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                </button>
            </div>
        </div>
    </div>
    </section>
    </form>

    </div>

    <script>
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
                    let files = [...this.files];
                    files.splice(index, 1);

                    this.files = createFileList(files);
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
