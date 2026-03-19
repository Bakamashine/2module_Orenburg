@extends('layouts.basic')
@section('title')
    Products
@endsection
@section('content')
    <a href="{{route('product.create', ['category' => $category->id])}}">Create product</a>
    @if(count($product) == 0)
        <p class="text-center">Продуктов нет</p>
    @else
        @foreach($product as $value)

        @endforeach
    @endif
@endsection
