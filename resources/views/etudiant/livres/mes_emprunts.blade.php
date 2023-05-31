@extends('etudiant.base')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                </ol>
            </nav>
        </div>
        <section>
            <h1 style="color: #012970">Mes Livres</h1>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                <tr>
                    <th>Livre</th>
                    <th>Autheur</th>
                    <th>Categorie</th>
                    <th>Status</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($emp as $item)

                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img
                                    src="{{ asset('./images_Livres/'.$item->livre->image) }}"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                                />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ $item->livre->titre }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $item->livre->autheur }}</p>
                        </td>

                        <td>
                            <p class="fw-normal mb-1">{{ $item->livre->categorie }}</p>
                        </td>
                        <td>
                            @if($item->status == 'attend')
                                <p class="badge badge-success rounded-pill d-inline bg-warning">en attend</p>
                            @elseif($item->status == 'refuse')
                                <p class="badge badge-success rounded-pill d-inline bg-danger">{{ $item->status }}</p>
                            @elseif($item->status == 'accepter')
                                <p class="badge badge-success rounded-pill d-inline bg-success">{{ $item->status }}</p>
                            @else
                                <p class="badge badge-success rounded-pill d-inline bg-warning">{{ $item->status }}</p>
                            @endif
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ \Carbon\Carbon::parse($item->date_emp)->format('Y-m-d') }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ \Carbon\Carbon::parse($item->date_fin)->format('Y-m-d') }}</p>
                        </td>
                        <td>
                            @if($item->status == 'refuse' || $item->status == 'rendu' || $item->status == 'attend')
                            <p class="fw-normal mb-1">
                                <form action="{{ route('deleteEmprunt',$item->id) }}" method="post" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </p>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>



@endsection
