@extends('app')

@section('page_title')
    Aktivnosti
@endsection

@section('page_content')
    <div class="row pb-2">
        <div class="col">
            <div class="card notification-card border-0 shadow">
                <div class="card-header d-flex align-items-center">
                    <h2>filteri 😢</h2>
                </div>
                <div class="card-body">
                    <h3>Komentarisao kod jer ti bolje znaš kako si imenovao "kolekcije"</h3>
{{--                    <div class="list-group list-group-flush list-group-timeline">--}}
{{--                        @if (!$activities->isEmpty())--}}
{{--                            @foreach ($activities as $activity)--}}
{{--                                <div class="list-group-item border-0">--}}
{{--                                    <div class="row ps-lg-1">--}}
{{--                                        <div class="col-auto z-0">--}}
{{--                                            <div class="icon-shape icon-xs icon-shape-success rounded">--}}
{{--                                                <img src="{{ $activity->librarians[0]->picture ? $activity->librarians[0]->picture : 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png' }}"--}}
{{--                                                     alt="">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col ms-n2 mb-3">--}}
{{--                                            <h3 class="fs-6 fw-bold mb-1">{{ $activity->action }}</h3>--}}
{{--                                            @if ($activity->action == 'Izdavanje')--}}
{{--                                                <p class="mb-0"><a--}}
{{--                                                        href="{{ route('bibliotekar.show', $activity->librarian_id) }} "--}}
{{--                                                        class="link-purple">--}}
{{--                                                        {{ $activity->librarians[0]->name }}--}}
{{--                                                        {{ $activity->librarians[0]->lastname }}</a>--}}
{{--                                                    je izdao/la knjigu--}}
{{--                                                    <a href="{{ route('knjige.show', $activity->book_id) }}"--}}
{{--                                                       class="link-purple">--}}
{{--                                                        {{ $activity->books[0]->title }}--}}
{{--                                                    </a>--}}
{{--                                                    korisniku--}}
{{--                                                    <a href="{{ route('ucenik.show', $activity->student_id) }}"--}}
{{--                                                       class="link-purple">--}}
{{--                                                        {{ $activity->students[0]->name }}--}}
{{--                                                        {{ $activity->students[0]->lastname }}--}}
{{--                                                    </a>--}}
{{--                                                </p>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                        <span class="small"><a--}}
{{--                                                                href="{{ route('izdateknjige.show', $activity->issued_book_id) }}"--}}
{{--                                                                class="link-purple">Pogledaj--}}
{{--                                                                detalje</a></span>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            @if ($activity->action == 'Vraćanje')--}}
{{--                                                <p class="mb-0">--}}
{{--                                                    <a href="{{ route('ucenik.show', $activity->student_id) }}"--}}
{{--                                                       class="link-purple">--}}
{{--                                                        {{ $activity->students[0]->name }}--}}
{{--                                                        {{ $activity->students[0]->lastname }}--}}
{{--                                                    </a>--}}
{{--                                                    je vratio/la knjigu--}}
{{--                                                    <a href="{{ route('knjige.show', $activity->book_id) }}"--}}
{{--                                                       class="link-purple">--}}
{{--                                                        {{ $activity->books[0]->title }}--}}
{{--                                                    </a>--}}

{{--                                                </p>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                        <span class="small"><a--}}
{{--                                                                href="{{ route('izdateknjige.show', $activity->issued_book_id) }}"--}}
{{--                                                                class="link-purple">Pogledaj--}}
{{--                                                                detalje</a></span>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            @if ($activity->action == 'Rezervisanje')--}}
{{--                                                <p class="mb-0">--}}
{{--                                                    <a href="{{ route('ucenik.show', $activity->student_id) }}"--}}
{{--                                                       class="link-purple">--}}
{{--                                                        {{ $activity->students[0]->name }}--}}
{{--                                                        {{ $activity->students[0]->lastname }}--}}
{{--                                                    </a>--}}
{{--                                                    je rezervisao/la knjigu--}}
{{--                                                    <a href="{{ route('knjige.show', $activity->book_id) }}"--}}
{{--                                                       class="link-purple">--}}
{{--                                                        {{ $activity->books[0]->title }}--}}
{{--                                                    </a>--}}

{{--                                                </p>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                        <span class="small"><a href="#"--}}
{{--                                                                               class="link-purple">Pogledaj--}}
{{--                                                                detalje (nemamo view da vidimo detalje za--}}
{{--                                                                rezervacije)</a></span>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            @if ($activity->action == 'Otpisivanje')--}}
{{--                                                <p class="mb-0">--}}
{{--                                                    <a href="{{ route('bibliotekar.show', $activity->librarian_id) }}"--}}
{{--                                                       class="link-purple">--}}
{{--                                                        {{ $activity->librarians[0]->name }}--}}
{{--                                                        {{ $activity->librarians[0]->lastname }}--}}
{{--                                                    </a>--}}
{{--                                                    je otpisao/la knjigu--}}
{{--                                                    <a href="{{ route('knjige.show', $activity->book_id) }}"--}}
{{--                                                       class="link-purple">--}}
{{--                                                        {{ $activity->books[0]->title }}--}}
{{--                                                    </a>--}}

{{--                                                </p>--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                        <span class="small"><a href="#"--}}
{{--                                                                               class="link-purple">Pogledaj--}}
{{--                                                                detalje (nemamo view da vidimo detalje za--}}
{{--                                                                otpisivanje)</a></span>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            Nema aktivnosti--}}
{{--                        @endif--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection




