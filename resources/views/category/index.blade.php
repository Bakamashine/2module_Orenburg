@extends('layouts.basic')

@section('title')
    Категории
@endsection

@section('content')
    <a href="{{route('category.create')}}">Create category</a>
    @if(count($category) == 0)
        <p class="text-center">Категорий нет</p>
    @else
        @foreach($category as $value)
            <div class="border p-2 m-2">
                <p class="text-lg-start">Title: {{$value->title}}</p>
                <p class="text-sm-start">Description: {{$value->description}}</p>
                <form method="post" action="{{route('category.destroy', ['category' => $value->id])}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete</button>
                </form>
                <a class="btn btn-info" href="{{route('category.edit', ['category' => $value->id])}}">Edit</a>
                <a class="btn btn-info" href="{{route('category.show', ['category' => $value->id])}}">Show</a>
                <a class="btn btn-info" href="{{route('product.index', ['category' => $value->id])}}">Show products</a>
            </div>

        @endforeach
        {{$category->links()}}
    @endif
@endsection
