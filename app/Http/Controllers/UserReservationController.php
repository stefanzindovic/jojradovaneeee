<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAction;
use App\Models\BooksUnderAction;
use App\Models\Policy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class UserReservationController extends Controller
{

    public function index(HttpRequest $request){
        if ($request->has('books')) {
            $pending = Book::pendingReservedBook($request->books)->where('student_id', Auth::user()->id);
            $active = Book::activeReservedBook($request->books)->where('student_id', Auth::user()->id);
        } else {
            $pending = Book::pendingReservedBooks()->where('student_id', Auth::user()->id);
            $active = Book::activeReservedBooks()->where('student_id', Auth::user()->id);
        }

        if ($request->has('books')) {
            $reservations = Book::archivedReservationsByBook($request->books)->where('student_id', Auth::user()->id);
        } else {
            $reservations = Book::archivedReservations()->where('student_id', Auth::user()->id);
        }

        return view('pages.userside.reservations', compact('active','pending','reservations'));
    }

    public function create($id){
        $policy = Policy::findOrFail(1);
        $book = Book::findOrFail($id);
        return view('pages.userside.create', compact('book','policy'));
    }

    public function rezervisi(Book $book, HttpRequest $request){
        // reserve book for student
        $input = $request->validate([
            'action_start' => 'required|after_or_equal:' . \Carbon\Carbon::now()->format('Y-m-d'),
        ]);

        $input['student_id'] = Auth::user()->id;

        try {

            $policy = Policy::findOrFail(2);

            // Check if student already have save active issued book
            $doStudentHaveActiveIssues = User::doStudentHaveActiveIssues($input['student_id'], $book->id);

            if ($doStudentHaveActiveIssues) {
                return back()->with('errorMessage', 'Dostigli ste limit ili ste već rezervisali istu knjigu.');
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

            return to_route('knjige')->with('successMessage', 'Knjiga je uspješno rezervisana.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da pokušate ponovo.');
        }
    }

    public function otkazi(BooksUnderAction $book){
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

            return to_route('rezervacije.index')->with('successMessage', 'Rezervacija je otkazana.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
