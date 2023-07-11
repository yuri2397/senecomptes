@extends('main')


@section('content')

<div class="center">
    <div class="single-choose  active text-center p">
        <div class="do-icon">
            <span class="flaticon-award"></span>
        </div>
        <div class="do-caption">
            <h4>Ajouter un compte</h4>
            <br>

            <form action="/new-account-admin" method="post">
                @csrf
                <div class="form-group text-start has-validation">
                    <label for="username" class="form-label">Email du compte</label>
                    <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" aria-describedby="validationServer1Feedback" name="username" id="username" required placeholder="Email du compte">
                    <div id="validationServer1Feedback" class="invalid-feedback">
                        @error('username')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group text-start has-validation">
                    <label for="password" class="form-label">Mot de passe du compte</label>
                    <input type="text" value="{{ old('password') }}" name="password" aria-describedby="validationServer2Feedback" class="form-control @error('password') is-invalid @enderror" id="password" required placeholder="Mot de passe du compte">
                    <div id="validationServer2Feedback" class="invalid-feedback">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group text-start ">
                    <label for="nb_profile" class="form-label">Nombre de profil</label>
                    <input type="number" min="1" name="nb_profile" class="form-control @error('nb_profile') is-invalid @enderror " aria-describedby="validationServer3Feedback" id="nb_profile" required placeholder="Nombre de profil">
                    <div id="validationServer3Feedback" class="invalid-feedback">
                        @error('nb_profile')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <br>
                <button class="btn btn-primary btn-block" type="submit">Ajouter</button>
            </form>
        </div>
    </div>
</div>


@endsection
