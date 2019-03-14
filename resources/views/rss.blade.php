@extends('layouts.app')

@section('content')


<h1>Créer un nouveau flux</h1>



{{--{!! Form::open(['route' => 'createrss', 'ng-submit' => "addprofil()", 'enctype' => "multipart/form-data"]) !!}

<div class="form-group">
    {!! Form::label('name', 'Nom') !!}
    {!! Form::text('name', null, ['class' => 'form-control','ng-model'=>"newProfil"]) !!}
</div>

<div class="form-group">
    {!! Form::label('url', 'URL') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>






<p>
{!! Form::submit('Valider', ['class' => 'button is-info']) !!}
</p>
{!! Form::close() !!} --}}
<div id="replace">
<form id="signup-form" v-on:submit.prevent='processForm'>
      <!-- name -->
      <div class="field">
        <label class="label">Nom</label>
        <input type="text" class="input" name="name" v-model='name'>
      </div>

      <!-- email -->
      <div class="field">
        <label class="label">Url</label>
        <input type="text" class="input" name="url" v-model="url">
      </div>

       <div class="field">
        <label class="label">Filtres (séparés par une virgule)</label>
        <input type="text" class="input" name="filtres" v-model="filtres">
      </div>

      <!-- submit button -->
      <div class="field has-text-right">
        <button type="submit" class="button is-danger">Submit</button>
      </div>
      <div class="success">@{{message}}</div>
    </form>


<h1> Vos flux</h1>


<form v-on:submit.prevent='editFlux'>
<select v-model="selected">
  <option v-for="url in urls" v-bind:value="url.id">
    @{{ url.name }}
  </option>
</select>
<span v-for="uri in urls">
	<div v-if='uri.id === selected'>
		
		<p> url : @{{uri.url}}</p>
		<p v-for='filter in uri.filters'>
			Filtres: @{{filter.name}}
		</p>
		<button type="submit" class="button is-danger">Supprimer ce flux</button>
		
	
 

</span>
</form>
</div>
</div>

   

 

{{--<input type="text" id="input" v-model='message'>
<p>la valeure est: @{{ message }}</p>--}}






@endsection