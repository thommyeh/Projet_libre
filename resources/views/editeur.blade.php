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
    <div id="character">
    <p>
      <form id="form" v-on:submit.prevent='Form'>
         <div class="col-xs-2" style="text-align: center;">
         <label class="label">Nom de votre personnage</label>
         <p>
         <input class="form-control InputProfile" type="text" name="name" v-model="name" id="name">
                   <div class="field has-text-right">
      <button class="btn btn-primary buttonBleu" id="save" type="submit" style="margin-top: 300%;">Sauvegarder le personnage</button>
      </div>
      </p>

      </div>
  

</form>

    </p>

</div>
  </div>

</div>

   <footer class="footer fixed-bottom">
  <small>© 2019 Copyright:
    <a href="{{ route('legals') }}"> My Help Mate</a>
 <a href="{{ route('RGPD') }}"> Politique de confidentialité</a>
    </small>
  </footer>
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
      destCanvasContext.drawImage(destinationImage,352,202,96,96,0,0,96,96);
    var dataURL = destCanvas.toDataURL();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $.ajax({
    type: "POST",
    url: "/avatar",
    data: {
        imgBase64: dataURL,
        name: character.name
    }
}).done(function(o) {
    window.location.replace("http://127.0.0.1:8000/pageProfil");;

});

      };

    destinationImage.src = sourceImageData;
    };
  };
onload = saveButton;

</script>
<script src="{{ asset('js/character.js') }}" defer></script>


@endsection
