@extends('app')

@section('page_title')
    Arhivirane rezervacije
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading mt-[7px]">
            <h1 class="pl-[30px] pb-[21px] border-b-[1px] border-[#e4dfdf] ">
                Arhivirane rezervacije
            </h1>
        </div>
        <!-- Space for content -->
        <div class="scroll height-dashboard">

            <div>
                <!-- Space for content -->
                <div class="flex justify-start pt-3 bg-white">
                    <div class="mt-[10px]">
                        <ul class="text-[#2D3B48]">
                            <li class="mb-[4px]">
                                <div class="w-[300px] pl-[32px]">
                                    <span class=" whitespace-nowrap w-full text-[25px]  flex justify-between fill-current">
                                        <div
                                            class="py-[15px] px-[20px] w-[268px] cursor-pointer group hover:bg-[#EFF3F6] rounded-[10px]">
                                            <a href="{{ route('books.issues.issues') }}" aria-label="Sve knjige"
                                                class="flex items-center">
                                                <i
                                                    class="text-[#707070] transition duration-300 ease-in group-hover:text-[#576cdf] far fa-copy text-[20px]"></i>
                                                <div>
                                                    <p
                                                        class="transition duration-300 ease-in group-hover:text-[#576cdf]  text-[15px] ml-[18px]">
                                                        Izdate knjige
                                                    </p>
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
                                            <a href="{{ route('books.issues.returned') }}" aria-label="Vracene knjige"
                                                class="flex items-center">
                                                <i
                                                    class="transition duration-300 ease-in  text-[#707070] text-[20px] fas fa-file group-hover:text-[#576cdf]"></i>
                                                <div>
                                                    <p
                                                        class="transition duration-300 ease-in  text-[15px] ml-[21px] group-hover:text-[#576cdf]">
                                                        Vracene knjige
                                                    </p>
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
                                            <a href="{{ route('books.issues.breached') }}"
                                                aria-label="Knjige na raspolaganju" class="flex items-center">
                                                <i
                                                    class="group-hover:text-[#576cdf] text-[#707070] text-[20px] fas fa-exclamation-triangle transition duration-300 ease-in "></i>
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
                                            <a href="{{ route('books.reservations') }}" aria-label="Rezervacije"
                                                class="flex items-center">
                                                <i
                                                    class="text-[#707070] group-hover:text-[#576cdf] text-[20px] far fa-calendar-check transition duration-300 ease-in"></i>
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
                                            class="group bg-[#EFF3F6] hover:bg-[#EFF3F6] py-[15px] px-[20px] w-[268px] rounded-[10px] cursor-pointer">
                                            <a href="{{ route('books.reservations.archived') }}" aria-label="Rezervacije"
                                                class="flex items-center">
                                                <i
                                                    class="text-[#707070] text-[20px] fas fa-calendar-alt transition duration-300 ease-in text-[#576cdf]"></i>
                                                <div>
                                                    <p
                                                        class="text-[15px] ml-[19px] transition duration-300 ease-in text-[#576cdf]">
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
                        <table class="overflow-hidden shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf] rezervacije"
                            id="myTable">
                            <thead class="bg-[#EFF3F6]">
                                <tr class="border-b-[1px] border-[#e4dfdf]">
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox">
                                        </label>
                                    </th>
                                    <th class="flex items-center px-4 py-4 leading-4 tracking-wider text-left">Naziv
                                        knjige<a href="#"><i class="ml-2 fa-lg fas fa-long-arrow-alt-down"
                                                onclick="sortTable()"></i></a>
                                    </th>

                                    <!-- Datum rezervacije + dropdown filter for date -->
                                    <th
                                        class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer datumDrop-toggle">
                                        Datum rezervacije<i class="ml-2 fas fa-filter"></i>
                                        <div id="datumDropdown"
                                            class="datumMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-l border-2 border-gray-300">
                                            <div
                                                class="flex justify-between flex-row p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <div>
                                                    <label class="font-medium text-gray-500">Period od:</label>
                                                    <input type="date"
                                                        class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none">
                                                </div>
                                                <div class="ml-[50px]">
                                                    <label class="font-medium text-gray-500">Period do:</label>
                                                    <input type="date"
                                                        class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none">
                                                </div>
                                            </div>
                                            <div class="flex pt-[10px] text-white ">
                                                <a href="#"
                                                    class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                    Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                </a>
                                                <a href="#"
                                                    class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                    Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </th>

                                    <!-- Rezervacija istice + dropdown filter for date -->
                                    <th
                                        class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer zadrzavanjeDrop-toggle">
                                        Rezervacija
                                        istice<i class="ml-2 fas fa-filter"></i>
                                        <div id="zadrzavanjeDropdown"
                                            class="zadrzavanjeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] right-0 border-2 border-gray-300">
                                            <div
                                                class="flex justify-between flex-row p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <div>
                                                    <label class="font-medium text-gray-500">Period od:</label>
                                                    <input type="date"
                                                        class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none">
                                                </div>
                                                <div class="ml-[50px]">
                                                    <label class="font-medium text-gray-500">Period do:</label>
                                                    <input type="date"
                                                        class="border-[1px] border-[#e4dfdf]  cursor-pointer focus:outline-none">
                                                </div>
                                            </div>
                                            <div class="flex pt-[10px] text-white ">
                                                <a href="#"
                                                    class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                    Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                </a>
                                                <a href="#"
                                                    class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                    Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </th>

                                    <!-- Rezervaciju podnio + dropdown filter for ucenik -->
                                    <th
                                        class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer uceniciDrop-toggle">
                                        Rezervaciju
                                        podnio<i class="ml-2 fas fa-filter"></i>
                                        <div id="uceniciDropdown"
                                            class="uceniciMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px]  right-0 border-2 border-gray-300">
                                            <ul class="border-b-2 border-gray-300 list-reset">
                                                <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                    <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                        placeholder="Search"
                                                        onkeyup="filterFunction('searchUcenici', 'uceniciDropdown', 'dropdown-item-ucenik')"
                                                        id="searchUcenici"><br>
                                                    <button
                                                        class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </li>
                                                <div class="h-[200px] scroll font-normal">
                                                    <li
                                                        class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-ucenik">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <img width="40px" height="30px" class="ml-[15px] rounded-full"
                                                            src="img/profileStudent.jpg">
                                                        <p
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            Ucenik Ucenikovic
                                                        </p>
                                                    </li>
                                                    <li
                                                        class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-ucenik">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <img width="40px" height="30px" class="ml-[15px] rounded-full"
                                                            src="img/profileStudent.jpg">
                                                        <p
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            Pero Perovic
                                                        </p>
                                                    </li>
                                                    <li
                                                        class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-ucenik">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <img width="40px" height="30px" class="ml-[15px] rounded-full"
                                                            src="img/profileStudent.jpg">
                                                        <p
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            Marko Markovic
                                                        </p>
                                                    </li>
                                                    <li
                                                        class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-ucenik">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <img width="40px" height="30px" class="ml-[15px] rounded-full"
                                                            src="img/profileStudent.jpg">
                                                        <p
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            Nikola Nikolic
                                                        </p>
                                                    </li>
                                                    <li
                                                        class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-ucenik">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <img width="40px" height="30px" class="ml-[15px] rounded-full"
                                                            src="img/profileStudent.jpg">
                                                        <p
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            Zivko Zivkovic
                                                        </p>
                                                    </li>
                                                    <li
                                                        class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-ucenik">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <img width="40px" height="30px" class="ml-[15px] rounded-full"
                                                            src="img/profileStudent.jpg">
                                                        <p
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            Petar Petrovic
                                                        </p>
                                                    </li>
                                                </div>
                                            </ul>
                                            <div class="flex pt-[10px] text-white ">
                                                <a href="#"
                                                    class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                    Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                </a>
                                                <a href="#"
                                                    class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                    Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </th>

                                    <!-- Status + dropdown filter for status -->
                                    <th
                                        class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer statusDrop-toggle">
                                        Status<i class="ml-2 fas fa-filter"></i>
                                        <div id="statusDropdown"
                                            class="statusMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] right-0 border-2 border-gray-300">
                                            <ul class="border-b-2 border-gray-300 list-reset">
                                                <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                    <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                        placeholder="Search"
                                                        onkeyup="filterFunction('searchStatus', 'statusDropdown')"
                                                        id="searchStatus"><br>
                                                    <button
                                                        class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </li>
                                                <div class="h-[200px] scroll font-normal">
                                                    <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <p
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            Rezervisano
                                                        </p>
                                                    </li>
                                                    <li class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200">
                                                        <label class="flex items-center justify-start">
                                                            <div
                                                                class="flex items-center justify-center flex-shrink-0 w-[16px] h-[16px] mr-2 bg-white border-2 border-gray-400 rounded focus-within:border-blue-500">
                                                                <input type="checkbox" class="absolute opacity-0">
                                                                <svg class="hidden w-4 h-4 text-green-500 pointer-events-none fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                                                                </svg>
                                                            </div>
                                                        </label>
                                                        <p
                                                            class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                            Odbijeno
                                                        </p>
                                                    </li>
                                                </div>
                                            </ul>
                                            <div class="flex pt-[10px] text-white ">
                                                <a href="#"
                                                    class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#46A149] bg-[#4CAF50] rounded-[5px]">
                                                    Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                                </a>
                                                <a href="#"
                                                    class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                    Ponisti <i class="fas fa-times ml-[4px]"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </th>
                                    <th class="px-4 py-4 hidden" style="display:none;"> </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">

                                @foreach ($reservations as $reservation)
                                    <tr
                                        class="hover:bg-gray-200 hover:shadow-md bg-gray-200 border-b-[1px] border-[#e4dfdf] changeBg">
                                        <td class="px-4 py-3 whitespace-no-wrap">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </td>
                                        <td class="flex flex-row items-center px-4 py-3">
                                            <img style="width: 35px; height: 35px;"
                                                class="object-cover w-8 mr-2 h-11 rounded-full"
                                                src="@if ($reservation->book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $reservation->book->picture) }} @endif"
                                                alt="" />
                                            <a href="{{ route('books.show', $reservation->book_id) }}">
                                                <span
                                                    class="font-medium text-center">{{ $reservation->book->title }}</span>
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($reservation->activeAction->action_start)->format('d.m.Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                            {{ \Carbon\Carbon::parse($reservation->activeAction->action_deadline)->format('d.m.Y') }}
                                        </td>
                                        <td class="flex flex-row items-center px-4 py-3">
                                            <img class="object-cover w-8 h-8 mr-2 rounded-full"
                                                src="{{ $reservation->student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/students/' . $reservation->student->picture) : asset('imgs/' . $reservation->student->picture) }}"
                                                alt="Profilna fotografija" />
                                            <a href="{{ route('students.show', $reservation->student->id) }}"
                                                class="ml-2 font-medium text-center">{{ $reservation->student->name }}</a>
                                        </td>

                                        <td class="px-4 py-3 text-sm leading-5 text-blue-900 whitespace-no-wrap">
                                            @if ($reservation->activeAction->action_status_id == 7)
                                                <div
                                                    class="inline-block px-[6px] py-[2px] font-medium bg-green-200 rounded-[10px]">
                                                    <span class="text-xs text-green-800">Knjiga izdata</span>
                                                </div>
                                            @else
                                                <div
                                                    class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]">
                                                    <span
                                                        class="text-xs text-red-800">{{ $reservation->activeAction->status->name }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <th class="px-4 py-4" style="display:none;"> </th>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr class="border-b-[1px] border-[#e4dfdf]">
                                    <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">

                                    </th>
                                    <th class="flex items-center px-4 py-4 leading-4 tracking-wider text-left">Naziv
                                        knjige
                                    </th>

                                    <!-- Datum rezervacije + dropdown filter for date -->
                                    <th
                                        class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer">
                                        Datum rezervacije
                                    </th>

                                    <!-- Rezervacija istice + dropdown filter for date -->
                                    <th
                                        class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer">
                                        Rezervacija
                                        istice
                                    </th>

                                    <!-- Rezervaciju podnio + dropdown filter for ucenik -->
                                    <th
                                        class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer">
                                        Rezervaciju
                                        podnio
                                    </th>

                                    <!-- Status + dropdown filter for status -->
                                    <th
                                        class="relative px-4 py-4 text-sm leading-4 tracking-wider text-left cursor-pointer">
                                        Status
                                    </th>
                                    <th class="px-4 py-4 hidden" style="display:none;"> </th>

                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
