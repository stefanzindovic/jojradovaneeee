<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['full_name', 'bio', 'picture'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_categories');
    }
}
