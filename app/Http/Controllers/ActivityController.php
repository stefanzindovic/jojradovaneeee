<?php

namespace App\Http\Controllers;

use App\Models\BookAction;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function dashboard()
    {
        $activities = BookAction::with(['status', 'book', 'originalBook', 'librarian'])->orderBy('id', 'desc')->get();
        return view('..pages.books.activities.dashboard', compact('activities'));
    }
}
