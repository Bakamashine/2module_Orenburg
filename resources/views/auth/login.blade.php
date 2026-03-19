@extends('layouts.basic')

@section('title')
    Авторизация
@endsection

@section("content")
    <form method="post" action="{{route('login.store')}}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input value="{{old("email")}}" type="email" class="form-control @error('email') is-invalid @enderror "
                   id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            @error('email') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                   id="exampleInputPassword1" name="password">
            @error('password') <p class="text-danger">{{$message}}</p> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
