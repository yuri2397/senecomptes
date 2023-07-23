@extends('main') 

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col">
            @if (Auth::check() && $accounts && $accounts->count() > 0)
            <a href="{{ route('new-account-admin') }}" role="button" class="btn btn-primary">Ajouter nouveau compte</a>
            @endif
        </div>
        <div class="col">
            @if (Auth::check() && $accounts && $accounts->count() > 0)
            <a href="{{ route('dayly-check') }}" role="button" class="bg-success btn btn-success">Voir les comptes expirés</a>
            @endif
        </div>
    </div>

    <br><br>
    @if (Auth::check() && $accounts && $accounts->count() > 0)
        <div class="container">
            <div class="row">
                @foreach ($accounts as $account)
                <h2>ID compte {{ $account->id }}</h2>
                <div class="do-btn">
                    Email:
                    <b class="text-lowercase mx-2">{{ $account->username }}</b>
                </div>
                <br>
                <div class="do-btn">
                    Mot de passe:
                    <b class="text-lowercase mx-2">{{ $account->password }}</b>
                </div>
                <hr>
                @foreach ($account->account_items as $account_item)
                <div class="col-lg-4 col-md-6">
                    <div class="single-do active text-center mb-30 p-3">
                        <div class="do-caption">
                            <h2 class="">
                                ID <b>{{ $account_item->id }}</b>
                            </h2>
                            <br>
                            <div class="footer-tittle text-start">
                                <div class="do-btn">
                                    <a>
                                        <i class="ti-arrow-right"></i>
                                        CODE PIN:
                                        <b class="text-lowercase mx-2">{{ $account_item->pin}}</b>
                                    </a>
                                </div>
                                <br>
                                <div class="do-btn">
                                    <a>
                                        <i class="ti-arrow-right"></i>
                                        Utilisateur:
                                        <b class="text-lowercase mx-2">
                                            @if ($account_item->user)
                                            <span class="text-uppercase">{{ $account_item->user->name}}</span>
                                            @else
                                            <span class="text-success text-uppercase">Aucun</span>
                                            @endif
                                        </b>
                                    </a>
                                </div>
                                <br>
                                <div class="do-btn">
                                    <a>
                                        <i class="ti-arrow-right"></i>
                                        Statut:
                                        <b class="text-lowercase mx-2">
                                            @if ($account_item->status)
                                            <span class="text-success text-uppercase">Actif</span>
                                            @else
                                            <span class="text-danger text-uppercase">Inactif</span>
                                            @endif
                                        </b>
                                    </a>
                                </div>
                                @if ($account_item->user)
                                <br>
                                <div class="alert alert-danger">
                                    Expire le : {{ $account_item->limit_at }}
                                </div>
                                @endif
                                <br>
                                <br>
                                <form method="POST" action="{{ route('new-pin') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $account_item->id }}">
                                    <button class="btn btn-success btn-sm">Regenerer code PIN</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <hr>
                @endforeach
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
                        <br>
                        <p>
                            Aucun compte disponible.
                        </p>
                        <br>

                    </div>
                    <a href="{{ route('new-account-admin') }}" role="button" class="btn btn-primary">Ajouter nouveau compte</a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
