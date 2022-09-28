@extends('layouts.user')


@section('title')
    Knjige
@endsection

@section('main')
    <main id="main" style="padding-top: 3%; !important;">

        <section id="books" class="values">
            <div class="container-xxl">
                <div class="row">
                    <div class="card">
                        <form action="" method="GET">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h3 class="text-primary">KATEGORIJE</h3>
                                        <div class="scroll" style="min-height: 250px;max-height: 350px;">
                                            <ul class="list-group">
                                                @if ($categories->isNotEmpty())
                                                    @foreach ($categories as $category)
                                                        <li class="label list-group-item">
                                                            <input type="checkbox"
                                                                name="category_id[{{ $category->title }}]"
                                                                onChange="this.form.submit()" class="me-2 categoryFilterId"
                                                                value="{{ $category->id }}"
                                                                @if (request()->filled('category_id.' . $category->title)) checked @endif>
                                                            {{ $category->title }}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    Nema kategorija.
                                                @endif
                                            </ul>
                                        </div>
                                        <h3 class="text-primary pt-5">ŽANROVI</h3>
                                        <div class="scroll" style="min-height: 250px;max-height: 350px;">
                                            <ul class="list-group">
                                                @if ($genres->isNotEmpty())
                                                    @foreach ($genres as $genre)
                                                        <li class="label list-group-item">
                                                            <input type="checkbox" class="me-2"
                                                                name="genre_id[{{ $genre->title }}]"
                                                                onChange="this.form.submit()" value="{{ $genre->id }}"
                                                                @if (request()->filled('genre_id.' . $genre->title)) checked @endif>
                                                            {{ $genre->title }}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    Nema žanrova.
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            @if ($books->isNotEmpty())
                                                @foreach ($books as $book)
                                                    <div class="col-auto">
                                                        <div class="card" style="width: 18rem;height: auto">
                                                            <a href="{{ route('knjige.show', $book->id) }}">
                                                                <img style="object-fit: cover;height: 100%; width: 100%"
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
                                                                    <a href="{{ route('rezervacija.knjige', $book->id) }}"
                                                                        class="btn btn-premium">Rezerviši</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                Nema rezultata.
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="row">

                                    {{ $books->links() }}

                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </section>
        <div class="bg-white py-3">
            <div class="d-flex justify-content-center">
                <span>Powered by <img src="{{ asset('imgs/Intelecto.png') }}" class="pb-1" height="20px"
                        alt="Intelco"></span>
            </div>
        </div>

    </main>
@endsection
