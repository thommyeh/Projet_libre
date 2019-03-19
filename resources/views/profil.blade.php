<body id="mypage">
   @extends('layouts.app')
   @section('content')
   <div class="container">
      <div class="row ProfileStyle">
         <div class="col-md-offset-1 col-md-2">
            Settings 
            <div><a class="NavBarText nav-link"href="{{ route('profil') }}">Paramètres du compte </a></div>
            <div><a class="NavBarText nav-link"href="{{ route('profile') }}">Paramètres du profil </a></div>
         </div>
         <div class="col-md-offset-2 col-md-7 ProfileStyleDroite">
            <div id="profil-edit">
            <form id="editform" v-on:submit.prevent='EditProfil'>
         <div class="field">
             <label class="label">Nom d'utilisateur</label>
         <input type="text" class="input" name="name" v-model="name" v-bind:placeholder="user.name">
      </div>
      <div class="filed">
          <label class="label">Adresse E-mail</label>
         <input type="text" class="input" name="email" v-model="email" v-bind:placeholder="user.email">
      </div>
      <p>@{{message}}</p>
            <div class="field has-text-right">
         <button type="submit" class="button is-danger btn btn-primary buttonBleu">Modifier</button>
      </div>
</form>
</div>
            <form action="{{route('delete')}}" method="POST">
               @method('DELETE')
               @csrf
               <button class="btn btn-primary buttonBleu" type="submit" onclick="myFunction()">Supprimer mon compte</button>               
            </form>
         </div>
      </div>
   </div>
   <script>
         function myFunction() {
       if(!confirm("Voulez-vous vraiment supprimer votre compte?"))
       event.preventDefault();
   }
   </script>
    <script src="{{ asset('js/profil.js') }}" defer></script>
</body>
<script></script>
@endsection