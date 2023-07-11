@extends('main')


@section('content')

<div class="center">
    <div class="single-choose  active text-center p">
        <div class="do-icon">
            <span class="flaticon-award"></span>
        </div>
        <div class="do-caption">
            <h4>Connectez-vous</h4>
            <br>

            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <form action="/login" method="post">
                @csrf
                <div class="form-group ">
                    <label for="phone">Téléphone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" aria-describedby="validationServer1Feedback" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="Numéro de téléphone">
                    <div id="validationServer1Feedback" class="invalid-feedback">
                        @error('phone')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <br>
                <div class="form-group text-start ">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password" required placeholder="Mot de passe">
                </div>
                <br>
                <button class="btn btn-primary btn-block" type="submit">Se connecter</button>
                <br>
                <br>
                <a class="text-primary lead" style="text-decoration:none" href="/register">Créer un compte</a>
            </form>
        </div>
    </div>

</div>

@endsection
