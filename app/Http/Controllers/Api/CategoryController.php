<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getProduct(Category $category)
    {
        return ProductResource::collection($category->product()->get());
    }

    public function get()
    {
        return CategoryResource::collection(Category::all());
    }
}
