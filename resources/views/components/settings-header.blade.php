@php use Illuminate\Support\Facades\Route; @endphp

<div class="heading mt-[7px]">
    <div class="border-b-[1px] border-[#e4dfdf]">
        <div class="pl-[30px] pb-[21px]">
            <h1>
                Podešavanja
            </h1>
        </div>
    </div>
</div>
<div class="py-4 text-gray-500 border-b-[1px] border-[#e4dfdf] pl-[30px]">
    <a href="{{ route('settings.policies.index') }}"
       class="inline @if(Route::current()->getName() == 'settings.policies.index') active-book-nav @endif">
        Polisa
    </a>
    <a href="{{route('settings.categories.index')}}"
       class="inline ml-[70px] hover:text-blue-800 @if(Route::current()->getName() == 'settings.categories.index') active-book-nav @endif">
        Kategorije
    </a>
    <a href="{{ route('settings.genres.index') }}" class="inline ml-[70px] hover:text-blue-800 @if(Route::current()->getName() == 'settings.genres.index') active-book-nav @endif">
        Žanrovi
    </a>
    <a href="{{ route('settings.publishers.index') }}" class="inline ml-[70px] hover:text-blue-800 @if(Route::current()->getName() == 'settings.publishers.index') active-book-nav @endif">
        Izdavači
    </a>
    <a href="{{ route('settings.covers.index') }}" class="inline ml-[70px] hover:text-blue-800 @if(Route::current()->getName() == 'settings.covers.index') active-book-nav @endif">
        Povezi
    </a>
    <a href="{{ route('settings.formats.index') }}" class="inline ml-[70px] hover:text-blue-800 @if(Route::current()->getName() == 'settings.formats.index') active-book-nav @endif">
        Formati
    </a>
    <a href="{{ route('settings.scripts.index') }}" class="inline ml-[70px] hover:text-blue-800 @if(Route::current()->getName() == 'settings.scripts.index') active-book-nav @endif">
        Pisma
    </a>
    <a href="{{ route('settings.languages.index') }}" class="inline ml-[70px] hover:text-blue-800 @if(Route::current()->getName() == 'settings.languages.index') active-book-nav @endif">
        Jezici
    </a>
</div>
