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
    public function index()
    {
        // Get all active and pending reservations
    }

    public function archived()
    {
        // Get all accepted, declined and expired reservations
    }

    public function reserve(Book $book, HttpRequest $request)
    {
        // reserve book for student
        $input = $request->validate([
            'student_id' => 'required|numeric',
            'action_start' => 'required',
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

            return to_route('books.index')->with('successMessage', 'Knjiga je uspješno izdata.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function accept()
    {
        // accept pending reservation
    }

    public function decline()
    {
        // decline pending reservation
    }

    public function reservePage(Book $book)
    {
        // show reservation book page
        $students = User::where('role_id', 3)->get();
        return view('..pages.books.actions.reservations.reserve', compact('book', 'students'));
    }
}
