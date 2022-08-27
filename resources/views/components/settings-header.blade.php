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
    <a href="settingsZanrovi.php" class="inline ml-[70px] hover:text-blue-800">
        Zanrovi
    </a>
    <a href="settingsIzdavac.php" class="inline ml-[70px] hover:text-blue-800">
        Izdavac
    </a>
    <a href="settingsPovez.php" class="inline ml-[70px] hover:text-blue-800">
        Povez
    </a>
    <a href="settingsFormat.php" class="inline ml-[70px] hover:text-blue-800">
        Format
    </a>
    <a href="settingsPismo.php" class="inline ml-[70px] hover:text-blue-800">
        Pismo
    </a>
</div>
