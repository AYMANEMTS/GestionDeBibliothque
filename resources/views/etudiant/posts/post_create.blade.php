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

        <div class="posts">
            <h3>Cree un post</h3>
            @if(session('success'))
                <div class="alert-danger"
                {{session('success')}}
                </div>
            @endif
            <div class="container">
                <form method="post" action="{{ route('Post.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="form-label">Title</label>
                            <input class="form-control" type="text" name="title">
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Image Post</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 mt-4">
                            <textarea name="body" id="editor" ></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input class="btn btn-primary" type="submit" value="Cree">
                        </div>
                    </div>
                </form>
            </div>

    </main>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor')
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
