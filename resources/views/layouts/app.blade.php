<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ㅆㅆㅆㅆ | 선생과 학생의 경계가 없는 익스트림 토론장</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>

<link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/nanummyeongjo.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.js"
              integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
              crossorigin="anonymous"></script>
<style type="text/css">
@import url(http://fonts.googleapis.com/earlyaccess/notosanskr.css);
* {
    font-family: 'Noto Sans KR';
    font-weight: 100;
}
body {
    margin-bottom: 50px;
}
.navbar {
    padding: 15px;
}
.navbar-brand {
    outline: none;
}
.lead, h1 {
    font-family: 'Nanum Myeongjo';
}
.lead {
    font-size: 30px;
    color: gray;
}

#writeAt{
    margin: 5px 5px 30px 5px;
    font-size: 18px;
    background-color: #fff;
    padding-left: 13px;
    height: 50px;
    line-height: 50px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, .3);
    color: gray;
    border-radius: 2px;
}
.stArticle {
    margin: 10px 5px 15px 5px;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, .3);
    border-radius: 2px;

    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    /*color: white;*/
}
.stArticle .title, .stArticle .content, .stArticle .author, .stArticle .thumb .content, .stArticle .category {
    /*background-color: black;*/
    /*display: inline;*/
    color: white;
    mix-blend-mode: exclusion;
    font-weight: 100;
}
.stArticle .title {
    font-size: 23px;
}
.stArticle .content {
    font-size: 13px;
}
.stArticle .thumb, .stArticle .author {
    font-size: 13px;
    /*color: white;*/
}
.stArticle .thumb .up {
    color: dodgerblue;
    display: inline;
}
.stArticle .thumb .down {
    color: red;
    display: inline;
}
.stArticle .thumb .content {
    font-size: 13px;
    display: inline;
}
.stArticle .category {
    font-size: 13px;
}
.btn-user{
    background-color: transparent;
    border-color: transparent;
    color: black;
}
.btn-user:focus {
    box-shadow: none;
}
.user-img-small {
    width: 30px;
    margin-right: 5px;
    border-radius: 50px;
}
.user-img-big {
    width: 200px;
    margin-right: 5px;
    border-radius: 200px;
    box-shadow: 0px 1px 3px rgba(0, 0, 0, .3);
}
</style>
<body>

    <nav class="navbar navbar-expand-md navbar-light navbar-white">
        <a class="navbar-brand" href="/"><img src="/img/SSSS.png" width="50"></a>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ explode('.',Route::current()->getName())[0] == 'articles' ? 'active' : '' }}">
                    <a class="nav-link" href="/">게시판</a>
                </li>
                <li class="nav-item {{ explode('.',Route::current()->getName())[0] == 'discuss' ? 'active' : '' }}">
                    <a class="nav-link" href="/discuss">토론장</a>
                </li>
<!--                 <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> -->
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0">
            @guest
                <button onclick="window.location.href='{{ route('login') }}'" class="btn btn-outline-secondary btn-user" type="button">Login</button>
                <button onclick="window.location.href='{{ route('register') }}'" class="btn btn-outline-secondary btn-user" type="button">Register</button>
            @else
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle btn-user" type="button" data-toggle="dropdown"><img class="user-img-small" src="{{ Auth::user()->profile }}" alt=""> {{ Auth::user()->name }}
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}">
                        Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                        </a>
                    </li>
                </ul>
            </div> 
            @endguest 
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/VisualEditor_-_Icon_-_Search.svg/1024px-VisualEditor_-_Icon_-_Search.svg.png" alt="" style="width: 60px"></a>
        </form>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <main role="main" class="container">
        @yield('content')
    </main><!-- /.container -->
    @if($errors->any())
        <script>alert('{{$errors->first()}}');</script>
    @endif
</body>
<script>
window.onpageshow = function(event) {
    if (event.persisted) {
        document.location.reload();
    }
};

</script>
</html>

