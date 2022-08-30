@php
    use Jenssegers\Date\Date;

    Date::setLocale('sr');
@endphp

@extends('app')

@section('page_title')
    Administracija
@endsection

@section('page_content')
<section class="w-screen h-screen py-4 pl-[80px] text-[#333333]">
    <!-- Heading of content -->
    <div class="heading mt-[7px]">
        <h1 class="pl-[30px] pb-[21px] border-b-[1px] border-[#e4dfdf] ">
            Administracija
        </h1>
    </div>
    <!-- Space for content -->
    <div class="scroll height-dashboard">
        <div class="flex items-center justify-between px-[30px] py-4 space-x-3 rounded-lg">
            <a href="{{route('librarians.create')}}"
               class="btn-animation inline-flex items-center text-sm py-2.5 px-5 rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">
                <i class="fas fa-plus mr-[15px]"></i> Novi bibliotekar
            </a>
        </div>

        <div
            class="inline-block min-w-full px-[30px] pt-3 align-middle bg-white rounded-bl-lg rounded-br-lg shadow-dashboard">
            <table class="overflow-hidden shadow-lg rounded-xl min-w-full border-[1px] border-[#e4dfdf]" id="myTable">
                <thead class="bg-[#EFF3F6]">
                <tr class="border-[1px] border-[#e4dfdf]">
                    <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox">
                        </label>
                    </th>
                    <th class="px-4 py-4 leading-4 tracking-wider text-left">Ime i prezime
                    </th>
                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Email</th>
                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Tip korisnika</th>
                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Zadnji pristup sistemu
                    </th>
                    <th class="px-4 py-4"></th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($librarians as $librarian)
                    <tr class="hover:bg-gray-200 hover:shadow-md border-[1px] border-[#e4dfdf]">
                        <td class="px-4 py-4 whitespace-no-wrap">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox">
                            </label>
                        </td>
                        <td class="flex flex-row items-center px-4 py-4">
                            <img class="object-cover w-8 h-8 mr-2 rounded-full"
                                 src="{{$librarian->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . $librarian->picture) : asset('imgs/' . $librarian->picture)}}"
                                 alt=""/>
                            <a href="{{ route('librarians.show', $librarian->id) }}">
                                <span class="font-medium text-center">{{ $librarian->name }}</span>
                            </a>
                        </td>
                        <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">{{ $librarian->email }}
                        </td>
                        <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">{{ $librarian->role->name }}</td>
                        <td class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">@if($librarian->logins->isNotEmpty())
                                {{ $librarian->logins[$librarian->logins->count() - 1]->created_at->diffForHumans() }}
                            @else
                                Nikada se nije ulogovao
                            @endif</td>
                        <td class="px-4 py-4 text-sm leading-5 text-right whitespace-no-wrap">
                            <p class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsLibrarian hover:text-[#606FC7]">
                                <i class="fas fa-ellipsis-v"></i>
                            </p>
                            <div
                                class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-librarian">
                                <div
                                    class="absolute right-[25px] w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                    aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117"
                                    role="menu">
                                    <div class="py-1">
                                        <a href="{{route('librarians.show', $librarian->id)}}" tabindex="0"
                                           class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                           role="menuitem">
                                            <i class="far fa-file mr-[5px] ml-[5px] py-1"></i>
                                            <span class="px-4 py-0">Pogledaj</span>
                                        </a>
                                        <a href="{{route('librarians.edit', $librarian->id)}}" tabindex="0"
                                           class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                           role="menuitem">
                                            <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                            <span class="px-4 py-0">Izmijeni</span>
                                        </a>
                                        <form
                                            onSubmit="if(!confirm('Da li ste sigurni da želite da obrišete ovog bibliotekara?')){return false;}"
                                            method="POST" action="{{route('librarians.destroy', $librarian->id)}}">
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr class="border-[1px] border-[#e4dfdf]">
                    <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox">
                        </label>
                    </th>
                    <th class="px-4 py-4 leading-4 tracking-wider text-left">Ime i prezime
                    </th>
                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Email</th>
                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Tip korisnika</th>
                    <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Zadnji pristup sistemu
                    </th>
                    <th class="px-4 py-4"></th>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>

</section>
@endsection
