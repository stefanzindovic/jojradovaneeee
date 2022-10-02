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
use JetBrains\PhpStorm\NoReturn;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $students = User::with(['role', 'logins'])->orderBy('id', 'DESC')->where('is_active', true)->where('role_id', 3)->get();
        return view('..pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('pages.students.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([a-zA-Z\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
            'jmbg' => ['required', 'numeric', 'digits:13', 'unique:users,jmbg'],
            'username' => ['required', 'regex:/^([a-z0-9])+$/', 'min:4', 'max:18', 'unique:users,username'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:24', 'confirmed'],
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        try {
            $genericName = 'profile-picture-placeholder.jpg';
            if ($request->hasFile('picture')) {
                $uploadPath = 'uploads/students/';

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
            $model->picture = $genericName;
            $model->role_id = 3;
            $model->password = Hash::make($input['password']);
            $model->save();

            return to_route('students.index')->with('successMessage', 'Novi učenik je dodan na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $student
     * @return Application|Factory|View
     */
    public function show(User $student): View|Factory|Application
    {
        if (!$student->is_active) return abort(404);
        if ($student->role->id != 3) return abort(404);

        // issued books
        $issuedBooks = User::getIssuedBooks($student->id);

        // returned books
        $returnedBooks = User::getReturnedBooks($student->id);

        // deadline breached books
        $breachedBooks = User::getBreachedBooks($student->id);

        // pending reservations
        $pendingReservations = User::getPendingReservedBooks($student->id);

        // active reservations
        $activeReservations = User::getActiveReservedBooks($student->id);

        // archived reservations
        $archivedReservations = User::getArchivedReservations($student->id);

        return view('..pages.students.profile', compact('student', 'issuedBooks', 'returnedBooks', 'breachedBooks', 'pendingReservations', 'activeReservations', 'archivedReservations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $student
     * @return Application|Factory|View
     */
    public function edit(User $student)
    {
        if ($student->role->id != 3) return abort(404);
        if (!$student->is_active) return abort(404);
        return view('..pages.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $student
     * @return RedirectResponse
     */
    public function update(Request $request, User $student): RedirectResponse
    {
        if ($student->role->id != 3) return abort(404);
        if (!$student->is_active) return abort(404);

        $input = $request->validate([
            'name' => 'required|regex: /^([a-zA-Z\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
            'jmbg' => ['required', 'numeric', 'digits:13', Rule::unique('users', 'jmbg')->ignore($student->id)],
            'username' => ['required', 'alpha_num', 'min:4', 'max:18', Rule::unique('users', 'username')->ignore($student->id)],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->ignore($student->id)],
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);



        try {
            $genericName = $student->picture;
            if ($request->hasFile('picture')) {
                $uploadPath = 'uploads/students/';

                // remove old icon from storage
                $oldIconPath = $uploadPath . $student->picture;
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
            $student->name = $input['name'];
            $student->email = $input['email'];
            $student->username = $input['username'];
            $student->jmbg = $input['jmbg'];
            $student->picture = $genericName;

            $student->update();

            return to_route('students.index')->with('successMessage', 'Informacije o učeniku su izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $student
     * @return RedirectResponse
     */
    public function destroy(User $student): RedirectResponse
    {
        if (!$student->is_active) return abort(404);
        if ($student->role->id != 3) return abort(404);

        if ($student->id == Auth::user()->id) {
            return back()->with('errorMessage', 'Ne možete obrisati samog sebe.');
        }
        //TODO: Add check if this author is used in some of existing books before delete action (if exists, return error message)

        try {
            $student->delete();

            return to_route('students.index')->with('successMessage', 'Učenik je obrisan.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Mo limo vas da polušate ponovo.');
        }
    }

    public function resetPassword(Request $request, User $student)
    {
        $input = $request->validate([
            'password' => 'required|min:8|max:24,confirmed',
        ]);

        try {
            $hashedPassword = Hash::make($input['password']);
            $student->password = $hashedPassword;
            $student->update();

            return back()->with('successMessage', 'Lozinka je uspješno izmijenjena.');
        } catch (\Throwable $th) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
