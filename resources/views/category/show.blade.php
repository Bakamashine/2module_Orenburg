@extends('layouts.basic')

@section('title')
    {{$category->title}}
@endsection

@section('content')
    <p>Title: {{$category->title}}</p>
    <p>Description: {{$category->description}}</p>
    <a href="{{route('category.index')}}" class="btn btn-link">Back</a>
@endsection
