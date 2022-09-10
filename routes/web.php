<?php

use App\Http\Controllers\BookController;
use App\Models\BookCategory;
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

Route::middleware(['auth'])->group(function () {
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

    // Students
    Route::resource('/students', \App\Http\Controllers\StudentsController::class);
    Route::patch('/students/password/{student}', [\App\Http\Controllers\StudentsController::class, 'resetPassword'])->name('students.password');

    // Librarians
    Route::resource('/librarians', \App\Http\Controllers\LibrarianController::class);
    Route::patch('/librarians/password/{librarian}', [\App\Http\Controllers\LibrarianController::class, 'resetPassword'])->name('librarians.password');

    // Books CRUD
    Route::resource('/books', BookController::class);
    Route::patch('/books/{book}/{gallery}', [\App\Http\Controllers\BookController::class, 'destroyPicture'])->name('books.picture.destroy');
});

require __DIR__ . '/auth.php';
