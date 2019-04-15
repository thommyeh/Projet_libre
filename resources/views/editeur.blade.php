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
<script src="{{ asset('js/canvas2image.js') }}"></script>
<div>
    <p>
        <button id="save">Save</button>
    </p>
</div>

<script>

    var canvas, $save;

    function bind () {
        $save = document.getElementById('save');
        $save.onclick = function (e) {
            Canvas2Image.saveAsImage(document.getElementsByTagName('canvas')[0], '1024', '768', 'png');
        }
    }
    onload = bind;

</script>

</div>
@endsection
