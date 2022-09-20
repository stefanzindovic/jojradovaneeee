@extends('app')
@section('page_title')
    {{ $book->title }} | Dokumentacija o akciji
@endsection
@section('page_content')
    <!-- Content -->
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
                                        <a href="{{ route('books.show', $book->id) }}"
                                            class="text-[#2196f3] hover:text-blue-600">
                                            {{ $book->title }}
                                        </a>
                                    </li>
                                    <li>
                                        <span class="mx-2">/</span>
                                    </li>
                                    <li>
                                        <p class="text-gray-400">
                                            Izdavanje-{{ $action->id }}
                                        </p>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pt-[24px] mr-[30px]">
                    <a href="otpisiKnjigu.php" class="inline hover:text-blue-600">
                        <i class="fas fa-level-up-alt mr-[3px]"></i>
                        Otpiši knjigu
                    </a>
                    <a href="{{ route('books.issues', $book->id) }}" class="inline hover:text-blue-600 ml-[20px] pr-[10px]">
                        <i class="far fa-hand-scissors mr-[3px]"></i>
                        Izdaj knjigu
                    </a>
                    <a href="vratiKnjigu.php" class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="fas fa-redo-alt mr-[3px] "></i>
                        Vrati knjigu
                    </a>
                    <a href="{{ route('books.reservations.reservePage', $book->id) }}"
                        class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                        <i class="far fa-calendar-check mr-[3px] "></i>
                        Rezerviši knjigu
                    </a>
                    <p
                        class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-[#e4dfdf] dotsIzdavanjeDetalji hover:text-[#606FC7]">
                        <i class="fas fa-ellipsis-v"></i>
                    </p>
                    <div
                        class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-izdavanje-detalji">
                        <div class="absolute right-0 w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                            aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="py-1">
                                <a href="{{ route('books.edit', $book->id) }}" tabindex="0"
                                    class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                    role="menuitem">
                                    <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                    <span class="px-4 py-0">Izmijeni knjigu</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row height-detaljiIzdavanje scroll pb-[20px]">
            <div class="">
                <!-- Space for content -->
                <div class="pl-[30px] section- mt-[20px]">
                    <div class="flex flex-row justify-between">
                        <div class="mr-[30px]">
                            <div class="mt-[20px]">
                                <span class="text-gray-500">Tip transakcije</span><br>
                                <p
                                    class="inline-block bg-blue-200 text-blue-800 rounded-[10px] text-center px-[6px] py-[2px]">
                                    {{ $action->status->name }}
                                </p>
                            </div>
                            <div class="mt-[40px]">
                                <span class="text-gray-500">Datum akcije</span>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($action->action_start)->format('d.m.Y') }}
                                </p>
                            </div>
                            <div class="mt-[40px]">
                                <span class="text-gray-500">Trenutno zadrzavanje knjige</span>
                                @if ($action->status->id == 1 || $action->status->id == 7)
                                    <x-current-holding start_date="{{ $action->action_start }}"
                                        deadline_date="{{ $action->action_deadline }}" indicator="false">
                                    </x-current-holding>
                                @elseif ($action->status->id == 8 || $action->status->id == 9)
                                    <x-current-holding current_date="{{ $action->action_start }}"
                                        deadline_date="{{ $action->action_deadline }}" indicator="false">
                                    </x-current-holding>
                                @else
                                    <div class="text-gray-500">
                                        <p class="font-medium">Nema zadržavanja</p>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-[40px]">
                                <span class="text-gray-500">Prekoracenje u danima</span>
                                @if ($action->status->id == 1 || $action->status->id == 7)
                                    <x-breached-days start_date="{{ $action->action_start }}"
                                        deadline_date="{{ $action->action_deadline }}">
                                    </x-breached-days>
                                @elseif ($action->status->id == 8 || $action->status->id == 9)
                                    <x-breached-days start_date="{{ $action->action_start }}"
                                        deadline_date="{{ $action->action_deadline }}">
                                    </x-breached-days>
                                @else
                                    <div class="text-gray-500">
                                        <p class="font-medium">Nema zadržavanja</p>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-[40px]">
                                <span class="text-gray-500">Bibliotekar</span>
                                <a href="{{ route('librarians.show', $action->librarian->id) }}"
                                    class="block font-medium text-[#2196f3] hover:text-blue-600">{{ $action->librarian->name }}</a>
                            </div>
                            <div class="mt-[40px]">
                                <span class="text-gray-500">Ucenik</span>
                                <a href="{{ route('students.show', $action->book->student->id) }}"
                                    class="block font-medium text-[#2196f3] hover:text-blue-600">{{ $action->book->student->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 w-full">
            <div class="flex flex-row">
                <div class="inline-block w-full text-white text-right py-[7px] mr-[100px] flex flex-row justify-end">
                    <form action="{{ route('books.issues.writeoff', $action->book->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <button type="submit"
                            class="btn-animation show-otpisiModal shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#FF470E] bg-[#FF5722]">
                            <i class="fas fa-level-up-alt mr-[4px] "></i> Otpisi knjigu
                        </button>
                    </form>
                    <form action="{{ route('books.issues.return', $action->book->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <button type="submit"
                            class="ml-[10px] btn-animation show-vratiModal shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                            <i class="fas fa-redo-alt mr-[4px] "></i> Vrati knjigu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
