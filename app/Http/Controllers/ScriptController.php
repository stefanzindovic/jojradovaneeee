<?php

namespace App\Http\Controllers;

use App\Models\Script;
use App\Http\Requests\StoreScriptRequest;
use App\Http\Requests\UpdateScriptRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
        return view('..pages.settings.index', compact('scripts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScriptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScriptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function show(Script $script)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function edit(Script $script)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScriptRequest  $request
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScriptRequest $request, Script $script)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Http\Response
     */
    public function destroy(Script $script)
    {
        //
    }
}
