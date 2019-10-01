
@extends('layouts.app')
@section('content')
<body id="mypage">
<div class="container ListePerso" style="padding-top:1%;">
	@foreach($characters as $character)
	<div class="columns ">
  <div class="column PersoUnique col-md-offset-2 col-md-7 ProfileStyleDroite">
    <img src='Assistant/assistants/{{$user->name."-".$character->name}}.png'>
    {{$character->name}} {{$character->choosen}}
    <form action="{{route('delete_character', ['id' => $character->id])}}" method="POST">

               @csrf
               <div class="place">
               <button class="btn btn-primary buttonBleu" style="margin:2px;" type="submit" onclick="myFunction()">Supprimer ce personnage</button>
            </form>

            <form action="{{route('use_character', ['id' => $character->id])}}" method="POST">

               @csrf
               <button class="btn btn-primary buttonBleu" style="margin:2px;" type="submit" onclick="myFunction1()">Utiliser ce personnage comme avatar</button>
               </div>
            </form>
                        <form action="{{route('choose_character', ['id' => $character->id])}}" method="POST">

               @csrf
               <button class="btn btn-primary buttonBleu" style="margin:2px;" type="submit" onclick="myFunction2()">Utiliser comme personnage principal</button>
               </div>
            </form>
  </div>

@endforeach
</div>

</body>
<script>

         function myFunction() {
       if(!confirm("Voulez-vous vraiment supprimer ce personnage?"))
       event.preventDefault();
   }
            function myFunction1() {
       if(!confirm("Utiliser ce personnage comme avatar?"))
       event.preventDefault();
   }
               function myFunction2() {
       if(!confirm("Utiliser ce personnage dans votre navigateur?"))
       event.preventDefault();
   }
   </script>
      <footer class="footer fixed-bottom">
  <small>© 2019 Copyright:
    <a href="{{ route('legals') }}"> My Help Mate</a>
 <a href="{{ route('RGPD') }}"> Politique de confidentialité</a>
    </small>
  </footer>
@endsection
