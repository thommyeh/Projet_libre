@extends('layouts.app')
@section('sidebar')
@endsection
@section('content')
<script src="{{ asset('js/phaser.min.js') }}"></script>
<style>
canvas {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    border: 2px solid black;
    border-radius: 9px;
}
</style>
<div class="game">
<script src="{{ asset('js/designer.js') }}"></script>
<script>
//Images Preloader
var imgLoader = @json($imgLoader);
</script>
</div>
@endsection
