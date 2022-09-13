<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BooksUnderAction extends Model
{
    use HasFactory, SoftDeletes;

    function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    function actions()
    {
        return $this->hasMany(BookAction::class, 'books_under_actions_id');
    }

    function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
