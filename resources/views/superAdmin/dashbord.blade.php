@extends('base')
@section('title','Dashbord')

@section('super')
    <h1>Super admin </h1>

    <h2>welcom {{ $user->username }}</h2>


    <h3><a href="{{ route('showSuper') }}">Ajouter Super admin</a></h3>
    <h3><a href="{{ route('moder.create') }}">Ajouter moder</a></h3>

<span class="text-mg text-bg-dark"><strong>Utilisateurs</strong></span>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
        </tr>
        @endforeach

        </tbody>
    </table>


    <p><a href="{{ route('logout') }}">Logout</a></p>
@endsection
