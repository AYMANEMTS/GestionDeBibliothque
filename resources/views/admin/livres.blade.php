@extends('admin.base')
@section('moder2')

    <div class="container-fluid" >
        <h1>List Livres : </h1><br>
        @if(session('done'))
            <div class="alert alert-success">
                {{ session('done') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('moder.livre.FormCreate') }}" class="btn btn-primary">Cree un Livre</a><br><br>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Livre</th>
                <th>Autheur</th>
                <th>Categorie</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            @foreach($livre as $book)
            <tbody>
            <tr>
                <td>{{ $book->id }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img
                            src="{{ asset('./images_Livres/'.$book->image) }}"
                            alt=""
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                        />
                        <div class="ms-3">
                            <p class="fw-bold mb-1">{{ $book->titre }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1">{{ $book->autheur }}</p>
                </td>

                <td>{{ $book->categorie }}</td>
                <td>
                    @if($book->dispo == 1)
                    <span class="badge badge-success rounded-pill d-inline bg-success">Disponible</span>
                    @else
                        <span class="badge badge-success rounded-pill d-inline bg-secondary">Not Disponible</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('moder.livre.show',$book->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-primary">View</a>
                    <a href="{{ route('moder.livre.update',$book->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-secondary">Edit</a>
                    <a href="{{ route('moder.Formdelete.livre' , $book->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>


        <div style="padding-top: 40px;padding-bottom: 40px">
        {{ $livre->links() }}
        </div>
    </div>




@endsection
