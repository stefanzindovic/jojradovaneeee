<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function dashboard()
    {
        return view('..pages.books.activities.dashboard');
    }
}
