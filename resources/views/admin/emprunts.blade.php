@extends('admin.base')

@section('moder2')

    <div class="container-fluid" >
        <h1>Les emprunts</h1>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Livre</th>
                <th>Utilisateure</th>
                <th>Date d'emprint</th>
                <th>Date de retour</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($emprunts as $emp)
            <tr>
                <td>{{ $emp->id }}</td>
                <td>
                    <img
                        src="{{ asset('./images_Livres/'.$emp->livre->image) }}"
                        alt=""
                        style="width: 45px; height: 45px"
                        class="rounded-circle"
                    />
                    {{ $emp->livre->titre }}</td>
                <td>{{ $emp->user->username }}</td>
                <td>{{ \Carbon\Carbon::parse($emp->date_emp)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($emp->date_fin)->format('Y-m-d') }}</td>
                <td>{{ $emp->periode($emp->date_fin,$emp->date_emp) }} jrs</td>
                <td> @if($emp->status == 'attend')
                        <p class="badge badge-success rounded-pill d-inline bg-warning">en attend</p>
                    @elseif($emp->status == 'refuse')
                        <p class="badge badge-success rounded-pill d-inline bg-danger">{{ $emp->status }}</p>
                    @else
                        <p class="badge badge-success rounded-pill d-inline bg-success">{{ $emp->status }}</p>
                    @endif
                </td>
                <td>
                    @if($emp->status == 'attend')
                    <form method="post" action="{{ route('moder.emprunt.accepter',$emp->id) }}">
                        @csrf
                    <button type="submit" class="btn btn-sm btn-success">Accepter</button>
                    </form>
                    <form action="{{ route('moder.emprunt.refuse',$emp->id) }}" method="post" >
                        @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Refuse</button>
                    </form>
                    @endif
                    @if($emp->status == 'accepter')
                        <p><b>accepted</b></p>
                            <form action="{{ route('moder.renduEmprunt',$emp->id) }}" method="post" >
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">Rendu</button>
                            </form>
                    @endif
                    @if($emp->status == 'refuse')
                            <form action="{{ route('moder.emprunt.delete',$emp->id) }}" method="post" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
