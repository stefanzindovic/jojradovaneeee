@extends('app')

@section('page_title')
    {{ $author->full_name }} | Izmijeni podatke
@endsection

@section('page_content')
    <x-cropper-frame></x-cropper-frame>
    <section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
        <!-- Heading of content -->
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
                                    <a href="{{route('authors.index')}}" class="text-[#2196f3] hover:text-blue-600">
                                        Evidencija autora
                                    </a>
                                </li>
                                <li>
                                    <span class="mx-2">/</span>
                                </li>
                                <li>
                                    <a href="{{route('authors.show', $author->id)}}"
                                       class="text-[#2196f3] hover:text-blue-600">
                                        {{$author->full_name}}
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

        <!-- Space for content -->
        <div class="scroll height-content section-content">
            <form id="myForm" method="POST" action="{{route('authors.update', $author->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="flex flex-row ml-[30px]">
                    <div class="w-[50%] mb-[150px]">
                        <div class="mt-[20px]">
                            <p>Ime i prezime <span class="text-red-500">*</span></p>
                            <input type="text" name="full_name" id="authorName"
                                   value="{{old('full_name', $author->full_name)}}"
                                   class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            />
                            @error('full_name')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                            <div id="authorNameValidationMessageByJs"></div>
                        </div>

                        <div class="mt-[20px]">
                            <p class="inline-block mb-2">Opis</p>
                            <textarea name="bio" id="authorBio"
                                      class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">{{old('bio', $author->bio)}}</textarea>
                            @error('bio')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                            <div id="authorBioValidationMessageByJs"></div>
                        </div>
                    </div>
                    <x-cropper picture="{{ $author->picture }}" stage="authors"></x-cropper>
                </div>
                <div class="absolute bottom-0 w-full">
                    <div class="flex flex-row">
                        <div class="inline-block w-full text-white text-right py-[7px] mr-[100px]">
                            <button type="reset"
                                    class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                            </button>
                            <button id="saveAuthorBtn" type="submit"
                                    class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]"
                                    >
                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
