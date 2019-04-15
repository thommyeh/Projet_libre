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
            {!! Form::open(['route' => 'edit', 'ng-submit' => "addprofil()", 'enctype' => "multipart/form-data"]) !!}
            <div class="form-group">
               {!! Form::label('name', 'Nom') !!}
               {!! Form::text('name', null, ['class' => 'form-control InputProfile', 'placeholder'=> $name, 'ng-model'=>"newProfil"]) !!}
            </div>
            <div class="form-group ">
               {!! Form::label('email', 'Adresse e-mail') !!}
               {!! Form::text('email', null, ['class' => 'form-control InputProfile', 'placeholder'=> $email]) !!}
            </div>
            <div class="form-group">
               {!! Form::label('avatar', 'Avatar') !!}
               {!! Form::file('avatar', null, ['class' => ' form-control button']) !!}
            </div>
            <p>
               {!! Form::submit('Editer', ['class' => 'button is-info btn btn-primary buttonBleu']) !!}
            </p>
            {!! Form::close() !!} 
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
</body>
<script></script>
@endsection