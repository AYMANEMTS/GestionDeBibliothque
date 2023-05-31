@extends('etudiant.base')

@section('main')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Livres</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section-msagee">
            <div class="row">
            @foreach($msages as $msg)
                @if($msg->status == 'refuse')
                    <div class="col-lg-12">
                        <div class="card" >
                            <div class="card-body bg-danger" style="height: 50px">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-text text-light">{{$msg->msage}}</p>
                                    <form method="post" action="{{ route('deleteMessage',$msg->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-footer bg-secondary">
                                <small class="text-white">Sent on {{Carbon\Carbon::parse($msg->created_at)->format('M d, H:i')}}</small>
                            </div>
                        </div>
                    </div>
                    @elseif($msg->status == 'accepter')
                        <div class="col-lg-12">
                            <div class="card" >
                                <div class="card-body bg-success" style="height: 50px">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-text text-light">{{$msg->msage}}</p>
                                        <form method="post" action="{{ route('deleteMessage',$msg->id) }}">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-secondary">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer bg-secondary">
                                    <small class="text-white">Sent on {{Carbon\Carbon::parse($msg->created_at)->format('M d, H:i')}}</small>
                                </div>
                            </div>
                        </div>
                @endif
            @endforeach
            </div>
        </section>
    </main>
@endsection
