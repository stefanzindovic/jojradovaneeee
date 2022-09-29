<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookRecords extends Controller
{
    public function issuedBooks($id){
        $book = Book::findOrFail($id);
        $books = Book::issuedBooks()->where('book_id',$id);
        return view('pages.books.bookrecords.issued', compact('books','book'));
    }

    public function returnedBooks($id){
        $book = Book::findOrFail($id);
        $books = Book::returnedBooks()->where('book_id',$id);
        return view('pages.books.bookrecords.returned', compact('books','book'));
    }

    public function breachedBooks($id){
        $book = Book::findOrFail($id);
        $books = Book::issuedBooksWithBreachedDeadline()->where('book_id',$id);
        return view('pages.books.bookrecords.breached', compact('books','book'));
    }

    public function reservedBooks($id){
        $book = Book::findOrFail($id);
        $pending = Book::pendingReservedBooks()->where('book_id',$id);
        $active = Book::activeReservedBooks()->where('book_id',$id);
        return view('pages.books.bookrecords.reservations', compact('pending','active','book'));
    }

    public function archivedReservations($id){
        $book = Book::findOrFail($id);
        $reservations = Book::archivedReservations()->where('book_id',$id);

        return view('pages.books.bookrecords.archived', compact('reservations','book'));
    }
}
