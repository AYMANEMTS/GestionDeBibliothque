@extends('etudiant.base')

@section('main')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ asset('./images_profiles/'.$user->profile_img) }}" alt="Profile" class="img-rounded">
                            <h2>{{$user->first_name . ' '.$user->last_name}}</h2>
                            <p>{{'@'.$user->username}}</p>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"><a href="{{ route('profile',$user->id) }}">Overview</a></button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"><a href="{{ route('editprofile',$user->id) }}">Edit Profile</a></button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"><a href="{{ route('rstpass',$user->id) }}">Change Password</a></button>
                                </li>
                            </ul>
                            <h5 class="card-title">Profile Details</h5>
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{session('success')}}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-primary" style="font-size: 17px">User Name</div>
                                <div class="col-lg-9 col-md-8" style="font-size: 17px;color: #012970">{{ $user->username }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-primary" style="font-size: 17px">First Name</div>
                                <div class="col-lg-9 col-md-8" style="font-size: 17px;color: #012970">{{ $user->first_name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-primary" style="font-size: 17px">Last Name</div>
                                <div class="col-lg-9 col-md-8" style="font-size: 17px;color: #012970">{{ $user->last_name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-primary" style="font-size: 17px">CIN</div>
                                <div class="col-lg-9 col-md-8" style="font-size: 17px;color: #012970">{{ $user->CIN }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-primary" style="font-size: 17px">Address</div>
                                <div class="col-lg-9 col-md-8" style="font-size: 17px;color: #012970">{{ $user->adress }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-primary" style="font-size: 17px">Phone</div>
                                <div class="col-lg-9 col-md-8" style="font-size: 17px;color: #012970">{{ $user->phone }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 text-primary" style="font-size: 17px">Email</div>
                                <div class="col-lg-9 col-md-8" style="font-size: 17px;color: #012970">{{ $user->email }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
