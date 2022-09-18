<nav id="sidebar"
    class="fixed z-10 flex flex-col justify-between overflow-x-hidden overflow-y-auto bg-[#EFF3F6] sidebar nav-height">
    <div class="">
        <!-- Hamburger Icon -->
        <div
            class="cursor-pointer text-[#707070] pl-[30px] pt-[28px] pb-[27px] text-[25px] border-b-[1px] border-[#e4dfdf] ">
            <i id="hamburger" class="hamburger-btn fas fa-bars"></i>
        </div>
        <div class="mt-[30px]">
            <ul class="text-[#2D3B48] sidebar-nav">
                <!-- Dashboard Icon -->
                <li
                    class="@if (\Illuminate\Support\Facades\Request::is('dashboards*')) bg-[#EAEAEA] @endif pt-[18px] pb-[14px] mb-[4px] group hover:bg-[#EAEAEA]">
                    <div class="ml-[20px]">
                        <span class="flex justify-between w-full fill-current whitespace-nowrap">
                            <div class="transition duration-300 ease-in group-hover:text-[#576cdf]">
                                <a href="dashboard.php" aria-label="Dashboard">
                                    <i
                                        class="text-[#707070] @if (\Illuminate\Support\Facades\Request::is('dashboards*')) text-[#576cdf] @endif px-[5px] pt-[4px] pb-[5px] fas fa-tachometer-alt text-[25px] rounded-[3px]"></i>
                                    <div class="hidden sidebar-item">
                                        <p
                                            class="@if (\Illuminate\Support\Facades\Request::is('dashboards*')) text-[#576cdf] @endif inline text-[15px] ml-[15px]">
                                            Komandna tabla</p>
                                    </div>
                                </a>
                            </div>
                        </span>
                    </div>
                </li>
                <!-- Bibliotekari Icon -->
                <li
                    class="@if (\Illuminate\Support\Facades\Request::is('librarians*')) bg-[#EAEAEA] @endif pt-[18px] pb-[14px] mb-[4px] group hover:bg-[#EAEAEA] h-[60px]">
                    <div class="ml-[30px]">
                        <span class="flex justify-between w-full whitespace-nowrap">
                            <div>
                                <a href="{{ route('librarians.index') }}" aria-label="Bibliotekari">
                                    <i
                                        class="@if (\Illuminate\Support\Facades\Request::is('librarians*')) text-[#576cdf] @endif text-[25px] text-[#707070] fa-solid fa-user-shield transition duration-300 ease-in group-hover:text-[#576cdf]"></i>
                                    <div class="hidden sidebar-item">
                                        <p
                                            class="@if (\Illuminate\Support\Facades\Request::is('librarians*')) text-[#576cdf] @endif inline text-[15px] ml-[20px] transition duration-300 ease-in group-hover:text-[#576cdf]">
                                            Bibliotekari
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </span>
                    </div>
                </li>
                <!-- Ucenici Icon -->
                <li
                    class="@if (\Illuminate\Support\Facades\Request::is('students*')) bg-[#EAEAEA] @endif pt-[18px] pb-[14px] mb-[4px] group hover:bg-[#EAEAEA] h-[60px]">
                    <div class="ml-[30px]">
                        <span class="flex justify-between w-full whitespace-nowrap">
                            <div>
                                <a href="{{ route('students.index') }}" aria-label="Učenici">
                                    <i
                                        class="text-[19px] @if (\Illuminate\Support\Facades\Request::is('students*')) text-[#576cdf] @endif transition duration-300 ease-in group-hover:text-[#576cdf] text-[#707070] fas fa-users"></i>
                                    <div class="hidden sidebar-item">
                                        <p
                                            class="transition @if (\Illuminate\Support\Facades\Request::is('students*')) text-[#576cdf] @endif duration-300 ease-in group-hover:text-[#576cdf] inline text-[15px] ml-[20px]">
                                            Ucenici</p>
                                    </div>
                                </a>
                            </div>
                        </span>
                    </div>
                </li>
                <!-- Knjige Icon -->
                <li
                    class="@if (\Illuminate\Support\Facades\Request::is('books*')) bg-[#EAEAEA] @endif pt-[18px] pb-[14px] mb-[4px] group hover:bg-[#EAEAEA] h-[60px]">
                    <div class="ml-[30px]">
                        <span class="flex justify-between w-full whitespace-nowrap">
                            <div>
                                <a href="{{ route('books.index') }}" aria-label="Knjige">
                                    <i
                                        class="text-[25px] @if (\Illuminate\Support\Facades\Request::is('books*')) text-[#576cdf] @endif transition duration-300 ease-in group-hover:text-[#576cdf] text-[#707070] fa-solid fa-book"></i>
                                    <div class="hidden sidebar-item">
                                        <p
                                            class="transition @if (\Illuminate\Support\Facades\Request::is('books*')) text-[#576cdf] @endif duration-300 ease-in group-hover:text-[#576cdf] inline text-[15px] ml-[20px]">
                                            Knjige</p>
                                    </div>
                                </a>
                            </div>
                        </span>
                    </div>
                </li>
                <!-- Autori Icon -->
                <li
                    class="@if (\Illuminate\Support\Facades\Request::is('authors*')) bg-[#EAEAEA] @endif pt-[18px] pb-[14px] mb-[4px] group hover:bg-[#EAEAEA] h-[60px]">
                    <div class="ml-[30px]">
                        <span class="flex justify-between w-full whitespace-nowrap">
                            <div>
                                <a href="{{ route('authors.index') }}" aria-label="Autori">
                                    <i
                                        class="text-[25px] @if (\Illuminate\Support\Facades\Request::is('authors*')) text-[#576cdf] @endif transition duration-300 ease-in group-hover:text-[#576cdf] text-[#707070] fa-solid fa-user-edit"></i>
                                    <div class="hidden sidebar-item">
                                        <p
                                            class="transition @if (\Illuminate\Support\Facades\Request::is('authors*')) text-[#576cdf] @endif duration-300 ease-in group-hover:text-[#576cdf] inline text-[15px] ml-[20px]">
                                            Autori</p>
                                    </div>
                                </a>
                            </div>
                        </span>
                    </div>
                </li>
                <!-- Izdavanje Icon -->
                <li
                    class="@if (\Illuminate\Support\Facades\Request::is('actions/*')) bg-[#EAEAEA] @endif pt-[18px] pb-[14px] mb-[4px] group hover:bg-[#EAEAEA] h-[60px]">
                    <div class="ml-[30px]">
                        <span class="flex justify-between w-full whitespace-nowrap">
                            <div>
                                <a href="{{ route('books.issues.issues') }}" aria-label="Knjige">
                                    <i
                                        class="@if (\Illuminate\Support\Facades\Request::is('actions*')) text-[#576cdf] @endif text-[22px] transition duration-300 ease-in group-hover:text-[#576cdf] text-[#707070] fas fa-exchange-alt"></i>
                                    <div class="hidden sidebar-item">
                                        <p
                                            class="@if (\Illuminate\Support\Facades\Request::is('books/actions*')) text-[#576cdf] @endif transition duration-300 ease-in group-hover:text-[#576cdf] inline text-[15px] ml-[20px]">
                                            Izdavanje
                                            knjiga
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div
        class="@if (\Illuminate\Support\Facades\Request::is('settings*')) bg-[#EAEAEA] @endif sidebar-nav py-[10px] border-t-[1px] border-[#e4dfdf] pt-[23px] pb-[29px]  group hover:bg-[#EAEAEA]">
        <!-- Settings Icon -->
        <a href="{{ route('settings.policies.index') }}" aria-label="Settngs" class="ml-[30px]">
            <span class="whitespace-nowrap">
                <i
                    class="@if (\Illuminate\Support\Facades\Request::is('settings*')) text-[#576cdf] @endif transition duration-300 ease-in group-hover:text-[#576cdf] text-[22px] text-[#707070] fas fa-cog"></i>
                <div class="hidden sidebar-item">
                    <p
                        class="@if (\Illuminate\Support\Facades\Request::is('settings*')) text-[#576cdf] @endif transition duration-300 ease-in group-hover:text-[#576cdf] inline text-[15px] ml-[20px]">
                        Podešavanja</p>
                </div>
            </span>
        </a>
    </div>
</nav>
