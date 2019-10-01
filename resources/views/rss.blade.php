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
			<h4>Créer un nouveau flux</h4>
			<form id="UrlForm" v-on:submit.prevent='newUrl'>
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
        <div>
        <input type="radio" v-model="selected2" value="actu" id="actu">
            Actu
            <input type="radio" v-model="selected2" value="telechargement" id="telechargement">
            Téléchargement
          </div>
				<div v-html='message'></div>
				<validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
				<!-- submit button -->
				<div class="field has-text-right">
					<button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-bottom:3%;">Envoyer</button>
				</div>
			</form>
			<h4> Vos flux</h4>
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
					<button type="submit" class="button is-danger btn btn-primary buttonBleu" style="margin-top:1%;">Supprimer ce flux</button>
				</form>
			</div>
	<div id="sync">
		<button v-on:click="SynchroFlux" class="button is-danger btn btn-primary buttonBleu"  style="margin-bottom:3%; margin-top: 3%;">Envoyer les modifications</button>
	</div>
</div>
</div>
</div>
<script src="{{ asset('js/rss.js') }}" defer></script>
   <footer class="footer fixed-bottom">
  <small>© 2019 Copyright:
    <a href="{{ route('legals') }}"> My Help Mate</a>
 <a href="{{ route('RGPD') }}"> Politique de confidentialité</a>
    </small>
  </footer>
@endsection
