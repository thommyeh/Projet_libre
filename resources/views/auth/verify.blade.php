
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'My Waifu') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/bulma.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirmer votre adresse E-mail') }}</div>

                <div class="card-body">
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
</body>