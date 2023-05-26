@extends('base')
@section('title','Ajouter un utilisateur')
@include('parts.navbar_super')
@section('super')
    <div class="content" style="margin-left: 200px;margin-top: 100px">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Ajouter un utilisateur</h3>
                             @foreach($errors->all() as $error)
                               <div class="alert alert-danger">
                                    <li>{{$error}}</li>
                               </div>
                             @endforeach
                            <form method="post" action="{{ route('admin.add.user.vrf') }}">
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
                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <select class="form-select" name="role" aria-label="Default select example">
                                            <option selected>Select Role</option>
                                            <option value="superadmin">Super Admin</option>
                                            <option value="admin">Admin</option>
                                            <option value="etudiant">Etudiant</option>
                                        </select>
                                        <label>Role</label>
                                    </div>
                                </div>

                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary btn-lg" type="submit" value="Ajouter" />
                                    <a href="{{ route('admin.users') }}" class="btn btn-lg btn-secondary">Cancel</a>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    </div>

@endsection
