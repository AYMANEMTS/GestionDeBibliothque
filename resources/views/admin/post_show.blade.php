@extends('admin.base')
@section('moder2')

    <div class="container">

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

@endsection
