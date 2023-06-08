@extends('admin.base')
@section('moder2')

    <div class="container-fluid" >
        <h1>List Posts accepter : </h1><br>
        @if(session('done'))
            <div class="alert alert-success">
                {{ session('done') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('moder.postsatt') }}" class="btn btn-primary">Post en attend</a><br><br>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Post</th>
                <th>User</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
            </thead>
            @foreach($posts as $post )
                <tbody>
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img
                                src="{{ asset('./images_posts/'.$post->image) }}"
                                alt=""
                                style="width: 45px; height: 45px"
                                class="rounded-circle"
                            />
                            <div class="ms-3">
                                <p class="fw-bold ml-2 mb-1">  {{ $post->title }}</p>
                            </div>
                        </div>
                    </td> <!--post-->
                    <td>
                        <div class="d-flex align-items-center">
                            <img
                                src="{{ asset('./images_profiles/'.$post->users->profile_img) }}"
                                alt=""
                                style="width: 45px; height: 45px"
                                class="rounded-circle"
                            />
                            <div class="ms-3">
                                <p class="fw-bold ml-2 mb-1">  {{ $post->users->username }}</p>
                            </div>
                        </div>
                    </td> <!--user-->
                    <td>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</td> <!--created_at-->
                    <td>
                        <a href="{{ route('moder.postshow',$post->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-primary">View</a>
                        <a href="{{ route('moder.refusePost',$post->id) }}" type="button" style="padding: 2px" class="btn  btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
        </table>


        <div style="padding-top: 40px;padding-bottom: 40px">
            {{ $posts->links() }}
        </div>
    </div>




@endsection
