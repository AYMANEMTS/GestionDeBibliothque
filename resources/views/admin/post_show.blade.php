@extends('admin.base')
@section('moder2')

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-2">{{ $post->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on {{Carbon\Carbon::parse($post->created_at)->format('Y M d, h:i A')}}</div>
                        <!-- Post categories-->
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $post->status }}</a>
                    </header>
                    <!-- Preview image figure-->
                    @if($post->image)
                        <figure class="mb-4"><img style="max-height: 250px" class="img-fluid rounded" src="{{ asset('./images_posts/'.$post->image) }}" alt="Bologna"></figure>
                    @else
                        <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                    @endif
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">{!! $post->body !!}</p>

                    </section>
                </article>


                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            @foreach($cmt as $comment)
                                <div class="d-flex m-2">
                                    @if($comment->user->profile_img)
                                        <div class="flex-shrink-0 m-2"><img style="width: 40px;height: 40px" class="rounded-circle m-0" src="{{ asset('./images_profiles/'.$comment->user->profile_img) }}" alt="..." /></div>
                                    @else
                                        <div class="flex-shrink-0"><img class="rounded-circle m-0" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    @endif
                                    <div class="ml-1">
                                        <input name="parent_id" value="{{ $comment->id }}" hidden>
                                        <div class="fw-bold">{{ $comment->user->username }}
                                        <a href="{{ route('coment.destroy',$comment->id) }}"  class="trash"  ><i class="fas fa-solid fa-trash"></i></a>
                                        </div>
                                        <p class="comment-body">{{ $comment->body }}</p>
                                        @if($comment->replies->count() > 0)
                                            @foreach($comment->replies as $reply)
                                                <div class="d-flex mt-4">
                                                    @if($reply->user->profile_img)
                                                        <div class="flex-shrink-0 m-2"><img style="width: 40px;height: 40px" class="rounded-circle m-0" src="{{ asset('./images_profiles/'.$reply->user->profile_img) }}" alt="..." /></div>
                                                    @else
                                                        <div class="flex-shrink-0"><img class="rounded-circle m-0" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                    @endif
                                                    <div class="ml-1">

                                                        <div class="fw-bold">{{ $reply->user->username }}
                                                            <a href="{{ route('coment.destroy',$comment->id) }}"  class="trash"  ><i class="fas fa-solid fa-trash"></i></a>
                                                        </div>
                                                        <p class="comment-body">{{ $reply->body }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            <!-- Side widgets-->
        </div>

@endsection
