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
    {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
</div>





{!! Form::submit('Editer', ['class' => 'btn btn-info']) !!}

{!! Form::close() !!}

<a href="/home">Retourner a l'accueil</a>
@endsection