@extends('base')
@section('title','Suprimer un utilisateur')
@include('parts.navbar_super')
@section('super')
    <div class="content" style="margin-left: 200px;margin-top: 100px">
        <h1 style="padding-left: 40px">Suprimer un utilisateur : </h1>
        <div class="" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user : <span class="text-lg text-danger">{{ $user->username }} </span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('admin.users') }}" type="button" class="btn btn-secondary">Cancel</a>
                        <form action="{{ route('admin.user.delete.vrf' , $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button style="margin: 4px" class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
