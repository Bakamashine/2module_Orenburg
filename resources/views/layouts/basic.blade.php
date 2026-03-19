<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>@yield("title")</title>
</head>
<body class="bg-body">
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route("main")}}">{{env('APP_NAME')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                    @endguest
                    @auth
                        <li class="nav-item"><a class="nav-link" href="javascript:void(0)" id="logout">Logout</a></li>
                        <form class="hiding" id="form_logout" method="post" action="{{route('logout.store')}}">
                            @csrf
                        </form>
                        <script>
                            logout.addEventListener("click", () => {
                                form_logout.submit();
                            })
                        </script>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Admin page</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a href="{{route('category.index')}}" class="nav-link">Category</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="bg-light m-5 p-3">
    @yield("content")
</main>
</body>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</html>
