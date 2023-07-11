@extends('main')


@section('content')

<div class="center">
    <div class="single-choose  active text-center p">
        <div class="do-icon">
            <span class="flaticon-award"></span>
        </div>
        <div class="do-caption">
            <h4>Créer votre compte</h4>
            <br>

            <form action="/register" method="post">
                @csrf
                <div class="form-group text-start has-validation">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" aria-describedby="validationServer1Feedback" name="name" id="name" required placeholder="Nom complet">
                    <div id="validationServer1Feedback" class="invalid-feedback">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group text-start has-validation">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="text" value="{{ old('phone') }}" name="phone" aria-describedby="validationServer2Feedback" class="form-control @error('phone') is-invalid @enderror" id="phone" required placeholder="Numéro de téléphone">
                    <div id="validationServer2Feedback" class="invalid-feedback">
                        @error('phone')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group text-start ">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " aria-describedby="validationServer3Feedback" id="password" required placeholder="Mot de passe">
                    <div id="validationServer3Feedback" class="invalid-feedback">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <br>
                <button class="btn btn-primary btn-block" type="submit">Créer mon compte</button>
                <br>
                <br>
                <a class="text-primary lead" style="text-decoration:none" href="/login">J'ai déjà un compte</a>

            </form>
        </div>
    </div>
</div>


@endsection
