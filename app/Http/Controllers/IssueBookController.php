<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Policy;
use App\Models\User;

class IssueBookController extends Controller
{
    public function index(Book $book)
    {
        $policy = Policy::find(1);
        $students = User::where('role_id', 3)->get();

        return view('..pages.books.actions.issue', compact('policy', 'students', 'book'));
    }
}
