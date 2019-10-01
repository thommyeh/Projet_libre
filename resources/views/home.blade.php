@extends('layouts.app')

@section('content')

<div>
Bienvenue sur le site de Helpmate, votre assistant personnel de navigation web !

Ce portail vous permet de contrôler les différents aspects de l'extension.
Inscrivez vous pour personnaliser votre Helpmate et beneficier de ses fonctionnalitées.

Helpmate vous permet d'être informé en temps réel de la publication d'articles ou de fichiers sur vos sites favoris ainsi que de planifier vos évènements sur notre calendrier.
Une fois téléchargé, votre compagnon serra ensuite présent sur votre navigateur à tout moment pour pour vous prévenir de publications relatives à vos intérets ou encore vous rappeller des évnènements importants.
</div>
<div>
<a href="Helpmate.zip" download>Télécharger l'extension Firefox</a> 
</div>


                  <footer class="footer fixed-bottom">
  <small>© 2019 Copyright:
    <a href="{{ route('legals') }}"> My Help Mate</a>
 <a href="{{ route('RGPD') }}"> Politique de confidentialité</a>
    </small>
  </footer>
@endsection
