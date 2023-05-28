@extends('admin.base')
@section('moder2')
    <div class="container-fluid" >
        <div class="col-lg-12">
            <h2>Profile : {{ $user->username }}</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <form method="get">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Username</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="username" value="{{ $user->username }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">First Name</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Last Name</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="last_email" value="{{ $user->last_name }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Phone</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="tel" name="phone" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">CIN</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="CIN" value="{{ $user->CIN }}">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Address</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="adress" value="{{ $user->adress }}">
                        </div>
                    </div>
                    <br><br>
                    <input style="width: 100%" class="btn btn-success" type="submit" name="update" value="Update">
                    </form>
                </div>
            </div>
        </div>
@endsection
