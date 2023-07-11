@extends('main')


@section('content')

<div class="center">
    <div class="single-choose  active text-center p">
        <div class="do-icon">
            <span class="flaticon-award"></span>
        </div>
        <div class="do-caption">
            <h4>Modifier le user</h4>
            <br>

            <form action="/update-user" method="post">
                @csrf
                <input hidden type="text" value="{{ $user->id }}" name="id" id="id" required>
                <div class="form-group text-start has-validation">
                    <label for="name" class="form-label">Nom complet</label>
                    <input disabled type="text"  value="{{ $user->name }}" class="form-control" name="name" id="name" required placeholder="Nom complet">

                </div>
                <div class="form-group text-start has-validation">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input disabled type="text" value="{{ $user->phone }}" name="phone" class="form-control" id="phone" required placeholder="Numéro de téléphone">
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
                <button class="btn btn-primary btn-block" type="submit">Modifier</button>
                <br>
                <br>
                <a class="text-primary lead" style="text-decoration:none" href="/users">Annuler</a>

            </form>
        </div>
    </div>
</div>

@endsection
