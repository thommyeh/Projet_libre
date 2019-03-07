
@extends('layouts.app')

@section('content')
<div>
 <img src="img/{{Auth::user()->avatar}}" id="large">&nbsp;{{Auth::user()->name}}
</div>
{!! Form::open(['route' => 'edit', 'ng-submit' => "addprofil()", 'enctype' => "multipart/form-data"]) !!}

<div class="form-group">
    {!! Form::label('name', 'Nom') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=> $name, 'ng-model'=>"newProfil"]) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Adresse e-mail') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder'=> $email]) !!}
</div>

<div class="form-group">
    {!! Form::label('avatar', 'Avatar') !!}
    {!! Form::file('avatar', null, ['class' => 'file-input']) !!}
</div>




<p>
{!! Form::submit('Editer', ['class' => 'button is-info']) !!}
</p>
{!! Form::close() !!}
<div>
	<p>

<form action="{{route('delete')}}" method="POST">
 @method('DELETE')
 @csrf
 <button type="submit">Supprimer mon compte</button>               
</form>

</div>
</p>
<p>
<a href="/home">Retourner a l'accueil</a>
</p>
<script>
  function myFunction() {
      if(!confirm("Voulez-vous vraiment supprimer votre compte?"))
      event.preventDefault();
  }
 </script>
@endsection