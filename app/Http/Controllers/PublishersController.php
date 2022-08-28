<?php

namespace App\Http\Controllers;

use App\Models\Publishers;
use App\Http\Requests\StorePublishersRequest;
use App\Http\Requests\UpdatePublishersRequest;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
