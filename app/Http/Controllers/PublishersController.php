<?php

namespace App\Http\Controllers;

use App\Models\Publishers;
use App\Http\Requests\StorePublishersRequest;
use App\Http\Requests\UpdatePublishersRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
     * @param  \App\Http\Requests\StorePublishersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublishersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publishers  $publishers
     * @return \Illuminate\Http\Response
     */
    public function show(Publishers $publishers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publishers  $publishers
     * @return \Illuminate\Http\Response
     */
    public function edit(Publishers $publishers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePublishersRequest  $request
     * @param  \App\Models\Publishers  $publishers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublishersRequest $request, Publishers $publishers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publishers  $publishers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publishers $publishers)
    {
        //
    }
}
