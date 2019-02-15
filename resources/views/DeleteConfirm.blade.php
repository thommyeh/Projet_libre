@extends('layouts.app')

@section('content')
Votre profil a bien été supprimé
@endsection

<script>

setTimeout(function(){ window.location.href= '{{route("home")}}';}, 1500);
 
</script>