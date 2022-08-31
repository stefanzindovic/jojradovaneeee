@php
    use Jenssegers\Date\Date;

    Date::setLocale('sr');
@endphp

@extends('app')

@section('page_title')
    {{ $librarian->name }}
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] pb-2 text-gray-700">
        <!-- Heading of content -->
        <div class="heading">
            <div class="flex flex-row justify-between border-b-[1px] border-[#e4dfdf]">
                <div class="pl-[30px] py-[10px] flex flex-col">
                    <div>
                        <h1>
                            {{$librarian->name}}
                        </h1>
                    </div>
                    <div>
                        <nav class="w-full rounded">
                            <ol class="flex list-reset">
                                <li>
                                    <a href="{{route('librarians.index')}}" class="text-[#2196f3] hover:text-blue-600">
                                        Svi bibliotekari
                                    </a>
                                </li>
                                <li>
                                    <span class="mx-2">/</span>
                                </li>
                                <li>
                                    <p class="text-gray-400">
                                        {{ $librarian->name }}
                                    </p>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="pt-[24px] pr-[30px]">
                    @if($librarian->id == \Illuminate\Support\Facades\Auth::user()->id || \Illuminate\Support\Facades\Auth::user()->role_id == 1)
                        <a href="#" class="inline hover:text-blue-600 show-modal">
                            <i class="fas fa-redo-alt mr-[3px]"></i>
                            Resetuj šifru
                        </a>
                        <a href="{{route('librarians.edit', $librarian->id)}}"
                           class="hover:text-blue-600 inline ml-[20px] pr-[10px]">
                            <i class="fas fa-edit mr-[3px] "></i>
                            Izmjeni podatke
                        </a>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1 && $librarian->id != \Illuminate\Support\Facades\Auth::user()->id)
                        <p class="inline cursor-pointer text-[25px] py-[10px] pl-[30px] border-l-[1px] border-gray-300 dotsLibrarianProfile hover:text-[#606FC7]"
                           id="dropdownStudent">
                            <i
                                class="fas fa-ellipsis-v"></i>
                        </p>
                        <div
                            class="z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-librarian-profile">
                            <div
                                class="absolute right-0 w-56 mt-[10px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                <div class="py-1">
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
                    @endif
                </div>
            </div>
        </div>
        <!-- Space for content -->
        <div class="pl-[30px] height-profile pb-[30px] scroll mt-[20px]">
            <div class="flex flex-row">
                <div class="mr-[30px]">
                    <div class="mt-[20px]">
                        <span class="text-gray-500">Ime i prezime</span>
                        <p class="font-medium">{{$librarian->name}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Tip korisnika</span>
                        <p class="font-medium">{{$librarian->role->name}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">JMBG</span>
                        <p class="font-medium">{{$librarian->jmbg}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Email</span>
                        <a href="mailto:{{$librarian->email}}"
                           class="cursor-pointer block font-medium text-[#2196f3] hover:text-blue-600">{{$librarian->email}}</a>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Korisnicko ime</span>
                        <p class="font-medium">{{$librarian->username}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Broj logovanja</span>
                        <p class="font-medium">{{$librarian->logins->count()}}</p>
                    </div>
                    <div class="mt-[40px]">
                        <span class="text-gray-500">Poslednji put logovan/a</span>
                        <p class="font-medium">@if($librarian->logins->isNotEmpty())
                                {{ $librarian->logins[$librarian->logins->count() - 1]->created_at->diffForHumans() }}
                            @else
                                Nikada se nije ulogovao
                            @endif</p>
                    </div>

                </div>
                <div class="ml-[100px]  mt-[20px]">
                    <img class="p-2 border-2 border-gray-300" width="300px"
                         @if($librarian->picture === 'profile-picture-placeholder.jpg') src="{{asset('imgs/profile-picture-placeholder.jpg')}}"
                         @else src="{{asset('storage/uploads/librarians/' . $librarian->picture)}}"
                         @endif alt="Profilna fotografija">
                </div>
            </div>
        </div>
    </section>

    <!-- This code will show up when we press reset password -->
    @if($librarian->id == \Illuminate\Support\Facades\Auth::user()->id || \Illuminate\Support\Facades\Auth::user()->role_id == 1)
        <div
            class="fixed top-0 left-0 flex items-center justify-center hidden w-full h-screen bg-black bg-opacity-50 modal">
            <!-- Modal -->
            <div class="w-[500px] bg-white rounded shadow-lg md:w-1/3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-[30px] py-[20px] border-b">
                    <h3>Resetuj sifru: {{$librarian->name}}</h3>
                    <button class="text-black close-modal">&cross;</button>
                </div>
                <!-- Modal Body -->
                <form class="forma">
                    <div class="flex flex-col px-[30px] py-[30px]">
                        <div class="flex flex-col pb-[30px]">
                            <span>Unesi novu šifru <span class="text-red-500">*</span></span>
                            <input
                                class="h-[40px] px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                type="password" name="password" id="resetLibrarianPassword">
                        </div>
                        <div class="flex flex-col pb-[30px]">
                            <span>Ponovi šifru <span class="text-red-500">*</span></span>
                            <input
                                class="h-[40px] px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                type="password" name="password_confirmation" id="resetLibrarianPasswordConfirm">
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-[30px] py-[20px] border-t w-100 text-white">
                        <button type="reset"
                                class="shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                            Ponisti <i class="fas fa-times ml-[4px]"></i>
                        </button>
                        <button id="resetPasswordBtn" type="submit"
                                class="shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                            Sačuvaj <i class="fas fa-check ml-[4px]"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
