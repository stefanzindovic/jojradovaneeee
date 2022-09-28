<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class BookUserSideController extends Controller
{
    public function index()
    {
        return view('pages.userside.index');
    }

    public function indexKnjige(Request $request)
    {
        $books = Book::paginate(20);


        if ($request->has('category_id') || $request->has('genre_id') || $request->has('author_id') || $request->has('language_id')) {
            $genres = collect([]);
            $categories = collect([]);
            $authors = collect([]);
            $languages = collect([]);

            if ($request->has('category_id')) {
                foreach ($request->category_id as $key => $value) {
                    $results = Book::with(['categories'])->whereHas('categories', function ($query) use ($value) {
                        $query->where('category_id', $value);
                    })->get();

                    if ($results->isNotEmpty()) {
                        foreach ($results as $result) {
                            $categories->add($result);
                        }
                    }
                }
            }
            if ($request->has('genre_id')) {
                foreach ($request->genre_id as $key => $value) {
                    $results = Book::with(['genres'])->whereHas('genres', function ($query) use ($value) {
                        $query->where('genre_id', $value);
                    })->get();

                    if ($results->isNotEmpty()) {
                        foreach ($results as $result) {
                            $genres->add($result);
                        }
                    }
                }
            }
            $books = $categories->merge($genres);
            $books = $books->unique();
        }

        $categories = Category::all();
        $genres = Genre::all();

        return view('pages.userside.books', compact('books', 'categories', 'genres'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('pages.userside.show', compact('book'));
    }
}
