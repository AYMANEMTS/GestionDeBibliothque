@extends('etudiant.base')

@section('main')
    <main id="main" class="main">
        <!-- Page content-->
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
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
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
                                <h3>leave a comment !</h3>
                                <!-- Comment form-->
                                <form action="{{ route('coment.store') }}" method="post" class="mb-4">
                                    @csrf
                                    <input name="post_id" value="{{ $post->id }}" hidden>
                                    <textarea name="body" class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                                    <button class="btn btn-primary m-1" type="submit">Submit</button>
                                </form>
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
                                            <a class="reply-link" style="margin-left: 20px" href="#!"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a>
                                        </div>
                                        <p>{{ $comment->body }}</p>
                                        <div class="reply-input" style="display: none;">
                                            <form method="post" action="{{ route('coment.storeChild') }}">
                                                @csrf
                                                <input name="post_id" value="{{ $post->id }}" hidden>
                                                <input name="parent_id" value="{{ $comment->id }}" hidden>
                                                <textarea class="form-control" name="body" id="" cols="50" rows="1"></textarea>
                                                <button type="submit" class="btn btn-sm btn-primary mt-2 reply-submit">Submit</button>
                                            </form>
                                        </div>
                                        @if($comment->replies->count() > 0)
                                            @foreach($comment->replies as $reply)
                                                <div class="d-flex mt-4">
                                                    @if($reply->user->profile_img)
                                                        <div class="flex-shrink-0 m-2"><img style="width: 40px;height: 40px" class="rounded-circle m-0" src="{{ asset('./images_profiles/'.$reply->user->profile_img) }}" alt="..." /></div>
                                                    @else
                                                        <div class="flex-shrink-0"><img class="rounded-circle m-0" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                    @endif                                                    <div class="ml-1">
                                                        <div class="fw-bold">{{ $reply->user->username }}</div>
                                                        {{ $reply->body }}
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
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.reply-link').click(function(e) {
                e.preventDefault();
                $(this).closest('.d-flex').find('.reply-input').toggle();
            });
        });
    </script>
@endsection
