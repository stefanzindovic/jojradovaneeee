<?php

namespace App\Http\Controllers;

use App\Models\Script;
use App\Http\Requests\StoreScriptRequest;
use App\Http\Requests\UpdateScriptRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ScriptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $scripts = Script::orderBy('id', 'DESC')->get();
        return view('..pages.settings.scripts', compact('scripts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.settings.addScript');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreScriptRequest $request
     * @return RedirectResponse
     */
    public function store(StoreScriptRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z0-9-_.,\s])+$/|min:4|max:50',
        ]);

        try {
            $model = new Script();
            $model->name = $input['name'];
            $model->save();

            return to_route('settings.scripts.index')->with('successMessage', 'Novo pismo je dodano na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Script $script
     * @return \Illuminate\Http\Response
     */
    public function show(Script $script)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Script $script
     * @return Application|Factory|View
     */
    public function edit(Script $script): View|Factory|Application
    {
        return view('..pages.settings.editScript', compact('script'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScriptRequest  $request
     * @param Script $script
     * @return RedirectResponse
     */
    public function update(UpdateScriptRequest $request, Script $script): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z0-9-_.,\s])+$/|min:4|max:50',
        ]);

        try {

            $script->name = $input['name'];
            $script->update();

            return to_route('settings.scripts.index')->with('successMessage', 'Informacije o pismu su izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Script $script
     * @return RedirectResponse
     */
    public function destroy(Script $script): RedirectResponse
    {
        //TODO: Add check if this genre is used in some of existing books before delete action (if exists, return error message)

        try {
            $script->delete();

            return to_route('settings.scripts.index')->with('successMessage', 'Pismo je uspješno obrisano.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
