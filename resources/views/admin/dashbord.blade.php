@extends('admin.base')
@section('moder2')
    <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Visitor Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Visitor (etudiant)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_etd}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total livres Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Livres </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Livre::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total emrunts Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total emprunts </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\emprunt::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa fa-table fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- total emprunt accepter Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                emprunts accepter</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\emprunt::where('status','accepter')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-solid fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-7 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Emprunt en attend</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Livre</th>
                                    <th>User</th>
                                    <th>Date d'emprint</th>
                                    <th>Date de retour</th>
                                    <th>Accepter</th>
                                    <th>Refuser</th>
                                </tr>
                                </thead>
                                @foreach($emp_enattend as $emprunt)
                                <tbody>
                                <tr>
                                    <td>{{$emprunt->livre->titre}} ({{$emprunt->livre->id}})</td>
                                    <td>{{$emprunt->user->username}} ({{$emprunt->user->id}})</td>
                                    <td>{{\Carbon\Carbon::parse($emprunt->date_emp)->format('Y-m-d')}}</td>
                                    <td>{{\Carbon\Carbon::parse($emprunt->date_fin)->format('Y-m-d')}}</td>
                                    <td>
                                        <form method="post" action="{{ route('moder.emprunt.accepter',$emprunt->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Accepter</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('moder.emprunt.refuse',$emprunt->id) }}" method="post" >
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Refuse</button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>

                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Emprunt accepter</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-1 pb-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Livre</th>
                                    <th>User</th>
                                    <th>Date de retour</th>
                                    <th>Refuse</th>

                                </tr>
                                </thead>
                                @foreach($emp_accepter as $emp)
                                <tbody>
                                <tr>
                                    <td>{{$emp->livre->titre}} ({{$emp->livre->id}})</td>
                                    <td>{{$emp->user->username}} ({{$emp->user->id}})</td>
                                    <td>{{$emp->date_fin}}</td>
                                    <td>
                                        <form action="{{ route('moder.emprunt.refuse',$emp->id) }}" method="post" >
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Refuse</button>
                                        </form>
                                    </td>

                                </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                        <canvas id="myPieChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-xl-7 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Emprunte Refuse</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-1 pb-2">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Livre</th>
                                        <th>User</th>
                                        <th>Delete</th>
                                        <th>Accepter</th>
                                    </tr>
                                    </thead>
                                    @foreach($emp_refuse as $emp)
                                    <tbody>
                                    <tr>
                                        <td>{{$emp->livre->titre}} ({{$emp->livre->id}})</td>
                                        <td>{{$emp->user->username}} ({{$emp->user->id}})</td>
                                        <td>
                                            <form action="{{ route('moder.emprunt.delete',$emp->id) }}" method="post" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="{{ route('moder.emprunt.accepter',$emp->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Accepter</button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>

                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- End of Main Content -->
@endsection
