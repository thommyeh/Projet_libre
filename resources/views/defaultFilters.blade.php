@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row ProfileStyle">
    <div class="col-md-offset-1 col-md-2">
      <div>
        <a class="NavBarText nav-link" href="{{ route('rss') }}">Flux </a>
      </div>
      <div>
        <a class="NavBarText nav-link" href="{{ route('rssfiltre') }}">Filtres </a>
      </div>
      <div>
        <a class="NavBarText nav-link" href="{{ route('suggestions') }}">Suggestions </a>
      </div>
    </div>
    <div class="col-md-offset-2 col-md-7 ProfileStyleDroite">
      <div id="replace">
        <p>
        <h4>Téléchargement</h4>
      </p>
        <!-- Filtres -->

        <div class="d-inline p-2" v-for="prefilter in defaultfilters" v-if="prefilter.cate == 'telechargement'">

          <button type="submit" @click="addDefault(prefilter.id)" class="btn btn-success"
            style="margin-top:1%;">@{{prefilter.name}}</button>

        </div>
        <p>
        <h4>Presse généraliste</h4>
      </p>
        <!-- Filtres -->

        <div class="d-inline p-2" v-for="prefilter in defaultfilters" v-if="prefilter.cate == 'general'">

          <button type="submit" @click="addDefault(prefilter.id)" class="btn btn-info"
            style="margin-top:1%;">@{{prefilter.name}}</button>

        </div>
        <p>
        <h4>Jeux Vidéos/ Numérique</h4>
      </p>
        <!-- Filtres -->

        <div class="d-inline p-2" v-for="prefilter in defaultfilters" v-if="prefilter.cate == 'numerique'">

          <button type="submit" @click="addDefault(prefilter.id)" class="btn btn-primary"
            style="margin-top:1%;">@{{prefilter.name}}</button>

        </div>

        <p>
            <h4>Économie</h4>
          </p>
            <!-- Filtres -->
    
            <div class="d-inline p-2" v-for="prefilter in defaultfilters" v-if="prefilter.cate == 'eco'">
    
              <button type="submit" @click="addDefault(prefilter.id)" class="btn btn-warning"
                style="margin-top:1%;">@{{prefilter.name}}</button>
    
            </div>
<p>
        <h4> Vos flux</h4>
      </p>
        <form v-on:submit.prevent='editFlux' id="formu">
          <div v-for="url in urls">
            <input type="radio" v-model="selected" :value="url.id" id="raydio">
            @{{ url.name }}
            <div v-if="url.id === selected">
              <p class='alert alert-success'>
                url : @{{url.url}}

              </p>

            </div>
          </div>
          <button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-top:1%;">Supprimer ce
            flux</button>
        </form>

      </div>
      <div id="sync">
        <button v-on:click="SynchroFlux" class="button is-danger btn btn-primary buttonBleu"
          style="margin-bottom:3%; margin-top: 3%;"> Envoyer les modifications</button>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/rss.js') }}" defer></script>
<footer class="footer fixed-bottom">
  <small>© 2019 Copyright:
    <a href="{{ route('legals') }}"> My Help Mate </a> |
    <a href="{{ route('RGPD') }}"> Politique de confidentialité</a>
  </small>
</footer>
@endsection