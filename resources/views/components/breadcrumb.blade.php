<nav aria-label="breadcrumb" class="d-none d-md-inline-block">
    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
        <li class="breadcrumb-item">
            <a href="/">
                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </a>
        </li>
        {{--        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>--}}
        @php
            $currentUrl = request()->path();
            $currentDomain = request()->getSchemeAndHttpHost();
            $breadcrumbLCase = explode('/', $currentUrl);
            $breadcrumbUCase = array_map('ucfirst', explode('/', $currentUrl));
            $breadcrumbLength = count($breadcrumbLCase);
            $breadcrumbUrl = $currentDomain;
            $i=0;

            //=================================================
            //  If any words dont appear as they should be in the
            //  breadcrumb down in array $seperateThese put it like this
            // '(exactly how the words appear)|(how they should appear)',
            //=================================================
            $seperateThese = [
                'Izdateknjige|Izdate Knjige',
                'Vraceneknjige|Vracene Knjige',
                'Rezervacijearhiva|Arhivirane Rezervacije',
            ];

            foreach ($breadcrumbUCase as $crumb){
                $breadcrumbUrl = $breadcrumbUrl . '/' . $breadcrumbLCase[$i];

                foreach ($seperateThese as $seperate){
                    $temp = explode('|', $seperate);
                    if ($crumb == $temp[0]){
                        $crumb = $temp[1];
                    }
                }

                echo "<li class=\"breadcrumb-item active\" aria-current=\"page\"><a href=\"$breadcrumbUrl\">$crumb</a></li>";
                $i++;
            }
        @endphp
    </ol>
</nav>
