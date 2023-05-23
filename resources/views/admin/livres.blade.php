@extends('base')
@section('title','Livres')
@include('parts.navbar_moder')


@section('moder')

    <div class="content" style="margin-left: 250px;margin-top: 100px;width: 80%">
        <h1>List Livres : </h1><br>
        @if(session('done'))
            <div class="alert alert-success">
                {{ session('done') }}
            </div>
        @endif
        <a href="{{ route('moder.livre.FormCreate') }}" class="btn btn-primary">Cree un Livre</a><br><br>
        <div class="row">
            @foreach ($livre as $item)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <!-- Card Dark -->
                    <div class="card m-3" style="width: 200px">

                        <!-- Card image -->
                        <div class="view overlay">
                            <div class="card-img-top" style="background-image: url('{{ asset('./images_Livres/'.$item->image) }}'); background-size: cover; height: 200px;"></div>
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body bg-dark elegant-color white-text rounded-bottom">

                                <!-- Title -->
                            <h4 class="card-title text-white">Card title</h4>
                            <hr class="hr-light">
                            <p class="text-white">Autheur : autheur</p>
                            <hr class="hr-light">
                            <!-- Text -->
                            <p class="text-white">Categorie : categorie</p>
                            <!-- Link -->
                            <a href="{{ route('moder.livre.show',$item->id) }}" class="white-text d-flex justify-content-end">
                                <h5>View <i class="fa-sharp fa-solid fa-eye fa-lg"></i></h5>
                            </a>

                        </div>

                    </div>
                    <!-- Card Dark -->
                </div>
            @endforeach
        </div>
        <div style="padding-top: 40px;padding-bottom: 40px">
        {{ $livre->links() }}
        </div>
    </div>



@endsection
