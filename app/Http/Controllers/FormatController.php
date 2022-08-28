<?php

namespace App\Http\Controllers;

use App\Models\Format;
use App\Http\Requests\StoreFormatRequest;
use App\Http\Requests\UpdateFormatRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $formats = Format::orderBy('id', 'DESC')->get();
        return view('..pages.settings.formats', compact('formats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.settings.addFormat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFormatRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFormatRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z0-9-_.\s])+$/|min:2|max:25'
        ]);

        try {
            // Generate new category model
            $model = new Format();
            $model->name = $input['name'];
            $model->save();

            return to_route('settings.formats.index')->with('successMessage', 'Novi format je uspješno dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Format $format
     * @return \Illuminate\Http\Response
     */
    public function show(Format $format)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Format $format
     * @return Application|Factory|View
     */
    public function edit(Format $format): View|Factory|Application
    {
        return view('..pages.settings.editFormat', compact('format'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormatRequest  $request
     * @param Format $format
     * @return RedirectResponse
     */
    public function update(UpdateFormatRequest $request, Format $format)
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z0-9-_.\s])+$/|min:2|max:25'
        ]);

        try {
            // Generate new category model
            $format->name = $input['name'];
            $format->update();

            return to_route('settings.formats.index')->with('successMessage', 'Informacije o formatu su uspješno izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Format $format
     * @return \Illuminate\Http\Response
     */
    public function destroy(Format $format)
    {
        //
    }
}
