@extends('base')
@section('title','Create Etudiant')
@include('parts.navbar_moder')


@section('moder')

    <div class="content" style="margin-left: 250px;margin-top: 100px">
        <h1>Create Student : </h1>
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
        @endforeach
        <form method="post" action="{{ route('moder.etudiant.create') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">

                    <div class="form-outline">
                        <input type="text" name="username" id="firstName" class="form-control form-control-lg" />
                        <label class="form-label" for="firstName">User Name</label>
                    </div>

                </div>
                <div class="col-md-6 mb-4">

                    <div class="form-outline">
                        <input type="text" name="adress" id="lastName" class="form-control form-control-lg" />
                        <label class="form-label" for="lastName">Adresse</label>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                        <input type="text" name="CIN" class="form-control form-control-lg" id="birthdayDate" />
                        <label for="birthdayDate" class="form-label">CIN</label>
                    </div>

                </div>
                <div class="col-md-6 mb-4">



                    <select class="form-select" name="gender" aria-label="Default select example">
                        <option selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <label>Gender</label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                        <input type="email" name="email" id="emailAddress" class="form-control form-control-lg" />
                        <label class="form-label" for="emailAddress">Email</label>
                    </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                        <input type="tel" name="phone" id="phoneNumber" class="form-control form-control-lg" />
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input type="password" name="password" id="phoneNumber" class="form-control form-control-lg" />
                        <label class="form-label" for="phoneNumber">Password</label>
                    </div>
                </div>
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                        <input type="password" name="password_confirmation" id="phoneNumber" class="form-control form-control-lg" />
                        <label class="form-label" for="phoneNumber">Confirm Password</label>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
            </div>


        </form>

    </div>
@endsection
