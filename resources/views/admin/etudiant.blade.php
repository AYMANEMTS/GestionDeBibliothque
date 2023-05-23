@extends('base')
@section('title','Etudiants')
@include('parts.navbar_moder')


@section('moder')

    <div class="content" style="margin-left: 250px;margin-top: 100px;width: 80%">
        <h1>List Etudiants : </h1><br>
        @if(isset($_GET['success']))
            <div class="alert alert-success">
                {{ $_GET['success'] }}
            </div>
        @endif
        @if(session('done'))
            <div class="alert alert-success">
                {{ session('done') }}
            </div>
        @endif
        <a href="{{ route('moder.formCreateEtudient') }}" class="btn btn-primary">Cree un etudiant</a><br><br>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">CIN</th>
                        <th scope="col">action</th>
                    </tr>
                    </thead>
                    @foreach($etd as $item)
                        @if($item->role == 'etudiant')
                    <tbody>
                    <tr>
                        <th>{{ $item->id }}</th>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->CIN }}</td>
                        <td>
                            <form action="{{ route('moder.dellet.student' , $item->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="submit">DELET</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                        @endif
                    @endforeach
                </table>

    </div>



@endsection
