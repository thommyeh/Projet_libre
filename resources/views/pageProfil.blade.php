
@extends('layouts.app')
@section('content')
<body id="mypage">
<div class="container">
	<h1>Vos personnages</h1>
	@foreach($characters as $character)
	<div class="columns">
  <div class="column">
    <img src='storage/{{$character->name}}.png'>
    {{$character->name}}
    <form action="{{route('delete_character', ['id' => $character->id])}}" method="POST">
               
               @csrf
               <button class="btn btn-primary buttonBleu" type="submit" onclick="myFunction()">Supprimer ce personnage</button>               
            </form>

            <form action="{{route('use_character', ['id' => $character->id])}}" method="POST">
               
               @csrf
               <button class="btn btn-primary buttonBleu" type="submit" onclick="myFunction1()">Utiliser ce personnage comme avatar</button>               
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
   </script>
@endsection