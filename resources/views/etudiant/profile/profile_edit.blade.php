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
                                    <button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-overview"><a href="{{ route('profile',$user->id) }}">Overview</a></button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password"><a href="{{ route('rstpass',$user->id) }}">Change Password</a></button>
                                </li>
                            </ul>
                            <!-- Profile Edit Form -->
                            <h1>  </h1>
                            <form method="post" action="{{ route('updateprofile',$user->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <img src="{{ asset('./images_profiles/'.$user->profile_img) }}" style="height: 120px;width: 120px" alt="Profile">
                                        <div class="pt-2">
                                            <input type="file" name="profile_img">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="username" type="text" class="form-control"  value="{{ $user->username }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="first_name" type="text" class="form-control"  value="{{ $user->first_name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Last name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="last_name" type="text" class="form-control"  value="{{ $user->last_name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label  class="col-md-4 col-lg-3 col-form-label">CIN</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="CIN" type="text" class="form-control"  value="{{ $user->CIN }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="adress" type="text" class="form-control" id="Address" value="{{ $user->adress }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control" id="Phone" value="{{ $user->phone }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


@endsection
