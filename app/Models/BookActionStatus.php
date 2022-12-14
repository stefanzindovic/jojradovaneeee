<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookActionStatus extends Model
{
    use HasFactory, SoftDeletes;

    function actions()
    {
        return $this->hasMany(BookAction::class, 'action_status_id');
    }
}
