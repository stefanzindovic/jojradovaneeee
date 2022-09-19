@php
use Jenssegers\Date\Date;

Date::setLocale('sr');
@endphp

@extends('app')

@section('page_title')
    {{ $student->name }}
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] pb-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex flex-row justify-between border-b-[1px] border-[#e4dfdf]">
                <div class="pl-[30px] py-[10px] flex flex-col">
                    <div>
                        <h1>
                            {{ $student->name }}
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
                                        {{ $student->name }}
                                    </p>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="pt-[24px] pr-[30px]">
                    <a href="#" class="inline hover:text-blue-600 show-modal">
                        <i class="fas fa-redo-alt mr-[3px]"></i>
                        Resetuj sifru
                    </a>
                    <a href="{{ route('students.edit', $student->id) }}"
                        class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="fas fa-edit mr-[3px] "></i>
                        Izmjeni
                    </a>
                    <p
                        class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-gray-300 dotsStudentProfile hover:text-[#606FC7]">
                        <i class="fas fa-ellipsis-v"></i>
                    </p>
                    <div
                        class="z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-student-profile">
                        <div class="absolute right-0 w-56 mt-[10px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                            aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                <form
                                    onSubmit="if(!confirm('Da li ste sigurni da želite da obrišete ovog učenika?')){return false;}"
                                    method="POST" action="{{ route('students.destroy', $student->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" tabindex="0"
                                        class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                        role="menuitem">
                                        <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                        <span class="px-4 py-0">Izbriši</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-b-[1px] py-4 text-gray-500 border-[#e4dfdf] pl-[30px] cursor-pointer">
            <a id="profileDetailsBtn" class="inline active-book-nav">
                Osnovni detalji
            </a>
            <a id="studentRecordsBtn" class="inline ml-[70px] hover:text-blue-800 cursor-pointer">
                Evidencija iznajmljivanja
            </a>
        </div>
        <div class="height-ucenikProfile pb-[30px] scroll">
            <!-- Space for content -->
            <section id="profileDetails" class="pl-[30px] section- mt-[20px]">
                <div class="flex flex-row">
                    <div class="mr-[30px]">
                        <div class="mt-[20px]">
                            <span class="text-gray-500">Ime i prezime</span>
                            <p class="font-medium">{{ $student->name }}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500">Tip korisnika</span>
                            <p class="font-medium">{{ $student->role->name }}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500">JMBG</span>
                            <p class="font-medium">{{ $student->jmbg }}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500">Email</span>
                            <a href="mailto:{{ $student->email }}"
                                class="block font-medium text-[#2196f3]">{{ $student->email }}</a>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500">Korisnicko ime</span>
                            <p class="font-medium">{{ $student->username }}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500">Broj logovanja</span>
                            <p class="font-medium">{{ $student->logins->count() }}</p>
                        </div>
                        <div class="mt-[40px]">
                            <span class="text-gray-500">Poslednji put logovan/a</span>
                            <p class="font-medium">
                                @if ($student->logins->isNotEmpty())
                                    {{ $student->logins[$student->logins->count() - 1]->created_at->diffForHumans() }}
                                @else
                                    Nikada se nije ulogovao
                                @endif
                            </p>
                        </div>

                    </div>
                    <div class="ml-[100px]  mt-[20px]">
                        <img class="p-2 border-2 border-gray-300" width="300px"
                            @if ($student->picture === 'profile-picture-placeholder.jpg') src="{{ asset('imgs/profile-picture-placeholder.jpg') }}" @else src="{{ asset('storage/uploads/students/' . $student->picture) }}" @endif
                            alt="Ikonica">
                    </div>
                </div>
            </section>
            <section id="studentRecords" class="justify-start pt-3 bg-white scroll hidden">
                <div class="mt-[10px]">
                    <ul class="text-[#2D3B48]">
                        <li class="mb-[4px]">
                            <div class="w-[300px] pl-[32px]">
                                <span class=" whitespace-nowrap w-full text-[25px]  flex justify-between fill-current">
                                    <div class="py-[15px] px-[20px] w-[268px] cursor-pointer bg-[#EFF3F6] rounded-[10px]">
                                        <a id="issuedBooksBtn" aria-label="Sve knjige" class="flex items-center">
                                            <i
                                                class="transition duration-300 ease-in group-hover:text-[#576cdf] text-[#576cdf] far fa-copy text-[20px]"></i>
                                            <div>
                                                <p
                                                    class="transition duration-300 ease-in group-hover:text-[#576cdf] text-[#576cdf] text-[15px] ml-[18px]">
                                                    Izdate knjige</p>
                                            </div>
                                        </a>
                                    </div>
                                </span>
                            </div>
                        </li>
                        <li class="mb-[4px]">
                            <div class="w-[300px] pl-[32px]">
                                <span class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                    <div
                                        class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                        <a id="returnedBooksBtn" aria-label="Izdate knjige" class="flex items-center">
                                            <i
                                                class="text-[#707070] text-[20px] fas fa-file transition duration-300 ease-in group-hover:text-[#576cdf]"></i>
                                            <div>
                                                <p
                                                    class="text-[15px] ml-[21px] transition duration-300 ease-in group-hover:text-[#576cdf]">
                                                    Vracene knjige</p>
                                            </div>
                                        </a>
                                    </div>
                                </span>
                            </div>
                        </li>
                        <li class="mb-[4px]">
                            <div class="w-[300px] pl-[28px]">
                                <span class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                    <div
                                        class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                        <a id="breachedBooksBtn" aria-label="Knjige na raspolaganju"
                                            class="flex items-center">
                                            <i
                                                class="text-[#707070] text-[20px] fas fa-exclamation-triangle transition duration-300 ease-in group-hover:text-[#576cdf]"></i>
                                            <div>
                                                <p
                                                    class="text-[15px] ml-[17px] transition duration-300 ease-in group-hover:text-[#576cdf]">
                                                    Knjige u prekoracenju</p>
                                            </div>
                                        </a>
                                    </div>
                                </span>
                            </div>
                        </li>
                        <li class="mb-[4px]">
                            <div class="w-[300px] pl-[32px]">
                                <span class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                    <div
                                        class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                        <a id="reservationsBooksBtn" aria-label="Rezervacije" class="flex items-center">
                                            <i
                                                class="text-[#707070] text-[20px] far fa-calendar-check transition duration-300 ease-in group-hover:text-[#576cdf]"></i>
                                            <div>
                                                <p
                                                    class="text-[15px] ml-[19px] transition duration-300 ease-in group-hover:text-[#576cdf]">
                                                    Aktivne rezervacije</p>
                                            </div>
                                        </a>
                                    </div>
                                </span>
                            </div>
                        </li>
                        <li class="mb-[4px]">
                            <div class="w-[300px] pl-[32px]">
                                <span class=" whitespace-nowrap w-full text-[25px] flex justify-between fill-current">
                                    <div
                                        class="group hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                        <a id="archivedBooksBtn" aria-label="Rezervacije" class="flex items-center">
                                            <i
                                                class="text-[#707070] text-[20px] fas fa-calendar-alt transition duration-300 ease-in group-hover:text-[#576cdf]"></i>
                                            <div>
                                                <p
                                                    class="text-[15px] ml-[19px] transition duration-300 ease-in group-hover:text-[#576cdf]">
                                                    Arhivirane rezervacije</p>
                                            </div>
                                        </a>
                                    </div>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="w-full mt-[10px] ml-2 px-2">
                    <div id="studentRecords_Issued">
                        <table class="shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf]" id="myTable">
                            <thead class="bg-[#EFF3F6]">
                                <tr class="border-b-[1px] border-[#e4dfdf]">
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox">
                                        </label>
                                    </th>
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left">
                                        Naziv knjige
                                        <a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down"
                                                onclick="sortTable()"></i>
                                        </a>
                                    </th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato uceniku</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Datum izdavanja</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Trenutno zadrzavanje
                                        knjige</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Knjigu izdao</th>
                                    <th class="px-4 py-4"> </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($issuedBooks as $book)
                                    <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                        <td class="px-4 py-3 whitespace-no-wrap">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </td>
                                        <td class="flex flex-row items-center px-4 py-3">
                                            <img style="width: 35px; height: 35px;"
                                                class="object-cover w-8 mr-2 h-11 rounded-full"
                                                src="@if ($book->book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->book->picture) }} @endif"
                                                alt="" />
                                            <a href="{{ route('books.show', $book->book->id) }}">
                                                <span class="font-medium text-center">{{ $book->book->title }}</span>
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ $book->student->name }}</td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($book->activeAction->action_start)->format('d.m.Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            <div>
                                                <span>2 nedelje i 3 dana</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ $book->activeAction->librarian->name }}</td>
                                        <td class="px-6 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                            <p
                                                class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsStudentProfileBookRecord hover:text-[#606FC7]">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </p>
                                            <div
                                                class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-student-profile-evidencija-knjige">
                                                <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                    aria-labelledby="headlessui-menu-button-1"
                                                    id="headlessui-menu-items-117" role="menu">
                                                    <div class="py-1">
                                                        <a href="{{ route('books.actions.details', ['book' => $book->id, 'action' => $book->activeAction->id]) }}"
                                                            tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Pogledaj detalje</span>
                                                        </a>

                                                        <a href="vratiKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Vrati knjigu</span>
                                                        </a>

                                                        <a href="otpisiKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Otpiši knjigu</span>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="studentRecords_Returned" class="hidden">
                        <table class="overflow-hidden shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf]"
                            id="myTable">
                            <thead class="bg-[#EFF3F6]">
                                <tr class="border-b-[1px] border-[#e4dfdf]">
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox">
                                        </label>
                                    </th>
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left">
                                        Naziv knjige
                                        <a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down"
                                                onclick="sortTable()"></i>
                                        </a>
                                    </th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato uceniku</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Datum izdavanja</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Datum vracanja</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Zadrzavanje knjige
                                    </th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Knjigu primio</th>
                                    <th class="px-4 py-4"> </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($returnedBooks as $book)
                                    <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                        <td class="px-4 py-3 whitespace-no-wrap">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </td>
                                        <td class="flex flex-row items-center px-4 py-3">
                                            <img style="width: 35px; height: 35px;"
                                                class="object-cover w-8 mr-2 h-11 rounded-full"
                                                src="@if ($book->book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->book->picture) }} @endif"
                                                alt="" />

                                            <a href="knjigaOsnovniDetalji.php">
                                                <span class="font-medium text-center">{{ $book->book->title }}</span>
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ $book->student->name }}</td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($book->activeAction->action_start)->format('d.m.Y') }}
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($book->activeAction->action_deadline)->format('d.m.Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            <div>
                                                <span>2 nedelje i 3 dana</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ $book->activeAction->librarian->name }}</td>
                                        <td class="px-6 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                            <p
                                                class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsUcenikVraceneKnjigeTabela hover:text-[#606FC7]">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </p>
                                            <div
                                                class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 ucenik-vracene-knjige-tabela">
                                                <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                    aria-labelledby="headlessui-menu-button-1"
                                                    id="headlessui-menu-items-117" role="menu">
                                                    <div class="py-1">
                                                        <a href="knjigaOsnovniDetalji.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Pogledaj detalje</span>
                                                        </a>

                                                        <a href="editKnjiga.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-edit mr-[6px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Izmijeni knjigu</span>
                                                        </a>

                                                        <a href="izdajKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Izdaj knjigu</span>
                                                        </a>

                                                        <a href="rezervisiKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="far fa-calendar-check mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Rezervisi knjigu</span>
                                                        </a>

                                                        <a href="vratiKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Vrati knjigu</span>
                                                        </a>

                                                        <a href="otpisiKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Otpisi knjigu</span>
                                                        </a>

                                                        <a href="#" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fa fa-trash mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Izbrisi knjigu</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div id="studentRecords_Breached" class="hidden">
                        <table class="overflow-hidden shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf]"
                            id="myTable">
                            <thead class="bg-[#EFF3F6]">
                                <tr class="border-b-[1px] border-[#e4dfdf]">
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox">
                                        </label>
                                    </th>
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left">
                                        Naziv knjige
                                        <a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down"
                                                onclick="sortTable()"></i>
                                        </a>
                                    </th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Datum izdavanja</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato uceniku</th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Prekoracenje u danima
                                    </th>
                                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Trenutno zadrzavanje
                                        knjige</th>
                                    <th class="px-4 py-4"> </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($breachedBooks as $book)
                                    <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                        <td class="px-4 py-3 whitespace-no-wrap">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </td>
                                        <td class="flex flex-row items-center px-4 py-3">
                                            <img style="width: 35px; height: 35px;"
                                                class="object-cover w-8 mr-2 h-11 rounded-full"
                                                src="@if ($book->book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->book->picture) }} @endif"
                                                alt="" />
                                            <a href="knjigaOsnovniDetalji.php">
                                                <span class="font-medium text-center">{{ $book->book->title }}</span>
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($book->activeAction->action_start)->format('d.m.Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ $book->student->name }}</td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            <div
                                                class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]">
                                                <span class="text-xs text-red-800">60 dana</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            <div>
                                                <span>3 mjeseca i 3 dana</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                            <p
                                                class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsUcenikPrekoracenjeKnjige hover:text-[#606FC7]">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </p>
                                            <div
                                                class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 ucenik-prekoracenje-knjige-tabela">
                                                <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                    aria-labelledby="headlessui-menu-button-1"
                                                    id="headlessui-menu-items-117" role="menu">
                                                    <div class="py-1">
                                                        <a href="knjigaOsnovniDetalji.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Pogledaj detalje</span>
                                                        </a>

                                                        <a href="editKnjiga.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-edit mr-[6px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Izmijeni knjigu</span>
                                                        </a>

                                                        <a href="izdajKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Izdaj knjigu</span>
                                                        </a>

                                                        <a href="rezervisiKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="far fa-calendar-check mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Rezervisi knjigu</span>
                                                        </a>

                                                        <a href="vratiKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Vrati knjigu</span>
                                                        </a>

                                                        <a href="otpisiKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Otpisi knjigu</span>
                                                        </a>

                                                        <a href="#" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fa fa-trash mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Izbrisi knjigu</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div id="studentRecords_Reservations" class="hidden">
                        <table
                            class="overflow-hidden shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf] rezervacije"
                            id="myTable">
                            <thead class="bg-[#EFF3F6]">
                                <tr class="border-b-[1px] border-[#e4dfdf]">
                                    <th class="px-4 py-3 leading-4 tracking-wider text-left text-blue-500">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox">
                                        </label>
                                    </th>
                                    <th class="px-4 py-3 text-sm leading-4 tracking-wider text-left">Naslov knjige
                                    <th class="px-4 py-3 text-sm leading-4 tracking-wider text-left">Datum rezervacije
                                    </th>
                                    <th class="px-4 py-3 text-sm leading-4 tracking-wider text-left">Rezervacija istice
                                    </th>
                                    <th class="px-4 py-3 text-sm leading-4 tracking-wider text-left">Rezervaciju podnio
                                    </th>
                                    <th class="px-4 py-3 text-sm leading-4 tracking-wider text-left">Status</th>
                                    <th class="px-4 py-3"> </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($pendingReservations as $record)
                                    <tr
                                        class="hover:bg-gray-200 hover:shadow-md bg-gray-200 border-b-[1px] border-[#e4dfdf] changeBg">
                                        <td class="px-4 py-3 whitespace-no-wrap">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($record->activeAction->action_start)->format('d.m.Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($record->activeAction->action_start)->format('d.m.Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">

                                            {{ \Carbon\Carbon::parse($record->activeAction->action_deadline)->format('d.m.Y') }}
                                        </td>
                                        <td class="flex flex-row items-center px-4 py-3">
                                            <img style="width: 35px; height: 35px;"
                                                class="object-cover w-8 mr-2 h-11 rounded-full"
                                                src="@if ($record->student->picture === 'profile-picture-placeholder.jpg') {{ asset('imgs/profile-picture-placeholder.jpg') }} @else {{ asset('storage/uploads/students/' . $record->student->picture) }} @endif"
                                                alt="" />
                                            <a href="{{ route('students.show', $record->student->id) }}"
                                                class="ml-2 font-medium text-center">{{ $record->student->name }}</a>
                                        </td>

                                        <td class="px-4 py-3">
                                            <div style="display: flex">

                                                <form action="{{ route('books.reservations.accept', $record->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="hover:text-green-500 mr-[5px]">
                                                        <i class="fas fa-check reservedStatus"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('books.reservations.decline', $record->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="hover:text-green-500 mr-[5px]">
                                                        <i class="fas fa-times deniedStatus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                            <p
                                                class="hidden inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsAktivneRezervacije hover:text-[#606FC7]">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </p>
                                            <div
                                                class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 aktivne-rezervacije">
                                                <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                    aria-labelledby="headlessui-menu-button-1"
                                                    id="headlessui-menu-items-117" role="menu">
                                                    <div class="py-1">
                                                        <a href="izdajKnjigu.php" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Izdaj knjigu</span>
                                                        </a>

                                                        <a href="#" tabindex="0"
                                                            class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                            role="menuitem">
                                                            <i class="fas fa-undo mr-[10px] ml-[5px] py-1"></i>
                                                            <span class="px-4 py-0">Otkazi rezervaciju</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($activeReservations as $record)
                                    <tr
                                        class="hover:bg-gray-200 hover:shadow-md bg-gray-200 border-b-[1px] border-[#e4dfdf] changeBg">
                                        <td class="px-4 py-3 whitespace-no-wrap">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($record->activeAction->action_start)->format('d.m.Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($record->activeAction->action_deadline)->format('d.m.Y') }}
                                        </td>
                                        <td class="flex flex-row items-center px-4 py-3">
                                            <img style="width: 35px; height: 35px;"
                                                class="object-cover w-8 mr-2 h-11 rounded-full"
                                                src="@if ($record->student->picture === 'profile-picture-placeholder.jpg') {{ asset('imgs/profile-picture-placeholder.jpg') }} @else {{ asset('storage/uploads/students/' . $record->student->picture) }} @endif"
                                                alt="" />
                                            <a href="{{ route('students.show', $record->student->id) }}"
                                                class="ml-2 font-medium text-center">{{ $record->student->name }}</a>
                                        </td>

                                        <td class="px-4 py-3 text-sm leading-5 text-blue-900 whitespace-no-wrap">
                                            <div
                                                class="inline-block px-[6px] py-[2px] font-medium bg-yellow-200 rounded-[10px]">
                                                <span class="text-xs text-yellow-700">Rezervisano</span>
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                            <p
                                                class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsAktivneRezervacije hover:text-[#606FC7]">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </p>
                                            <div
                                                class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 aktivne-rezervacije">
                                                <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                    aria-labelledby="headlessui-menu-button-1"
                                                    id="headlessui-menu-items-117" role="menu">
                                                    <div class="py-1">
                                                        <form
                                                            action="{{ route('books.reservations.issue', $record->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i
                                                                    class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Izdaj knjigu</span>
                                                            </button>
                                                        </form>

                                                        <form
                                                            action="{{ route('books.reservations.cancel', $record->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="fas fa-undo mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Otkaži rezervaciju</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="studentRecords_Archived" class="hidden">
                        Arhivirane
                    </div>
                </div>
        </div>
        </div>
    </section>
    </div>


    </section>

    <!-- This code will show up when we press reset password -->
    <div class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-screen bg-black bg-opacity-50 modal">
        <!-- Modal -->
        <div class="w-[500px] bg-white rounded shadow-lg md:w-1/3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-[30px] py-[20px] border-b">
                <h3>Resetuj šifru: {{ $student->name }}</h3>
                <button class="text-black close-modal">&cross;</button>
            </div>
            <!-- Modal Body -->
            <form method="POST" action="{{ route('students.password', $student->id) }}">
                @csrf
                @method('PATCH')
                <div class="flex flex-col px-[30px] py-[30px]">
                    <div class="flex flex-col pb-[30px]">
                        <span>Unesi novu šifru <span class="text-red-500">*</span></span>
                        <input required minlength="8" maxlength="24"
                            class="h-[40px] px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            type="password" name="password" id="newPassword">
                        <div id="passwordValidationMessage"></div>
                    </div>
                    <div class="flex flex-col pb-[30px]">
                        <span>Ponovi šifru <span class="text-red-500">*</span></span>
                        <input required minlength="8" maxlength="24"
                            class="h-[40px] px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            type="password" name="password_confirmation" id="newPasswordConfirmation">
                    </div>
                </div>
                <div class="flex items-center justify-end px-[30px] py-[20px] border-t w-100 text-white">
                    <button type="reset"
                        class="shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                        Ponisti <i class="fas fa-times ml-[4px]"></i>
                    </button>
                    <button id="savePasswordBtn" type="submit"
                        class="shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                        Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
