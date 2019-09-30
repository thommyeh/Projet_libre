@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
   <footer class="footer fixed-bottom">
  <small>© 2019 Copyright:
    <a href="{{ route('legals') }}"> My Help Mate</a>
 <a href="{{ route('RGPD') }}"> Politique de confidentialité</a>
    </small>
  </footer>
@endsection
