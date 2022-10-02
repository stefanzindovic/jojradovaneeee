<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function searchweb()
    {
        # code
        $s = \request()->post('searchWord');

        $books = Book::where('title', 'like', "%{$s}%")->take(5);

        return response()->json([
            'books' => $books->get(),
        ]);

    }


    public function searchstaff()
    {
        # code
        $s = \request()->post('searchWord');

        $books = Book::where('title', 'like', "%{$s}%")->take(5);

        $authors = Author::where('full_name', 'like', "%{$s}%")->take(5);

        $students = User::where('role_id', '=', '3')
            ->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('username', 'like', "%{$s}%")
                    ->orWhere('jmbg', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%");
            })->take(5);

        $librarians = User::where('role_id', '=', 2)
            ->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('username', 'like', "%{$s}%")
                    ->orWhere('jmbg', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%");
            })->take(5);
        return response()->json([
            'books' => $books->get(),
            'students' => $students->get(),
            'librarians' => $librarians->get(),
            'authors' => $authors->get(),
        ]);

    }
}
