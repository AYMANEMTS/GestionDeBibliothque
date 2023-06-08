@extends('admin.base')



@section('moder2')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cree un Livre</h6>
        </div>
    </div>
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{$error}}</li>
        </div>
    @endforeach
    <form method="post" action="{{ route('moder.livre.create') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-outline">
                    <input type="text" name="titre" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">titre</label>
                </div>
            </div>
            <div class="col-md-6 mb-4">

                <div class="form-outline">
                    <input type="text" name="autheur" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">autheur</label>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-outline">
                    <input type="date" name="annee" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">Date de création</label>
                </div>
            </div>
            <div class="col-md-6 mb-4">

                <div class="form-outline">
                    <input type="text" name="categorie" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Categorie</label>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-outline">
                    <label class="form-label" for="firstName">Description</label>
                    <textarea id="description" name="description" class="form-control form-control-lg"></textarea>
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
                    <input type="text" class="form-control form-control-lg" name="launge">
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
