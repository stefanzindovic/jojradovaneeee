<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cover;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Format;
use App\Models\Script;
use App\Models\Category;
use App\Models\Language;
use App\Models\BookAction;
use App\Models\Publishers;
use App\Models\BookGallery;
use App\Models\BooksUnderAction;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request as HttpRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->with(['authors', 'categories', 'gallery', 'booksUnderActions'])->get();
        $issuedBooksCount = Book::issuedBooks()->countBy('book_id');
        $writtenOffBooks = Book::writtenOffBooks()->countBy('book_id');
        $booksWithBreachedDeadlines = Book::issuedBooksWithBreachedDeadline()->countBy('book_id');
        $reservedBooksPendingCount = Book::pendingReservedBooks()->countBy('book_id');
        $reservedBooksActiveCount = Book::activeReservedBooks()->countBy('book_id');

        return view('..pages/books/index', compact('books', 'issuedBooksCount', 'writtenOffBooks', 'booksWithBreachedDeadlines', 'reservedBooksPendingCount', 'reservedBooksActiveCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = Author::orderBy('id', 'desc')->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $languages = Language::orderBy('id', 'desc')->get();
        $scripts = Script::orderBy('id', 'desc')->get();
        $publishers = Publishers::orderBy('id', 'desc')->get();
        $covers = Cover::orderBy('id', 'desc')->get();
        $formats = Format::orderBy('id', 'desc')->get();

        return view('..pages/books/add', compact('categories', 'authors', 'genres', 'scripts', 'publishers', 'covers', 'formats', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $input = $request->validate([
            'title' => 'required|min:1|max:50',
            'description' => 'nullable|min:10|max:2048',
            'categories' => 'required|min:1',
            'genres' => 'required|array|min:1',
            'authors' => 'required|array|min:1',
            'publisher' => 'required',
            'published_at' => 'required|numeric|min:1800|max:' . date('Y'),
            'total_copies' => 'required|numeric|min:1|max:999',
            'total_pages' => 'required|numeric|min:1|max:2000',
            'script' => 'required|numeric|min:1',
            'language' => 'required|numeric|min:1',
            'cover' => 'required|numeric|min:1',
            'format' => 'required|numeric|min:1',
            'isbn' => 'required|numeric|digits:13',
            'cover_picture' => 'nullable|string',
            'pictures' => 'nullable|array|min:1',
        ]);

        try {
            $model = new Book();
            $model->title = $input['title'];
            $model->description = $input['description'] ?? 'Nema sadržaja.';
            $model->total_copies = $input['total_copies'];
            $model->published_at = $input['published_at'];
            $model->total_pages = $input['total_pages'];
            $model->isbn = $input['isbn'];
            $model->script()->associate($input['script']);
            $model->cover()->associate($input['cover']);
            $model->format()->associate($input['format']);
            $model->publisher()->associate($input['publisher']);
            $model->language()->associate($input['language']);
            $model->save();
            $model->categories()->attach($input['categories']);
            $model->genres()->attach($input['genres']);
            $model->authors()->attach($input['authors']);

            // upload images if exists
            if ($request->hasFile('pictures')) {
                foreach ($request->pictures as $picture) {
                    $uploadsPath = 'uploads/books/';
                    $genericName = trim(strtolower(time() . $picture->getClientOriginalName()));

                    if ($request->has('cover_picture')) {
                        if ($picture->getClientOriginalName() == $input['cover_picture']) {
                            $model->picture = $genericName;
                            $model->update();
                        }
                    }

                    Storage::disk('public')->putFileAs(
                        $uploadsPath,
                        $picture,
                        $genericName,
                    );

                    $galleryModel = new BookGallery();
                    $galleryModel->picture = $genericName;
                    $galleryModel->book()->associate($model);
                    $galleryModel->save();
                }
            }

            return to_route('books.index')->with('successMessage', 'Nova knjiga je dodana na spisak.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $issuedRecords = Book::issuedBook($book->id);
        $returnedRecords = Book::returnedBook($book->id);
        $booksWithBreachDeadline = Book::issuedBookWithBreachedDeadline($book->id);
        $pendingReservations = Book::pendingReservedBook($book->id);
        $activeReservations = Book::activeReservedBook($book->id);
        $archivedReservations = Book::archivedReservationsByBook($book->id);

        $availableCopiesCount = Book::calcNumberOfAvailableCopies($book->id);

        $bookRecentActions = BookAction::actionsByBookPaginate($book->id, 3);

        return view('..pages.books.book', compact('book', 'issuedRecords', 'returnedRecords', 'booksWithBreachDeadline', 'pendingReservations', 'activeReservations', 'archivedReservations', 'availableCopiesCount', 'bookRecentActions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $authors = Author::orderBy('id', 'desc')->get();
        $genres = Genre::orderBy('id', 'desc')->get();
        $languages = Language::orderBy('id', 'desc')->get();
        $scripts = Script::orderBy('id', 'desc')->get();
        $publishers = Publishers::orderBy('id', 'desc')->get();
        $covers = Cover::orderBy('id', 'desc')->get();
        $formats = Format::orderBy('id', 'desc')->get();
        $writtenOffCount = Book::writtenOffBook($book->id)->count();

        return view('..pages.books.edit', compact('categories', 'authors', 'genres', 'scripts', 'publishers', 'covers', 'formats', 'languages', 'book', 'writtenOffCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $input = $request->validate([
            'title' => 'required|min:1|max:50',
            'description' => 'nullable|min:10|max:2048',
            'categories' => 'required|min:1',
            'genres' => 'required|array|min:1',
            'authors' => 'required|array|min:1',
            'publisher' => 'required',
            'published_at' => 'required|numeric|min:1800|max:' . date('Y'),
            'total_copies' => 'required|numeric|min:1|max:999',
            'total_pages' => 'required|numeric|min:1|max:2000',
            'script' => 'required|numeric|min:1',
            'language' => 'required|numeric|min:1',
            'cover' => 'required|numeric|min:1',
            'format' => 'required|numeric|min:1',
            'isbn' => 'required|numeric|digits:13',
            'cover_picture' => 'nullable|string',
            'pictures' => 'nullable|array|min:1',
        ]);


        try {
            $book->title = $input['title'];
            $book->description = $input['description'] ?? 'Nema sadržaja.';
            $book->total_copies = $input['total_copies'];
            $book->published_at = $input['published_at'];
            $book->total_pages = $input['total_pages'];
            $book->isbn = $input['isbn'];
            $book->script()->associate($input['script']);
            $book->cover()->associate($input['cover']);
            $book->format()->associate($input['format']);
            $book->publisher()->associate($input['publisher']);
            $book->language()->associate($input['language']);
            $book->update();
            $book->categories()->sync($input['categories']);
            $book->genres()->sync($input['genres']);
            $book->authors()->sync($input['authors']);


            // change cover picture if there is no new uploaded images
            if (!$request->hasFile('pictures') && $request->has('cover_picture')) {
                $book->picture = $input['cover_picture'];
                $book->update();
            }

            // upload images if exists
            if ($request->hasFile('pictures')) {
                foreach ($request->pictures as $picture) {
                    $uploadsPath = 'uploads/books/';
                    $genericName = trim(strtolower(time() . $picture->getClientOriginalName()));

                    if ($request->has('cover_picture')) {
                        if ($picture->getClientOriginalName() == $input['cover_picture']) {
                            $book->picture = $genericName;
                            $book->update();
                        }
                    }

                    Storage::disk('public')->putFileAs(
                        $uploadsPath,
                        $picture,
                        $genericName,
                    );

                    $galleryModel = new BookGallery();
                    $galleryModel->picture = $genericName;
                    $galleryModel->book()->associate($book);
                    $galleryModel->save();
                }
            }

            return to_route('books.index')->with('successMessage', 'Informacije o knjizi uspješno izmijenjene.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        try {
            // Check if there is some book copies that are under active action
            if ($book->calcNumberOfAvailableCopies($book->id) < $book->total_copies - $book->writtenOffBook($book->id)->count()) {
                return back()->with('errorMessage', 'Neke kopije ove knjige su pod aktivnostima u biblioteci.');
            }

            // Delete book multimedia
            if ($book->gallery()->count() > 0) {
                $uploadPath = 'uploads/books/';

                foreach ($book->gallery() as $gallery) {
                    $oldPicturePath = $uploadPath . $gallery->picture;
                    if (Storage::disk('public')->exists($oldPicturePath)) {
                        Storage::disk('public')->delete($oldPicturePath);
                    }
                }
            }
            // delete book

            Book::deleting(function () use ($book) {
                foreach ($book->booksUnderActions as $bookUnderAction) {
                    $bookUnderAction->actions()->delete();
                }
                $book->booksUnderActions()->delete();
            });

            $book->delete();

            return to_route('books.index')->with('successMessage', 'Knjiga je uspješno obrisana.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function destroyMultiple(HttpRequest $request)
    {
        try {
            foreach ($request->id as $book){
                $book = Book::findOrFail($book);
                // Check if there is some book copies that are under active action
                if ($book->calcNumberOfAvailableCopies($book->id) < $book->total_copies - $book->writtenOffBook($book->id)->count()) {
                    return back()->with('errorMessage', 'Neke kopije ove knjige su pod aktivnostima u biblioteci.');
                }

                // Delete book multimedia
                if ($book->gallery()->count() > 0) {
                    $uploadPath = 'uploads/books/';

                    foreach ($book->gallery() as $gallery) {
                        $oldPicturePath = $uploadPath . $gallery->picture;
                        if (Storage::disk('public')->exists($oldPicturePath)) {
                            Storage::disk('public')->delete($oldPicturePath);
                        }
                    }
                }
                // delete book

                Book::deleting(function () use ($book) {
                    foreach ($book->booksUnderActions as $bookUnderAction) {
                        $bookUnderAction->actions()->delete();
                    }
                    $book->booksUnderActions()->delete();
                });

                $book->delete();
            }

            return to_route('books.index')->with('successMessage', 'Knjige su uspješno obrisane.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }



    public function destroyPicture(Book $book,  BookGallery $gallery)
    {
        try {
            $uploadPath = 'uploads/books/';

            // change cover picture if cover is deleted
            if ($book->picture == $gallery->picture) {
                $book->picture = 'book-placeholder.png';
                $book->update();
            }

            // remove old picture from storage
            $oldPicturePath = $uploadPath . $gallery->picture;
            if (Storage::disk('public')->exists($oldPicturePath)) {
                Storage::disk('public')->delete($oldPicturePath);
            }

            $gallery->delete();
            return back()->with('successMessage', 'Slika uspješno obrisana.');
        } catch (\Throwable $th) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function displayActionDetails(Book $book, BookAction $action)
    {
        if ($action->is_active == false) return abort(404);
        $action->loadMissing(['status']);
        return view('..pages.books.actions.action', compact('book', 'action'));
    }

    public function archiveAction(BookAction $action)
    {
        try {
            $action->is_active = false;
            $action->update();

            return to_route('activities')->with('successMessage', 'Zapis je uspješno arhiviran.');
        } catch (\Throwable $th) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
