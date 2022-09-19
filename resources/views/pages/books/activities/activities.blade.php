@extends('app')

@section('page_title')
    Aktivnosti
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <div class="heading mt-[7px]">
            <h1 class="pl-[30px] pb-[21px]  border-b-[1px] border-[#e4dfdf] ">
                Prikaz aktivnosti
            </h1>
        </div>
        <!-- Space for content -->
        <div class="pl-[30px] overflow-auto scroll height-dashboard pb-[30px] mt-[20px]">
            <div class="flex flex-row justify-between">
                <div class="mr-[30px]">
                    <div class="text-[14px] flex flex-row mb-[30px]">
                        <div class="">
                            <div class="rounded">
                                <div class="relative">
                                    <button class="w-auto rounded focus:outline-none uceniciDrop-toggle">
                                        <span class="float-left">Ucenici: Svi <i
                                                class="px-[7px] fas fa-angle-down"></i></span>
                                    </button>
                                    <div id="uceniciDropdown"
                                        class="uceniciMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md top-[42px] pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                    placeholder="Search"
                                                    onkeyup="filterFunction('searchUcenici', 'uceniciDropdown', 'dropdown-item-izdato')"
                                                    id="searchUcenici"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll">
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-izdato">
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
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-izdato">
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
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-izdato">
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
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-izdato">
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
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-izdato">
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
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-izdato">
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
                                </div>
                            </div>
                        </div>
                        <div class="ml-[25px]">
                            <div class="rounded">
                                <div class="relative">
                                    <button class="w-auto rounded focus:outline-none bibliotekariDrop-toggle">
                                        <span class="float-left">Bibliotekari: Svi <i
                                                class="px-[7px] fas fa-angle-down"></i></span>
                                    </button>
                                    <div id="bibliotekariDropdown"
                                        class="bibliotekariMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                    placeholder="Search"
                                                    onkeyup="filterFunction('searchBibliotekari', 'bibliotekariDropdown', 'dropdown-item-bibliotekar')"
                                                    id="searchBibliotekari"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll">
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-bibliotekar">
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
                                                        src="img/profileExample.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Bibliotekar Bulatovic
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-bibliotekar">
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
                                                        src="img/profileExample.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Pero Perovic
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-bibliotekar">
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
                                                        src="img/profileExample.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Marko Markovic
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-bibliotekar">
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
                                                        src="img/profileExample.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Nikola Nikolic
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-bibliotekar">
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
                                                        src="img/profileExample.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Zivko Zivkovic
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-bibliotekar">
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
                                                        src="img/profileExample.jpg">
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
                                </div>
                            </div>
                        </div>
                        <div class="ml-[25px]">
                            <div class="rounded">
                                <div class="relative">
                                    <button class="w-auto rounded focus:outline-none" id="knjigeMenu">
                                        Knjiga: <i class="px-[7px] fas fa-angle-down"></i></span>
                                    </button>
                                    <div id="knjigeDropdown"
                                        class="knjigeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                    placeholder="Search"
                                                    onkeyup="filterFunction('searchKnjige', 'knjigeDropdown', 'dropdown-item-knjiga')"
                                                    id="searchKnjige"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll">
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-knjiga">
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
                                                    <img width="30px" height="30px" class="ml-[15px]"
                                                        src="img/tomsojer.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Tom Sojer
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-knjiga">
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
                                                    <img width="30px" height="30px" class="ml-[15px]"
                                                        src="img/tomsojer.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Ilijada
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-knjiga">
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
                                                    <img width="30px" height="30px" class="ml-[15px]"
                                                        src="img/tomsojer.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Robinson Kruso
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-knjiga">
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
                                                    <img width="30px" height="30px" class="ml-[15px]"
                                                        src="img/tomsojer.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Orlovi rano lete
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-knjiga">
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
                                                    <img width="30px" height="30px" class="ml-[15px]"
                                                        src="img/tomsojer.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Tom Sojer
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-knjiga">
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
                                                    <img width="30px" height="30px" class="ml-[15px]"
                                                        src="img/tomsojer.jpg">
                                                    <p
                                                        class="block p-2 text-black cursor-pointer group-hover:text-blue-600">
                                                        Hari Poter
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
                                </div>
                            </div>
                        </div>
                        <div class="ml-[25px]">
                            <div class="rounded">
                                <div class="relative">
                                    <button class="w-auto rounded focus:outline-none" id="transakcijeMenu">
                                        <span class="float-left">Transakcije: Sve <i
                                                class="px-[7px] fas fa-angle-down"></i></span>
                                    </button>
                                    <div id="transakcijeDropdown"
                                        class="transakcijeMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md pin-t pin-l border-2 border-gray-300">
                                        <ul class="border-b-2 border-gray-300 list-reset">
                                            <li class="p-2 pb-[15px] border-b-[2px] relative border-gray-300">
                                                <input class="w-full h-10 px-2 border-2 rounded focus:outline-none"
                                                    placeholder="Search"
                                                    onkeyup="filterFunction('searchTransakcije', 'transakcijeDropdown', 'dropdown-item-transakcije')"
                                                    id="searchTransakcije"><br>
                                                <button
                                                    class="absolute block text-xl text-center text-gray-400 transition-colors w-7 h-7 leading-0 top-[14px] right-4 focus:outline-none hover:text-gray-900">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </li>
                                            <div class="h-[200px] scroll">
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-transakcije">
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
                                                        Izdavanje knjiga
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-transakcije">
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
                                                        Vracanje knjiga
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-transakcije">
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
                                                        Unos nove knjige
                                                    </p>
                                                </li>
                                                <li
                                                    class="flex p-2 mt-[2px] pt-[15px] group hover:bg-gray-200 dropdown-item-transakcije">
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
                                                        Brisanje knjige
                                                    </p>
                                                </li>
                                            </div>
                                        </ul>
                                        <div class="flex pt-[10px] text-white ">
                                            <a href="#"
                                                class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#009688] bg-[#46A149] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                                class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-[25px]">
                            <div class="rounded">
                                <div class="relative">
                                    <button class="w-auto rounded focus:outline-none datumDrop-toggle">
                                        <span class="float-left">Datum: Svi <i
                                                class="px-[7px] fas fa-angle-down"></i></span>
                                    </button>
                                    <div id="datumDropdown"
                                        class="datumMenu hidden absolute rounded bg-white min-w-[310px] p-[10px] shadow-md pin-t pin-l border-2 border-gray-300">
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
                                                class="btn-animation py-2 px-[20px] transition duration-300 ease-in hover:bg-[#009688] bg-[#46A149] rounded-[5px]">
                                                Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                            </a>
                                            <a href="#"
                                                class="btn-animation ml-[20px] py-2 px-[20px] transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                                Ponisti <i class="fas fa-times ml-[4px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-[35px] cursor-pointer hover:text-blue-600">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                    </div>
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
                            <button type="button"
                                class="btn-animation w-full px-4 py-2 text-sm tracking-wider text-gray-600 transition duration-300 ease-in border-[1px] border-gray-400 rounded activity-showMore hover:bg-gray-200 focus:outline-none focus:ring-[1px] focus:ring-gray-300">
                                Show more
                            </button>
                        </div>
                    @else
                        Nema aktivnosti
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
