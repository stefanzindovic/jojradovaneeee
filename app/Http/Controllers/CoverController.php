<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Http\Requests\StoreCoverRequest;
use App\Http\Requests\UpdateCoverRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Viewx
     */
    public function index(): View|Factory|Application
    {
        $covers = Cover::orderBy('id', 'DESC')->get();
        return view('..pages.settings.cover', compact('covers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.settings.addCover');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCoverRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCoverRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z0-9\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
        ]);

        try {
            $model = new Cover();
            $model->name = $input['name'];
            $model->save();

            return to_route('settings.covers.index')->with('successMessage', 'Novi povez je dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Cover $cover
     * @return \Illuminate\Http\Response
     */
    public function show(Cover $cover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cover $cover
     * @return Application|Factory|View
     */
    public function edit(Cover $cover): View|Factory|Application
    {
        return view('..pages.settings.editCover', compact('cover'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCoverRequest $request
     * @param Cover $cover
     * @return RedirectResponse
     */
    public function update(UpdateCoverRequest $request, Cover $cover): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z0-9\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
        ]);

        try {
            $cover->name = $input['name'];
            $cover->update();

            return to_route('settings.covers.index')->with('successMessage', 'Informacije o povezu su izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cover $cover
     * @return RedirectResponse
     */
    public function destroy(Cover $cover): RedirectResponse
    {
        if ($cover->books->isNotEmpty()) {
            return to_route('settings.covers.index')->with('errorMessage', 'U biblioteci se nalaze knjige sa ovim povezom.');
        }
        try {
            $cover->delete();

            return to_route('settings.covers.index')->with('successMessage', 'Povez je uspješno obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }

    public function destroyMultiple(Request $request)
    {

        try {
            foreach ($request->id as $cover){
                $cover = Cover::findOrFail($cover);
                if ($cover->books->isNotEmpty()) {
                    return to_route('settings.covers.index')->with('errorMessage', 'U biblioteci se nalaze knjige sa ovim povezom.');
                }
                $cover->delete();
            }

            return to_route('settings.covers.index')->with('successMessage', 'Svi slobodni povezi su uspješno obrisani.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }
}
