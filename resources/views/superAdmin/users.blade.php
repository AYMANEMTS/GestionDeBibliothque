@extends('base')
@section('title','Dashbord')
@include('parts.navbar_super')
@section('super')


    <div class="content" style="margin-left: 250px;margin-top: 100px;width: 80%">
        <h3 class="text-mg text-bg-dark"><strong>Utilisateurs</strong></h3>


        <a href="{{ route('admin.add.user') }}" class="btn btn-secondary">Cree Un User</a><br><br>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td><a href="{{ route('admin.change.user.rol',$user->id) }}"><i class="fa-sharp fa-solid fa-bars"></i></a></td>
        </tr>
        @endforeach

        </tbody>
    </table>
        {{ $users->links() }}
    </div>
@endsection
