<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $genres = Genre::orderBy('id', 'DESC')->get();
        return view('..pages.settings.genres', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.settings.addGenre');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGenreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreGenreRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'title' => 'required|regex: /^([A-Za-z0-9-,\sŠšĐđŽžČčĆć])+$/|min:4|max:50'
        ]);

        try {
            // Generate new category model
            $model = new Genre();
            $model->title = $input['title'];
            $model->save();

            return to_route('settings.genres.index')->with('successMessage', 'Novi žanr je uspješno dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Genre $genre
     * @return Response
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Genre $genre
     * @return Application|Factory|View
     */
    public function edit(Genre $genre): View|Factory|Application
    {
        return view('..pages.settings.editGenre', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGenreRequest $request
     * @param Genre $genre
     * @return RedirectResponse
     */
    public function update(UpdateGenreRequest $request, Genre $genre): RedirectResponse
    {
        $input = $request->validate([
            'title' => 'required|regex: /^([A-Za-z0-9-,\sŠšĐđŽžČčĆć])+$/|min:4|max:50'
        ]);

        try {
            $genre->title = $input['title'];
            $genre->update();

            return to_route('settings.genres.index')->with('successMessage', 'Informacije o žanru su uspješno izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Genre $genre
     * @return RedirectResponse
     */
    public function destroy(Genre $genre): RedirectResponse
    {
        //TODO: Add check if this genre is used in some of existing books before delete action (if exists, return error message)
        $genre->loadMissing(['books']);
        if ($genre->books->isNotEmpty()) {
            return to_route('settings.genres.index')->with('errorMessage', 'U biblioteci postoje knjige koje pripadaju ovom žanru.');
        }

        try {
            $genre->delete();

            return to_route('settings.genres.index')->with('successMessage', 'Žanr je uspješno obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function destroyMultiple(Request $request)
    {


        try {
            foreach ($request->id as $genre){
                $genre = Genre::findOrFail($genre);
                $genre->loadMissing(['books']);
                if ($genre->books->isNotEmpty()) {
                    return to_route('settings.genres.index')->with('errorMessage', 'U biblioteci postoje knjige koje pripadaju ovom žanru.');
                }
                $genre->delete();
            }

            return to_route('settings.genres.index')->with('successMessage', 'Svi slobodni žanrovi su uspješno obrisani.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
