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
use Illuminate\Support\Facades\Request;

class IssueBookController extends Controller
{
    public function index(Book $book)
    {
        $policy = Policy::findOrFail(1);
        $students = User::where('role_id', 3)->get();

        return view('..pages.books.actions.issues.issue', compact('policy', 'students', 'book'));
    }

    public function issue(Book $book, HttpRequest $request)
    {
        $input = $request->validate([
            'student_id' => 'required|numeric',
            'action_start' => 'required',
            'action_deadline' => 'required',
        ]);

        try {
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
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function issues(HttpRequest $request)
    {
        $books = null;
        if ($request->has('books')) {
            return back();
        } else {
            $books = BooksUnderAction::with(['activeAction' => function ($query) {
                $query->where('action_status_id', 1);
            }, 'book', 'student'])->whereHas('activeAction', function ($query) {
                $query->where('action_status_id', 1);
            })->get();
        }
        return view('..pages.books.actions.issues.issues', compact('books'));
    }
}
