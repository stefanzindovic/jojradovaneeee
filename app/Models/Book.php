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
        })->get();
    }

    public static function issuedBook($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
        })->where('book_id', $id)->get();
    }

    public static function writtenOffBooks()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 8);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 8);
        })->get();
    }

    public static function writtenOffBook($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 8);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 8);
        })->where('book_id', $id)->get();
    }

    public static function returnedBooks()
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 9);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 9);
        })->get();
    }
}
