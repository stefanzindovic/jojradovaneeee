<?php

namespace App\Http\Controllers;

use App\Models\BookAction;
use App\Http\Requests\StoreBookActionRequest;
use App\Http\Requests\UpdateBookActionRequest;

class BookActionController extends Controller
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
     * @param  \App\Http\Requests\StoreBookActionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookActionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookAction  $bookAction
     * @return \Illuminate\Http\Response
     */
    public function show(BookAction $bookAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookAction  $bookAction
     * @return \Illuminate\Http\Response
     */
    public function edit(BookAction $bookAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookActionRequest  $request
     * @param  \App\Models\BookAction  $bookAction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookActionRequest $request, BookAction $bookAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookAction  $bookAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookAction $bookAction)
    {
        //
    }
}
