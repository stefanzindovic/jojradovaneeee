<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  d-flex  align-items-center">
            <a class="navbar-brand" href="#">
                <img src="{{asset('imgs/booklogo.png')}}" height="40" class="navbar-brand-img" alt="...">
            </a>
            <div class=" ml-auto ">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link @if (url()->current() == route('dashboard')) active @endif" href="{{route('dashboard')}}" >
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (url()->current() == route('librarians.index')) active @endif" href="{{route('librarians.index')}}">
                            <i class="ni ni-badge text-primary"></i>
                            <span class="nav-link-text">Bibliotekari</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (url()->current() == route('students.index')) active @endif" href="{{route('students.index')}}">
                            <i class="ni ni-single-02 text-primary"></i>
                            <span class="nav-link-text">Učenici</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (url()->current() == route('books.index')) active @endif" href="{{route('books.index')}}">
                            <i class="ni ni-books text-primary"></i>
                            <span class="nav-link-text">Knjige</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (url()->current() == route('authors.index')) active @endif" href="{{route('authors.index')}}">
                            <i class="ni ni-circle-08 text-primary"></i>
                            <span class="nav-link-text">Autori</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (url()->current() == route('books.issues.issues')) active @endif" href="{{route('books.issues.issues')}}">
                            <i class="ni ni-curved-next text-primary"></i>
                            <span class="nav-link-text">Izdavanje</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (url()->current() == route('settings.policies.index')) active @endif" href="{{route('settings.policies.index')}}">
                            <i class="ni ni-settings-gear-65 text-primary"></i>
                            <span class="nav-link-text">Settingss</span>
                        </a>
                    </li>
                    <hr class="my-3">
                    <h6 class="navbar-heading pl-4 text-muted">
                        <span class="docs-normal">Dokumentacija</span>
                    </h6>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="ni ni-spaceship"></i>
                            <span class="nav-link-text">API</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
