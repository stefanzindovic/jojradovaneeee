<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $librarians = User::with(['role', 'logins'])->orderBy('id', 'DESC')->where('is_active', true)->whereNot('role_id', 3)->get();
        return view('..pages.librarians.index', compact('librarians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(): View|Factory|RedirectResponse|Application
    {
        if (Auth::user()->role_id != 1) {
            return back()->with('errorMessage', 'Nemate dozvolu za izvršenje ove akcije.');
        }

        return view('..pages.librarians.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->role_id != 1) {
            return back()->with('errorMessage', 'Nemate dozvolu za izvršenje ove akcije.');
        }

        $input = $request->validate([
            'name' => 'required|regex: /^([a-zA-Z\s!ŠšĐđŽžČčĆć])+$/|min:4|max:50',
            'jmbg' => ['required', 'numeric', 'digits:13', 'unique:users,jmbg'],
            'username' => ['required', 'alpha_num', 'min:4', 'max:18', 'unique:users,username'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:24', 'confirmed'],
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        try {
            $genericName = 'profile-picture-placeholder.jpg';
            if ($request->hasFile('picture')) {
                $uploadPath = 'uploads/librarians/';

                // upload new icon
                if ($request->hasFile('picture')) {
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
            $model = new User();
            $model->name = $input['name'];
            $model->email = $input['email'];
            $model->username = $input['username'];
            $model->jmbg = $input['jmbg'];
            $model->role_id = 2;
            $model->picture = $genericName;
            $model->password = Hash::make($input['password']);

            $model->save();

            return to_route('librarians.index')->with('successMessage', 'Novi bibliotekar je dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $librarian
     * @return Application|Factory|View
     */
    public function show(User $librarian): View|Factory|Application
    {
        if (!$librarian->is_active) return abort(404);
        if ($librarian->role->id == 3) return abort(404);
        return view('..pages.librarians.profile', compact('librarian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $librarian
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(User $librarian): View|Factory|RedirectResponse|Application
    {
        if ($librarian->role->id == 3) {
            return abort(404);
        }
        if (!$librarian->is_active) {
            return abort(404);
        }

        if ($librarian->role_id === 1 && Auth::user()->role_id !== 1) {
            return back()->with('errorMessage', 'Ne možete izmijeniti administratora');
        }

        if ($librarian->id != Auth::user()->id && Auth::user()->role_id !== 1) {
            return back()->with('errorMessage', 'Nemate ovlaštenje potrebno za izvršenje ove akcije.');
        }

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
        if (!$librarian->is_active) return abort(404);
        if ($librarian->role->id == 3) return abort(404);

        if ($librarian->role->id == 1 && Auth::user()->id != $librarian->id) {
            return back()->with('errorMessage', 'Ne možete izmijeniti administratora');
        }

        $input = $request->validate([
            'name' => 'required|regex: /^([a-zA-Z\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
            'jmbg' => ['required', 'numeric', 'digits:13', Rule::unique('users', 'jmbg')->ignore($librarian->id)],
            'username' => ['required', 'alpha_num', 'min:4', 'max:18', Rule::unique('users', 'username')->ignore($librarian->id)],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->ignore($librarian->id)],
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);



        try {
            $genericName = $librarian->picture;
            if ($request->hasFile('picture')) {
                $uploadPath = 'uploads/librarians/';

                // remove old icon from storage
                $oldIconPath = $uploadPath . $librarian->picture;
                if (Storage::disk('public')->exists($oldIconPath)) {
                    Storage::disk('public')->delete($oldIconPath);
                }

                // upload new icon
                if ($request->hasFile('picture')) {
                    $uploadedFile = $request->file('picture');
                    $genericName = trim(strtolower(time() . $uploadedFile->getClientOriginalName()));

                    Storage::disk('public')->putFileAs(
                        $uploadPath,
                        $uploadedFile,
                        $genericName
                    );
                }
            } else {
                $genericName = 'profile-picture-placeholder.jpg';
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
     * @param User $librarian
     * @return RedirectResponse
     */
    public function destroy(User $librarian): RedirectResponse
    {
        if ($librarian->role->id == 3) return abort(404);
        if (!$librarian->is_active) return abort(404);

        if ($librarian->role->id == 1) {
            return back()->with('errorMessage', 'Ne možete obrisati administratora.');
        }

        if ($librarian->id == Auth::user()->id) {
            return back()->with('errorMessage', 'Ne možete obrisati samog sebe.');
        }

        if (Auth::user()->role_id != 1) {
            return back()->with('errorMessage', 'Nemate ovlaštenje potrebno za izvršenje ove akcije.');
        }

        try {
            $librarian->delete();

            return to_route('librarians.index')->with('successMessage', 'Bibliotekar je obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function destroyMultiple(Request $request)
    {

        try {
            foreach ($request->id as $librarian){
                $librarian = User::findOrFail($librarian);
                if ($librarian->role->id == 3) return abort(404);
                if (!$librarian->is_active) return abort(404);

                if ($librarian->role->id == 1) {
                    return back()->with('errorMessage', 'Ne možete obrisati administratora.');
                }

                if ($librarian->id == Auth::user()->id) {
                    return back()->with('errorMessage', 'Ne možete obrisati samog sebe.');
                }

                if (Auth::user()->role_id != 1) {
                    return back()->with('errorMessage', 'Nemate ovlaštenje potrebno za izvršenje ove akcije.');
                }

                $librarian->delete();
            }

            return to_route('librarians.index')->with('successMessage', 'Bibliotekar je obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function resetPassword(Request $request, User $librarian)
    {
        $input = $request->validate([
            'password' => 'required|min:8|max:24,confirmed',
        ]);


        if ($librarian->id != Auth::user()->id && Auth::user()->role_id !== 1) {
            return back()->with('errorMessage', 'Nemate ovlaštenje potrebno za izvršenje ove akcije.');
        }

        try {
            $hashedPassword = Hash::make($input['password']);
            $librarian->password = $hashedPassword;
            $librarian->update();
            return back()->with('successMessage', 'Lozinka je uspješno izmijenjena.');
        } catch (\Throwable $th) {
            dd($th);
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
