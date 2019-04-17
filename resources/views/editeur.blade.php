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
#save {
    position: absolute;
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
<script src="{{ asset('js/FileSaver.js') }}"></script>
<div>
    <p>
        <button id="save">Save</button>
    </p>
</div>
<canvas id="canvas2" width="96px" height="96px"></canvas>
</div>

<script>

function saveButton () {

  var save = document.getElementById('save');
  var sourceCanvas = document.getElementsByTagName("canvas")[1];
  var destCanvas = document.getElementById("canvas2");

  save.onclick = function () {

    console.log(sourceCanvas);
    console.log(destCanvas);
    var sourceImageData = sourceCanvas.toDataURL("image/png");
    var destCanvasContext = destCanvas.getContext('2d');

    var destinationImage = new Image;
    destinationImage.onload = function(){
      destCanvasContext.drawImage(destinationImage,464,250,96,96,0,0,96,96);
      destCanvas.toBlob(function(blob) {
       saveAs(blob, "avatar.png");
      });
    };
    destinationImage.src = sourceImageData;
  }
}
onload = saveButton;

</script>
@endsection
