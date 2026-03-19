<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(5);
        return view("category.index", compact('category'));
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());
        return to_route("category.index");
    }

    public function create()
    {
        return view('category.create');
    }

    public function edit(Category $category)
    {
        return view("category.edit", compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        $category->save();
        return to_route("category.index");
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
