@extends('etudiant.base')

@section('main')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Livres</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @error('error')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <section class="section profile">
            <div class="row">
                @foreach($book as $livre)
                <div class="col-xl-3">
                    <!-- Card with an image on top -->
                    <div class="card">

                        <div class="card-img-top" style="background-image: url('{{ asset('./images_Livres/'.$livre->image) }}'); background-size: cover; height: 200px;"></div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $livre->titre }}</h2>
                            <p class="card-text text-dark">Autheur : <span style="color: #012970">{{ $livre->autheur }}</span></p>
                            <p class="card-text text-dark">Catrgorie : <span style="color: #012970">{{ $livre->categorie }}</span></p>
                            <p class="card-text text-dark">Status : <span style="color: #012970">@if($livre->dispo = 1)
                              <p class="text-success">Disponible</p>@else <p class="text-danger">Not Disponible</p>
                            @endif</span></p>
                            <a class="btn btn-primary" href="{{ route('detail' ,$livre->id) }}">View</a>
                        </div>
                    </div><!-- End Card with an image on top -->
                </div>
                @endforeach
            </div>
        </section>
    </main>
<style>
    .card-body {
        position: relative;
        padding: 0; /* Remove padding to avoid extra spacing */
    }

    .card-img-top {
        max-width: 100%; /* Set the maximum width of the image to 100% of its container */
        height: auto; /* Maintain aspect ratio */
        display: block; /* Ensure the image is displayed as a block element */
    }

</style>
@endsection
