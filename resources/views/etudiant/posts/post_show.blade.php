@extends('etudiant.base')

@section('main')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Post </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="container-fluid">
            @if($post->utilisateure_id == Auth::user()->id)
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <form method="get" action="{{ route('Post.destroy',$post->id) }}">
                            @csrf
                        
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i>suprimer</button>
                        </form>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                        <a class="btn btn-warning"  href="{{ route('Post.edit',$post->id) }}"><i class="fa-solid fa-pen-to-square"></i>edit</a>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-10">
                    <div class="text-primary text-lg">
                        <h1>{{ $post->title }}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <p>{!! $post->body !!}</p>
                </div>
                <div class="col-lg-5">
                    <img class="img-fluid img-thumbnail" src="{{ asset('./images_posts/'.$post->image) }}" alt="">
                </div>
            </div>
        </div>
    </main>

@endsection
