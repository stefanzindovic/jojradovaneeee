@extends('app')

@section('page_title')
    Kategorije
@endsection

@section('page_content')
    <section class="w-screen h-screen pl-[80px] py-4 text-gray-700">
        <!-- Heading of content -->
        <x-settings-header></x-settings-header>

        <div class="height-kategorije pb-[30px] scroll">
            <div class="flex items-center px-[50px] py-8 space-x-3 rounded-lg">
                <a href="{{ route('settings.categories.create') }}"
                   class="btn-animation inline-flex items-center text-sm py-2.5 px-5 transition duration-300 ease-in rounded-[5px] tracking-wider text-white bg-[#3f51b5] rounded hover:bg-[#4558BE]">
                    <i class="fas fa-plus mr-[15px]"></i> Nova kategorija
                </a>
            </div>

            <div
                class="inline-block min-w-full px-[50px] pt-3 align-middle bg-white rounded-bl-lg rounded-br-lg shadow-dashboard">
                @if($categories->isNotEmpty())
                    <table class="overflow-hidden shadow-lg rounded-xl min-w-full border-[1px] border-[#e4dfdf]" id="myTable">
                        <thead class="bg-[#EFF3F6] w-full">
                            <tr class="border-b-[1px] border-[#e4dfdf]">
                                <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500" data-orderable="false">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox">
                                    </label>
                                </th>
                                <th style="min-width: 75%; max-width: 75%;" class="px-4 py-4 leading-4 tracking-wider text-left">Naziv kategorije<a href="#"></a>
                                </th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Opis</th>
                                <th class="px-4 py-4" data-orderable="false"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($categories as $category)
                            <tr class="w-full hover:bg-gray-200 hover:shadow-md border-b-[1px] border-[#e4dfdf]">
                                <td class="px-4 py-4 whitespace-no-wrap">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox">
                                    </label>
                                </td>
                                <td class="flex flex-row items-center px-4 py-4">
                                    <div style="width: 45px; height: 45px;" class="rounded-full">
                                        <img style="border-radius: 100%" class="w-full h-full" src="{{asset($category->icon)}}" alt="Ikonica">
                                    </div>
                                    <a class="flex" href="{{ route('settings.categories.show', $category->id) }}">
                                        <p class="ml-4 text-center">{{ $category->title }}</p>
                                    </a>
                                </td>
                                <td style="width: 75%; height: 75%;" class="px-4 py-4 text-sm leading-5 whitespace-no-wrap">{{ $category->description }}</td>
                                <td class="px-4 py-4 text-sm leading-5 text-right whitespace-no-wrap">
                                    <p class="inline cursor-pointer text-[20px] py-[10px] px-[30px] border-gray-300 dotsCategory hover:text-[#606FC7]">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </p>
                                    <div
                                        class="relative z-10 hidden transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-category">
                                        <div class="absolute right-[25px] w-56 mt-[7px] origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                             aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                            <div class="py-1">
                                                <a href="{{ route('settings.categories.edit', $category->id) }}" tabindex="0"
                                                   class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                   role="menuitem">
                                                    <i class="fas fa-edit mr-[1px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Izmijeni</span>
                                                </a>
                                                <a href="{{ route('settings.categories.destroy', $category->id) }}" tabindex="0"
                                                   class="flex w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 outline-none hover:text-blue-600"
                                                   role="menuitem">
                                                    <i class="fa fa-trash mr-[5px] ml-[5px] py-1"></i>
                                                    <span class="px-4 py-0">Izbrisi</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-b-[1px] border-[#e4dfdf]">
                                <th class="px-4 py-4 leading-4 tracking-wider text-left text-blue-500" data-orderable="false">

                                </th>
                                <th style="min-width: 75%; max-width: 75%;" class="px-4 py-4 leading-4 tracking-wider text-left">Naziv kategorije<a href="#"></a>
                                </th>
                                <th class="px-4 py-4 text-sm leading-4 tracking-wider text-left">Opis</th>
                                <th class="px-4 py-4" data-orderable="false"></th>
                            </tr>
                        </tfoot>
                    </table>
                @else
                    <p class="px-4 py-4 text-sm leading-5 whitespace-no-wrap text-center">Nema dostupnih kategorija</p>
                @endif
            </div>
        </div>

    </section>
@endsection
