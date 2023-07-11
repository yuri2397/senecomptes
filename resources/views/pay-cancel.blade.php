@extends('main')

@section('content')
<div class="row">
    <div class="col-lg-4 mt-3 col-md-6 center">
        <div class="single-choose rounded rounded-4 p-3 active text-center mb-30">
            <div class="do-icon">
                <span class="flaticon-award"></span>
            </div>
            <div class="do-caption m-auto">
                
                <h2>
                    Abonnement annulé
                </h2>
                <div class="do-caption">
                    <p>
                        Votre abonnement a été annulé. Vous pouvez réessayer plus tard.
                    </p>
                </div>
                @if (Auth::check())
                <a href="{{ route('profile') }}" role="button" class="btn btn-primary">Voir profil</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
