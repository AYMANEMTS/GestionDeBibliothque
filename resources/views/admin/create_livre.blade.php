@extends('base')
@include('parts.navbar_moder')
@section('title','Create Livre')



@section('moder')

    <div class="content" style="margin-left: 250px;margin-top: 100px;width: 80%">
        <h1>Create Livre : </h1>
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
                <label for="launge" class="form-label">launge</label>
                <div class="col-md-6 mb-4 d-flex align-items-center">
                    <select id="launge" name="launge" class="form-select">
                        <option style="font-size: 16px;" selected>Launge : </option>
                        <option style="font-size: 16px;" value="espagnol">espagnol</option>
                        <option style="font-size: 16px;" value="anglais">anglais</option>
                        <option style="font-size: 16px;" value="arabe">arabe</option>
                        <option style="font-size: 16px;" value="français">français</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                        <input type="text" name="categorie" class="form-control form-control-lg"  />
                        <label for="birthdayDate" class="form-label">Categorie</label>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                        <input type="date" name="annee"  class="form-control form-control-lg" />
                        <label class="form-label" for="emailAddress">Annee</label>
                    </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                        <input type="file" name="image" class="form-control form-control-lg" />
                        <label class="form-label" for="phoneNumber">Image</label>
                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                </div>
            </div>
                <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                        <input type="checkbox" value="true" name="dispo"  class="form-check-input" />
                        <label class="form-label" for="emailAddress">Disponible ?</label>
                    </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                        <textarea class="form-control" name="description" id="" cols="50" rows="2"></textarea><br>
                        <label class="form-label">Description</label>
                    </div>

            </div>

            <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                <a href="{{ route('moder.livre') }}" class="btn btn-secondary btn-lg" type="button"  >Cancel</a>
            </div>
                </div>
            </div>
        </form>

    </div>
@endsection
