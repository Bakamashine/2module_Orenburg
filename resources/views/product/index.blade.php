@extends('layouts.basic')
@section('title')
    Products
@endsection
@section('content')
    <a href="{{route('product.create', ['category' => $category->id])}}">Create product</a>
    @if(count($product) == 0)
        <p class="text-center">Продуктов нет</p>
    @else
        <div class="d-flex justify-content-between flex-wrap">
            @foreach($product as $value)
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('storage') . "/$value->image"}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$value->title}}</h5>
                        <p class="card-text">{{$value->description}}</p>
                        <form method="post" action="{{route('product.destroy', ['product' => $value->id])}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        <a class="btn btn-link" href="{{route('product.edit', ['product' => $value->id])}}">Edit</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
