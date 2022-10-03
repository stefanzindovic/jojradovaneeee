<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $languages = Language::orderBy('id', 'DESC')->get();
        return view('..pages.settings.languages', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.settings.addLanguage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLanguageRequest $request
     * @return RedirectResponse
     */
    public function store(StoreLanguageRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
        ]);

        try {
            $model = new Language();
            $model->name = $input['name'];
            $model->save();

            return to_route('settings.languages.index')->with('successMessage', 'Novi jezik je dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Language $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Language $language
     * @return Application|Factory|View
     */
    public function edit(Language $language): View|Factory|Application
    {
        return view('..pages.settings.editLanguage', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLanguageRequest $request
     * @param Language $language
     * @return RedirectResponse
     */
    public function update(UpdateLanguageRequest $request, Language $language): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
        ]);

        try {
            $language->name = $input['name'];
            $language->update();

            return to_route('settings.languages.index')->with('successMessage', 'Informacije o jeziku su izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Language $language
     * @return RedirectResponse
     */
    public function destroy(Language $language): RedirectResponse
    {
        if ($language->books->isNotEmpty()) {
            return to_route('settings.languages.index')->with('errorMessage', 'U biblioteci se nalaze knjige na ovom jeziku.');
        }

        try {
            $language->delete();

            return to_route('settings.languages.index')->with('successMessage', 'Jezik je uspješno obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function destroyMultiple(Request $request)
    {

        try {
            foreach ($request->id as $language) {
                $language = Language::findOrFail($language);
                if ($language->books->isNotEmpty()) {
                    return to_route('settings.languages.index')->with('errorMessage', 'U biblioteci se nalaze knjige na ovom jeziku.');
                }
                $language->delete();
            }

            return to_route('settings.language.index')->with('successMessage', 'Svi slobodni jezici su uspješno obirsani.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }
}
