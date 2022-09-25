<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookUserSideController extends Controller
{
    public function index()
    {
        return view('pages.userside.index');
    }

    public function indexKnjige()
    {
        $books = Book::paginate(20);
        $categories = Category::all();
        $genres = Genre::all();
        return view('pages.userside.books', compact('books','categories','genres'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('pages.userside.show', compact('book'));
    }


}
