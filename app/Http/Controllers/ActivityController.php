<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAction;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function dashboard()
    {
        $activities = BookAction::with(['status', 'book', 'originalBook', 'librarian'])->orderBy('created_at', 'desc')->take(6)->get();
        $reservations = Book::pendingReservedBooksPaginate(4);

        $issuedBooksCounter = Book::issuedBooks()->count();

        $pendingReservationsCounter = Book::pendingReservedBooks()->count();
        $activeReservationsCounter = Book::activeReservedBooks()->count();
        $reservationsCounter = $pendingReservationsCounter + $activeReservationsCounter;

        $breachedBooksCounter = Book::issuedBooksWithBreachedDeadline()->count();

        return view('..pages.books.activities.dashboard', compact('activities', 'reservations', 'issuedBooksCounter', 'reservationsCounter', 'breachedBooksCounter'));
    }

    public function activities(Request $request)
    {
        $activities = null;
        if ($request->has('book')) {
            $activities = BookAction::actionsByBook($request->book);
        } else {
            $activities = BookAction::with(['status', 'book', 'originalBook', 'librarian'])->orderBy('created_at', 'desc')->get();
        }

        return view('..pages.books.activities.activities', compact('activities'));
    }
}
