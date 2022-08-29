<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
            'name' => 'required|regex: /^([A-Za-z\s])+$/|min:4|max:50',
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
     * @param  \App\Http\Requests\UpdateLanguageRequest  $request
     * @param Language $language
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanguageRequest $request, Language $language)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Language $language
     * @return RedirectResponse
     */
    public function destroy(Language $language): RedirectResponse
    {
        try {
            $language->delete();

            return to_route('settings.language.index')->with('successMessage', 'Jezik je uspješno obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }
}
