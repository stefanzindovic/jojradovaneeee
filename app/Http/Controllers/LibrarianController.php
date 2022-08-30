<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LibrarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $librarians = User::with(['role', 'logins'])->orderBy('id', 'DESC')->where('is_active', true)->where('role_id', 1)->orWhere('role_id', 2)->get();
        return view('..pages.librarians.index', compact('librarians'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $librarian
     * @return Application|Factory|View
     */
    public function show(User $librarian): View|Factory|Application
    {
        if(!$librarian->is_active) return abort(404);
        if($librarian->role->id == 3) return abort(404);
        return view('..pages.librarians.profile', compact('librarian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $librarian
     * @return Application|Factory|View
     */
    public function edit(User $librarian): View|Factory|Application
    {
        if($librarian->role->id == 3) return abort(404);
        if(!$librarian->is_active) return abort(404);
        return view('..pages.librarians.edit', compact('librarian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $librarian
     * @return RedirectResponse
     */
    public function update(Request $request, User $librarian): \Illuminate\Http\RedirectResponse
    {
        if(!$librarian->is_active) return abort(404);
        if($librarian->role->id == 3) return abort(404);

        $input = $request->validate([
            'name' => 'required|regex: /^([a-zA-Z\s])+$/|min:4|max:50',
            'jmbg' => ['required', 'numeric', 'digits:13', Rule::unique('users', 'jmbg')->ignore($librarian->id)],
            'username' => ['required', 'alpha_num', 'min:4', 'max:18', Rule::unique('users', 'username')->ignore($librarian->id)],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->ignore($librarian->id)],
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);



        try {
            $genericName = $librarian->picture;
            if($request->hasFile('picture')) {
                $uploadPath = 'uploads/librarians/';

                // remove old icon from storage
                $oldIconPath = $uploadPath . $librarian->picture;
                if(Storage::disk('public')->exists($oldIconPath)) {
                    Storage::disk('public')->delete($oldIconPath);
                }

                // upload new icon
                if($request->hasFile('picture')) {
                    $uploadedFile = $request->file('picture');
                    $genericName = trim(strtolower(time() . $uploadedFile->getClientOriginalName()));

                    Storage::disk('public')->putFileAs(
                        $uploadPath,
                        $uploadedFile,
                        $genericName
                    );
                }
            }

            // update category in db
            $librarian->name = $input['name'];
            $librarian->email = $input['email'];
            $librarian->username = $input['username'];
            $librarian->jmbg = $input['jmbg'];
            $librarian->picture = $genericName;

            $librarian->update();

            return to_route('librarians.index')->with('successMessage', 'Informacije o bibliotekaru su izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $librarian)
    {
        if($librarian->role->id == 3) return abort(404);
        if(!$librarian->is_active) return abort(404);
    }
}
