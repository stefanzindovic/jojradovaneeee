<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TheSeer\Tokenizer\Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('..pages.settings.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('..pages.settings.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $input = $request->validate([
            'title' => 'required|regex: /^([A-Za-z0-9-,\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
            'description' => 'nullable|min:10|max:512',
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        // upload image if image exists
        $genericName = 'placeholder.png';
        if ($request->hasFile('picture')) {
            $uploadedFile = $request->file('picture');
            $genericName = trim(strtolower(time() . $uploadedFile->getClientOriginalName()));
            $uploadsPath = 'uploads/categories/';

            Storage::disk('public')->putFileAs(
                $uploadsPath,
                $uploadedFile,
                $genericName
            );
        }

        try {
            // Generate new category model
            $model = new Category();
            $model->title = $input['title'];
            $model->description = $input['description'] ?? 'Nema opisa.';
            $model->picture = $genericName;
            $model->save();

            return to_route('settings.categories.index')->with('successMessage', 'Nova kategorija je uspješno kreirana.')->with('successMessage', 'Nova kategorija je dodana na spisak.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category): View|Factory|Application
    {
        return view('..pages.settings.editCategory', compact('category'));
    }

    public function deletePicture(Category $category)
    {
        try {
            // remove old icon from storage
            $uploadPath = 'uploads/categories/';

            $oldIconPath = $uploadPath . $category->picture;
            if (Storage::disk('public')->exists($oldIconPath)) {
                Storage::disk('public')->delete($oldIconPath);
            }

            $category->picture = 'placeholder.png';
            $category->update();

            return to_route('authors.index')->with('successMessage', 'Fotografija uspješno uklonjena.');
        } catch (\Throwable $th) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $input = $request->validate([
            'title' => 'required|regex: /^([A-Za-z0-9-,\sŠšĐđŽžČčĆć])+$/|min:4|max:50',
            'description' => 'nullable|min:10|max:512',
            'picture' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        try {
            $genericName = $category->picture;
            if ($request->hasFile('picture')) {
                $uploadPath = 'uploads/categories/';

                // remove old picture from storage
                $oldpicturePath = $uploadPath . $category->picture;
                if (Storage::disk('public')->exists($oldpicturePath)) {
                    Storage::disk('public')->delete($oldpicturePath);
                }

                // upload new picture
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
            $category->title = $input['title'];
            $category->description = $input['description'] ?? 'Nema opisa.';
            $category->picture = $genericName;

            $category->update();

            return to_route('settings.categories.index')->with('successMessage', 'Informacije o kategoriji su uspješno izmijenjene.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->loadMissing(['books']);
        if ($category->books->isNotEmpty()) {
            return to_route('settings.categories.index')->with('errorMessage', 'U biblioteci postoje knjige koje pripadaju ovoj kategoriji.');
        }

        try {
            $uploadPath = 'uploads/categories/';

            // remove old picture from storage
            $oldpicturePath = $uploadPath . $category->picture;
            if (Storage::disk('public')->exists($oldpicturePath)) {
                Storage::disk('public')->delete($oldpicturePath);
            }

            $category->delete();

            return to_route('settings.categories.index')->with('successMessage', 'Kategorija je uspješno obrisana.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }

    public function destroyMultiple(Request $request)
    {
        try {
            foreach ($request->id as $category) {
                $category = Category::findOrFail($category);
                $category->loadMissing(['books']);
                if ($category->books->isNotEmpty()) {
                    return to_route('settings.categories.index')->with('errorMessage', 'U biblioteci postoje knjige koje pripadaju ovoj kategoriji.');
                }
                $uploadPath = 'uploads/categories/';

                // remove old picture from storage
                $oldpicturePath = $uploadPath . $category->picture;
                if (Storage::disk('public')->exists($oldpicturePath)) {
                    Storage::disk('public')->delete($oldpicturePath);
                }

                $category->delete();
            }

            return to_route('settings.categories.index')->with('successMessage', 'Kategorija je uspješno obrisana.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Nešto nije u redu. Molimo vas da polušate ponovo.');
        }
    }
}
