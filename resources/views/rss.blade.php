@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card RSS">
<div class="card-header">{{ __('Créer un nouveau flux') }}</div>
<div class="card-body ProfileStyleDroite" id="replace">
   <form id="signup-form" v-on:submit.prevent='processForm'>
      <!-- name -->
      <div class="field">
         <label class="label">Nom</label>
         <input type="text" class="input form-control InputProfile rssInput" name="name" v-model='name'>
      </div>
      <!-- url -->
      <div class="field">
         <label class="label">Url</label>
         <input type="text" class="input form-control InputProfile rssInput" name="url" v-model="url">
      </div>
      <!-- submit button -->
      <div class="field has-text-right">
         <button type="submit" class="button is-danger btn btn-primary buttonBleu">Envoyer</button>
      </div>
      <div class="success">@{{message}}</div>
   </form>
   <h4 style="margin-top:2%;">Ajouter des filtres</h4>
   <!-- Filtres -->
<form id="filters-form" v-on:submit.prevent='FiltersForm'>
         <div class="field">
         <label class="label">Filtres</label>
         <input type="text" class="input form-control InputProfile rssInput" name="filtres" v-model="filtres">
      </div>
            <div class="field has-text-right">
         <button type="submit" class="button is-danger btn btn-primary buttonBleu">Envoyer</button>
      </div>
</form>
   <h4 style="margin-top:2%;"> Vos flux</h4>
   <form v-on:submit.prevent='editFlux'>
      <select class ="form-control" v-model="selected">
         <option v-for="url in urls" v-bind:value="url.id">
            @{{ url.name }}
         </option>
      </select>
      <span v-for="uri in urls">
         <div v-if='uri.id === selected'>
            <p> url : @{{uri.url}}</p>
            <button type="submit" class="button is-danger btn btn-primary buttonBleu">Supprimer ce flux</button>
            </div>
      </span>
   </form>
    <h4 style="margin-top:2%;"> Vos filtres</h4>
   <form v-on:submit.prevent='editFilters'>
      <select class="form-control" v-model="selected1">
         <option v-for="filter in filters" v-bind:value="filter.id">
            @{{ filter.name }}
         </option>
      </select>
      <span v-for="filtou in filters">
         <div v-if='filtou.id === selected1'>
            
            <button type="submit" class="button is-danger">Supprimer ce filtre</button>
            </div>
      </span>
   </form>  
   


</div>
</div>
</div>
</div>
</div>

 <script src="{{ asset('js/rss.js') }}" defer></script>
@endsection