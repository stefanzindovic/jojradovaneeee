@extends('layouts.user')

@section('title')
    Početna
@endsection

@section('main')
    <section id="hero" class="hero d-flex align-items-center" style="padding-top: 0 !important;">

        <div class="container-xxl">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center" style="padding-top: 0 !important;">
                    <h1 data-aos="fade-up">Doživi nove avanture čitanjem raznih knjiga</h1>
                    <h2 data-aos="fade-up" data-aos-delay="10">Veliki izbor knjiga dostupan svim čitaocima</h2>
                    <div data-aos="fade-up" data-aos-delay="10">
                        <div class="text-lg-start">
                            <a href="#knjige" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Pogledaj</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200" style="padding-top: 0 !important;">
                    <div id="bookreader-container" class="img-fluid"></div>
                </div>
            </div>
        </div>

    </section>

    <main id="main">

        <section id="knjige" class="values">

            <div class="container-xxl" data-aos="fade-up">

                <header class="section-header">
                    <h2>KNJIGE</h2>
                    <p>Preporučujemo</p>
                </header>

                <div class="row d-flex justify-content-center">

                    @if(empty($books))
                        <div class="d-flex justify-content-center">
                            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                                <div class="box">
                                    <div id="404error" class="img-fluid pb-2" alt=""></div>
                                    <h3>Trenutno nema dostupnih knjiga</h3>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row d-flex justify-content-center">
                            @foreach($books as $book)
                                <div class="col-auto">
                                    <div class="card" style="width: 18rem;height: auto">
                                        <a href="{{ route('knjige.show', $book->id) }}">
                                            <img style="object-fit: cover;height: 350px; width: 100%"
                                                 src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif"
                                                 class="book-image" alt="...">
                                        </a>
                                        <div class="card-body">
                                            <h2 class="card-title"><a
                                                    href="{{ route('knjige.show', $book->id) }}">{{ $book->title }}</a>
                                            </h2>
                                            <div class="card-text" style="min-height: 120px">
                                                {!! Str::limit($book->description, 80) !!}
                                            </div>
                                            <div class="d-grid gap-2">
                                                @if($book->calcNumberOfAvailableCopies($book->id) < 1)
                                                    <button disabled class="btn btn-premium">Trenutno nedostupno</button>
                                                @else
                                                    <a href="{{route('rezervacija.knjige', $book->id)}}" class="btn btn-premium">Rezerviši</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    @endif


                </div>

            </div>

        </section>
        <div class="bg-white py-3">
            <div class="d-flex justify-content-center">
                <span>Powered by <img src="{{asset('imgs/Intelecto.png')}}" class="pb-1" height="20px" alt="Intelco"></span>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script>
        var animation = bodymovin.loadAnimation({
            // animationData: { /* ... */ },
            container: document.getElementById('bookreader-container'), // required
            path: "{{asset('userside/img/bookreader.json')}}", // required
            renderer: 'svg', // required
            loop: true, // optional
            autoplay: true, // optional
            name: "Book Reader", // optional
        });

        var animation = bodymovin.loadAnimation({
            // animationData: { /* ... */ },
            container: document.getElementById('404error'), // required
            path: "{{asset('userside/img/404_1.json')}}", // required
            renderer: 'svg', // required
            loop:  true, // optional
            autoplay: true, // optional
            name: "Icon", // optional
        });
    </script>

@endsection
