@extends('etudiant.base')

@section('main')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Posts</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
            <div class="container-fluid">
                <a class="btn btn-primary mb-2" href="{{ route('Post.create') }}">Cree un post</a>
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-4">
                            <div class="card" style="width: 250px">
                                @if($post->image)
                                <img class="card-img" style="margin: 0px" src="{{ asset('./images_posts/'.$post->image) }}" alt="Bologna">
                                @else
                                    <img class="card-img" style="margin: 0px" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg"" alt="Bologna">
                                @endif
                                    <div class="card-body">
                                    <h4 class="card-title"  style="padding-top: 0px">Pasta with Prosciutto</h4>
                                    <p class="text-primary cat">
                                        @if($post->users->profile_img)
                                            <img class="img-circle" style="height: 30px;width: 30px;margin: 0px" src="{{ asset('./images_profiles/'.$post->users->profile_img) }}" alt="">
                                        @else
                                            <img class="img-circle" style="height: 30px;width: 30px;margin: 0px" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg" alt="">
                                        @endif
                                        @<span>{{ $post->users->username }}</span>
                                    </p>
                                    <a href="#" class="btn btn-info">Read more</a>
                                </div>
                                <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                                    <div class="views">{{Carbon\Carbon::parse($post->created_at)->format('M d, h:iA')}}
                                    </div>
                                    <div class="stats">
                                        <i class="far fa-eye"></i> 1347
                                        <i class="far fa-comment"></i> 12
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </main>


@endsection
