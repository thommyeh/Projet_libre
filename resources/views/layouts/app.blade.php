<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'My Waifu') }}</title>
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      <!-- Styles -->
      
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:600&display=swap" rel="stylesheet">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

       <script src="{{ asset('js/sync.js') }}" defer></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
       <link href="{{asset('css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
        <link href="{{asset('css/custom.css')}}" rel="stylesheet"> 
         <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
         <script src=" https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script>
        <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
        <script src="{{asset('js/parsley.js')}}"></script>
     



<!-- ICON NEEDS FONT AWESOME FOR CHEVRON UP ICON -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

   </head>
   <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark NavBarLayout NavBarText navbarcenter">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>

      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
         <a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Josefin Sans', sans-serif; font-size: 25px; ">
         Helpmate

         </a>
         @auth
         <ul class="navbar-nav mr-auto mt-2 mt-lg-0 NavBarText mx-auto">
            <li class="nav-item">
               <a class=" NavBarText nav-link" href="{{ route('home')}}">Accueil</a>
            </li>
            <li class="nav-item">
               <a class=" NavBarText nav-link" href="{{route('editeur')}}">Editeur de perso</a>
            </li>
            <li class="nav-item NavBarText">
               <a class="nav-link NavBarText" href="{{route('event')}}">Calendrier</a>
            </li>
            <li class="nav-item NavBarText">
               <a class="nav-link NavBarText" href="{{url('event-list')}}">Vos événements</a>
            </li>
            <li class="nav-item NavBarText">
               <a class="nav-link NavBarText" href="{{url('rss')}}">Flux RSS</a>
            </li>
         </ul>
         @endauth
         @guest
         <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            .
            <li class="nav-item ">
               <a class="nav-link NavBarText" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
               <a class="nav-link NavBarText" href="{{ route('register') }}">{{ __('S\'inscrire') }}</a>
            </li>
            @endif
         </ul>
         @else
         <div class="dropdown btn-dark">
            <img src="{{Auth::user()->avatar}}" id="thumb">
            <button class="btn btn-dark dropdown-toggle " type="button" data-toggle="dropdown">{{ Auth::user()->name }}
            <span class="caret"></span></button>
            <div class="dropdown NavBarText">
               <ul class="dropdown-menu dropdownMenuLayout">
                  <li><a class="nav-link NavBarText DropDownColor" href="{{ route('pageProfil') }}">
                     {{ __('Liste des personnages') }}
                     </a>
                  </li>
                  <li><a class="nav-link NavBarText DropDownColor" href="{{ route('profil') }}">
                     {{ __('Paramètres du compte') }}
                     </a>
                  </li>
                  <li><a class="nav-link NavBarText DropDownColor" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     {{ __('Se déconnecter') }}
                     </a>
                  </li>
                 
               
               </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
            </form>
         </div>
      </div>
      @endguest
      </div>
   </nav>
   <body id="mypage">

      @show
      <main>
         @yield('content')

      </main>
<!-- Return to Top -->

   </body>


  

   <script type="text/javascript">
      function applyTheme (theme) {
       "use strict"
      document.getElementById("mypage").className = theme;
      localStorage.setItem ("theme", theme);
      }

      function applyDayTheme () {
           "use strict"

      applyTheme("day");
      }

      function applyNightTheme() {
           "use strict"

      applyTheme("night");

      }

      function addButtonLestenrs () {
           "use strict"

      document.getElementById("b1").addEventListener("click", applyDayTheme);
      document.getElementById("b2").addEventListener("click", applyNightTheme);

      }

      function initiate(){
           "use strict"

      if(typeof(localStorage)===undefined)
         alert("the application can not be executed properly in this browser");
      else{
         if(localStorage.getItem("theme")===null)
            applyDayTheme();
         else
            applyTheme(localStorage.getItem("theme"));

      }
      addButtonLestenrs();
      }

      initiate();

// ===== Scroll to Top ==== 

   </script>
   <script> $(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});</script>

<script>var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
} </script>
</html>
