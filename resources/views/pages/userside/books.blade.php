@extends('layouts.user')


@section('title')
    Knjige
@endsection

@section('main')

    <main id="main" style="padding-top: 3%; !important;">

        <section id="books" class="values">
            <div class="container-xxl" data-aos="fade-up">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <h3>FILTERI</h3>

                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        @foreach($books as $book)
                                            <div class="col-4">
                                                <div class="card" style="width: 18rem;">
                                                    <img style="object-fit: fill;height: 288px;width: 288px" src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif" class="book-image" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$book->title}}</h5>
                                                        <p class="card-text">
                                                            {{ Str::limit($book->description),80 }}
                                                        </p>
                                                        <div class="d-grid gap-2">
                                                            <a href="#" class="btn btn-primary">Rezerviši</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{ $books->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </main>
@endsection
