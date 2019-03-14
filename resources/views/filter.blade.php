@extends('layouts.app')

@section('content')

<div id="filter">
	<h1>Fluxs</h1>
<ul>
    

   <li v-for='url in urls'>
   	<div v-for='filter in url.filters'>
   	<strong>
   	@{{url.name}}
   </strong>
   	<p>Url</p>
   	  @{{url.url}} 
   	  <p>Filtres</p>
   	  @{{filter.name}}
   	  <p>
   	  	<div id="filters">
   	  <input type="text" id="input" v-model='newfilter'>
<button @click='addfilter'>Ajouter un filtre</button>
   	  </p>
   	</div>
   	 		</li> 
   	  
   	  
   

   	
     
 
</ul>




{{--<input type="text" id="input" v-model='message'>
<p>la valeure est: @{{ message }}</p>--}}


</div>
@endsection