@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row ProfileStyle">
    <div class="col-md-offset-1 col-md-2">
      
      <div>
        <a class="NavBarText nav-link"href="{{ route('rss') }}">Liste des flux </a>
      </div>
      <div>
        <a class="NavBarText nav-link"href="{{ route('rssfiltre') }}">Liste des filtres </a>
      </div>
    </div>
    <div class="col-md-offset-2 col-md-7 ProfileStyleDroite">
    <div id="replace">
      <h4>Ajouter des filtres</h4>
      <!-- Filtres -->
      <form id="filters-form" v-on:submit.prevent='FiltersForm'>
        <div class="field">
          <label class="label">Filtres</label>
          <input type="text" class="input form-control InputProfile rssInput" name="filtres" v-model="filtres">
        </div>
        <div class="field has-text-right">
          <button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-bottom:3%;">Envoyer</button>
        </div>
      </form>
      <h4> Vos filtres</h4>
      <form v-on:submit.prevent='editFilters'>
        <div v-for="filter in filters">
          <input type="radio" v-model="selected1" :value="filter.id">
            @{{ filter.name }}  
        </div>
        <button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-top:1%;">Supprimer ce filtre</button>
      </form>
    </div>
          <div id="sync"><button v-on:click="SynchroFlux" class="button is-danger btn btn-primary buttonBleu"  style="margin-bottom:3%; margin-top: 3%;">
  Envoyer les modifications
</button>
  </div>
</div>
                  
 <script src="{{ asset('js/rss.js') }}" defer></script>
 @endsection
