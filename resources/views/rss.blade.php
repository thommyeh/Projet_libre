@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">

<div id="replace">
<div class="float-left">

 <div id="top-left">
      <h4>Créer un nouveau flux</h4>
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
      <div v-html='message'>
      </div>
<validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
      <!-- submit button -->
      <div class="field has-text-right">
         <button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-top:3%;">Envoyer</button>
      </div>
   </form>
</div>

 <div id="bottom-left">
    <h4> Vos flux</h4>
<form v-on:submit.prevent='editFlux' id="formu">
  <div v-for="url in urls">
              <input type="radio" v-model="selected" :value="url.id" id="raydio">  @{{ url.name }}
              <div v-if="url.id === selected">
    <p class='alert alert-success'> url : @{{url.url}}</p>
 </div>
  </div>
  <button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-top:3%;">Supprimer ce flux</button>
 </form>
</div>
</div>
<div class="float-right">

<div id="top-right">
   <h4>Ajouter des filtres</h4>
   <!-- Filtres -->
<form id="filters-form" v-on:submit.prevent='FiltersForm'>
         <div class="field">
         <label class="label">Filtres</label>
         <input type="text" class="input form-control InputProfile rssInput" name="filtres" v-model="filtres">
      </div>
            <div class="field has-text-right">
         <button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-top:3%;">Envoyer</button>
      </div>
</form>
</div>

<div id="bottom-right">
    <h4> Vos filtres</h4>
<form v-on:submit.prevent='editFilters'>
  <div v-for="filter in filters">
              <input type="radio" v-model="selected1" :value="filter.id">  @{{ filter.name }}
  </div>
  <button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-top:3%;">Supprimer ce filtre</button>
 </form>
</div>
</div>
</div>
</div>
</div>
 <script src="{{ asset('js/rss.js') }}" defer></script>
@endsection
