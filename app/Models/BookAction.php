<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookAction extends Model
{
    use HasFactory, SoftDeletes;

    function status()
    {
        return $this->belongsTo(BookActionStatus::class, 'action_status_id');
    }

    function book()
    {
        return $this->belongsTo(BooksUnderAction::class, 'books_under_actions_id');
    }

    function originalBook()
    {
        return $this->belongsTo(Book::class, 'books_under_actions_id');
    }

    function librarian()
    {
        return $this->belongsTo(User::class, 'librarian_id');
    }
}
