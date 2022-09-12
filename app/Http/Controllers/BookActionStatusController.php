<?php

namespace App\Http\Controllers;

use App\Models\BookActionStatus;
use App\Http\Requests\StoreBookActionStatusRequest;
use App\Http\Requests\UpdateBookActionStatusRequest;

class BookActionStatusController extends Controller
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
     * @param  \App\Http\Requests\StoreBookActionStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookActionStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookActionStatus  $bookActionStatus
     * @return \Illuminate\Http\Response
     */
    public function show(BookActionStatus $bookActionStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookActionStatus  $bookActionStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(BookActionStatus $bookActionStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookActionStatusRequest  $request
     * @param  \App\Models\BookActionStatus  $bookActionStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookActionStatusRequest $request, BookActionStatus $bookActionStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookActionStatus  $bookActionStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookActionStatus $bookActionStatus)
    {
        //
    }
}
