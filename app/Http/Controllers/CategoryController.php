<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the category.
     */
    public function index()
    {
        //
        $categories = Category::all()->sortByDesc('created_at');

        return view('category.index', compact('categories'));
    }


    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate(["name" => ["required", "string", "min:3"]]);

        Category::create(["name" => $request->get('name')]);

        return redirect()->route('category.index');
    }

    /**
     * Updates a given category
     */
    public function update(Request $request, Category $category)
    {
        $inputName = $category->id . "name";

        $request->validate([
            'categories' => ['required', 'array'],
            $inputName => ['required', 'string', 'min:3'],
        ], [], [
            $inputName => __('name'),
        ]);

        $category->update(["name" => $request->get($inputName)]);

        return redirect()->route('category.index');
    }


    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->forceDelete();

        return redirect()->route("category.index");
    }
}
