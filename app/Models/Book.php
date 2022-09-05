<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'isbn', 'publisher_id', 'language_id', 'cover_id', 'script_id', 'format_id', 'total_pages', 'total_copies', 'published_at'
    ];
}
