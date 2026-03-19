@extends('layouts.basic')

@section('title')
    Create category
@endsection

@section('content')
    <form method="post" action="{{route('category.store')}}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input placeholder="title..." value="{{old("title")}}" type="text"
                   class="form-control @error('title') is-invalid @enderror " id="exampleInputtitle1"
                   aria-describedby="titleHelp" name="title">
            @error('title') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputdescription1" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description">
                {{old('description')}}
            </textarea>
            @error('description') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
