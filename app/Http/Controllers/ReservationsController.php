<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BookAction;
use Illuminate\Http\Request;
use App\Models\BooksUnderAction;
use App\Models\Policy;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    public function index(HttpRequest $request)
    {
        // Get all active and pending reservations
        $pending = null;
        $active = null;

        if ($request->has('books')) {
            $pending = Book::pendingReservedBook($request->books);
            $active = Book::activeReservedBook($request->books);
        } else {
            $pending = Book::pendingReservedBooks();
            $active = Book::activeReservedBooks();
        }
        return view('..pages.books.actions.reservations.reservations', compact('pending', 'active'));
    }

    public function archived(HttpRequest $request)
    {
        // Get all accepted, declined and expired reservations
        $reservations = null;

        if ($request->has('books')) {
            $reservations = Book::archivedReservationsByBook($request->books);
        } else {
            $reservations = Book::archivedReservations();
        }

        return view('..pages.books.actions.reservations.archived', compact('reservations'));
    }

    public function reserve(Book $book, HttpRequest $request)
    {
        // reserve book for student
        $input = $request->validate([
            'student_id' => 'required|numeric',
            'action_start' => 'required|after_or_equal:' . \Carbon\Carbon::now()->format('Y-m-d'),
        ]);

        try {

            $policy = Policy::findOrFail(2);

            // Check if student already have save active issued book
            $doStudentHaveActiveIssues = User::doStudentHaveActiveIssues($input['student_id'], $book->id);

            if ($doStudentHaveActiveIssues) {
                return back()->with('errorMessage', 'Korisnik je dostigao limit ili već ima istu knjigu.');
            }

            // Generate and save new model for book under action
            $bookUnderActionModel = new BooksUnderAction();
            $bookUnderActionModel->book()->associate($book);
            $bookUnderActionModel->student()->associate($input['student_id']);
            $bookUnderActionModel->save();

            $bookActionModel = new BookAction();
            $bookActionModel->book()->associate($bookUnderActionModel);
            $bookActionModel->librarian()->associate(Auth::user());
            $bookActionModel->status()->associate(2);
            $bookActionModel->action_start = $input['action_start'];
            $bookActionModel->action_deadline = \Carbon\Carbon::parse($input['action_start'])->addDays($policy->value);
            $bookActionModel->save();

            return to_route('books.index')->with('successMessage', 'Knjiga je uspješno rezervisana.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function accept(BooksUnderAction $book)
    {
        // accept pending reservation
        try {

            // Check if targeted book is issued
            $allowedStatuses = [2];

            if (!in_array($book->activeAction->action_status_id, $allowedStatuses)) {
                return back()->with('errorMessage', 'Ova knjiga nije rezervisana.');
            }

            // Genreate action model for returned book
            $bookActionModel = new BookAction();
            $bookActionModel->book()->associate($book);
            $bookActionModel->librarian()->associate(Auth::user());
            $bookActionModel->status()->associate(3);
            $bookActionModel->action_start = $book->activeAction->action_start;
            $bookActionModel->action_deadline = $book->activeAction->action_deadline;
            $bookActionModel->action_addons = date('Y-m-d');
            $bookActionModel->save();

            return to_route('books.reservations')->with('successMessage', 'Rezervacija je odobrena.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function issue(BooksUnderAction $book)
    {
        // accept pending reservation
        try {
            $policy = Policy::findOrFail(1);

            // Check if targeted book is issued
            $allowedStatuses = [3];

            if (!in_array($book->activeAction->action_status_id, $allowedStatuses)) {
                return back()->with('errorMessage', 'Rezervacija ove knjige nije odobrena.');
            }

            // Genreate action model for returned book
            $bookActionModel = new BookAction();
            $bookActionModel->book()->associate($book);
            $bookActionModel->librarian()->associate(Auth::user());
            $bookActionModel->status()->associate(7);
            $bookActionModel->action_start = date('Y-m-d');
            $bookActionModel->action_deadline = \Carbon\Carbon::parse($bookActionModel->action_start)->addDays($policy->value);
            $bookActionModel->action_addons = null;
            $bookActionModel->save();

            return to_route('books.reservations')->with('successMessage', 'Knjiga je uspješno izdata po rezervaciji.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function cancel(BooksUnderAction $book)
    {
        // accept pending reservation
        try {
            $policy = Policy::findOrFail(1);

            // Check if targeted book is issued
            $allowedStatuses = [3];

            if (!in_array($book->activeAction->action_status_id, $allowedStatuses)) {
                return back()->with('errorMessage', 'Rezervacija ove knjige nije odobrena.');
            }

            // Genreate action model for returned book
            $bookActionModel = new BookAction();
            $bookActionModel->book()->associate($book);
            $bookActionModel->librarian()->associate(Auth::user());
            $bookActionModel->status()->associate(6);
            $bookActionModel->action_deadline = $book->action_deadline;
            $bookActionModel->action_addons = date('Y-m-d');
            $bookActionModel->save();

            return to_route('books.reservations')->with('successMessage', 'Knjiga je uspješno izdata po rezervaciji.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function decline(BooksUnderAction $book)
    {
        // decline pending reservation
        try {

            // Check if targeted book is issued
            $allowedStatuses = [2];

            if (!in_array($book->activeAction->action_status_id, $allowedStatuses)) {
                return back()->with('errorMessage', 'Ova knjiga nije rezervisana.');
            }

            // Genreate action model for returned book
            $bookActionModel = new BookAction();
            $bookActionModel->book()->associate($book);
            $bookActionModel->librarian()->associate(Auth::user());
            $bookActionModel->status()->associate(4);
            $bookActionModel->action_start = date('Y-m-d');
            $bookActionModel->action_deadline = $book->activeAction->action_deadline;
            $bookActionModel->action_addons = $book->activeAction->action_start;
            $bookActionModel->save();

            return to_route('books.reservations')->with('successMessage', 'Rezervacija je odbijena.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function reservePage(Book $book)
    {
        // Check if there is available copies of this book
        $numOfAvailableCopies = Book::calcNumberOfAvailableCopies($book->id);

        if ($numOfAvailableCopies < 1) {
            return back()->with('errorMessage', 'Nema dovoljno primjeraka na raspolaganju.');
        }

        // show reservation book page
        $students = User::where('role_id', 3)->get();
        return view('..pages.books.actions.reservations.reserve', compact('book', 'students'));
    }
}
