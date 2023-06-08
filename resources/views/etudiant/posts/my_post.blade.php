@extends('etudiant.base')

@section('main')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Posts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Post </li>
                </ol>
                <a class="btn btn-outline-facebook" href="{{ route('Post.create') }}">Cree un post</a>
                <a class="btn btn-outline-instagram " href="{{ route('Post.index') }}">Touts les posts</a>
            </nav>
        </div><!-- End Page Title -->
        <div class="container-fluid">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-4">
                        <div class="card" style="width: 250px;height: 400px">
                            @if($post->image)
                                <img class="card-img" style="margin: 0px;max-height: 200px" src="{{ asset('./images_posts/'.$post->image) }}" alt="Bologna">
                            @else
                                <img class="card-img" style="margin: 0px" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg" alt="Bologna">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title"  style="padding-top: 0px">{{ $post->title }}</h4>
                                <p class="text-primary cat">
                                    @if($post->users->profile_img)
                                        <img class="img-circle" style="height: 30px;width: 30px;margin: 0px" src="{{ asset('./images_profiles/'.$post->users->profile_img) }}" alt="">
                                    @else
                                        <img class="img-circle" style="height: 30px;width: 30px;margin: 0px" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg" alt="">
                                    @endif
                                    @<span>{{ $post->users->username }}</span>
                                </p>
                                <a href="{{ route('Post.show',$post->id) }}" class="btn btn-info">Read more</a>
                            </div>
                            <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                                <div class="views">{{Carbon\Carbon::parse($post->created_at)->format('M d, h:iA')}}
                                </div>
                                <div class="stats">
                                    <form method="GET" action="{{ route('Post.destroy',$post->id) }}">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" style="border: 0px;background-color: white;color: red"><i class="fa-solid fa-trash"></i>delete</button>
                                    </form>
                                    <button style="border: 0px;background-color: white;color: #336EFF" href="{{ route('Post.edit',$post->id) }}"><i class="fa-solid fa-pen-to-square"></i>edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <div class="modal fade" id="confirmationdelete" tabindex="-1" role="dialog" aria-labelledby="createStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createStudentModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <h1>are you sure to delete this post </h1>
                        <button type="submit">delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  @push('script')
      <script>
          function yarbi(){
              document.getElementById('deletePost').addEventListener('click', function(event) {
                  event.preventDefault(); // Prevent the default link behavior

                  // Show the delete confirmation modal
                  const confirmationModal = document.getElementById('confirmationdelete');
                  confirmationModal.style.display = 'block';
              });
          }
      </script>
  @endpush

@endsection
