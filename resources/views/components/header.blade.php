<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <button id="sidebar-toggle" class="sidebar-toggle me-3 btn btn-icon-only d-none d-lg-inline-block align-items-center justify-content-center"><svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg></button>

        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
                <div class="search-wrapper">
                    <div class="nav-icon-wrapper d-lg-none">
                        <a class="nav-icon-btn" style="top: 14px;left: -107px;position: absolute;cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="25" width="25"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/></svg>
                        </a>
                    </div>
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
                            <div class="input-group w-75">
                                <input autocomplete="off" onkeyup="search()" id="SearchBar" name="searchWord" type="text" placeholder="Pretraži"
                                       aria-label="Pretraži" aria-describedby="search-button"
                                       class="form-control  "  style="box-shadow:none !important;border-top-right-radius:0.25rem!important;border-bottom-right-radius: 0.25rem!important;">
                                <div class="dropdown ps-1" style="position: relative">
                                    <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Filteri
                                    </a>

                                    <ul class="dropdown-menu" id="filters"  aria-labelledby="dropdownMenuLink">
                                        <li><label class="dropdown-item"><input type="checkbox" checked class="form-check-input" id="bookFilter"> Knjige</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" checked class="form-check-input" id="studentFilter"> Učenici</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" checked class="form-check-input" id="librarianFilter"> Bibliotekari</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" checked class="form-check-input" id="authorFilter"> Autori</label></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <!--Search by Petar-->
                        <div class="search-results" id="searchBoxResults" style="display: none">
                            <div class="products-list">
                                <div id="bookList">
                                    <small>Knjige</small>
                                    <ul id="searchBookList" class="list-group">

                                    </ul>
                                    <hr>
                                </div>
                                <div id="studentList">
                                    <small>Učenici</small>
                                    <ul id="searchStudentList" class="list-group mb-1">

                                    </ul>
                                    <hr>
                                </div>
                                <div id="librarianList">
                                    <small>Bibliotekari</small>
                                    <ul id="searchLibrarianList" class="list-group">

                                    </ul>
                                    <hr>
                                </div>
                                <div id="authorList">
                                    <small>Autori</small>
                                    <ul id="searchAuthorList" class="list-group">

                                    </ul>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->
                </div>
            </div>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link" href="{{route('activities')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="text-gray-900" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                        </svg>
                    </a>
                </li>
                <li class="dropdown nav-item mt-1">
                    <a class="nav-link text-dark unread dropdown-toggle" data-unread-notifications="true" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <svg class="icon text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-center mt-2 py-0">
                        <div class="list-group list-group-flush">
                            <p class="text-center text-primary fw-bold border-bottom border-light py-2 mb-0">Novi</p>
                            <a class="dropdown-item" href="{{route('librarians.create')}}">
                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                </svg>
                                Bibliotekar
                            </a>
                            <a class="dropdown-item" href="{{route('students.create')}}">
                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                </svg>
                                Učenik
                            </a>
                            <a class="dropdown-item" href="{{route('books.create')}}">
                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                </svg>
                                Knjiga
                            </a>
                            <a class="dropdown-item" href="{{route('authors.create')}}">
                                <svg class="dropdown-icon text-gray-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                </svg>
                                Autor
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="avatar rounded-circle" alt="Image placeholder" src="{{Auth::user()->picture !== 'profile-picture-placeholder.jpg' ? asset('storage/uploads/librarians/' . Auth::user()->picture) : asset('imgs/' . Auth::user()->picture)}}">
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small fw-bold text-gray-900">{{Auth::user()->name}} {{Auth::user()->lastname}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                        <a class="dropdown-item d-flex align-items-center"
                           href="{{route('librarians.show', Auth::user()->id)}} ">
                            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                            Profil
                        </a>
                        <div role="separator" class="dropdown-divider my-1"></div>
                        <form class="mb-0" id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center" href="#">
                                <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Odjavi se
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

