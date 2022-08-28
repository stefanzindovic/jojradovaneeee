<?php

namespace App\Http\Controllers;

use App\Models\Publishers;
use App\Http\Requests\StorePublishersRequest;
use App\Http\Requests\UpdatePublishersRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $publishers = Publishers::orderBy('id', 'DESC')->get();
        return view('..pages.settings.publishers', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.settings.addPublisher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePublishersRequest $request
     * @return RedirectResponse
     */
    public function store(StorePublishersRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z\s])+$/|min:4|max:50',
        ]);

        $model = new Publishers();
        $model->name = $input['name'];
        $model->save();

        return to_route('settings.publishers.index')->with('successMessage', 'Novi izdavač je dodan na spisak.');
    }

    /**
     * Display the specified resource.
     *
     * @param Publishers $publishers
     * @return Response
     */
    public function show(Publishers $publishers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Publishers $publisher
     * @return Application|Factory|View
     */
    public function edit(Publishers $publisher): Application|Factory|View
    {
        return view('..pages.settings.editPublisher', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePublishersRequest $request
     * @param Publishers $publisher
     * @return RedirectResponse
     */
    public function update(UpdatePublishersRequest $request, Publishers $publisher): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([A-Za-z\s])+$/|min:4|max:50',
        ]);

        $publisher->name = $input['name'];
        $publisher->update();

        return to_route('settings.publishers.index')->with('successMessage', 'Informacije o izdavaču su uspješno izmijenjene.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Publishers $publisher
     * @return RedirectResponse
     */
    public function destroy(Publishers $publisher): RedirectResponse
    {
        //TODO: Add check if this genre is used in some of existing books before delete action (if exists, return error message)

        $publisher->delete();

        return to_route('settings.publishers.index')->with('successMessage', 'Izdavač je uspješno obrisan.');
    }
}
