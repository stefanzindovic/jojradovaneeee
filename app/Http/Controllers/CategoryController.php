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
use Illuminate\Support\Facades\Storage;

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
            'title' => 'required|regex: /^([A-Za-z0-9-,\s])+$/|min:4|max:50',
            'description' =>'required|min:10|max:512',
            'icon' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        // upload image if image exists
        $genericName = 'profile-picture-placeholder.jpg';
        if($request->hasFile('icon')) {
            $uploadedFile = $request->file('icon');
            $genericName = trim(strtolower(time() . $uploadedFile->getClientOriginalName()));
            $uploadsPath = 'uploads/categories/';

            Storage::disk('public')->putFileAs(
                $uploadsPath,
                $uploadedFile,
                $genericName
            );
        }

        // Generate new category model
        $model = new Category();

        $model->title = $input['title'];
        $model->description = $input['description'];
        $model->icon = $genericName;

        $model->save();

        return to_route('settings.categories.index')->with('successMessage', 'Nova kategorija je uspješno kreirana.');
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
            'title' => 'required|regex: /^([A-Za-z0-9-,\s])+$/|min:4|max:50',
            'description' =>'required|min:10|max:512',
            'icon' => 'nullable|mimes:jpg,jpeg,png,svg,bim,webp,gif|max:5120',
        ]);

        $genericName = $category->icon;
        if($request->hasFile('icon')) {
            $uploadPath = 'uploads/categories/';

            // remove old icon from storage
            $oldIconPath = $uploadPath . $category->icon;
            if(Storage::disk('public')->exists($oldIconPath)) {
                Storage::disk('public')->delete($oldIconPath);
            }

            // upload new icon
            if($request->hasFile('icon')) {
                $uploadedFile = $request->file('icon');
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
        $category->description = $input['description'];
        $category->icon = $genericName;

        $category->update();

        return to_route('settings.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
