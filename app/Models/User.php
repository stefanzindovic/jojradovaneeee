<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public static function getIssuedBooks($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
        })->orderBy('id', 'desc')->where('student_id', $id)->get();
    }

    public static function getReturnedBooks($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 9);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 9);
        })->orderBy('id', 'desc')->where('student_id', $id)->get();
    }

    public static function getBreachedBooks($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where(function ($query) {
                $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
            })->whereDate('action_deadline', '<', date('Y-m-d'));
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where(function ($query) {
                $query->where('action_status_id', 1)->orWhere('action_status_id', 7);
            })->whereDate('action_deadline', '<', date('Y-m-d'));
        })->orderBy('id', 'desc')->where('student_id', $id)->get();
    }

    public static function getPendingReservedBooks($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 2);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 2);
        })->orderBy('id', 'desc')->where('student_id', $id)->get();
    }

    public static function getActiveReservedBooks($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 3);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 3);
        })->where('student_id', $id)->orderBy('id', 'desc')->get();
    }

    public static function getArchivedReservations($id)
    {
        return BooksUnderAction::with(['activeAction' => function ($query) {
            $query->where('action_status_id', 4)->orWhere('action_status_id', 5)->orWhere('action_status_id', 6)->orWhere('action_status_id', 7);
        }, 'book', 'student'])->whereHas('activeAction', function ($query) {
            $query->where('action_status_id', 4)->orWhere('action_status_id', 5)->orWhere('action_status_id', 6)->orWhere('action_status_id', 7);
        })->orderBy('id', 'desc')->where('student_id', $id)->get();
    }

    public static function doStudentHaveActiveIssues($student_id, $book_id)
    {
        $student = User::with(['booksUnderAction', 'booksUnderAction.activeAction'])->findOrFail($student_id);
        $activeBooks = $student->booksUnderAction;

        //todo: Replace 2 with policy value in future
        $activeBookCount = User::getIssuedBooks($student_id)->count();
        $pendingReservationsCount = User::getPendingReservedBooks($student_id)->count();
        $activeReservationsCount = User::getActiveReservedBooks($student_id)->count();


        if (($activeBookCount + $pendingReservationsCount + $activeReservationsCount) > 2) {
            return true;
        }

        if (User::getIssuedBooks($student_id)->pluck('book_id')->contains($book_id) || User::getPendingReservedBooks($student_id)->pluck('book_id')->contains($book_id) || User::getActiveReservedBooks($student_id)->pluck('book_id')->contains($book_id)) {
            return true;
        }

        return false;
    }

    function bookActions()
    {
        return $this->hasMany(BookAction::class, 'librarian_id');
    }
}
