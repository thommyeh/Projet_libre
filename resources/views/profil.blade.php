@extends('layouts.app')

@section('content')

Profil:

{!! Form::open(['route' => 'edit', 'ng-submit' => "addprofil()"]) !!}

<div class="form-group">
    {!! Form::label('name', 'Nom') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=> $name, 'ng-model'=>"newProfil"]) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Adresse e-mail') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder'=> $email]) !!}
</div>





{!! Form::submit('Editer', ['class' => 'btn btn-info']) !!}

{!! Form::close() !!}

<a href="/home">Retourner a l'accueil</a>
@endsection