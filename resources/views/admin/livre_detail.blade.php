@extends('admin.base')
@section('moder2')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="project-info-box mt-0">
                <h2>{{ $livre->titre }}</h2>
                <p class="mb-0">{{ $livre->description }}</p>
            </div><!-- / project-info-box -->

            <div class="project-info-box">
                <p><b>Autheur:</b> {{ $livre->autheur }}</p>
                <p><b>Launge:</b> {{ $livre->launge }}</p>
                <p><b>Annee:</b> {{ $livre->annee }}</p>
                <p><b>Categories:</b> {{ $livre->categorie }}</p>
                <p><b>Disponible:</b>@if($livre->dispo == 0)
                        Note Disponible
                    @elseif($livre->dispo == 1)
                        Livre {{$livre->titre}} est disponible
                    @endif </p>
            </div><!-- / project-info-box -->

            <div class="project-info-box mt-0 mb-0">
                <p class="mb-0">
                    <span class="fw-bold mr-10 va-middle hide-mobile">Action:</span>
                    <a href="{{ route('moder.Formdelete.livre',$livre->id) }}" >
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <a href="{{ route('moder.livre.update',$livre->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                        <i class="fas fa-align-center"></i>
                    </a>
                    <a href="{{ route('moder.livre') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Back">
                        <i class="fas fa-arrow-left"></i>
                    </a>

                </p>
            </div><!-- / project-info-box -->
        </div><!-- / column -->

        <div class="col-md-7">
            <img style="height: 400px" src="{{ asset('./images_Livres/'.$livre->image) }}" alt="project-image" class="rounded">
        </div><!-- / column -->
{{--        <a href="{{ asset('./pdfs/livre_'.$livre->id .'.pdf') }}" class="btn btn-primary">View Pdf</a>--}}
    </div>
</div>
<!-- Delete Livre Modal -->
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

@endsection
