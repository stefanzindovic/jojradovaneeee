<?php

use App\Http\Controllers\BookController;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

|
*/

Auth::routes();

Route::get('/', [\App\Http\Controllers\BookUserSideController::class, 'index'])->name('home');
Route::get('/knjige', [\App\Http\Controllers\BookUserSideController::class, 'indexKnjige'])->name('knjige');
Route::get('/knjige/{id}', [\App\Http\Controllers\BookUserSideController::class, 'show'])->name('knjige.show');

Route::post('/searchweb', [\App\Http\Controllers\SearchController::class, 'searchweb']);

Route::middleware(['auth'])->group(function () {

    //Search
    Route::post('/searchstaff', [\App\Http\Controllers\SearchController::class, 'searchstaff']);


    //User Side
    Route::get('/profil', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profil');
    Route::get('/profil/edit/', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profil.edit');
    Route::patch('/profil/{id}', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profil.update');
    Route::get('/rezervacije', [\App\Http\Controllers\UserReservationController::class, 'index'])->name('rezervacije.index');
    Route::get('/rezervisi/{id}', [\App\Http\Controllers\UserReservationController::class, 'create'])->name('rezervacija.knjige');
    Route::post('/rezervisi/{book}', [\App\Http\Controllers\UserReservationController::class, 'rezervisi'])->name('rezervisi.knjigu');
    Route::patch('/otkazi/{book}', [\App\Http\Controllers\UserReservationController::class, 'otkazi'])->name('rezervacija.otkazi');

    Route::middleware(['staff'])->group(function () {


        //Book Records

        Route::get('/book/{id}/issuedbooks', [\App\Http\Controllers\BookRecords::class, 'issuedBooks'])->name('book.issued');
        Route::get('/book/{id}/returnedbooks', [\App\Http\Controllers\BookRecords::class, 'returnedBooks'])->name('book.returned');
        Route::get('/book/{id}/breachedbooks', [\App\Http\Controllers\BookRecords::class, 'breachedBooks'])->name('book.breached');
        Route::get('/book/{id}/reservedbooks', [\App\Http\Controllers\BookRecords::class, 'reservedBooks'])->name('book.reserved');
        Route::get('/book/{id}/archivedreservations', [\App\Http\Controllers\BookRecords::class, 'archivedReservations'])->name('book.archivedReservations');

        //Student Records

        Route::get('/student/{id}/issuedbooks', [\App\Http\Controllers\StudentRecords::class, 'issuedBooks'])->name('student.issued');
        Route::get('/student/{id}/returnedbooks', [\App\Http\Controllers\StudentRecords::class, 'returnedBooks'])->name('student.returned');
        Route::get('/student/{id}/breachedbooks', [\App\Http\Controllers\StudentRecords::class, 'breachedBooks'])->name('student.breached');
        Route::get('/student/{id}/reservedbooks', [\App\Http\Controllers\StudentRecords::class, 'reservedBooks'])->name('student.reserved');
        Route::get('/student/{id}/archivedreservations', [\App\Http\Controllers\StudentRecords::class, 'archivedReservations'])->name('student.archivedReservations');


        // Activities
        Route::get('/dashboard', [\App\Http\Controllers\ActivityController::class, 'dashboard'])->name('dashboard');
        Route::get('/activities', [\App\Http\Controllers\ActivityController::class, 'activities'])->name('activities');

        Route::get('/settings', function () {
            return redirect('/settings/policies');
        });
        Route::get('/actions', function () {
            return redirect('/actions/issues');
        });
        //Settings multi delete
        Route::delete('category/destroymultiple', [\App\Http\Controllers\CategoryController::class, 'destroyMultiple'])->name('category.destroyMultiple');
        Route::delete('genre/destroymultiple', [\App\Http\Controllers\GenreController::class, 'destroyMultiple'])->name('genre.destroyMultiple');
        Route::delete('publisher/destroymultiple', [\App\Http\Controllers\PublishersController::class, 'destroyMultiple'])->name('publisher.destroyMultiple');
        Route::delete('cover/destroymultiple', [\App\Http\Controllers\CoverController::class, 'destroyMultiple'])->name('cover.destroyMultiple');
        Route::delete('format/destroymultiple', [\App\Http\Controllers\FormatController::class, 'destroyMultiple'])->name('format.destroyMultiple');
        Route::delete('script/destroymultiple', [\App\Http\Controllers\ScriptController::class, 'destroyMultiple'])->name('script.destroyMultiple');
        Route::delete('language/destroymultiple', [\App\Http\Controllers\LanguageController::class, 'destroyMultiple'])->name('language.destroyMultiple');

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::resource('/policies', \App\Http\Controllers\PolicyController::class);
            Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
            Route::resource('/genres', \App\Http\Controllers\GenreController::class);
            Route::resource('/publishers', \App\Http\Controllers\PublishersController::class);
            Route::resource('/covers', \App\Http\Controllers\CoverController::class);
            Route::resource('/formats', \App\Http\Controllers\FormatController::class);
            Route::resource('/scripts', \App\Http\Controllers\ScriptController::class);
            Route::resource('/languages', \App\Http\Controllers\LanguageController::class);
        });

        // Authors
        Route::resource('/authors', \App\Http\Controllers\AuthorController::class);
        Route::delete('author/destroymultiple', [\App\Http\Controllers\AuthorController::class, 'destroyMultiple'])->name('authors.destroyMultiple');
        Route::patch('authors/{author}/destroyPicture', [\App\Http\Controllers\AuthorController::class, 'deletePicture'])->name('authors.destroyPicture');

        // Students
        Route::resource('/students', \App\Http\Controllers\StudentsController::class);
        Route::patch('/students/password/{student}', [\App\Http\Controllers\StudentsController::class, 'resetPassword'])->name('students.password');
        Route::delete('student/destroymultiple', [\App\Http\Controllers\StudentsController::class, 'destroyMultiple'])->name('students.destroyMultiple');

        // Librarians
        Route::resource('/librarians', \App\Http\Controllers\LibrarianController::class);
        Route::patch('/librarians/password/{librarian}', [\App\Http\Controllers\LibrarianController::class, 'resetPassword'])->name('librarians.password');
        Route::patch('/librarians/password/{librarian}', [\App\Http\Controllers\LibrarianController::class, 'resetPassword'])->name('librarians.password');
        Route::delete('librarian/destroymultiple', [\App\Http\Controllers\LibrarianController::class, 'destroyMultiple'])->name('librarians.destroyMultiple');

        // Books CRUD
        Route::resource('/books', BookController::class);
        Route::get('/books/{book}/action/{action}', [\App\Http\Controllers\BookController::class, 'displayActionDetails'])->name('books.actions.details');
        Route::delete('/books/action/{action}', [\App\Http\Controllers\BookController::class, 'archiveAction'])->name('books.actions.delete');
        Route::patch('/books/{book}/{gallery}', [\App\Http\Controllers\BookController::class, 'destroyPicture'])->name('books.picture.destroy');
        Route::delete('book/destorymultiplebooks', [\App\Http\Controllers\BookController::class, 'destroyMultiple'])->name('books.destroyMultiple');

        // Issue book
        Route::prefix('actions/issues')->name('books.issues')->group(function () {
            Route::get('/{book}/issue', [\App\Http\Controllers\IssueBookController::class, 'index'])->name('.issuebook');
            Route::get('/', [\App\Http\Controllers\IssueBookController::class, 'issues'])->name('.issues');
            Route::get('/returned', [\App\Http\Controllers\IssueBookController::class, 'returned'])->name('.returned');
            Route::get('/breached', [\App\Http\Controllers\IssueBookController::class, 'breachedDeadline'])->name('.breached');
            Route::post('/{book}', [\App\Http\Controllers\IssueBookController::class, 'issue'])->name('.issue');
            Route::patch('/{book}/return', [\App\Http\Controllers\IssueBookController::class, 'return'])->name('.return');
            Route::patch('/{book}/writeoff', [\App\Http\Controllers\IssueBookController::class, 'writeOff'])->name('.writeoff');
            Route::get('/{book}/returnmultiple', [\App\Http\Controllers\IssueBookController::class, 'returnmultiple'])->name('.returnmultiple');
            Route::patch('/returnmultiplebooks', [\App\Http\Controllers\IssueBookController::class, 'returnmultiplebooks'])->name('.returnmultiplebooks');
            Route::get('/{book}/writeoffmultiple', [\App\Http\Controllers\IssueBookController::class, 'writeoffmultiple'])->name('.writeoffmultiple');
            Route::patch('/writeoffmultiplebooks', [\App\Http\Controllers\IssueBookController::class, 'writeoffmultiplebooks'])->name('.writeoffmultiplebooks');
        });

        // Reserve book
        Route::prefix('actions/reservations')->name('books.reservations')->group(function () {
            Route::get('/', [\App\Http\Controllers\ReservationsController::class, 'index']);
            Route::get('/archived', [\App\Http\Controllers\ReservationsController::class, 'archived'])->name('.archived');
            Route::get('/{book}/reserve', [\App\Http\Controllers\ReservationsController::class, 'reservePage'])->name('.reservePage');
            Route::post('/{book}/reserve', [\App\Http\Controllers\ReservationsController::class, 'reserve'])->name('.reserve');
            Route::patch('/{book}/accept', [\App\Http\Controllers\ReservationsController::class, 'accept'])->name('.accept');
            Route::patch('/{book}/decline', [\App\Http\Controllers\ReservationsController::class, 'decline'])->name('.decline');
            Route::patch('/{book}/issue', [\App\Http\Controllers\ReservationsController::class, 'issue'])->name('.issue');
            Route::patch('/{book}/cancel', [\App\Http\Controllers\ReservationsController::class, 'cancel'])->name('.cancel');
        });
    });
});
