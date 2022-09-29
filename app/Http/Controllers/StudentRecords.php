<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class StudentRecords extends Controller
{
    public function issuedBooks($id){
        $student = User::findOrFail($id);
        $books = Book::issuedBooks()->where('student_id',$id);
        return view('pages.students.studentrecords.issued', compact('books','student'));
    }

    public function returnedBooks($id){
        $student = User::findOrFail($id);
        $books = Book::returnedBooks()->where('student_id',$id);
        return view('pages.students.studentrecords.returned', compact('books','student'));
    }

    public function breachedBooks($id){
        $student = User::findOrFail($id);
        $books = Book::issuedBooksWithBreachedDeadline()->where('student_id',$id);
        return view('pages.students.studentrecords.breached', compact('books','student'));
    }

    public function reservedBooks($id){
        $student = User::findOrFail($id);
        $pending = Book::pendingReservedBooks()->where('student_id',$id);
        $active = Book::activeReservedBooks()->where('student_id',$id);
        return view('pages.students.studentrecords.reservations', compact('pending','active','student'));
    }

    public function archivedReservations($id){
        $student = User::findOrFail($id);
        $reservations = Book::archivedReservations()->where('student_id',$id);

        return view('pages.students.studentrecords.archived', compact('reservations','student'));
    }
}
