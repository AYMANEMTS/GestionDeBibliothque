@extends('admin.base')
@section('moder2')

    <div class="container-fluid" >
        <h1>Update Livre : </h1>
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
        @endforeach
        <form method="post" action="{{ route('moder.livre.update.vrf' ,$livre->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                        <input type="text" name="titre" value="{{ $livre->titre }}" id="firstName" class="form-control form-control-lg" />
                        <label class="form-label" for="firstName">titre</label>
                    </div>
                </div>
                <div class="col-md-6 mb-4">

                    <div class="form-outline">
                        <input type="text" value="{{ $livre->autheur }}" name="autheur" id="lastName" class="form-control form-control-lg" />
                        <label class="form-label" for="lastName">autheur</label>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                        <input type="date" value="{{ $livre->annee }}" name="annee" id="firstName" class="form-control form-control-lg" />
                        <label class="form-label" for="firstName">Date de création</label>
                    </div>
                </div>
                <div class="col-md-6 mb-4">

                    <div class="form-outline">
                        <input type="text" value="{{ $livre->categorie }}" name="categorie" id="lastName" class="form-control form-control-lg" />
                        <label class="form-label" for="lastName">Categorie</label>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                        <textarea  name="description" rows="1"  class="form-control form-control-lg">{{ $livre->description }}</textarea>
                        <label class="form-label" for="firstName">Description</label>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                        <input name="image" class="form-control form-control-lg" type="file" name="image"  />
                        <label class="form-label" for="lastName">Image</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-outline" >
                        <input class="form-control form-control-lg" name="launge" value="{{ $livre->launge }}">
                        <label class="form-label" for="emailAddress">Launge </label>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="form-outline" >
                        <input type="checkbox" value="true" name="dispo"  class="form-check-input" />
                        <label class="form-label" for="emailAddress">Disponible ?</label>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                <a href="{{ route('moder.livre') }}" class="btn btn-secondary btn-lg" type="button"  >Cancel</a>
            </div>
            <h1></h1>
            <h1></h1>
            <h1></h1>
        </form>

    </div>
@endsection
