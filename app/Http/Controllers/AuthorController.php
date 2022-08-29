<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $authors = Author::orderBy('id', 'DESC')->get();
        return view('..pages.authors.index', compact('authors'));
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
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return Application|Factory|View
     */
    public function show(Author $author): View|Factory|Application
    {
        return view('..pages.authors.profile', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param Author $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
