
@extends('layouts.app')
@section('content')
<body id="mypage">
<div class="container">
	<h1>Vos personnages</h1>
	@foreach($characters as $character)
	<div class="columns">
  <div class="column">
    <img src='storage/{{$character->name}}.png'>
    {{$character->name}}
  </div>
@endforeach
</div>

</body>
@endsection