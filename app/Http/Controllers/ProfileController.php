<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        return view('pages.userside.profil');
    }

    public function edit()
    {
        return view('pages.userside.edit');
    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);
        if ($student->role->id != 3) return abort(404);
        if (!$student->is_active) return abort(404);

        $input = $request->validate([
            'name' => 'required|regex: /^([a-zA-Z\s])+$/|min:2|max:50',
            'username' => ['required', 'alpha_num', 'min:4', 'max:18', Rule::unique('users', 'username')->ignore($student->id)],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->ignore($student->id)],
            'picture' => 'sometimes|nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        if(!empty($request->input('password'))) {
            $request->validate([
                'password' => ['sometimes','confirmed', Rules\Password::defaults(), 'min:8', 'max:24']]);
            $input['password'] = bcrypt($request['password']);
        }



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
            }

            // update category in db
            $student->name = $input['name'];
            $student->email = $input['email'];
            $student->username = $input['username'];
            $student->picture = $genericName;

            $student->update();

            return to_route('home')->with('successMessage', 'Informacije o učeniku su izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
