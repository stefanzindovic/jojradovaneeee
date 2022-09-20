@php
use Jenssegers\Date\Date;

Date::setLocale('sr');
@endphp

@extends('app')

@section('page_title')
    Kontrolna tabla
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading mt-[7px]">
            <h1 class="pl-[30px] pb-[21px]  border-b-[1px] border-[#e4dfdf] ">
                Kontrolna tabla
            </h1>
        </div>
        <!-- Space for content -->
        <div class="pl-[30px] scroll height-dashboard overflow-auto mt-[20px] pb-[30px]">
            <div class="flex flex-row justify-between">
                <div class="mr-[30px]">
                    <h3 class="uppercase mb-[20px]">Aktivnosti</h3>
                    <!-- Activity Cards -->
                    @if ($activities->count() > 0)
                        @foreach ($activities as $activity)
                            <div class="activity-card flex flex-row mb-[30px]">
                                <div class="w-[60px] h-[60px]">
                                    @if ($activity->action_status_id == 1 ||
                                        $activity->action_status_id == 3 ||
                                        $activity->action_status_id == 4 ||
                                        $activity->action_status_id == 7 ||
                                        $activity->action_status_id == 8)
                                        <img class="rounded-full"
                                            src="{{ $activity->librarian->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . $activity->librarian->picture) : asset('imgs/' . $activity->librarian->picture) }}"
                                            alt="">
                                    @elseif($activity->action_status_id == 2 || $activity->action_status_id == 9)
                                        <img class="rounded-full"
                                            src="{{ $activity->book->student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/students/' . $activity->book->student->picture) : asset('imgs/' . $activity->book->student->picture) }}"
                                            alt="">
                                    @elseif($activity->action_status_id == 5 || $activity->action_status_id == 6)
                                        <img class="rounded-full"
                                            src="{{ $activity->book->book->picture !== 'book-placeholder.png' ? asset('storage/uploads/books/' . $activity->book->book->picture) : asset('imgs/' . $activity->book->book->picture) }}"
                                            alt="">
                                    @endif
                                </div>
                                <div class="ml-[15px] mt-[5px] flex flex-col">
                                    <div class="text-gray-500 mb-[5px]">
                                        <p class="uppercase">
                                            {{ strtoupper($activity->status->name) }}
                                            <span class="inline lowercase">
                                                - {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                            </span>
                                        </p>
                                    </div>
                                    @if ($activity->action_status_id === 1)
                                        <div class="">
                                            <p>
                                                <a href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->librarian->name }}
                                                </a>
                                                je izdala knjigu <span
                                                    class="font-medium">{{ $activity->book->book->title }}
                                                </span> korisniku
                                                <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a>
                                                dana <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @elseif ($activity->action_status_id === 2)
                                        <div class="">
                                            <p>Korisnik
                                                <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a> je zatražio rezervaciju knjige
                                                <span class="font-medium">{{ $activity->book->book->title }}
                                                </span> za <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @elseif ($activity->action_status_id === 3)
                                        <div class="">
                                            <p>
                                                <a href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->librarian->name }}
                                                </a>
                                                je odobrio rezervaciju knjige <span
                                                    class="font-medium">{{ $activity->book->book->title }}
                                                </span> korisniku
                                                <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a>
                                                za <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @elseif ($activity->action_status_id === 4)
                                        <div class="">
                                            <p>
                                                <a href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->librarian->name }}
                                                </a>
                                                je odbio rezervaciju knjige <span
                                                    class="font-medium">{{ $activity->book->book->title }}
                                                </span> korisnika
                                                <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a>
                                                za <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @elseif ($activity->action_status_id === 5)
                                        <div class="">
                                            <p>
                                                Rezervacija knjige <span
                                                    class="font-medium">{{ $activity->book->book->title }}
                                                </span> koju je ponudio korisnik <a
                                                    href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a> za <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                je istekla.
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @elseif ($activity->action_status_id === 6)
                                        <div class="">
                                            <p>
                                                Rezervacija knjige <span
                                                    class="font-medium">{{ $activity->book->book->title }}
                                                </span> koju je ponudio korisnik <a
                                                    href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a> za <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                je otkazana.
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @elseif ($activity->action_status_id === 7)
                                        <div class="">
                                            <p>
                                                <a href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->librarian->name }}
                                                </a>
                                                je po rezervaciji izdao knjigu <span
                                                    class="font-medium">{{ $activity->book->book->title }}
                                                </span> korisniku
                                                <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a>
                                                dana <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @elseif ($activity->action_status_id === 8)
                                        <div class="">
                                            <p>
                                                <a href="{{ route('librarians.show', $activity->librarian->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->librarian->name }}
                                                </a>
                                                je po otpisao knjigu <span
                                                    class="font-medium">{{ $activity->book->book->title }}
                                                </span> koja je bila izdata korisniku
                                                <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a>
                                                dana <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @elseif ($activity->action_status_id === 9)
                                        <div class="">
                                            <p>Korisnik
                                                <a href="{{ route('students.show', $activity->book->student->id) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    {{ $activity->book->student->name }}
                                                </a> je vratio knjigu
                                                <span class="font-medium">{{ $activity->book->book->title }}
                                                </span> dana <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($activity->action_start)->format('d.m.Y') }}</span>
                                                <a href="{{ route('books.actions.details', [$activity->book->book->id, $activity->id]) }}"
                                                    class="text-[#2196f3] hover:text-blue-600">
                                                    pogledaj detaljnije >>
                                                </a>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="inline-block w-full mt-4">
                            <a href="{{ route('activities') }}"
                                class="btn-animation block text-center w-full px-4 py-2 text-sm tracking-wider text-gray-600 transition duration-300 ease-in border-[1px] border-gray-400 rounded hover:bg-gray-200 focus:outline-none focus:ring-[1px] focus:ring-gray-300">
                                Prikaži više
                            </a>
                        </div>
                    @else
                        Nema aktivnosti
                    @endif
                </div>
                <div class="mr-[50px] ">
                    <h3 class="uppercase mb-[20px] text-left">
                        Rezervacije knjiga
                    </h3>
                    <div>
                        <table class="w-[560px] table-auto">
                            <tbody class="bg-gray-200">
                                @if ($reservations->count() > 0)
                                    @foreach ($reservations as $reservation)
                                        <tr class="bg-white border-b-[1px] border-[#e4dfdf]">
                                            <td class="flex flex-row items-center px-2 py-4">
                                                <img class="object-cover w-8 h-8 rounded-full "
                                                    src="{{ $reservation->student->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/students/' . $reservation->student->picture) : asset('imgs/' . $reservation->student->picture) }}"
                                                    alt="" />
                                                <a href="ucenikProfile.php"
                                                    class="ml-2 font-medium text-center">{{ $reservation->student->name }}</a>
                                            <td>
                                            </td>
                                            <td class="px-2 py-2">
                                                <a href="{{ route('books.show', $reservation->book->id) }}">
                                                    {{ $reservation->book->title }}
                                                </a>
                                            </td>
                                            <td class="px-2 py-2">
                                                <span
                                                    class="px-[10px] py-[3px] bg-gray-200 text-gray-800 px-[6px] py-[2px] rounded-[10px]">{{ \Carbon\Carbon::parse($reservation->activeAction->action_start)->format('d.m.Y') }}</span>
                                            </td>
                                            <td class="px-2 py-2">
                                                <div style="display: flex">

                                                    <form
                                                        action="{{ route('books.reservations.accept', $reservation->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="hover:text-green-500 mr-[5px]">
                                                            <i class="fas fa-check reservedStatus"></i>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('books.reservations.decline', $reservation->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="hover:text-red-500 mr-[5px]">
                                                            <i class="fas fa-times deniedStatus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p>Nema rezervacija</p>
                                @endif
                            </tbody>
                        </table>
                        @if ($reservations->count() > 0)
                            <div class="text-right mt-[5px]">
                                <a href="{{ route('books.reservations') }}" class="text-[#2196f3] hover:text-blue-600">
                                    <i class="fas fa-calendar-alt mr-[4px]" aria-hidden="true"></i>
                                    Prikazi sve
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="relative">
                        <h3 class="uppercase mb-[20px] text-left py-[30px]">
                            Statistika
                        </h3>
                        <div class="text-right">
                            <div class="flex pb-[30px]">
                                <a href="{{ route('books.issues.issues') }}"
                                    class="w-[145px] text-[#2196f3] hover:text-blue-600" href="izdateKnjige.php">
                                    Izdate knjige
                                </a>
                                <div
                                    class="ml-[30px] bg-green-600 transition duration-200 ease-in  hover:bg-green-900 stats-bar-green h-[26px]">

                                </div>
                                <p class="ml-[10px] number-green text-[#2196f3] hover:text-blue-600">
                                    {{ $issuedBooksCounter }}
                                </p>
                            </div>
                            <div class="flex pb-[30px]">
                                <a href="{{ route('books.reservations') }}"
                                    class="w-[145px] text-[#2196f3] hover:text-blue-600" href="aktivneRezervacije.php">
                                    Rezervisane knjige
                                </a>
                                <div
                                    class="ml-[30px] bg-yellow-600 transition duration-200 ease-in  hover:bg-yellow-900 stats-bar-yellow  h-[26px]">

                                </div>
                                <p class="ml-[10px] text-[#2196f3] hover:text-blue-600 number-yellow">
                                    {{ $reservationsCounter }}
                                </p>
                            </div>
                            <div class="flex pb-[30px]">
                                <a href="{{ route('books.issues.breached') }}"
                                    class="w-[145px] text-[#2196f3] hover:text-blue-600" href="knjigePrekoracenje.php">
                                    Knjige u prekoracenju
                                </a>
                                <div
                                    class="ml-[30px] bg-red-600 transition duration-200 ease-in hover:bg-red-900 stats-bar-red h-[26px]">

                                </div>
                                <p class="ml-[10px] text-[#2196f3] hover:text-blue-600 number-red">
                                    {{ $breachedBooksCounter }}
                                </p>
                            </div>
                        </div>
                        <div class="absolute h-[220px] w-[1px] bg-black top-[78px] left-[174px]">
                        </div>
                        <div
                            class="absolute flex conte left-[175px] border-t-[1px] border-[#e4dfdf] top-[248px] pr-[87px]">
                            <p class="ml-[-13px]">
                                0
                            </p>
                            <p class="ml-[57px]">
                                20
                            </p>
                            <p class="ml-[57px]">
                                40
                            </p>
                            <p class="ml-[57px]">
                                60
                            </p>
                            <p class="ml-[57px]">
                                80
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
