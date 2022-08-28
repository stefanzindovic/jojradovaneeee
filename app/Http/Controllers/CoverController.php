<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Http\Requests\StoreCoverRequest;
use App\Http\Requests\UpdateCoverRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCoverRequest $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z\s])+$/|min:4|max:50',
        ]);

        try {
            $model = new Cover();
            $model->name = $input['name'];
            $model->save();

            return to_route('settings.covers.index')->with('successMessage', 'Novi povez je dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('successMessage', 'Nešto nije u red. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function show(Cover $cover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function edit(Cover $cover)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoverRequest  $request
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoverRequest $request, Cover $cover)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cover $cover)
    {
        //
    }
}
