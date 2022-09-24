<header id="header" class="header fixed-top">
    <div class="container-xxl  d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <div id="icon-container" style="max-width: 40px;margin: 0;padding: 0;margin-right: 10px;" ></div>
            <span>Biblioteka</span>
        </a>
        <div class="col-5">
            <input type="text" placeholder="Pretraži" class="form-control ms-2 mr-4">
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="/">Početna</a></li>
                <li><a class="nav-link scrollto" href="{{route('knjige')}}">Knjige</a></li>
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#"><span>{{Auth::user()->name}}</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            @if(Auth::user()->role_id < 3)
                                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                            @else
                                <li><a href="{{route('profil')}}">Moj profil</a></li>
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
