<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BookAction;
use App\Models\UserLogins;
use Illuminate\Http\Request;
use App\Models\BookActionStatus;

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
        $books = Book::all();
        $students = User::where('role_id', 3)->get();
        $librarians = User::where('role_id', '!=', 3)->get();
        $actions = BookActionStatus::all();

        $activities = null;
        if ($request->has('book')) {
            $activities = BookAction::actionsByBook($request->book);
        } else if ($request->has('book_id') || $request->has('student_id') || $request->has('librarian_id') || $request->has('action_id')) {
            $query = BookAction::query();
            if ($request->filled('book_id')) {
                $loop = 0;
                $query->whereHas('book', function ($q) use ($request, $loop) {
                    $q->where('book_id', $request->book_id[0]);
                    foreach ($request->book_id as $value) {
                        if ($loop < 1) {
                            $loop++;
                            continue;
                        }
                        $q->orWhere('book_id', $value);
                        $loop++;
                    }
                });
            }
            if ($request->filled('student_id')) {
                $loop = 0;
                $query->whereHas('book', function ($q) use ($request, $loop) {
                    $q->where('student_id', $request->student_id[0]);
                    foreach ($request->student_id as $value) {
                        if ($loop < 1) {
                            $loop++;
                            continue;
                        }
                        $q->orWhere('student_id', $value);
                        $loop++;
                    }
                });
            }
            if ($request->filled('librarian_id')) {
                $loop = 0;
                $query->whereHas('librarian', function ($q) use ($request, $loop) {
                    $q->where('librarian_id', $request->librarian_id[0]);
                    foreach ($request->librarian_id as $value) {
                        if ($loop < 1) {
                            $loop++;
                            continue;
                        }
                        $q->orWhere('librarian_id', $value);
                        $loop++;
                    }
                });
            }
            if ($request->filled('action_id')) {
                $loop = 0;
                $query->whereHas('status', function ($q) use ($request, $loop) {
                    $q->where('action_status_id', $request->action_id[0]);
                    foreach ($request->action_id as $value) {
                        if ($loop < 1) {
                            $loop++;
                            continue;
                        }
                        $q->orWhere('action_status_id', $value);
                        $loop++;
                    }
                });
            }
            $activities = $query->get();
        } else {
            $activities = BookAction::with(['status', 'book', 'originalBook', 'librarian'])->where('is_active', true)->orderBy('created_at', 'desc')->get();
        }

        return view('..pages.books.activities.activities', compact('activities', 'books', 'students', 'librarians', 'actions'));
    }
}
