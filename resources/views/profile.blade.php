@extends('main') @section('content')

<div class="active text-center p">
    <div class="do-icon">
        <span class="flaticon-award"></span>
        <div class="container mt-1">
            @if (Auth::check() && $account_items && $account_items->count() > 0)
            <a href="{{ route('new-account') }}" role="button" class="btn btn-primary">Ajouter un nouveau profil</a>
            <br>
            <br>
            <div class="what-we-do">
                <div class="container">
                    <div class="row">

                        @foreach ($account_items as $account_item)
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="single-do active text-center" style="background: #f1f1f1">
                                <div class="do-caption" >
                                    <h3 class="">
                                        Profil <b>{{ $account_item->reference }}</b>
                                    </h3>
                                    <br>
                                    <div class="footer-tittle text-start">
                                        <div class="do-btn">
                                            <a>
                                                Email:
                                                <b class="text-lowercase mx-2 h6 text-dark">{{ $account_item->account->username }}</b>
                                            </a>
                                        </div>
                                        <br>
                                        <div class="do-btn">
                                            <a>
                                                Mot de passe:
                                                <b class="text-lowercase mx-2  h6 text-dark">{{ $account_item->account->password }}</b>
                                            </a>
                                        </div>
                                        <br>
                                        <div class="do-btn">
                                            <a>
                                                
                                                CODE PIN:
                                                <b class="text-lowercase mx-2 h6 text-dark">{{ $account_item->pin}}</b>
                                            </a>
                                        </div>
                                        <br>
                                        <div class="alert alert-danger">
                                            Expire le : {{ $account_item->limit_at }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-lg-4 mt-3 col-md-6 center">
                    <div class="single-choose rounded rounded-4 p-3 active text-center mb-30">
                        <div class="do-icon">
                            <span class="flaticon-award"></span>
                        </div>
                        <div class="do-caption m-auto">
                            <h1><b>2 500 FCFA</b></h1>
                            <div class="do-caption">
                                <h4>Plan d'abonnement de base</h4>
                                <p>
                                    Profitez du partage de compte Netflix avec
                                    notre plan d'abonnement de base pour
                                    seulement 2 500 FCFA par mois.
                                </p>
                            </div>
                            <a href="{{ route('new-account') }}" role="button" class="btn btn-primary">J'achéte un compte</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
