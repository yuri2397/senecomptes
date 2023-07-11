@extends('main')

@section('content')
<div class="active text-center p">
    <div class="do-icon">
        <div class="container mt-4">
            <h1>Liste des utilisateurs</h1>
            <br>
            <table class="table table-light">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nom</td>
                        <td>Téléphone</td>
                        <td>Mot de passe</td>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>********</td>
                        <th>
                            <a href="update-user/{{ $user->id }}" class="text-danger">Modifier</a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
