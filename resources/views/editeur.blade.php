@extends('layouts.app')

@section('sidebar')

@endsection
@section('content')
<script src="{{ asset('js/phaser.min.js') }}"></script>
<div class="container">
  <div class="row justify-content-center">
    <div class="row no-gutters">
      <div class="col-6 col-md-4">
        <div class="game">

<script src="{{ asset('js/designer.js') }}"></script>

<script>
//Images Preloader
var imgLoader = @json($imgLoader);
</script>

<script src="{{ asset('js/FileSaver.js') }}"></script>

<canvas id="canvas2" width="96px" height="96px"></canvas>

        </div>
      </div>
    </div>
  </div>
</div>
<div id="character">
    <p>
      <form id="form" v-on:submit.prevent='Form'>
         <div class="col-xs-2">
         <label class="label">Nom de votre personnage</label>
         <p>
         <input type="text" name="name" v-model="name" id="name">
      </p>
      </div>
            <div class="field has-text-right">
      <button id="save" type="submit">Save</button>
      </div>

</form>


    </p>


</div>

<script>

function saveButton () {

  var save = document.getElementById('save');
  var sourceCanvas = document.getElementsByTagName("canvas")[1];
  var destCanvas = document.getElementById("canvas2");

  save.onclick = function () {

    var sourceImageData = sourceCanvas.toDataURL("image/png");
    var destCanvasContext = destCanvas.getContext('2d');
    var destinationImage = new Image;
    destinationImage.onload = function(){
      destCanvasContext.drawImage(destinationImage,464,250,96,96,0,0,96,96);
/*
      destCanvas.toBlob(function(blob) {
       saveAs(blob, character.name+'.png');
*/
    var dataURL = destCanvas.toDataURL();

    $.ajax({
    type: "POST",
    url: "/avatar",
    data: {
        imgBase64: dataURL
    }
}).done(function(o) {
    console.log('saved');

});

      });
    };
    destinationImage.src = sourceImageData;
  }
}
onload = saveButton;

</script>
<script src="{{ asset('js/character.js') }}" defer></script>
@endsection
