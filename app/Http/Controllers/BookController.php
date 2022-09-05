<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cover;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Format;
use App\Models\Script;
use App\Models\Category;
use App\Models\Language;
use App\Models\Publishers;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->with(['authors', 'categories', 'gallery'])->get();
        return view('..pages/books/index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = Author::orderBy('id', 'desc')->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $languages = Language::orderBy('id', 'desc')->get();
        $scripts = Script::orderBy('id', 'desc')->get();
        $publishers = Publishers::orderBy('id', 'desc')->get();
        $covers = Cover::orderBy('id', 'desc')->get();
        $formats = Format::orderBy('id', 'desc')->get();

        return view('..pages/books/add', compact('categories', 'authors', 'genres', 'scripts', 'publishers', 'covers', 'formats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
