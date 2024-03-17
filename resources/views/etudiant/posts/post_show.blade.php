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
                            <div class="d-flex align-items">
                                @php
                                    $Lstatus = 'grey';
                                    $Dstatus = 'grey';
                                    $user = \Illuminate\Support\Facades\Auth::user();
                                    $like = \App\Models\Like::where('user_id',$user->id)->where('post_id',$post->id)->first();
                                    $dislike = \App\Models\Deslike::where('user_id',$user->id)->where('post_id',$post->id)->first();
                                    if ($like){$Lstatus = 'green';}else{$Lstatus = 'grey';}
                                    if ($dislike){$Dstatus = 'red';}else{$Dstatus = 'grey';}
                                 @endphp
                                <form action="{{ route('posts.like') }}" method="POST" id="form-js">
                                    <div id="count-js">{{ $post->likes->count() }} Like(s)</div>
                                    <input type="hidden" id="post-id-js" value="{{ $post->id }}">
                                    <button type="submit" class="btn "><i id="like" style="color: {{ $Lstatus }}" class="fa fa-light fa-thumbs-up"></i><b>     J'aime</b></button>
                                </form>
                                <form action="{{ route('posts.deslike') }}" id="form-deslike-post">
                                    <div id="count-ds-js">{{ $post->deslikes->count() }} Dislike(s)</div>
                                    <input type="hidden" id="post-id-js" value="{{ $post->id }}">
                                    <button type="submit" class="btn "><i id="dislike" style="color: {{$Dstatus}}" class="fa fa-light fa-thumbs-down"></i><b>     J'aime pas</b></button>
                                </form>
                            </div>
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
                                    @php
                                        $LCstatus = 'grey';
                                        $DCstatus = 'grey';
                                        $likeC = \App\Models\Like::where('user_id',$user->id)->where('cmnt_id',$comment->id)->first();
                                        $dislikeC = \App\Models\Deslike::where('user_id',$user->id)->where('cmnt_id',$comment->id)->first();
                                        if ($likeC){$LCstatus = 'green';}
                                        if ($dislikeC){$DCstatus = 'red';}
                                    @endphp
                                <div class="d-flex m-2">
                                    @if($comment->user->profile_img)
                                        <div class="flex-shrink-0 m-2"><img style="width: 40px;height: 40px" class="rounded-circle m-0" src="{{ asset('./images_profiles/'.$comment->user->profile_img) }}" alt="..." /></div>
                                    @else
                                        <div class="flex-shrink-0"><img class="rounded-circle m-0" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    @endif
                                    <div class="ml-1">
                                        <input name="parent_id" value="{{ $comment->id }}" hidden>
                                        <div class="fw-bold">{{ $comment->user->username }}
                                            <a class="reply-link" style="margin-left: 20px" href=""><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a>
                                        @if($comment->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                <a class="reply-link-edit"  href=""><i class="fa-solid fa-pen"></i></a>
                                                <a href="{{ route('coment.destroy',$comment->id) }}"  class="trash"  ><i class="fa-solid fa-trash"></i></a>
                                       @endif
                                        </div>
                                        <p class="comment-body">{{ $comment->body }}</p>
                                        <form class="comment-body-input" method="post" action="{{ route('coment.update',$comment->id) }}">
                                            @csrf
                                            <input type="text" name="body_update" class="form-control"  value="{{ $comment->body }}">
                                            <input class="btn btn-sm btn-info m-1" type="submit" value="update">
                                        </form>
                                        <div class="d-flex align-items">
                                            <form  action="{{ route('comment.like') }}" id="form-cmnt">
                                                <div id="count-cmnt-js">{{ $comment->likes->count() }} Like(s)</div>
                                                <input type="hidden" name="id" id="cmnt-id-js" value="{{ $comment->id }}">
                                                <button type="submit" class="btn "><i style="color: {{ $LCstatus }}" id="likeComent"  class="fa fa-light fa-thumbs-up likeComent"></i><b>     J'aime</b></button>
                                            </form>
                                            <form  action="{{ route('comment.dislike') }}" id="form-dis-cmnt">
                                                <div id="count-dscm-js">{{ $comment->deslikes->count() }} Dislike(s)</div>
                                                <input type="hidden" name="id" id="cmnt-id-js" value="{{ $comment->id }}">
                                                <button type="submit" class="btn "><i id="dislikeComment" style="color: {{ $DCstatus }}" class="fa fa-light fa-thumbs-down"></i><b>     J'aime</b></button>
                                            </form>
                                        </div>

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
                                                    @endif
                                                        <div class="ml-1">

                                                        <div class="fw-bold">{{ $reply->user->username }}
                                                            @if($reply->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                                <a class="reply-link-edit" style="margin-left: 10px"  href=""><i class="fa-solid fa-pen"></i></a>
                                                                <a href="{{ route('coment.destroy',$reply->id) }}"  class="trash"  ><i class="fa-solid fa-trash"></i></a>

                                                            @endif
                                                        </div>
                                                            <p class="comment-body">{{ $reply->body }}</p>
                                                            <form class="comment-body-input" method="post" action="{{ route('coment.update',$comment->id) }}">
                                                                @csrf
                                                                <input type="text" name="body_update" class="form-control"  value="{{ $reply->body }}">
                                                                <input class="btn btn-sm btn-info m-1" type="submit" value="update">
                                                            </form>
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
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.reply-link').click(function(e) {
                e.preventDefault();
                $(this).closest('.d-flex').find('.reply-input').toggle();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.reply-link-edit').click(function(e) {
                e.preventDefault();
                var commentDetails = $(this).closest('.d-flex');
                var commentBody = commentDetails.find('.comment-body');
                var commentInput = commentDetails.find('.comment-body-input');

                if (commentBody.is(':visible')) {
                    commentBody.hide();
                    commentInput.show();
                    commentInput.focus();
                } else {
                    commentBody.show();
                    commentInput.hide();
                }
            });
            // Hide input fields initially
            $('.comment-body-input').hide();
        });
    </script>
    <script src="{{ asset('likePost.js') }}"></script>
    <script src="{{ asset('DeslikePost.js') }}"></script>
    <script src="{{ asset('likeComment.js') }}"></script>
    <script src="{{ asset('DislikeComment.js') }}"></script>
@endsection
