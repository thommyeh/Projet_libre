<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Event</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="{{asset('css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
 <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  </head>
  
  

    <nav class="navbar navbar-inverse bg-dark btn-dark">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}">Retourner à l'accueil</a></li>
            <li><a href="{{url('event')}}">Calendrier</a></li>
            <li><a href="{{url('event-list')}}">Vos évenements</a></li>
          </ul>
          <ul class="dropdown-menu dropdownMenuLayout">
               <li><a href="{{ route('profil') }}">
               {{ __('Espace perso') }}
               </a></li>
               <li><a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
               {{ __('Se déconnecter') }}
               </a></li>
            </ul>
        </div>
      </div>
    </nav><body id="mypage">
    <div class="jumbotron">
      <div class="container">
           @yield('content')      
      </div>
    </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="{{asset('js/parsley.js')}}"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
      <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script>
    
    
   

      @section('content_script')   
      @show

</body>
</html>
