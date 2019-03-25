@extends('layouts.app')
@section('content')
 <body id="mypage">
<div class="container">
    <div class="row justify-content-center">
 <div class="col-md-8">
            <div class="card RSS">


                <div class="card-header">{{ __('Confirmer votre adresse E-mail') }}</div>
        <div class=" ProfileStyleDroite">
            <div class="card-body ProfileStyleDroite">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nouveau lien de confirmation a été envoyé a votre adresse E-mail') }}
                        </div>
                    @endif

                    {{ __('Pour activer votre compte, veuillez cliquer sur le lien de validation envoyé a votre adresse E-mail.') }}
                    {{ __('Pour reçevoir a nouveau le mail de confirmation') }}, <a href="{{ route('verification.resend') }}">{{ __('Cliquer ici pour en reçevoir un nouveau') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
@endsection