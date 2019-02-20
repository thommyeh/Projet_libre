<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'My Waifu') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/bulma.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <img class="nav-item" src="2.png">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                     <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('Weebif', 'Weebify') }}
                </a>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('S\'inscrire') }}</a>
                        </li>
                        @endif
                        @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="img/{{Auth::user()->avatar}}" id="thumb">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profil') }}"
                                >
                                {{ __('Espace perso') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Se déconnecter') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@auth
    @section('EspacePerso')
          <div class="tabs is-centered is-boxed is-fullwidth">
  <ul>
    <li><a href="/editeur">Editeur de perso</a></li>
    <li><a href="/profil">Mon profil</a></li>
    <li><a>Calendrier</a></li>
    <li><a>Documents</a></li>
  </ul>
</div>
@endauth
        @show
<main class="container">
    @yield('content')
</main>
</div>
</body>
<footer class="fix-footer has-background-grey">
 <nav class="level">
  <p class="level-item has-text-centered has-text-white-bis">
    <a class="is-link is-primary has-text-white-bis" href="/home">Accueil</a>
  </p>
  <p class="level-item has-text-centered has-text-white-bis">
    <a href="/docs" class="has-text-white-bis">Documentation</a>
  </p>
  
  <p class="level-item has-text-centered has-text-white-bis">
    <a class="link is-primary">Mentions légales</a>
  </p>
  <p class="level-item has-text-centered has-text-white-bis">
    <a class="link is-link has-text-white-bis" href="">Contact</a>
  </p>
</nav>
</footer>
</html>