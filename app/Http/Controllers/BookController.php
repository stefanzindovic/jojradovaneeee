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
use App\Models\BookGallery;
use Illuminate\Support\Facades\Storage;

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

        return view('..pages/books/add', compact('categories', 'authors', 'genres', 'scripts', 'publishers', 'covers', 'formats', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $input = $request->validate([
            'title' => 'required|min:1|max:50',
            'description' => 'required|min:10|max:500',
            'categories' => 'required|min:1',
            'genres' => 'required|array|min:1',
            'authors' => 'required|array|min:1',
            'publisher' => 'required',
            'published_at' => 'required|numeric|min:1800|max:' . date('Y'),
            'total_copies' => 'required|numeric|min:1|max:999',
            'total_pages' => 'required|numeric|min:1|max:2000',
            'script' => 'required|numeric|min:1',
            'language' => 'required|numeric|min:1',
            'cover' => 'required|numeric|min:1',
            'format' => 'required|numeric|min:1',
            'isbn' => 'required|numeric|digits:13',
            'cover_picture' => 'nullable|string',
            'pictures' => 'nullable|array|min:1',
        ]);

        try {
            $model = new Book();
            $model->title = $input['title'];
            $model->description = $input['description'];
            $model->total_copies = $input['total_copies'];
            $model->published_at = $input['published_at'];
            $model->total_pages = $input['total_pages'];
            $model->isbn = $input['isbn'];
            $model->script()->associate($input['script']);
            $model->cover()->associate($input['cover']);
            $model->format()->associate($input['format']);
            $model->publisher()->associate($input['publisher']);
            $model->language()->associate($input['language']);
            $model->save();
            $model->categories()->attach($input['categories']);
            $model->genres()->attach($input['genres']);
            $model->authors()->attach($input['authors']);

            // upload images if exists
            if ($request->hasFile('pictures')) {
                foreach ($request->pictures as $picture) {
                    $uploadsPath = 'uploads/books/';
                    $genericName = trim(strtolower(time() . $picture->getClientOriginalName()));

                    if ($request->has('cover_picture')) {
                        if ($picture->getClientOriginalName() == $input['cover_picture']) {
                            $model->picture = $genericName;
                            $model->update();
                        }
                    }

                    Storage::disk('public')->putFileAs(
                        $uploadsPath,
                        $picture,
                        $genericName,
                    );

                    $galleryModel = new BookGallery();
                    $galleryModel->picture = $genericName;
                    $galleryModel->book()->associate($model);
                    $galleryModel->save();
                }
            }

            return to_route('books.index')->with('successMessage', 'Nova knjiga je dodana na spisak.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('..pages.books.book', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = Author::orderBy('id', 'desc')->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $languages = Language::orderBy('id', 'desc')->get();
        $scripts = Script::orderBy('id', 'desc')->get();
        $publishers = Publishers::orderBy('id', 'desc')->get();
        $covers = Cover::orderBy('id', 'desc')->get();
        $formats = Format::orderBy('id', 'desc')->get();

        return view('..pages.books.edit', compact('categories', 'authors', 'genres', 'scripts', 'publishers', 'covers', 'formats', 'languages', 'book'));
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
