      <link href="{{ asset('css/style.css') }}" rel="stylesheet">
   @extends('layouts.app')
   @section('content')
      <body id="mypage">
   <div class="container">
   <div class="row ProfileStyle">
   <div class="col-md-offset-1 col-md-2">
      Settings 
      <div><a class="NavBarText nav-link"href="{{ route('profil') }}">Paramètres du compte </a></div>
      <div><a class="NavBarText nav-link"href="{{ route('profile') }}">Paramètres du profil </a></div>
   </div>
   <div class="col-md-offset-2 col-md-7 ProfileStyleDroite">
   <div class="form-group" id="mypage">
      <h6>Thème du site</h6>
      <button class="Daytheme btn btn-primary" id="b1"></button>
      <button class="NightTheme btn btn-primary " id="b2"></button>
   </div>
   <div class="form-group">
      <h6> Couleur du profil </h6>
      <div class="color" style="background: rgb(61, 180, 242);"></div>
      <div class="color" style="background: #81FF47;"></div>
      <div class="color" style="background:#C42929;"></div>
      <div class="color" style="background:#EA6089;"></div>
      <div class="color" style="background:#A360EA;"></div>
      <div class="color" style="background:#EF7845;"></div>
   </div>
 </div>
</div>
</div>
</body>
<script>
   function myFunction() {
       if(!confirm("Voulez-vous vraiment supprimer votre compte?"))
       event.preventDefault();
   }
   
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
   
   
   
</script>
                  <footer class="footer fixed-bottom">
  <small>© 2019 Copyright:
    <a href="{{ route('legals') }}"> My Help Mate </a> |
 <a href="{{ route('RGPD') }}"> Politique de confidentialité</a>
    </small>
  </footer>
@endsection