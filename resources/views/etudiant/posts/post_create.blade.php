@extends('etudiant.base')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Post Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="alert alert-secondary">
            <li>Note : image max size : 2048m</li>
        </div>

        <div class="posts">
            <h3>Cree un post</h3>
            <div class="container-fluid">
                <form id="submit-form" method="post" action="{{ route('Post.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-label">Title</label>
                            <input class="form-control" type="text" name="title">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Image Post</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <div class="alert alert-sm alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-4">
                            <textarea name="body" id="editor" ></textarea>
                            @error('body')
                            <div class="alert alert-sm alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mt-3">
                            <button style="width: 960px" class="btn btn-primary" type="submit" >Cree un post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                ckfinder: {
                    uploadUrl: '{{route('upload.image').'?_token='.csrf_token()}}',
                }

            })
            .catch( error => {

            } );
    </script>
@endsection
