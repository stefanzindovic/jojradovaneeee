<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'jmbg',
        'picture',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relation between user roles and users
    function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    // relation between user logins and users
    function logins(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLogins::class);
    }

    function booksUnderAction()
    {
        return $this->hasMany(BooksUnderAction::class, 'student_id');
    }

    public static function doStudentHaveActiveIssues($student_id, $book_id)
    {
        $student = User::with(['booksUnderAction'])->findOrFail($student_id);
        $activeBooks = $student->booksUnderAction;

        //todo: Replace 2 with policy value in future
        $activeBooksCount = 0;
        foreach ($activeBooks as $book) {
            if ($book->activeAction->action_status_id == 1 || $book->activeAction->action_status_id == 2) {
                $activeBooksCount++;

                if ($activeBooksCount > 2) {
                    return true;
                }
            }
        }

        foreach ($activeBooks as $book) {
            if ($book->book_id == $book_id && ($book->activeAction->action_status_id == 1 || $book->activeAction->action_status_id == 2)) {
                return true;
            }
        }

        return false;
    }

    function bookActions()
    {
        return $this->hasMany(BookAction::class, 'librarian_id');
    }
}
