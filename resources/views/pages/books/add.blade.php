@extends('app')

@section('page_title')
    Nova knjiga
@endsection

@section('page_content')
    <div>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
                <section>
                    <div class="heading">
                        <div class="flex border-b-[1px] border-[#e4dfdf]">
                            <div class="pl-[30px] py-[10px] flex flex-col">
                                <div>
                                    <h1>
                                        Nova knjiga
                                    </h1>
                                </div>
                                <div>
                                    <nav class="w-full rounded">
                                        <ol class="flex list-reset">
                                            <li>
                                                <a onclick="{{ route('books.index') }}"
                                                    class="text-[#2196f3] cursor-pointer hover:text-blue-600">
                                                    Evidencija knjiga
                                                </a>
                                            </li>
                                            <li>
                                                <span class="mx-2">/</span>
                                            </li>
                                            <li>
                                                <p class="text-gray-400">
                                                    Nova knjiga
                                                </p>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="py-4
                                                    text-gray-500 border-b-[1px] border-[#e4dfdf] pl-[30px]">
                        <a id="bookDetailsBtn" class="inline active-book-nav cursor-pointer hover:text-blue-800">
                            Osnovni detalji
                        </a>
                        <a id="bookSpecificationsBtn" class="inline ml-[70px] cursor-pointer hover:text-blue-800 ">
                            Specifikacija
                        </a>
                        <a id="bookMultimediaBtn" class="inline ml-[70px] cursor-pointer hover:text-blue-800">
                            Multimedija
                        </a>
                    </div>
                </section>
                <section id="addBookTab_Basics">
                    <div class="scroll height-content section-content">
                        <div class="flex flex-row ml-[30px] mb-[150px]">
                            <div class="w-[50%]">
                                <div class="mt-[20px]">
                                    <p>Naziv knjige <span class="text-red-500">*</span></p>
                                    <input type="text" name="nazivKnjiga" id="nazivKnjiga"
                                        class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        onkeydown="clearErrorsNazivKnjiga()" />
                                    <div id="validateNazivKnjiga"></div>
                                </div>

                                <div class="mt-[20px]">
                                    <p class="inline-block mb-2">Kratki sadrzaj</p>
                                    <textarea name="kratki_sadrzaj"
                                        class="flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">
        
                                        </textarea>
                                </div>

                                <div class="mt-[20px]">
                                    <p>Izaberite kategorije <span class="text-red-500">*</span></p>
                                    <select id="categories" name="categories[]" multiple="multiple"
                                        class="select2Form flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">
                                        <option value="1">Udzbenici</option>
                                        <option value="2">Romani</option>
                                    </select>

                                    <div x-init="loadOptions()" class="flex flex-col w-[90%]" style="display: none">
                                        <input name="values" id="kategorijaInput" type="hidden"
                                            x-bind:value="selectedValues()">
                                        <div class="relative inline-block w-[100%]">
                                            <div class="relative flex flex-col items-center">
                                                <div x-on:click="open" class="w-full svelte-1l8159u">
                                                    <div class="flex p-1 my-2 bg-white border border-gray-300 shadow-sm svelte-1l8159u focus-within:ring-2 focus-within:ring-[#576cdf]"
                                                        onclick="clearErrorsKategorija()">
                                                        <div class="flex flex-wrap flex-auto">
                                                            <template x-for="(option,index) in selected"
                                                                :key="options[option].value">
                                                                <div
                                                                    class="flex items-center justify-center px-[6px] py-[2px] m-1 text-blue-800 bg-blue-200 rounded-[10px] ">
                                                                    <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                                        options[option] x-text="options[option].text"></div>
                                                                    <div class="flex flex-row-reverse flex-auto">
                                                                        <div x-on:click="remove(index,option)">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        </template>
                                                        <div x-show="selected.length    == 0" class="flex-1">
                                                            <input
                                                                class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none"
                                                                x-bind:value="selectedValues()">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 svelte-1l8159u">
                                                        <button type="button" x-show="isOpen() === true" x-on:click="open"
                                                            class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                                        </button>
                                                        <button type="button" x-show="isOpen() === false" @click="close"
                                                            class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">

                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full">
                                                <div x-show.transition.origin.top="isOpen()"
                                                    class="z-40 w-full overflow-y-auto bg-white rounded shadow max-h-select svelte-5uyqqj"
                                                    x-on:click.away="close">
                                                    <div class="flex flex-col w-full">
                                                        <template x-for="(option,index) in options" :key="option">
                                                            <div>
                                                                <div class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-teal-100"
                                                                    @click="select(index,$event)">
                                                                    <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                                                        class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                                                                        <div class="flex items-center w-full">
                                                                            <div class="mx-2 leading-6" x-model="option"
                                                                                x-text="option.text"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="validateKategorija"></div>
                            </div>

                            <div class="mt-[20px]">
                                <p>Izaberite zanrove <span class="text-red-500">*</span></p>
                                <select id="genres" name="genres[]" multiple="multiple"
                                    class="select2Form flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">
                                    <option value="1">Udzbenici</option>
                                    <option value="2">Romani</option>
                                </select>

                                <div x-init="loadOptions()" class="flex flex-col w-[90%]" style="display: none">
                                    <input name="values" id="kategorijaInput" type="hidden"
                                        x-bind:value="selectedValues()">
                                    <div class="relative inline-block w-[100%]">
                                        <div class="relative flex flex-col items-center">
                                            <div x-on:click="open" class="w-full svelte-1l8159u">
                                                <div class="flex p-1 my-2 bg-white border border-gray-300 shadow-sm svelte-1l8159u focus-within:ring-2 focus-within:ring-[#576cdf]"
                                                    onclick="clearErrorsKategorija()">
                                                    <div class="flex flex-wrap flex-auto">
                                                        <template x-for="(option,index) in selected"
                                                            :key="options[option].value">
                                                            <div
                                                                class="flex items-center justify-center px-[6px] py-[2px] m-1 text-blue-800 bg-blue-200 rounded-[10px] ">
                                                                <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                                    options[option] x-text="options[option].text"></div>
                                                                <div class="flex flex-row-reverse flex-auto">
                                                                    <div x-on:click="remove(index,option)">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    </template>
                                                    <div x-show="selected.length    == 0" class="flex-1">
                                                        <input
                                                            class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none"
                                                            x-bind:value="selectedValues()">
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 svelte-1l8159u">
                                                    <button type="button" x-show="isOpen() === true" x-on:click="open"
                                                        class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                                    </button>
                                                    <button type="button" x-show="isOpen() === false" @click="close"
                                                        class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <div x-show.transition.origin.top="isOpen()"
                                                class="z-40 w-full overflow-y-auto bg-white rounded shadow max-h-select svelte-5uyqqj"
                                                x-on:click.away="close">
                                                <div class="flex flex-col w-full">
                                                    <template x-for="(option,index) in options" :key="option">
                                                        <div>
                                                            <div class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-teal-100"
                                                                @click="select(index,$event)">
                                                                <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                                                    class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                                                                    <div class="flex items-center w-full">
                                                                        <div class="mx-2 leading-6" x-model="option"
                                                                            x-text="option.text"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="validateZanr"></div>
                        </div>
                    </div>

                    <div class="w-[50%]">
                        <div class="mt-[20px]">
                            <p>Izaberite autore <span class="text-red-500">*</span></p>
                            <select id="authors" name="authors[]" multiple="multiple"
                                class="select2Form flex w-[90%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]">
                                <option value="1">Udzbenici</option>
                                <option value="2">Romani</option>
                            </select>

                            <div x-init="loadOptions()" class="flex flex-col w-[90%]" style="display: none">
                                <input name="values" id="kategorijaInput" type="hidden"
                                    x-bind:value="selectedValues()">
                                <div class="relative inline-block w-[100%]">
                                    <div class="relative flex flex-col items-center">
                                        <div x-on:click="open" class="w-full svelte-1l8159u">
                                            <div class="flex p-1 my-2 bg-white border border-gray-300 shadow-sm svelte-1l8159u focus-within:ring-2 focus-within:ring-[#576cdf]"
                                                onclick="clearErrorsKategorija()">
                                                <div class="flex flex-wrap flex-auto">
                                                    <template x-for="(option,index) in selected"
                                                        :key="options[option].value">
                                                        <div
                                                            class="flex items-center justify-center px-[6px] py-[2px] m-1 text-blue-800 bg-blue-200 rounded-[10px] ">
                                                            <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                                options[option] x-text="options[option].text"></div>
                                                            <div class="flex flex-row-reverse flex-auto">
                                                                <div x-on:click="remove(index,option)">

                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                </template>
                                                <div x-show="selected.length    == 0" class="flex-1">
                                                    <input
                                                        class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none"
                                                        x-bind:value="selectedValues()">
                                                </div>
                                            </div>
                                            <div class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 svelte-1l8159u">
                                                <button type="button" x-show="isOpen() === true" x-on:click="open"
                                                    class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                                </button>
                                                <button type="button" x-show="isOpen() === false" @click="close"
                                                    class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <div x-show.transition.origin.top="isOpen()"
                                            class="z-40 w-full overflow-y-auto bg-white rounded shadow max-h-select svelte-5uyqqj"
                                            x-on:click.away="close">
                                            <div class="flex flex-col w-full">
                                                <template x-for="(option,index) in options" :key="option">
                                                    <div>
                                                        <div class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-teal-100"
                                                            @click="select(index,$event)">
                                                            <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                                                class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent">
                                                                <div class="flex items-center w-full">
                                                                    <div class="mx-2 leading-6" x-model="option"
                                                                        x-text="option.text"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="validateAutori"></div>
                    </div>

                    <div class="mt-[20px]">
                        <p>Izdavac <span class="text-red-500">*</span></p>
                        <select
                            class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            name="izdavac" id="izdavac" onclick="clearErrorsIzdavac()">
                            <option disabled selected></option>
                            <option value="">
                                Izdavac 1
                            </option>
                        </select>
                        <div id="validateIzdavac"></div>
                    </div>

                    <div class="mt-[20px]">
                        <p>Godina izdavanja <span class="text-red-500">*</span></p>
                        <select
                            class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            name="godinaIzdavanja" id="godinaIzdavanja" onclick="clearErrorsGodinaIzdavanja()">
                            <option disabled selected></option>
                            <option value="">
                                Godina izdavanja 1
                            </option>
                        </select>
                        <div id="validateGodinaIzdavanja"></div>
                    </div>

                    <div class="mt-[20px]">
                        <p>Kolicina <span class="text-red-500">*</span></p>
                        <input type="text" name="knjigaKolicina" id="knjigaKolicina"
                            class="flex w-[45%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                            onkeydown="clearErrorsKnjigaKolicina()" />
                        <div id="validateKnjigaKolicina"></div>
                    </div>
                </section>
                <section id="addBookTab_Specifications" class="hidden">
                    <div class="scroll height-content section-content">
                        <div class="flex flex-row ml-[30px]">
                            <div class="w-[50%] mb-[150px]">
                                <div class="mt-[20px]">
                                    <p>Broj strana <span class="text-red-500">*</span></p>
                                    <input type="text" name="brStrana" id="brStrana"
                                        class="flex w-[45%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        onkeydown="clearErrorsBrStrana()" />
                                    <div id="validateBrStrana"></div>
                                </div>

                                <div class="mt-[20px]">
                                    <p>Pismo <span class="text-red-500">*</span></p>
                                    <select
                                        class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        name="pismo" id="pismo" onclick="clearErrorsPismo()">
                                        <option disabled selected></option>
                                        <option value="">
                                            Cirilica
                                        </option>
                                        <option value="">
                                            Latinica
                                        </option>
                                        <option value="">
                                            Arapsko
                                        </option>
                                        <option value="">
                                            Kinesko
                                        </option>
                                    </select>
                                    <div id="validatePismo"></div>
                                </div>

                                <div class="mt-[20px]">
                                    <p>Povez <span class="text-red-500">*</span></p>
                                    <select
                                        class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        name="povez" id="povez" onclick="clearErrorsPovez()">
                                        <option disabled selected></option>
                                        <option value="">
                                            Tvrdi
                                        </option>
                                        <option value="">
                                            Meki
                                        </option>
                                    </select>
                                    <div id="validatePovez"></div>
                                </div>

                                <div class="mt-[20px]">
                                    <p>Format <span class="text-red-500">*</span></p>
                                    <select
                                        class="flex w-[45%] mt-2 px-2 py-2 border bg-white border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        name="format" id="format" onclick="clearErrorsFormat()">
                                        <option disabled selected></option>
                                        <option value="">
                                            A1
                                        </option>
                                        <option value="">
                                            A2
                                        </option>
                                    </select>
                                    <div id="validateFormat"></div>
                                </div>

                                <div class="mt-[20px]">
                                    <p>International Standard Book Num <span class="text-red-500">*</span></p>
                                    <input type="text" name="isbn" id="isbn"
                                        class="flex w-[45%] mt-2 px-2 py-2 text-base bg-white border border-gray-300 shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-[#576cdf]"
                                        onkeydown="clearErrorsIsbn()" />
                                    <div id="validateIsbn"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="addBookTab_Multimedia" class="hidden">
                    <div class="scroll height-content section-content">

                        <div class="w-9/12 mx-auto bg-white rounded p7 mt-[40px] mb-[150px]">
                            <div x-data="dataFileDnD()"
                                class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                                <div x-ref="dnd"
                                    class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">
                                    <input accept="*" type="file" multiple
                                        class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                                        @change="addFiles($event)"
                                        @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                                        @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                        @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                        title="" />

                                    <div class="flex flex-col items-center justify-center py-10 text-center">

                                        <p class="m-0">Drag your files here or click in this area.</p>
                                    </div>
                                </div>

                                <template x-if="files.length > 0">
                                    <div class="grid grid-cols-4 gap-4 mt-4" @drop.prevent="drop($event)"
                                        @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                                        <template x-for="(_, index) in Array.from({ length: files.length })">
                                            <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
                                                style="padding-top: 100%;" @dragstart="dragstart($event)"
                                                @dragend="fileDragging = null"
                                                :class="{ 'border-blue-600': fileDragging == index }" draggable="true"
                                                :data-index="index">
                                                <!-- Checkbox -->
                                                <input
                                                    class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                                    type="radio" name="chosen_image" />
                                                <!-- End checkbox -->
                                                <button
                                                    class="absolute bottom-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                                    type="button" @click="remove(index)">
                                                    <svg class="w-[25px] h-[25px] text-gray-700"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        nviewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                                <template x-if="files[index].type.includes('audio/')">
                                                    <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                    </svg>
                                                </template>
                                                <template
                                                    x-if="files[index].type.includes('application/') || files[index].type === ''">
                                                    <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                </template>
                                                <template x-if="files[index].type.includes('image/')">
                                                    <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                                        x-bind:src="loadFile(files[index])" />
                                                </template>
                                                <template x-if="files[index].type.includes('video/')">
                                                    <video
                                                        class="absolute inset-0 object-cover w-full h-full border-4 border-white pointer-events-none preview">
                                                        <fileDragging x-bind:src="loadFile(files[index])"
                                                            type="video/mp4">
                                                    </video>
                                                </template>

                                                <div
                                                    class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                                                    <span class="w-full font-bold text-gray-900 truncate"
                                                        x-text="files[index].name">Loading</span>
                                                    <span class="text-xs text-gray-900"
                                                        x-text="humanFileSize(files[index].size)">...</span>
                                                </div>

                                                <div class="absolute inset-0 z-40 transition-colors duration-300"
                                                    @dragenter="dragenter($event)" @dragleave="fileDropping = null"
                                                    :class="{
                                                        'bg-blue-200 bg-opacity-80': fileDropping == index &&
                                                            fileDragging !=
                                                            index
                                                    }">
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="absolute bottom-0 w-full">
                            <div class="flex flex-row">
                                <div class="inline-block w-full text-white text-right py-[7px] mr-[100px]">
                                    <button type="button"
                                        class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                                        Ponisti <i class="fas fa-times ml-[4px]"></i>
                                    </button>
                                    <button id="vratiKnjigu" type="submit"
                                        class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]">
                                        Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
        </form>
    </div>
    </section>
    <div class="absolute bottom-0 w-full">
        <div class="flex flex-row">
            <div class="inline-block w-full text-white text-right py-[7px] mr-[100px]">
                <button type="reset"
                    class="btn-animation shadow-lg mr-[15px] w-[150px] focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in bg-[#F44336] hover:bg-[#F55549] rounded-[5px]">
                    Ponisti <i class="fas fa-times ml-[4px]"></i>
                </button>
                <button id="sacuvajSpecifikaciju" type="submit"
                    class="btn-animation shadow-lg w-[150px] disabled:opacity-50 focus:outline-none text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] hover:bg-[#46A149] bg-[#4CAF50]"
                    onclick="validacijaSpecifikacija()">
                    Sacuvaj <i class="fas fa-check ml-[4px]"></i>
                </button>
            </div>
        </div>
    </div>
    </section>
    </form>

    </div>

    <script>
        function dataFileDnD() {
            return {
                files: [],
                fileDragging: null,
                fileDropping: null,
                humanFileSize(size) {
                    const i = Math.floor(Math.log(size) / Math.log(1024));
                    return (
                        (size / Math.pow(1024, i)).toFixed(2) * 1 +
                        " " + ["B", "kB", "MB", "GB", "TB"][i]
                    );
                },
                remove(index) {
                    let files = [...this.files];
                    files.splice(index, 1);

                    this.files = createFileList(files);
                },
                drop(e) {
                    let removed, add;
                    let files = [...this.files];

                    removed = files.splice(this.fileDragging, 1);
                    files.splice(this.fileDropping, 0, ...removed);

                    this.files = createFileList(files);

                    this.fileDropping = null;
                    this.fileDragging = null;
                },
                dragenter(e) {
                    let targetElem = e.target.closest("[draggable]");

                    this.fileDropping = targetElem.getAttribute("data-index");
                },
                dragstart(e) {
                    this.fileDragging = e.target
                        .closest("[draggable]")
                        .getAttribute("data-index");
                    e.dataTransfer.effectAllowed = "move";
                },
                loadFile(file) {
                    const preview = document.querySelectorAll(".preview");
                    const blobUrl = URL.createObjectURL(file);

                    preview.forEach(elem => {
                        elem.onload = () => {
                            URL.revokeObjectURL(elem.src); // free memory
                        };
                    });

                    return blobUrl;
                },
                addFiles(e) {
                    const files = createFileList([...this.files], [...e.target.files]);
                    this.files = files;
                    this.form.formData.files = [...files];
                }
            };
        }
    </script>
@endsection
