@extends('etudiant.base')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashbord</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Livre Disponible Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card" >
                                <div class="card-body" >
                                    <h5 class="card-title"><a style="color: #012970" href="{{ route('books') }}">Livre Disponible</a></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-book-half"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $livreDisponible->count() }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Livre Disponible Card -->

                        <!-- Livre Rendu Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Livre Rendu <span>| This Year</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-clipboard-check" style="color: #4154f1;"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $livreRendu }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Livre Rendu Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Visitors <span>| This Year</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $coustomers->count() }}</h6>
                                            <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->

                        <!-- Mes posts -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Mes Posts</h5>

                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">Preview</th>
                                            <th scope="col">title</th>
                                            <th scope="col">Created_at</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach($posts as $post)
                                            <tbody>
                                            <tr>
                                                <th scope="row"><a href="#"><img src="{{ asset('./images_posts/'.$post->image) }}" alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">{{ $post->title }}</a></td>
                                                <td>{{ Carbon\Carbon::parse($post->created_at)->format('Y m d') }}</td>
                                                @if($post->status == 'accepter')
                                                    <td class="text-success">
                                                        <span class="badge badge-success rounded-pill d-inline bg-success">Accepter</span>
                                                    </td>
                                                @elseif($post->status == 'attend')
                                                    <td class="text-warning">
                                                        <span class="badge badge-success rounded-pill d-inline bg-warning">en attend</span>
                                                    </td>
                                                @else
                                                    <td class="text-danger">
                                                        <span class="badge badge-success rounded-pill d-inline bg-danger">Refuse</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('Post.show',$post->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-primary">View</a>
                                                    <a href="{{ route('Post.edit',$post->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-secondary">Edit</a>
                                                    <a href="{{ route('Post.destroy',$post->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Mes posts -->

                        <!-- Mes posts -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Mes Emprunt</h5>

                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">Preview</th>
                                            <th scope="col">title</th>
                                            <th scope="col">Date de retour</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach($mesEmprunts as $emp)
                                            <tbody>
                                            <tr>
                                                <th scope="row"><a href="#"><img src="{{ asset('./images_Livres/'.$emp->livre->image) }}" alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold">{{ $emp->livre->titre }}</a></td>
                                                <td>{{ Carbon\Carbon::parse($emp->date_fin)->format('Y m d') }}</td>
                                                @if($post->status == 'accepter')
                                                    <td class="text-success">
                                                        <span class="badge badge-success rounded-pill d-inline bg-success">Accepter</span>
                                                    </td>
                                                @elseif($post->status == 'attend')
                                                    <td class="text-warning">
                                                        <span class="badge badge-success rounded-pill d-inline bg-warning">en attend</span>
                                                    </td>
                                                @else
                                                    <td class="text-danger">
                                                        <span class="badge badge-success rounded-pill d-inline bg-danger">Refuse</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('detail',$emp->livre->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-primary">View</a>
                                                    <form method="post" action="{{ route('deleteEmprunt',$emp->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    <button type="submit" style="padding: 2px;margin-top: 3px" class="btn  btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Mes posts -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Last Books -->
                        <div class="card-body pb-0">
                            <h5 class="card-title">Top books<span>| Week</span></h5>

                            <div class="news">
                                @foreach($lastBooks as $book)
                                    <div class="post-item clearfix ">
                                        <img style="max-height: 100px;max-width: 100px;margin: 0px" src="{{ asset('./images_Livres/'.$book->image) }}" alt="">
                                        <h4><a href="{{ route('detail',$book->id) }}">{{ $book->titre }}</a></h4>
                                        <p>{{  Str::limit($book->description,95) }}</p>
                                    </div>
                                @endforeach
                            </div><!-- End sidebar recent posts-->

                        </div>
                    <!--  last posts -->
                    <div class="card-body pb-0">
                        <h5 class="card-title">Top Posts<span>| Week</span></h5>

                        <div class="news">
                            @foreach($lastPosts as $post)
                                <div class="post-item clearfix ">
                                    <img style="max-height: 100px;max-width: 100px;margin: 0px" src="{{ asset('./images_posts/'.$post->image) }}" alt="">
                                    <h4><a href="{{ route('Post.show',$post->id) }}">{{ $post->title }}</a></h4>
                                    <p>{{ Carbon\Carbon::parse($post->created_at)->format('Y m d') }}</p>
                                    <p><i class="far fa-eye"></i> {{ $post->views }}
                                        <i class="far fa-comment"></i> {{ $post->comments->count() }}
                                    </p>
                                </div>
                            @endforeach
                        </div><!-- End sidebar recent posts-->

                    </div>
                </div>
                    </div><!-- End last posts -->


                </div><!-- End Right side columns -->

            </div>
        </section>
    </main>

@endsection
