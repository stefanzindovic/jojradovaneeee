<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAction;
use App\Models\BookActionStatus;
use App\Models\BooksUnderAction;
use App\Models\Policy;
use App\Models\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class IssueBookController extends Controller
{
    public function index(Book $book)
    {

        // Check if there is available copies of this book
        $numOfAvailableCopies = Book::calcNumberOfAvailableCopies($book->id);

        if ($numOfAvailableCopies < 1) {
            return back()->with('errorMessage', 'Nema dovoljno primjeraka na raspolaganju.');
        }

        $policy = Policy::findOrFail(1);
        $students = User::where('role_id', 3)->get();

        $issuedRecords = Book::issuedBook($book->id);
        $returnedRecords = Book::returnedBook($book->id);
        $booksWithBreachDeadline = Book::issuedBookWithBreachedDeadline($book->id);
        $pendingReservations = Book::pendingReservedBook($book->id);
        $activeReservations = Book::activeReservedBook($book->id);
        $archivedReservations = Book::archivedReservationsByBook($book->id);

        $availableCopiesCount = Book::calcNumberOfAvailableCopies($book->id);

        return view('..pages.books.actions.issues.issue', compact('policy', 'students', 'book', 'numOfAvailableCopies', 'issuedRecords', 'returnedRecords', 'booksWithBreachDeadline', 'pendingReservations', 'activeReservations', 'archivedReservations', 'availableCopiesCount'));
    }

    public function issue(Book $book, HttpRequest $request)
    {
        $input = $request->validate([
            'student_id' => 'required|numeric',
            'action_start' => 'required',
            'action_deadline' => 'required',
        ]);

        try {

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
            $bookActionModel->status()->associate(1);
            $bookActionModel->action_start = $input['action_start'];
            $bookActionModel->action_deadline = $input['action_deadline'];
            $bookActionModel->save();

            return to_route('books.index')->with('successMessage', 'Knjiga je uspješno izdata.');
        } catch (\Throwable $th) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function issues(HttpRequest $request)
    {
        $books = null;
        if ($request->has('books')) {
            $books = Book::issuedBook($request->books);
        } else {
            $books = Book::issuedBooks();
        }
        return view('..pages.books.actions.issues.issues', compact('books'));
    }

    public function return(BooksUnderAction $book, HttpRequest $request)
    {
        try {

            // Check if targeted book is issued
            $allowedStatuses = [1, 7];

            if (!in_array($book->activeAction->action_status_id, $allowedStatuses)) {
                return back()->with('errorMessage', 'Ova knjiga nije izdata.');
            }

            // Genreate action model for returned book
            $bookActionModel = new BookAction();
            $bookActionModel->book()->associate($book);
            $bookActionModel->librarian()->associate(Auth::user());
            $bookActionModel->status()->associate(9);
            $bookActionModel->action_start = date('Y-m-d');
            $bookActionModel->action_deadline = $book->activeAction->action_deadline;
            $bookActionModel->action_addons = $book->activeAction->action_start;
            $bookActionModel->save();

            return to_route('books.issues.issues')->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        } catch (\Throwable $th) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function returned()
    {
        $books = Book::returnedBooks();
        return view('..pages.books.actions.issues.returned', compact('books'));
    }

    public function breachedDeadline(BooksUnderAction $book, HttpRequest $request)
    {
        $books = null;
        if ($request->has('books')) {
            $books = Book::issuedBookWithBreachedDeadline($request->books);
        } else {
            $books = Book::issuedBooksWithBreachedDeadline();
        }
        return view('..pages.books.actions.issues.breached', compact('books'));
    }

    public function writeOff(BooksUnderAction $book)
    {
        try {
            $policy = Policy::findOrFail(3);

            // Check if targeted book is issued
            $allowedStatuses = [1, 7];

            if (!in_array($book->activeAction->action_status_id, $allowedStatuses)) {
                return back()->with('errorMessage', 'Ova knjiga nije izdata.');
            }

            // Check if targeted book's deadline is long enough to be written off
            if (\Carbon\Carbon::parse($book->activeAction->action_deadline)->gt(\Carbon\Carbon::now()) || \Carbon\Carbon::parse($book->activeAction->action_deadline)->diffInDays(null, false) < $policy->value) {
                return back()->with('errorMessage', 'Prekoračenje nije dovoljno dugo da bi knjiga mogla biti otpisana.');
            }

            // Genreate action model for returned book
            $bookActionModel = new BookAction();
            $bookActionModel->book()->associate($book);
            $bookActionModel->librarian()->associate(Auth::user());
            $bookActionModel->status()->associate(8);
            $bookActionModel->action_start = date('Y-m-d');
            $bookActionModel->action_deadline = null;
            $bookActionModel->save();

            return to_route('books.issues.issues')->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        } catch (\Throwable $th) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
