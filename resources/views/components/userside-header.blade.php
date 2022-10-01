<header id="header" class="header fixed-top">
    <div class="container-xxl  d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center" style="margin-left: -12px;">
            <div id="icon-container" style="max-width: 50px;margin: 0;padding: 0" ></div>
            <span style="font-size: 24px !important;">Biblioteka</span>
        </a>

        <div class="search-wrapper">
            <div class="nav-icon-wrapper d-lg-none">
                <a class="nav-icon-btn" style="top: 12px;left: 15px;position: relative;cursor:pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25">
                        <g clip-path="url(#prefix__clip-path)" data-name="Group 9938">
                            <g data-name="Group 9935">
                                <path
                                    d="M10.765 17.708a7.292 7.292 0 117.292-7.292 7.3 7.3 0 01-7.292 7.292zm0-12.5a5.208 5.208 0 105.208 5.208 5.214 5.214 0 00-5.208-5.208z"
                                    data-name="Path 8736"></path>
                            </g>
                            <g data-name="Group 9936">
                                <path
                                    d="M20.34 21.77a1.037 1.037 0 01-.736-.305l-2.947-2.946a1.042 1.042 0 010-1.473l.737-.736a1.041 1.041 0 011.473 0l2.946 2.946a1.041 1.041 0 010 1.473l-.736.736a1.038 1.038 0 01-.737.305z"
                                    data-name="Path 8737"></path>
                            </g>
                            <g data-name="Group 9937">
                                <path d="M14.447 15.573L15.92 14.1l2.578 2.578-1.473 1.473z" data-name="Rectangle 478"></path>
                            </g>
                        </g>
                    </svg></a></div>
            <div class="search-overlay open" style="display: none;"></div>
            <div class="mobile-wrapper" style="">
                <form  onsubmit="event.preventDefault()" id="searchForm" class="form-inline my-2 my-lg-0 main-search d-lg-block">
                    @csrf
                    <a id="mobile-close-search-button" class="mobile-close-search d-lg-none" style="cursor:pointer;"><svg
                            xmlns="http://www.w3.org/2000/svg" width="6.495" height="10.328">
                            <g data-name="Group 268">
                                <path stroke="#fff" stroke-width="2"
                                      d="M4.916 1.085a.292.292 0 01.413 0 .292.292 0 010 .413L1.702 5.125 5.331 8.75a.292.292 0 01-.413.413L1.085 5.33a.292.292 0 010-.413z"
                                      data-name="Path 23"></path>
                            </g>
                        </svg></a>
                    <div class="input-group w-100">
                        <input autocomplete="off" onkeyup="search()" id="SearchBar" name="searchWord" type="text" placeholder="Pretraži"
                                                          aria-label="Pretraži" aria-describedby="search-button"
                                                          class="form-control"  style="border-top-right-radius:0.25rem!important;border-bottom-right-radius: 0.25rem!important; ">
                        <button class="clear-input d-lg-none">
                        </button>
                    </div>
                </form>
                <!---->
                <div class="search-results" id="searchBoxResults" style="display: none">
                    <div class="products-list">
                        <ul id="searchBoxList" class="list-group">

                        </ul>
                    </div>
                </div>
            </div>
            <!---->
        </div>


        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto @if (url()->current() == route('home')) active @endif" href="/">Početna</a></li>
                <li><a class="nav-link scrollto @if (url()->current() == route('knjige')) active @endif" href="{{route('knjige')}}">Knjige</a></li>
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#"><span>{{Auth::user()->name}}</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            @if(Auth::user()->role_id < 3)
                                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                            @else
                                <li><a href="{{route('profil')}}">Moj profil</a></li>
                                <li><a href="{{route('rezervacije.index')}}">Rezervacije</a></li>
                            @endif
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Odjavi se</a>
                                <form class="mb-0" id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li><a class="nav-link scrollto" href="{{route('login')}}">Prijavi se</a></li>
                    <li><a class="getstarted scrollto" href="{{route('register')}}">Registruj se</a></li>
                @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>


