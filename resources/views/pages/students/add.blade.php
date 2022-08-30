@extends('app')

@section('page_title')
    Novi učenik
@endsection

@section('page_content')
    <x-cropper-frame></x-cropper-frame>
    <section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex border-b-[1px] border-[#e4dfdf]">
                <div class="pl-[30px] py-[10px] flex flex-col">
                    <div>
                        <h1 class="">
                            Novi učenik
                        </h1>
                    </div>
                    <div>
                        <nav class="w-full rounded">
                            <ol class="flex list-reset">
                                <li>
                                    <a href="{{ route('students.index') }}" class="text-[#2196f3] hover:text-blue-600">
                                        Svi ucenici
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
            <form id="myForm" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-row ml-[30px]">
                    <div class="w-[50%] mb-[100px]">
                        <div class="mt-[20px]">
                            <span>Ime i prezime <span class="text-red-500">*</span></span>
                            <input minlength="4" maxlength="50" required type="text" name="name" id="studentName" value="{{ old('name') }}" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsNameUcenikEdit()"/>
                            @error('name')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                            <div id="studentNameValidationMessage"></div>
                        </div>

                        <div class="mt-[20px]">
                            <span>Tip korisnika</span>
                            <select class="flex w-[90%] mt-2 px-2 py-2 border bg-gray-300 border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]" name="tip_korisnika" disabled>
                                <option value="3" selected>
                                    Učnik
                                </option>
                            </select>
                        </div>

                        <div class="mt-[20px]">
                            <span>JMBG <span class="text-red-500">*</span></span>
                            <input minlength="13" maxlength="13" required type="text" name="jmbg" id="studentJmbg" value="{{old('jmbg')}}" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsJmbgUcenikEdit()"/>
                            @error('jmbg')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                            <div id="studentJmbgValidationMessage"></div>
                        </div>

                        <div class="mt-[20px]">
                            <span>E-mail <span class="text-red-500">*</span></span>
                            <input required type="email" name="email" id="studentEmail" value="{{ old('email') }}" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsEmailUcenikEdit()"/>
                            @error('email')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                            <div id="studentEmailValidationMessage"></div>
                        </div>

                        <div class="mt-[20px]">
                            <span>Korisnicko ime <span class="text-red-500">*</span></span>
                            <input minlength="4" maxlength="18" required type="text" name="username" id="studentUsername" value="{{old('username')}}" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsUsernameUcenikEdit()"/>
                            @error('username')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                            <div id="studentUsernameValidationMessage"></div>
                        </div>
                        <div class="mt-[20px]">
                            <span>Sifra <span class="text-red-500">*</span></span>
                            <input type="password" name="password" id="studentPassword" required minlength="8" maxlength="24" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsPwUcenikEdit()"/>
                            @error('password')
                            <p style="color:red;" id="errorMessageByLaravel"><i
                                    class="fa fa-times  mr-[5px] mt-[10px]"></i> {{ $message }}</p>
                            @enderror
                            <div id="studentPasswordValidationMessage"></div>
                        </div>

                        <div class="mt-[20px]">
                            <span>Ponovi sifru <span class="text-red-500">*</span></span>
                            <input type="password" name="password_confirm" id="studentPasswordConfirm" required minlength="8" maxlength="24" class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]" onkeydown="clearErrorsPw2UcenikEdit()"/>
                        </div>
                    </div>

                    <x-cropper></x-cropper>
                </div>

                <div class="absolute bottom-0 w-full">
                    <div class="flex flex-row">
                        <div class="inline-block w-full text-right py-[7px] mr-[100px] text-white">
                            <button type="reset"
                                    class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                            </button>
                            <button id="saveStudentBtn" type="submit"
                                    class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection
