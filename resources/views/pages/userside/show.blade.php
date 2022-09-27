@extends('layouts.user')

@section('title')
    {{$book->title}}
@endsection


<style>

    .thumbnail_images ul {
        list-style: none;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-top: 10px
    }

    .thumbnail_images ul li {
        margin: 5px;
        padding: 10px;
        border: 2px solid #eee;
        cursor: pointer;
        transition: all 0.5s
    }

    .thumbnail_images ul li:hover {
        border: 2px solid #000
    }

    .main_image {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 400px;
        width: 100%;
        overflow: hidden
    }
</style>


@section('main')
    <main id="main" style="padding-top: 3%; !important;">

        <section id="books" class="values">
            <div class="container-xxl" data-aos="fade-up">
                <div class="container mb-5">
                    <div class="card pt-5">
                        <div class="row g-0">
                            <div class="col-md-6 border-end">
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="main_image">
                                        <img src="@if ($book->picture === 'book-placeholder.png') {{ asset('imgs/book-placeholder.png') }} @else {{ asset('storage/uploads/books/' . $book->picture) }} @endif" id="main_product_image" width="280" height="100%"></div>
                                    <div class="thumbnail_images">
                                        <ul id="thumbnail" class="overflow-auto">
                                            @foreach ($book->gallery as $image)
                                                <li><img onclick="changeImage(this)" src="{{ asset('storage/uploads/books/' . $image->picture) }} " width="70"></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 right-side">
                                    <div class="d-flex justify-content-between align-items-center"><h1 class="fw-bold">{{$book->title}}</h1></div>
                                    <h4 class="text-gray">
                                        @foreach ($book->authors as $author)
                                            {{ $author->full_name }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </h4>
                                    <div class="mt-2 pr-3 content"><p>{!! $book->description !!}</p>
                                    </div>

                                    <div class="d-grid gap-2 pt-5">
                                        <a href="{{route('rezervacija.knjige', $book->id)}}" class="btn btn-premium">Rezerviši</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </main>
@endsection

@section('scripts')
    <script>
        function changeImage(element) {

            var main_prodcut_image = document.getElementById('main_product_image');
            main_prodcut_image.src = element.src;


        }
    </script>
@endsection

