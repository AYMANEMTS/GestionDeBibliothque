@extends('etudiant.base')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Livres</li>
            </ol>
        </nav>
        </div>
        <section class="livre-detail">
            <div class="row">
                @if(session('done'))
                    <div class="alert alert-success">
                        {{ session('done') }}
                    </div>
                @endif
                <div class="col-md-5">
                    <div class="project-info-box mt-0">
                        <h1 style="font-size: 25px">{{ $book->titre }}</h1>
                        <p class="mb-0">{{ $book->description }}</p>
                    </div><!-- / project-info-box -->

                    <div class="project-info-box">
                        <p><b>Autheur:</b> {{$book->autheur}}</p>
                        <p><b>Categorie:</b> {{$book->categorie}}</p>
                        <p><b>Date:</b> {{$book->annee}}</p>
                        <p><b>Launge:</b> {{$book->launge}}</p>
                        <p><b>Status:</b>{{$book->dispo?' Disponible':' Not Disponible'}} </p>
                        @if($book->dispo == 0)
                            <p><b>Date de retour : @isset($empr->date_fin)
                                        {{\Carbon\Carbon::parse($empr->date_fin)->format('Y-m-d')}}
                                    @endisset
                                </b> </p>
                        @else
                            <a  id="emprunterBtn" class="btn btn-success">Emprunter ce livre</a>
                        @endif
                    </div><!-- / project-info-box -->
                    <div id="emprunterForm" style="display: none;">
                        <form method="post" action="{{ route('empruntunlivre',$book->id    ) }}">
                            @csrf
                            <label class="form-label">Date emprunt</label>
                            <input class="form-control" type="date" name="date_emp" >
                            <button class="btn btn-success" type="submit">Submit</button>
                        </form>
                    </div>

                    <div class="project-info-box mt-0 mb-0">
                        <p class="mb-0">
                            <span class="fw-bold mr-10 va-middle hide-mobile">Share:    </span>
                            <a href="#x" class="btn btn-xs btn-facebook btn-circle btn-icon mr-5 mb-0"><i class="fab fa-facebook-f"></i></a>
                            <a href="#x" class="btn btn-xs btn-twitter btn-circle btn-icon mr-5 mb-0"><i class="fab fa-twitter"></i></a>
                            <a href="#x" class="btn btn-xs btn-pinterest btn-circle btn-icon mr-5 mb-0"><i class="fab fa-pinterest"></i></a>
                            <a href="#x" class="btn btn-xs btn-linkedin btn-circle btn-icon mr-5 mb-0"><i class="fab fa-linkedin-in"></i></a>
                        </p>
                    </div><!-- / project-info-box -->
                </div><!-- / column -->

                <div class="col-md-7">
                    <img src="{{asset('./images_livres/'.$book->image)}}" alt="project-image" class="rounded">
                </div><!-- / column -->
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var emprunterBtn = document.getElementById("emprunterBtn");
            var emprunterForm = document.getElementById("emprunterForm");
            var formVisible = false;

            emprunterBtn.addEventListener("click", function(e) {
                e.preventDefault();
                if (formVisible) {
                    emprunterForm.style.display = "none";
                    formVisible = false;
                } else {
                    emprunterForm.style.display = "block";
                    formVisible = true;
                }
            });
        });
    </script>
@endsection
