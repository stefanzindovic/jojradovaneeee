<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'picture', 'isbn', 'publisher_id', 'language_id', 'cover_id', 'script_id', 'format_id', 'total_pages', 'total_copies', 'published_at'
    ];

    // One to many relationships

    public function publisher()
    {
        return $this->belongsTo(Publishers::class, 'publisher_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function cover()
    {
        return $this->belongsTo(Cover::class, 'cover_id');
    }

    public function script()
    {
        return $this->belongsTo(Script::class, 'script_id');
    }

    public function format()
    {
        return $this->belongsTo(Format::class, 'format_id');
    }

    public function gallery()
    {
        return $this->hasMany(BookGallery::class);
    }

    // Many to many relationships

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }

    public function booksUnderActions()
    {
        return $this->hasMany(BooksUnderAction::class);
    }

    public static function issuedBooks()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
        })->orderBy('id', 'desc')->get();
    }

    public static function issuedBook($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
        })->where('book_id', $id)->orderBy('id', 'desc')->get();
    }

    public static function writtenOffBooks()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 8);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 8);
        })->orderBy('id', 'desc')->get();
    }

    public static function writtenOffBook($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 8);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 8);
        })->where('book_id', $id)->orderBy('id', 'desc')->get();
    }

    public static function returnedBooks()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 9);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 9);
        })->orderBy('id', 'desc')->get();
    }

    public static function issuedBooksWithBreachedDeadline()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where(function ($query) {
                $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
            })->whereDate('action_deadline', '<', date('Y-m-d'));
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where(function ($query) {
                $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
            })->whereDate('action_deadline', '<', date('Y-m-d'));
        })->orderBy('id', 'desc')->get();
    }

    public static function issuedBookWithBreachedDeadline($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where(function ($query) {
                $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
            })->whereDate('action_deadline', '<', date('Y-m-d'));
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where(function ($query) {
                $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
            })->whereDate('action_deadline', '<', date('Y-m-d'));
        })->where('book_id', $id)->orderBy('id', 'desc')->get();
    }

    public static function pendingReservedBooks()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 2);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 2);
        })->orderBy('id', 'desc')->get();
    }

    public static function pendingReservedBook($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 2);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 2);
        })->where('book_id', $id)->orderBy('id', 'desc')->get();
    }

    public static function activeReservedBooks()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 3);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 3);
        })->orderBy('id', 'desc')->get();
    }

    public static function activeReservedBook($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 3);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 3);
        })->where('book_id', $id)->orderBy('id', 'desc')->get();
    }

    public static function archivedReservations()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 4)->orWhere('action_status_id', 5)->orWhere('action_status_id', 6)->orWhere('action_status_id', 7);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 4)->orWhere('action_status_id', 5)->orWhere('action_status_id', 6)->orWhere('action_status_id', 7);
        })->orderBy('id', 'desc')->get();
    }

    public static function calcNumberOfAvailableCopies($id)
    {

        $book = Book::findOrFail($id);
        $issuedBooksCount = Book::issuedBook($id)->count();
        $writtenOffBook = Book::writtenOffBook($id)->count();
        $bookWithBreachedDeadlines = Book::issuedBookWithBreachedDeadline($id)->count();
        $reservedBookPendingCount = Book::pendingReservedBook($id)->count();
        $reservedBookActiveCount = Book::activeReservedBook($id)->count();

        return $book->total_copies - ($issuedBooksCount + $writtenOffBook + $bookWithBreachedDeadlines + $reservedBookPendingCount + $reservedBookActiveCount);;
    }
}
