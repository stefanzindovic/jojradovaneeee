<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAction;
use App\Models\User;
use App\Models\UserLogins;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function dashboard()
    {
        $activities = BookAction::with(['status', 'book', 'originalBook', 'librarian'])->where('is_active', true)->orderBy('created_at', 'desc')->take(6)->get();
        $reservations = Book::pendingReservedBooksPaginate(4);
        $books = Book::orderBy('id', 'desc')->with(['authors', 'categories', 'gallery', 'booksUnderActions'])->get();
        $issuedBooksCounter = Book::issuedBooks()->count();
        $librarians = User::with(['role', 'logins'])->orderBy('id', 'DESC')->where('is_active', true)->whereNot('role_id', 3)->get();
        $students = User::with(['role', 'logins'])->orderBy('id', 'DESC')->where('is_active', true)->where('role_id', 3)->get();
        $logins = UserLogins::get()->all();
        $pendingReservationsCounter = Book::pendingReservedBooks()->count();
        $activeReservationsCounter = Book::activeReservedBooks()->count();
        $reservationsCounter = $pendingReservationsCounter + $activeReservationsCounter;

        $breachedBooksCounter = Book::issuedBooksWithBreachedDeadline()->count();

        return view('..pages.books.activities.dashboard', compact('activities', 'reservations', 'issuedBooksCounter', 'reservationsCounter', 'breachedBooksCounter', 'books', 'librarians', 'students', 'logins'));
    }

    public function activities(Request $request)
    {
        $activities = null;
        if ($request->has('book')) {
            $activities = BookAction::actionsByBook($request->book);
        } else {
            $activities = BookAction::with(['status', 'book', 'originalBook', 'librarian'])->where('is_active', true)->orderBy('created_at', 'desc')->get();
        }

        return view('..pages.books.activities.activities', compact('activities'));
    }
}
