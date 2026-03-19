@extends('layouts.basic')
@section('title')
    Create product
@endsection

@section('content')
    <form method="post" action="{{route('product.store', ['category' => $category->id])}}"
          enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">
                Title
            </label>
            <input class="form-control @error('title') is-invalid @enderror" name="title">
            @error('title') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Description
            </label>
            <textarea name="description"
                      class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
            @error('description') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Price
            </label>
            <input type="number" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror"
                   name="price">
            @error('price') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">
                Image
            </label>
            <input value="{{old('image')}}" type="file" class="form-control @error('image') is-invalid @enderror"
                   name="image">
            @error('image') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
@endsection
