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

    public static function actionsByBookPaginate($id, $paginate)
    {
        return BookAction::with(['book' => function ($query) use ($id) {
            $query->where('book_id', $id);
        }])->whereHas('book', function ($query) use ($id) {
            $query->where('book_id', $id);
        })->where('is_active', true)->take(
            $paginate
        )->orderBy('created_at', 'desc')->get();
    }

    public static function actionsByBook($id)
    {
        return BookAction::with(['book' => function ($query) use ($id) {
            $query->where('book_id', $id);
        }])->whereHas('book', function ($query) use ($id) {
            $query->where('book_id', $id);
        })->where('is_active', true)->orderBy('created_at', 'desc')->get();
    }
}
