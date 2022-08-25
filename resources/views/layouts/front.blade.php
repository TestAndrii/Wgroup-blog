<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name','Laravel') }} - @yield('title')</title>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    	<div class="container">
		  <a class="navbar-brand" href="{{url('/')}}">Wgroup posts test</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="{{url('/')}}">Главная</a>
		      </li>
		      @guest
		      <li class="nav-item">
		        <a class="nav-link" href="{{url('login')}}">Войти</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="{{url('register')}}">Регистрация</a>
		      </li>
		      @else
                <li class="nav-item">
                    <span class="badge bg-warning float-right"> Сообщений: {{Auth::user()->comments()->count()}}</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('save-post-form')}}">Добавить</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('manage-posts')}}">Редактировать</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{url('logout')}}">Выйти</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
		      @endguest
		    </ul>
		  </div>
		</div>
	</nav>
	<!-- Get latest posts -->
	<main class="container mt-4">
		@yield('content')
	</main>
</body>
</html>
