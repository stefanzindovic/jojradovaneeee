<nav aria-label="breadcrumb" class="d-none d-md-inline-block">
    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
        <li class="breadcrumb-item">
            <a href="/dashboard">
                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
            </a>
        </li>

        {{--   Za ovaj hardcode je trebalo puno rada, znoja i mozdanih celija  --}}

        @php
            $currentUrl = request()->path();
            $currentDomain = request()->getSchemeAndHttpHost();
            $breadcrumbLCase = explode('/', $currentUrl);
            $breadcrumbUCase = array_map('ucfirst', explode('/', $currentUrl));
            $breadcrumbLength = count($breadcrumbLCase);
            $breadcrumbUrl = $currentDomain;
            $i = 0;
            $mode = 0;
            $done = 0;
            
            if (isset($breadcrumbLCase[1]) && !isset($breadcrumbLCase[3]) && is_numeric($breadcrumbLCase[1])) {
                $mode = 1; //Users & books
            } elseif (isset($breadcrumbLCase[3]) && is_numeric($breadcrumbLCase[1]) && is_numeric($breadcrumbLCase[3])) {
                $mode = 2; //Activities
            } elseif (isset($breadcrumbLCase[3]) && is_numeric($breadcrumbLCase[2])) {
                $mode = 3; //settings
            }
            
            switch ($mode) {
                case 0:
                    break;
                case 1:
                    switch ($breadcrumbLCase[0]) {
                        case 'librarians':
                            $user = \App\Models\User::findOrFail($breadcrumbLCase[1]);
                            $breadcrumbUCase[1] = $user->name;
                            break;
            
                        case 'students':
                            $user = \App\Models\User::findOrFail($breadcrumbLCase[1]);
                            $breadcrumbUCase[1] = $user->name;
                            break;
            
                        case 'books':
                            $book = \App\Models\Book::findOrFail($breadcrumbLCase[1]);
                            $breadcrumbUCase[1] = $book->title;
                            break;
            
                        case 'authors':
                            $author = \App\Models\Author::findOrFail($breadcrumbLCase[1]);
                            $breadcrumbUCase[1] = $author->full_name;
                            break;
                    }
                    break;
            
                case 2:
                    $book = \App\Models\Book::findOrFail($breadcrumbLCase[1]);
                    $action = \App\Models\BookAction::findOrFail($breadcrumbLCase[3]);
                    $action = $action->status;
            
                    $breadcrumbUCase[1] = $book->title;
                    $breadcrumbUCase[3] = $action->name;
                    break;
            
                case 3:
                    switch ($breadcrumbLCase[1]) {
                        case 'categories':
                            $category = \App\Models\Category::findOrFail($breadcrumbLCase[2]);
                            $breadcrumbUCase[2] = $category->title;
                            break;
                        case 'genres':
                            $genre = \App\Models\Genre::findOrFail($breadcrumbLCase[2]);
                            $breadcrumbUCase[2] = $genre->title;
                            break;
                        case 'publishers':
                            $publisher = \App\Models\Publishers::findOrFail($breadcrumbLCase[2]);
                            $breadcrumbUCase[2] = $publisher->name;
                            break;
                        case 'covers':
                            $cover = \App\Models\Cover::findOrFail($breadcrumbLCase[2]);
                            $breadcrumbUCase[2] = $cover->name;
                            break;
                        case 'formats':
                            $format = \App\Models\Format::findOrFail($breadcrumbLCase[2]);
                            $breadcrumbUCase[2] = $format->name;
                            break;
                        case 'scripts':
                            $script = \App\Models\Script::findOrFail($breadcrumbLCase[2]);
                            $breadcrumbUCase[2] = $script->name;
                            break;
                        case 'languages':
                            $language = \App\Models\Language::findOrFail($breadcrumbLCase[2]);
                            $breadcrumbUCase[2] = $language->name;
                            break;
                        default:
                            if ($breadcrumbLCase[0] == 'actions') {
                                $book = \App\Models\Book::findOrFail($breadcrumbLCase[2]);
                                $breadcrumbUCase[2] = $book->title;
                            }
                    }
                    break;
            }
            
            //=================================================
            //  If any words dont appear as they should be in the
            //  breadcrumb down in array $seperateThese put it like this
            // '(exactly how the words appear)|(how they should appear)',
            //=================================================
            
            $seperateThese = [
                //'Izdateknjige|Izdate Knjige',
                //'Vraceneknjige|Vracene Knjige',
                //'Rezervacijearhiva|Arhivirane Rezervacije',
                'Izdata|Issued',
                'Rezervisana|Reserved',
                'Rezervacija odobrena|Reservation approved',
                'Rezervacija odbijena|Reservation denied',
                'Rezervacija istekla|Reservation expired',
                'Rezervacija otkazana|Reservation canceled',
                'Izdata po rezervaciji|Issued via reservation',
                'Otpisana|Signed off',
                'Vraćena|Returned',
            ];
            
            foreach ($breadcrumbUCase as $key => $crumb) {
                if ($breadcrumbLCase[0] == 'actions' && $done != 1) {
                    $breadcrumbUrl = $breadcrumbUrl . '/' . 'books';
                    $done = 1;
                }
            
                if ($breadcrumbLCase[0] == 'actions' && $key < 2) {
                } else {
                    $breadcrumbUrl = $breadcrumbUrl . '/' . $breadcrumbLCase[$i];
                }
            
                foreach ($seperateThese as $seperate) {
                    $temp = explode('|', $seperate);
                    if ($crumb == $temp[0]) {
                        $crumb = $temp[1];
                    }
                }
            
                if ($breadcrumbLCase[0] == 'actions' && $key < 2 && isset($breadcrumbUCase[3])) {
                } elseif ($breadcrumbLCase[0] != 'actions' && $mode == 3 && $key == 2) {
                    echo "<li class=\"breadcrumb-item active\" aria-current=\"page\">$crumb</li>";
                } elseif ($key + 1 == $breadcrumbLength) {
                    echo "<li style=\"color: #131732; font-weight: bold;\" class=\"breadcrumb-item active\" aria-current=\"page\">$crumb</li>";
                } else {
                    if (isset($breadcrumbUCase[2]) && $breadcrumbUCase[2] == 'Action' && $key == 2) {
                        echo "<li class=\"breadcrumb-item active\" aria-current=\"page\">$crumb</li>";
                    } else {
                        echo "<li class=\"breadcrumb-item active\" aria-current=\"page\"><a href=\"$breadcrumbUrl\">$crumb</a></li>";
                    }
                }
                $i++;
            }
        @endphp
    </ol>
</nav>
