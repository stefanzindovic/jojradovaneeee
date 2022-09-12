<?php

namespace App\Http\Controllers;

use App\Models\BooksUnderAction;
use App\Http\Requests\StoreBooksUnderActionRequest;
use App\Http\Requests\UpdateBooksUnderActionRequest;

class BooksUnderActionController extends Controller
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
     * @param  \App\Http\Requests\StoreBooksUnderActionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBooksUnderActionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BooksUnderAction  $booksUnderAction
     * @return \Illuminate\Http\Response
     */
    public function show(BooksUnderAction $booksUnderAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BooksUnderAction  $booksUnderAction
     * @return \Illuminate\Http\Response
     */
    public function edit(BooksUnderAction $booksUnderAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBooksUnderActionRequest  $request
     * @param  \App\Models\BooksUnderAction  $booksUnderAction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBooksUnderActionRequest $request, BooksUnderAction $booksUnderAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BooksUnderAction  $booksUnderAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BooksUnderAction $booksUnderAction)
    {
        //
    }
}
