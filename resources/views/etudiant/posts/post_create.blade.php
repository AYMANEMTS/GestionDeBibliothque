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
            <li>Note : images max size : 2048</li>
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
                            <input type="hidden" name="image_url" id="image-url">
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

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            CKEDITOR.replace(document.querySelector('#editor'), {
                filebrowserUploadUrl: "{{ route('upload.image',['_token' => csrf_token() ]) }}",
                filebrowserUploadMethod: 'form'
            })
                .then(editor => {
                    console.log('Editor initialized:', editor);
                })
                .catch(error => {
                    console.error('Error initializing editor:', error);
                });
    
            document.querySelector('#submit-form').addEventListener('submit', function (e) {
                e.preventDefault();
    
                const form = e.target;
                const formData = new FormData(form);
    
                $.ajax({
                    url: form.action,
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        alert(data.msg);
                    },
                    error: function (xhr, textStatus, error) {
                        console.error('Error submitting form:', error);
                    }
                });
            });
        });
    </script>
@endsection
