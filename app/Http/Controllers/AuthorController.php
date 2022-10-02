<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $authors = Author::orderBy('id', 'DESC')->get();
        return view('..pages.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.authors.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreAuthorRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'full_name' => 'required|regex: /^([a-zA-Z\s!ČčĆćŠšĐđŽž])+$/|min:4|max:50',
            'bio' => 'nullable|min:10|max:500',
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        try {
            $genericName = 'profile-picture-placeholder.jpg';
            if ($request->hasFile('picture')) {
                $uploadPath = 'uploads/authors/';

                // upload new icon
                if ($request->hasFile('picture')) {
                    $uploadedFile = $request->file('picture');
                    $genericName = trim(strtolower(time() . $uploadedFile->getClientOriginalName()));

                    Storage::disk('public')->putFileAs(
                        $uploadPath,
                        $uploadedFile,
                        $genericName
                    );
                }
            }

            // update category in db
            $model = new Author();
            $model->full_name = $input['full_name'];
            $model->bio = $input['bio'] ?? 'Nema biografije.';
            $model->picture = $genericName;

            $model->save();

            return to_route('authors.index')->with('successMessage', 'Autor je dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return Application|Factory|View
     */
    public function show(Author $author): View|Factory|Application
    {
        return view('..pages.authors.profile', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return Application|Factory|View
     */
    public function edit(Author $author): View|Factory|Application
    {
        return view('..pages.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAuthorRequest $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(UpdateAuthorRequest $request, Author $author): RedirectResponse
    {
        $input = $request->validate([
            'full_name' => 'required|regex: /^([a-zA-Z\s!ČčĆćŠšĐđŽž])+$/|min:4|max:50',
            'bio' => 'nullable|min:10|max:500',
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        try {
            $genericName = $author->picture;
            if ($request->hasFile('picture')) {
                $uploadPath = 'uploads/authors/';

                // remove old icon from storage
                $oldIconPath = $uploadPath . $author->picture;
                if (Storage::disk('public')->exists($oldIconPath)) {
                    Storage::disk('public')->delete($oldIconPath);
                }

                // upload new icon
                if ($request->hasFile('picture')) {
                    $uploadedFile = $request->file('picture');
                    $genericName = trim(strtolower(time() . $uploadedFile->getClientOriginalName()));

                    Storage::disk('public')->putFileAs(
                        $uploadPath,
                        $uploadedFile,
                        $genericName
                    );
                }
            }

            // update category in db
            $author->full_name = $input['full_name'];
            $author->bio = $input['bio'] ?? 'Nema biografije.';
            $author->picture = $genericName;

            $author->update();

            return to_route('authors.index')->with('successMessage', 'Informacije o autoru su izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return RedirectResponse
     */
    public function destroy(Author $author): RedirectResponse
    {
        //TODO: Add check if this author is used in some of existing books before delete action (if exists, return error message)
        $author->loadMissing(['books']);
        if ($author->books->isNotEmpty()) {
            return to_route('authors.index')->with('errorMessage', 'U biblioteci se nalaze knjige ovog autora.');
        }
        try {
            $uploadPath = 'uploads/authors/';

            // remove old icon from storage
            $oldIconPath = $uploadPath . $author->picture;
            if (Storage::disk('public')->exists($oldIconPath)) {
                Storage::disk('public')->delete($oldIconPath);
            }

            $author->delete();

            return to_route('authors.index')->with('successMessage', 'Autor je obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Mo limo vas da polušate ponovo.');
        }
    }

    public function destroyMultiple(Request $request)
    {
        try {
            foreach ($request->id as $author){
                $author = Author::findOrFail($author);
                if ($author->books->isNotEmpty()) {
                    return to_route('authors.index')->with('errorMessage', 'U biblioteci se nalaze knjige ovog autora.');
                }
                $author->loadMissing(['books']);
                $uploadPath = 'uploads/authors/';

                // remove old icon from storage
                $oldIconPath = $uploadPath . $author->picture;
                if (Storage::disk('public')->exists($oldIconPath)) {
                    Storage::disk('public')->delete($oldIconPath);
                }

                $author->delete();
            }

            return to_route('authors.index')->with('successMessage', 'Autor je obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Mo limo vas da polušate ponovo.');
        }
    }
}
