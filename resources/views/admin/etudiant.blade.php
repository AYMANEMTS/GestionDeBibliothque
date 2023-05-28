@extends('admin.base')
@section('moder2')


    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if(isset($_GET['success']))
            <div class="alert alert-success">
                {{ $_GET['success'] }}
            </div>
        @endif
        @if(session('done'))
            <div class="alert alert-success">
                {{ session('done') }}
            </div>
        @endif
        <a class="btn btn-primary" data-toggle="modal" data-target="#createStudentModal">Cree Un Etudiant</a><br><br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Etudiants</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>CIN</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach($etd as $item)
                            @if($item->role == 'etudiant')
                        <tbody>
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->adress }}</td>
                            <td>{{ $item->CIN }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <form action="{{ route('moder.dellet.student' , $item->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-outline-danger btn-sm" type="submit">DELET</button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                            @endif
                        @endforeach
                    </table>
                    {{$etd->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Create Student Modal -->
    <div class="modal fade" id="createStudentModal" tabindex="-1" role="dialog" aria-labelledby="createStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createStudentModalLabel">Create New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            <li>{{$error}}</li>
                        </div>
                    @endforeach
                    <!-- Add your form fields for creating a new student here -->
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
                            <input class="btn btn-primary btn-lg" type="submit" value="Ajouter" />

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
