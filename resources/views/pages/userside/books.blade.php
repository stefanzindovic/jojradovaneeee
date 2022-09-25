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
                                <div class="col-md-3">
                                    <h3 class="text-primary">KATEGORIJE</h3>
                                    <div class="scroll" style="min-height: 250px;max-height: 350px;">
                                        <ul class="list-group">
                                            @foreach($categories as $category)
                                                <li class="label list-group-item">
                                                    <input type="checkbox" class="me-2" value="{{$category->id}}">
                                                    {{$category->title}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <h3 class="text-primary pt-5">ŽANROVI</h3>
                                    <div class="scroll" style="min-height: 250px;max-height: 350px;">
                                        <ul class="list-group">
                                            @foreach($genres as $genre)
                                                <li class="label list-group-item">
                                                    <input type="checkbox" class="me-2" value="{{$genre->id}}">
                                                    {{$genre->title}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        @foreach($books as $book)
                                            <div class="col-md-4">
                                                <div class="card" style="width: 18rem;">
                                                    <a href="{{route('knjige.show', $book->id)}}">
                                                       <img style="object-fit: cover;height: 288px;width: 288px" src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif" class="book-image" alt="...">
                                                    </a>
                                                    <div class="card-body">
                                                        <h2 class="card-title"><a href="{{route('knjige.show', $book->id)}}">{{$book->title}}</a></h2>
                                                        <p class="card-text">
                                                            {{ Str::limit($book->description),80 }}
                                                        </p>
                                                        <div class="d-grid gap-2">
                                                            <a href="{{route('rezervacija.knjige', $book->id)}}" class="btn btn-premium">Rezerviši</a>
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
