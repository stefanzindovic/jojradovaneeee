<?php

namespace App\Http\Controllers;

use App\Models\BookAction;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function dashboard()
    {
        $activities = BookAction::with(['status', 'book', 'originalBook', 'librarian'])->orderBy('created_at', 'desc')->paginate(6);
        return view('..pages.books.activities.dashboard', compact('activities'));
    }
}
