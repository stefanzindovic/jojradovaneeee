<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search()
    {
        # code
        $s = \request()->post('searchWord');

        if (!empty($s)){
            $books = Book::where('title', 'like', "%{$s}%")->take(5);
            return response()->json([
                'books' => $books->get(),
            ]);
        }else{
        }
    }
}
