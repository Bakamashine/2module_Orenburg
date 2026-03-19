<?php

namespace App\Http\Controllers;

use App\Contracts\IImageService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{

    public function __construct(private IImageService $imageService)
    {
    }

    public function index(Category $category)
    {
        $product = $category->product()->paginate(5);
        return view('product.index', [
            'product' => $product,
            'category' => $category
        ]);

    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function store(StoreProductRequest $request, Category $category)
    {
        $product = $category->product()->make(
            $request->only(['title', 'description', 'price'])
        );

        $product->image = $this->imageService->UploadImage($request);
        $product->save();

    }

    public function create(Category $category)
    {
        return view('product.create', compact('category'));
    }
}
