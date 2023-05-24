@extends('base')
@section('title','Change User Role')
@include('parts.navbar_super')
@section('super')
    <div class="content" style="margin-left: 260px;margin-top: 100px;width: 70%">
        <div class="row">
            <h3>Change Role Or Delete</h3>
            <div class="col-md-6 mb-4">

                <div class="form-outline">
                    <input type="text" name="username" value="{{ $user->username }}" readonly class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">User Name</label>
                </div>

            </div>
            <div class="col-md-6 mb-4">

                <div class="form-outline">
                    <input type="text" name="adress" value="{{ $user->adress }}" readonly class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Adresse</label>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4 d-flex align-items-center">

                <div class="form-outline datepicker w-100">
                    <input type="text" name="CIN" value="{{ $user->CIN }}" readonly class="form-control form-control-lg" id="birthdayDate" />
                    <label for="birthdayDate" class="form-label">CIN</label>
                </div>

            </div>
            <div class="col-md-6 mb-4 d-flex align-items-center">

                <div class="form-outline datepicker w-100">
                    <input type="text" name="phone" value="{{ $user->phone }}" readonly class="form-control form-control-lg" id="birthdayDate" />
                    <label for="birthdayDate" class="form-label">Phone</label>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6 mb-4 d-flex align-items-center">

                <div class="form-outline datepicker w-100">
                    <input type="text" name="CIN" value="{{ $user->email }}" readonly class="form-control form-control-lg" id="birthdayDate" />
                    <label for="birthdayDate" class="form-label">Email</label>
                </div>

            </div>
            <div class="col-md-6 mb-4 d-flex align-items-center">
            <form method="post" action="{{ route('admin.user.changerole',$user->id) }}">
                @csrf
                <select class="form-select" name="role" aria-label="Default select example">
                    <option selected>Selected : {{ $user->role }}</option>
                    <option value="superadmin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="etudiant">Etudiant</option>
                </select>
                <label>Role</label><br>


            <button class="btn btn-primary" name="change.role" type="submit">Change Role</button>
            </form>
            </div>
        </div>
        <a href="{{ route('admin.user.delete',$user->id) }}" class="btn btn-danger">Delete</a>
        <a href="{{ route('super.users') }}" class="btn btn-secondary">Cancel</a>
    </div>
@endsection
