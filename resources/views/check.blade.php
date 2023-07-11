@extends('main')

@section('content')

<div class="active text-center p">
    <div class="do-icon">
        <div class="container mt-4">
            <h1>Liste des comptes à modifier leur mot de passe</h1>
            <br>
            <table class="table table-light">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Numéro</td>
                        <td>Pin</td>
                        <td>Compte ID</td>
                        <td>Compte Email</td>
                        <td>Compte Password</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($toChange as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->reference }}</td>
                        <td>{{ $item->pin }}</td>
                        <td>{{ $item->account->id }}</td>
                        <td>{{ $item->account->username }}</td>
                        <td>{{ $item->account->password }}</td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
