@extends('app')

@section('page_title')
    Knjiga
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] pb-2 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex flex-row justify-between border-b-[1px] border-[#e4dfdf]">
                <div class="py-[10px] flex flex-row">
                    <div class="w-[77px] pl-[30px]">
                        <img style="width: 77px; height: 77px;" class="object-cover w-8 mr-2 h-11"
                            src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif"
                            alt="" />
                    </div>
                    <div class="pl-[15px]  flex flex-col">
                        <div>
                            <h1>
                                {{ $book->title }}
                            </h1>
                        </div>
                        <div>
                            <nav class="w-full rounded">
                                <ol class="flex list-reset">
                                    <li>
                                        <a href="{{ route('books.index') }}" class="text-[#2196f3] hover:text-blue-600">
                                            Evidencija knjiga
                                        </a>
                                    </li>
                                    <li>
                                        <span class="mx-2">/</span>
                                    </li>
                                    <li>
                                        <p class="text-gray-400">
                                            {{ $book->title }}
                                        </p>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pt-[24px]
                                            mr-[30px]">
                    <a href="otpisiKnjigu.php" class="inline hover:text-blue-600">
                        <i class="fas fa-level-up-alt mr-[3px]"></i>
                        Otpiši
                    </a>
                    <a href="{{ route('books.issues', $book->id) }}" class="inline hover:text-blue-600 ml-[20px] pr-[10px]">
                        <i class="far fa-hand-scissors mr-[3px]"></i>
                        Izdaj
                    </a>
                    <a href="vratiKnjigu.php" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="fas fa-redo-alt mr-[3px] "></i>
                        Vrati
                    </a>
                    <a href="{{ route('books.reservations.reservePage', $book->id) }}"
                        class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="far fa-calendar-check mr-[3px] "></i>
                        Rezerviši
                    </a>
                    <p
                        class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-[#e4dfdf] dotsKnjigaOsnovniDetalji hover:text-[#606FC7]">
                        <i class="fas fa-ellipsis-v"></i>
                    </p>
                    <div
                        class="z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-knjiga-osnovni-detalji">
                        <div class="absolute right-0 w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                            aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                <a href="{{ route('books.edit', $book->id) }}" tabindex="0"
                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                    role="menuitem">
                                    <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                    <span class="px-4 py-0">Izmijeni</span>
                                </a>
                                <form
                                    onSubmit="if(!confirm('Da li ste sigurni da želite da obrišete ovu knjigu?')){return false;}"
                                    method="POST" action="{{ route('books.destroy', $book->id) }}">
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
        <div class="flex flex-row overflow-auto height-osnovniDetalji">
            <div class="w-[80%]">
                <div class="border-b-[1px] py-4 text-gray-500 border-[#e4dfdf] pl-[30px]">
                    <a id="bookDetailsBtn" class="inline active-book-nav cursor-pointer hover:text-blue-800">
                        Osnovni detalji
                    </a>
                    <a id="bookSpecificationsBtn" class="inline ml-[70px] cursor-pointer hover:text-blue-800 ">
                        Specifikacija
                    </a>
                    <a id="bookRecordBtn" class="inline ml-[70px] hover:text-blue-800 cursor-pointer">
                        Evidencija iznajmljivanja
                    </a>
                    <a id="bookMultimediaBtn" class="inline ml-[70px] cursor-pointer hover:text-blue-800">
                        Multimedija
                    </a>
                </div>
                <div class="">
                    <!-- Space for content -->
                    <section id="addBookTab_Basics">
                        <div class="pl-[30px] section- mt-[20px]">
                            <div class="flex flex-row justify-between">
                                <div class="mr-[30px]">
                                    <div class="mt-[20px]">
                                        <span class="text-gray-500 text-[14px]">Naziv knjige</span>
                                        <p class="font-medium">{{ $book->title }}</p>
                                    </div>
                                    <div style="max-width: 400px;" class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Kategorija</span>
                                        <p class="font-medium">
                                            @foreach ($book->categories as $category)
                                                {{ $category->title }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div style="max-width: 400px;" class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Zanr</span>
                                        <p class="font-medium">
                                            @foreach ($book->genres as $genre)
                                                {{ $genre->title }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div style="max-width: 400px;" class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Autor/ri</span>
                                        <p class="font-medium">
                                            @foreach ($book->authors as $author)
                                                {{ $author->full_name }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Izdavac</span>
                                        <p class="font-medium">{{ $book->publisher->name }}</p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Godina izdavanja</span>
                                        <p class="font-medium">{{ $book->published_at }}</p>
                                    </div>
                                </div>
                                <div class="mr-[70px] mt-[20px] flex flex-col max-w-[600px]">
                                    <div>
                                        <h4 class="text-gray-500 ">
                                            Storyline (Kratki sadrzaj)
                                        </h4>
                                        <p style="overflow-y:auto; max-height:450px;"
                                            class="addReadMore showlesscontent my-[10px]">
                                            {{ $book->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Space for content -->
                    <section id="addBookTab_Specifications" class="hidden">
                        <div class="pl-[30px] mt-[20px]">
                            <div class="flex flex-row justify-between">
                                <div class="mr-[30px]">
                                    <div class="mt-[20px]">
                                        <span class="text-gray-500 text-[14px]">Broj strana</span>
                                        <p class="font-medium">{{ $book->total_pages }}</p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Pismo</span>
                                        <p class="font-medium">{{ $book->script->name }}</p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Jezik</span>
                                        <p class="font-medium">{{ $book->language->name }}</p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Povez</span>
                                        <p class="font-medium">{{ $book->cover->name }}</p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">Format</span>
                                        <p class="font-medium">{{ $book->format->name }}</p>
                                    </div>
                                    <div class="mt-[40px]">
                                        <span class="text-gray-500 text-[14px]">International Standard Book Number
                                            (ISBN)</span>
                                        <p class="font-medium">{{ $book->isbn }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Space for content -->
                    <section id="addBookTab_Records" class="hidden">
                        <div class="py-4 pt-[20px] pl-[30px] text-[#2D3B48]">
                            <a id="issuedBooks_Btn"
                                class="cursor-pointer py-[15px] px-[20px] w-[268px] text-[#576cdf] bg-[#EFF3F6] rounded-[10px] inline hover:text-[#576cdf]">
                                <i class="text-[20px] far fa-copy mr-[3px]"></i>
                                Izdate knjige
                            </a>
                            <a id="returnedBooks_Btn"
                                class="cursor-pointer inline py-[15px] rounded-[10px] group px-[20px] w-[268px] hover:text-[#576cdf] hover:bg-[#EFF3F6] ml-[20px] pr-[10px]">
                                <i class="text-[20px] text-[#707070] group-hover:text-[#576cdf] fas fa-file mr-[3px]"></i>
                                Vraćene knjige
                            </a>
                            <a id="deadlineBooks_Btn"
                                class="cursor-pointer inline py-[15px] rounded-[10px] group px-[20px] w-[268px] hover:text-[#576cdf] hover:bg-[#EFF3F6] ml-[20px] pr-[10px]">
                                <i
                                    class="text-[20px] text-[#707070] group-hover:text-[#576cdf] fas fa-exclamation-triangle mr-[3px]"></i>
                                Knjige u prekoracenju
                            </a>
                            <a id="reservedBooks_Btn"
                                class="cursor-pointer inline py-[15px] rounded-[10px] group px-[20px] w-[268px] hover:text-[#576cdf] hover:bg-[#EFF3F6] ml-[20px] pr-[10px]">
                                <i
                                    class="text-[20px] text-[#707070] group-hover:text-[#576cdf] far fa-calendar-check mr-[3px]"></i>
                                Aktivne rezervacije
                            </a>
                            <a id="archivedReservationsBooks_Btn"
                                class="cursor-pointer inline py-[15px] rounded-[10px] group px-[20px] w-[268px] hover:text-[#576cdf] hover:bg-[#EFF3F6] ml-[20px] pr-[10px]">
                                <i
                                    class="text-[20px] text-[#707070] group-hover:text-[#576cdf] fas fa-calendar-alt  mr-[3px]"></i>
                                Arhivirane rezervacije
                            </a>
                        </div>
                        <!-- Space for content -->
                        <div id="issuedBooks_Records" class="w-full mt-[10px] ml-2 px-4">
                            <table class="overflow-hidden shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf]"
                                id="myTable">
                                <thead class="bg-[#EFF3F6]">
                                    <tr class="border-b-[1px] border-[#e4dfdf]">
                                        <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato uceniku
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Datum izdavanja
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Datum vracanja
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Zadrzavanje knjige
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Knjigu primio</th>
                                        <th class="px-4 py-4"> </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($issuedRecords as $record)
                                        <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                            <td class="px-4 py-3 whitespace-no-wrap">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox">
                                                </label>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ $record->student->name }}
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ \Carbon\Carbon::parse($record->activeAction->action_start)->format('d.m.Y') }}
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ \Carbon\Carbon::parse($record->activeAction->action_deadline)->format('d.m.Y') }}
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{-- Search difs between two dates and format results in to the string --}}
                                                @php
                                                    // date dif
                                                    $diff = \Carbon\Carbon::parse($record->activeAction->action_start)->diff(\Carbon\Carbon::now());
                                                    
                                                    // format for years
                                                    $yearVersionOneValues = [2, 3, 4];
                                                    $yearVersion = 'godina';
                                                    
                                                    if (in_array($diff->y, $yearVersionOneValues)) {
                                                        $yearVersion = 'godine';
                                                    }
                                                    
                                                    // format for months
                                                    $monthVersionOneValues = [1];
                                                    $monthVersionTwoValues = [2, 3, 4];
                                                    $monthVersion = 'mjeseci';
                                                    
                                                    if (in_array($diff->m, $monthVersionOneValues)) {
                                                        $monthVersion = 'mjesec';
                                                    }
                                                    
                                                    if (in_array($diff->m, $monthVersionTwoValues)) {
                                                        $monthVersion = 'mjeseca';
                                                    }
                                                    
                                                    // format for days
                                                    $dayVersionOneValues = [1, 21, 31];
                                                    $dayVersion = 'dana';
                                                    
                                                    if (in_array($diff->d, $dayVersionOneValues)) {
                                                        $dayVersion = 'dan';
                                                    }
                                                    
                                                    // separated strings
                                                    $years = null;
                                                    $months = null;
                                                    $days = null;
                                                    
                                                    if ($diff->y != 0) {
                                                        $years = $diff->y . ' ' . $yearVersion . ' ';
                                                    }
                                                    
                                                    if ($diff->m != 0) {
                                                        $months = $diff->m . ' ' . $monthVersion . ' ';
                                                    }
                                                    
                                                    if ($diff->d != 0) {
                                                        $days = $diff->d . ' ' . $dayVersion . ' ';
                                                    }
                                                    
                                                    // final string
                                                    if ($years == null && $months == null && $days == null) {
                                                        $keepingBook = 'Izdata danas';
                                                    } else {
                                                        $keepingBook = $years . $months . $days;
                                                    }
                                                    
                                                    // check if deadline was breached
                                                    $isBreached = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($record->activeAction->action_deadline));
                                                @endphp
                                                <div
                                                    @if ($isBreached) class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]" @endif>
                                                    <span
                                                        @if ($isBreached) class="text-red-800" @endif>{{ $keepingBook }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ $record->activeAction->librarian->name }}
                                            </td>
                                            <td class="px-6 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                                <p
                                                    class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsIznajmljivanjeVraceneKnjige hover:text-[#606FC7]">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </p>
                                                <div
                                                    class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 iznajmljivanje-vracene-knjige">
                                                    <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                        aria-labelledby="headlessui-menu-button-1"
                                                        id="headlessui-menu-items-117" role="menu">
                                                        <div class="py-1">
                                                            <a href="izdavanjeDetalji.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Pogledaj detalje</span>
                                                            </a>

                                                            <a href="izdajKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i
                                                                    class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Izdaj knjigu</span>
                                                            </a>

                                                            <a href="vratiKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Vrati knjigu</span>
                                                            </a>

                                                            <a href="rezervisiKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i
                                                                    class="far fa-calendar-check mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Rezervisi knjigu</span>
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

                        <div id="returnedBooks_Records" class="w-full mt-[10px] ml-2 px-4 hidden">
                            <table class="overflow-hidden shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf]"
                                id="myTable">
                                <thead class="bg-[#EFF3F6]">
                                    <tr class="border-b-[1px] border-[#e4dfdf]">
                                        <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato uceniku
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Datum izdavanja
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Trenutno
                                            zadrzavanje knjige</th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Knjigu izdao</th>
                                        <th class="px-4 py-4"> </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($returnedRecords as $record)
                                        <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                            <td class="px-4 py-3 whitespace-no-wrap">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox">
                                                </label>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ $record->student->name }}
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ \Carbon\Carbon::parse($record->activeAction->action_addons)->format('d.m.Y') }}
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{-- Search difs between two dates and format results in to the string --}}
                                                @php
                                                    // date dif
                                                    $diff = \Carbon\Carbon::parse($record->activeAction->action_addons)->diff(\Carbon\Carbon::parse($record->activeAction->action_start), false);
                                                    
                                                    // format for years
                                                    $yearVersionOneValues = [2, 3, 4];
                                                    $yearVersion = 'godina';
                                                    
                                                    if (in_array($diff->y, $yearVersionOneValues)) {
                                                        $yearVersion = 'godine';
                                                    }
                                                    
                                                    // format for months
                                                    $monthVersionOneValues = [1];
                                                    $monthVersionTwoValues = [2, 3, 4];
                                                    $monthVersion = 'mjeseci';
                                                    
                                                    if (in_array($diff->m, $monthVersionOneValues)) {
                                                        $monthVersion = 'mjesec';
                                                    }
                                                    
                                                    if (in_array($diff->m, $monthVersionTwoValues)) {
                                                        $monthVersion = 'mjeseca';
                                                    }
                                                    
                                                    // format for days
                                                    $dayVersionOneValues = [1, 21, 31];
                                                    $dayVersion = 'dana';
                                                    
                                                    if (in_array($diff->d, $dayVersionOneValues)) {
                                                        $dayVersion = 'dan';
                                                    }
                                                    
                                                    // separated strings
                                                    $years = null;
                                                    $months = null;
                                                    $days = null;
                                                    
                                                    if ($diff->y != 0) {
                                                        $years = $diff->y . ' ' . $yearVersion . ' ';
                                                    }
                                                    
                                                    if ($diff->m != 0) {
                                                        $months = $diff->m . ' ' . $monthVersion . ' ';
                                                    }
                                                    
                                                    if ($diff->d != 0) {
                                                        $days = $diff->d . ' ' . $dayVersion . ' ';
                                                    }
                                                    
                                                    // final string
                                                    if ($years == null && $months == null && $days == null) {
                                                        $keepingBook = 'Nema zadržavanja';
                                                    } else {
                                                        $keepingBook = $years . $months . $days;
                                                    }
                                                    
                                                    // check if deadline was breached
                                                    $isBreached = \Carbon\Carbon::parse($record->activeAction->action_start)->gt(\Carbon\Carbon::parse($record->activeAction->action_deadline));
                                                @endphp
                                                <div
                                                    @if ($isBreached) class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]" @endif>
                                                    <span
                                                        @if ($isBreached) class="text-red-800" @endif>{{ $keepingBook }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ $record->activeAction->librarian->name }}
                                            </td>
                                            <td class="px-6 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                                <p
                                                    class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsIznajmljivanjeIzdateKnjige hover:text-[#606FC7]">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </p>
                                                <div
                                                    class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 iznajmljivanje-izdate-knjige">
                                                    <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                        aria-labelledby="headlessui-menu-button-1"
                                                        id="headlessui-menu-items-117" role="menu">
                                                        <div class="py-1">
                                                            <a href="izdavanjeDetalji.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Pogledaj detalje</span>
                                                            </a>

                                                            <a href="otpisiKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="fas fa-level-up-alt mr-[14px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Otpisi knjigu</span>
                                                            </a>

                                                            <a href="vratiKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Vrati knjigu</span>
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

                        <div id="deadlineBooks_Records" class="w-full mt-[10px] ml-2 px-4 hidden">
                            <table class="overflow-hidden shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf]"
                                id="myTable">
                                <thead class="bg-[#EFF3F6]">
                                    <tr class="border-b-[1px] border-[#e4dfdf]">
                                        <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Datum izdavanja
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Izdato uceniku
                                        </th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Prekoracenje u
                                            danima</th>
                                        <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Trenutno
                                            zadrzavanje knjige</th>
                                        <th class="px-4 py-4"> </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($booksWithBreachDeadline as $record)
                                        <tr class="hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                            <td class="px-4 py-3 whitespace-no-wrap">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" class="form-checkbox">
                                                </label>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ \Carbon\Carbon::parse($record->activeAction->action_start)->format('d.m.Y') }}
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{ $record->student->name }}
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                @php
                                                    // date dif in days
                                                    $diff = \Carbon\Carbon::parse($record->activeAction->action_start)->diffInDays(null, false);
                                                    
                                                    // format for days
                                                    $dayVersionOneValues = [1, 21, 31];
                                                    $dayVersion = 'dana';
                                                    
                                                    $lastDigit = $diff % 10;
                                                    
                                                    if (in_array($lastDigit, $dayVersionOneValues)) {
                                                        $dayVersion = 'dan';
                                                    }
                                                    
                                                    // final string
                                                    $days = null;
                                                    
                                                    if ($diff != 0) {
                                                        $days = $diff . ' ' . $dayVersion . ' ';
                                                    }
                                                @endphp
                                                <div
                                                    class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]">
                                                    <span class="text-xs text-red-800">{{ $days }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm leading-5 whitespace-no-wrap">
                                                {{-- Search difs between two dates and format results in to the string --}}
                                                @php
                                                    // date dif
                                                    $diff = \Carbon\Carbon::parse($record->activeAction->action_start)->diff(\Carbon\Carbon::now());
                                                    
                                                    // format for years
                                                    $yearVersionOneValues = [2, 3, 4];
                                                    $yearVersion = 'godina';
                                                    
                                                    if (in_array($diff->y, $yearVersionOneValues)) {
                                                        $yearVersion = 'godine';
                                                    }
                                                    
                                                    // format for months
                                                    $monthVersionOneValues = [1];
                                                    $monthVersionTwoValues = [2, 3, 4];
                                                    $monthVersion = 'mjeseci';
                                                    
                                                    if (in_array($diff->m, $monthVersionOneValues)) {
                                                        $monthVersion = 'mjesec';
                                                    }
                                                    if (in_array($diff->m, $monthVersionTwoValues)) {
                                                        $monthVersion = 'mjeseca';
                                                    }
                                                    
                                                    // format for days
                                                    $dayVersionOneValues = [1, 21, 31];
                                                    $dayVersion = 'dana';
                                                    
                                                    if (in_array($diff->d, $dayVersionOneValues)) {
                                                        $dayVersion = 'dan';
                                                    }
                                                    
                                                    // separated strings
                                                    $years = null;
                                                    $months = null;
                                                    $days = null;
                                                    
                                                    if ($diff->y != 0) {
                                                        $years = $diff->y . ' ' . $yearVersion . ' ';
                                                    }
                                                    
                                                    if ($diff->m != 0) {
                                                        $months = $diff->m . ' ' . $monthVersion . ' ';
                                                    }
                                                    
                                                    if ($diff->d != 0) {
                                                        $days = $diff->d . ' ' . $dayVersion . ' ';
                                                    }
                                                    
                                                    // final string
                                                    if ($years == null && $months == null && $days == null) {
                                                        $keepingBook = 'Izdata danas';
                                                    } else {
                                                        $keepingBook = $years . $months . $days;
                                                    }
                                                @endphp
                                                <div>
                                                    <span>{{ $keepingBook }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 text-sm leading-5 text-right whitespace-no-wrap">
                                                <p
                                                    class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsIznajmljivanjeKnjigePrekoracenje hover:text-[#606FC7]">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </p>
                                                <div
                                                    class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 iznajmljivanje-knjige-prekoracenje">
                                                    <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                        aria-labelledby="headlessui-menu-button-1"
                                                        id="headlessui-menu-items-117" role="menu">
                                                        <div class="py-1">
                                                            <a href="izdavanjeDetalji.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="far fa-file mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Pogledaj detalje</span>
                                                            </a>

                                                            <a href="izdajKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i
                                                                    class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Izdaj knjigu</span>
                                                            </a>

                                                            <a href="vratiKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i class="fas fa-redo-alt mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Vrati knjigu</span>
                                                            </a>

                                                            <a href="rezervisiKnjigu.php" tabindex="0"
                                                                class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                                role="menuitem">
                                                                <i
                                                                    class="far fa-calendar-check mr-[10px] ml-[5px] py-1"></i>
                                                                <span class="px-4 py-0">Rezervisi knjigu</span>
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

                        <div id="reservedBooks_Records" class="w-full mt-[10px] ml-2 px-4 hidden">
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
                                            </td>recordrecord
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
                                                                <i
                                                                    class="far fa-hand-scissors mr-[10px] ml-[5px] py-1"></i>
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

                        <div id="archivedReservationsBooks_Records" class="w-full mt-[10px] ml-2 px-4 hidden">
                            <table class="overflow-hidden shadow-lg rounded-xl w-full border-[1px] border-[#e4dfdf]"
                                id="myTable">
                                <thead class="bg-[#EFF3F6]">
                                    <tr class="border-b-[1px] border-[#e4dfdf]">
                                        <th class="px-4 py-3 leading-4 tracking-wider text-left text-blue-500">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox">
                                            </label>
                                        </th>
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
                                    @foreach ($archivedReservations as $record)
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
                                                @if ($record->activeAction->action_status_id == 7)
                                                    <div
                                                        class="inline-block px-[6px] py-[2px] font-medium bg-green-200 rounded-[10px]">
                                                        <span class="text-xs text-green-800">Knjiga izdata</span>
                                                    </div>
                                                @else
                                                    <div
                                                        class="inline-block px-[6px] py-[2px] font-medium bg-red-200 rounded-[10px]">
                                                        <span
                                                            class="text-xs text-red-800">{{ $record->activeAction->status->name }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <th class="px-4 py-4" style="display:none;"> </th>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </section>

                    <!-- Space for content -->
                    <section id="addBookTab_Multimedia" class="hidden scroll">
                        <div class="pl-[30px] section- mt-[20px]">
                            @if ($book->gallery->isEmpty())
                                Nema dostupne multimedije.
                            @else
                                <div style="display: grid;  grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr; gap: 1rem;">
                                    @foreach ($book->gallery as $pciture)
                                        <img style="width: 100%; aspect-ratio: 1 / 1;"
                                            src="{{ asset('storage/uploads/books/' . $pciture->picture) }}"
                                            alt="">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
            <div class="min-w-[20%] border-l-[1px] border-[#e4dfdf] ">
                <div class="border-b-[1px] border-[#e4dfdf]">
                    <div class="ml-[30px] mr-[70px] mt-[20px] flex flex-row justify-between">
                        <div class="text-gray-500 ">
                            <p>Na raspolaganju:</p>
                            <p class="mt-[20px]">Rezervisano:</p>
                            <p class="mt-[20px]">Izdato:</p>
                            <p class="mt-[20px]">U prekoracenju:</p>
                            <p class="mt-[20px]">Ukupna kolicina:</p>
                        </div>
                        <div class="text-center pb-[30px]">
                            <p class=" bg-green-200 text-green-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                {{ $availableCopiesCount }} primjeraka</p>
                            <a href="{{ route('books.reservations', ['books' => $book->id]) }}">
                                <p
                                    class=" mt-[16px] bg-yellow-200 text-yellow-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{ $pendingReservations->count() + $activeReservations->count() }} primjerka</p>
                            </a>
                            <a href="{{ route('books.issues.issues', ['books' => $book->id]) }}">
                                <p
                                    class=" mt-[16px] bg-blue-200 text-blue-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{ $issuedRecords->count() }} primjerka</p>
                            </a>
                            <a href="{{ route('books.issues.breached', ['books' => $book->id]) }}">
                                <p class=" mt-[16px] bg-red-200 text-red-800 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                    {{ $booksWithBreachDeadline->count() }} primjerka</p>
                            </a>
                            <p
                                class=" mt-[16px] border-[1px] border-green-700 text-green-700 rounded-[10px] px-[6px] py-[2px] text-[14px]">
                                {{ $book->total_copies }} primjeraka</p>
                        </div>
                    </div>
                </div>
                <div class="mt-[40px] mx-[30px]">
                    <div class="flex flex-col max-w-[304px]">
                        <div class="text-gray-500 ">
                            <p class="inline uppercase">
                                Izdavanja knjige
                            </p>
                            <span>
                                - 4 days ago
                            </span>
                        </div>
                        <div>
                            <p>
                                <a href="bibliotekarProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Valentina K.
                                </a>
                                je izdala knjigu
                                <a href="ucenikProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Peru Perovicu
                                </a>
                                dana
                                <span class="font-medium">
                                    21.02.2021.
                                </span>
                            </p>
                        </div>
                        <div>
                            <a href="izdavanjeDetalji.php" class="text-[#2196f3] hover:text-blue-600">
                                pogledaj detaljnije >>
                            </a>
                        </div>
                    </div>
                    <div class="mt-[40px] flex flex-col max-w-[304px]">
                        <div class="text-gray-500 ">
                            <p class="inline uppercase">
                                Izdavanja knjige
                            </p>
                            <span>
                                - 4 days ago
                            </span>
                        </div>
                        <div>
                            <p>
                                <a href="bibliotekarProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Valentina K.
                                </a>
                                je izdala knjigu
                                <a href="ucenikProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Peru Perovicu
                                </a>
                                dana
                                <span class="font-medium">
                                    21.02.2021.
                                </span>
                            </p>
                        </div>
                        <div>
                            <a href="izdavanjeDetalji.php" class="text-[#2196f3] hover:text-blue-600">
                                pogledaj detaljnije >>
                            </a>
                        </div>
                    </div>
                    <div class="mt-[40px] flex flex-col max-w-[304px]">
                        <div class="text-gray-500 ">
                            <p class="inline uppercase">
                                Izdavanja knjige
                            </p>
                            <span>
                                - 4 days ago
                            </span>
                        </div>
                        <div>
                            <p>
                                <a href="bibliotekarProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Valentina K.
                                </a>
                                je izdala knjigu
                                <a href="ucenikProfile.php" class="text-[#2196f3] hover:text-blue-600">
                                    Peru Perovicu
                                </a>
                                dana
                                <span class="font-medium">
                                    21.02.2021.
                                </span>
                            </p>
                        </div>
                        <div>
                            <a href="izdavanjeDetalji.php" class="text-[#2196f3] hover:text-blue-600">
                                pogledaj detaljnije >>
                            </a>
                        </div>
                    </div>
                    <div class="mt-[40px]">
                        <a href="dashboardAktivnost.php?knjiga=Tom Sojer" class="text-[#2196f3] hover:text-blue-600">
                            <i class="fas fa-history"></i> Prikazi sve
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
