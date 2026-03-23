@extends('layouts.basic')
@section('title')
    Create product
@endsection

@section('content')
    <form method="post" action="{{route('product.update', ['product' => $product->id])}}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">
                Title
            </label>
            <input class="form-control @error('title') is-invalid @enderror" name="title" value="{{$product->title}}">
            @error('title') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Description
            </label>
            <textarea name="description"
                      class="form-control @error('description') is-invalid @enderror">{{$product->description}}</textarea>
            @error('description') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Price
            </label>
            <input type="number" value="{{$product->price}}" class="form-control @error('price') is-invalid @enderror"
                   name="price">
            @error('price') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Image
            </label>
            <input type="file" class="form-control @error('image') is-invalid @enderror"
                   name="image">
            @error('image') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
@endsection
