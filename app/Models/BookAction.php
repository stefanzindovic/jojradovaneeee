<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookAction extends Model
{
    use HasFactory, SoftDeletes;

    public function status()
    {
        return $this->belongsTo(BookActionStatus::class, 'action_status_id');
    }
}
