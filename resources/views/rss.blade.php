@extends('layouts.app')
@section('content')
<h1>Créer un nouveau flux</h1>
<div id="replace">
   <form id="signup-form" v-on:submit.prevent='processForm'>
      <!-- name -->
      <div class="field">
         <label class="label">Nom</label>
         <input type="text" class="input" name="name" v-model='name'>
      </div>
      <!-- url -->
      <div class="field">
         <label class="label">Url</label>
         <input type="text" class="input" name="url" v-model="url">
      </div>
      <!-- submit button -->
      <div class="field has-text-right">
         <button type="submit" class="button is-danger">Submit</button>
      </div>
      <div class="success">@{{message}}</div>
   </form>
   <h1>Ajouter des filtres</h1>
   <!-- Filtres -->
<form id="filters-form" v-on:submit.prevent='FiltersForm'>
         <div class="field">
         <label class="label">Filtres</label>
         <input type="text" class="input" name="filtres" v-model="filtres">
      </div>
            <div class="field has-text-right">
         <button type="submit" class="button is-danger">Submit</button>
      </div>
</form>
   <h2> Vos flux</h2>
   <form v-on:submit.prevent='editFlux'>
      <select v-model="selected">
         <option v-for="url in urls" v-bind:value="url.id">
            @{{ url.name }}
         </option>
      </select>
      <span v-for="uri in urls">
         <div v-if='uri.id === selected'>
            <p> url : @{{uri.url}}</p>
            <button type="submit" class="button is-danger">Supprimer ce flux</button>
            </div>
      </span>
   </form>
    <h2> Vos filtres</h2>
   <form v-on:submit.prevent='editFilters'>
      <select v-model="selected1">
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
 <script src="{{ asset('js/rss.js') }}" defer></script>
@endsection