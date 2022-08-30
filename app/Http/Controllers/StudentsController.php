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
        $students = User::with(['role', 'logins'])->where('is_active', true)->where('role_id', 3)->get();
        return view('..pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $student
     * @return Application|Factory|View
     */
    public function show(User $student): View|Factory|Application
    {
        return view('..pages.students.profile', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $student
     * @return Application|Factory|View
     */
    public function edit(User $student)
    {
        return view('..pages.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $student
     * @return RedirectResponse
     */
    #[NoReturn] public function update(Request $request, User $student)
    {
        $input = $request->validate([
            'name' => 'required|regex: /^([a-zA-Z\s])+$/|min:4|max:50',
            'jmbg' => ['required', 'numeric', 'digits:13', Rule::unique('users', 'jmbg')->ignore($student->id)],
            'username' => ['required', 'alpha_num', 'min:4', 'max:18', Rule::unique('users', 'username')->ignore($student->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($student->id)],
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);



        try {
            $genericName = $student->picture;
            if($request->hasFile('picture')) {
                $uploadPath = 'uploads/students/';

                // remove old icon from storage
                $oldIconPath = $uploadPath . $student->picture;
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}