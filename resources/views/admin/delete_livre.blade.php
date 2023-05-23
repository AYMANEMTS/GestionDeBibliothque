@extends('base')
@section('title','Delete Livre ')
@include('parts.navbar_moder')


@section('moder')

    <div class="content" style="margin-left: 250px;margin-top: 100px">
        <h1>Delete Livre : </h1>
        <div class="" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this livre : <span class="text-lg text-danger">{{ $livre->titre }} </span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('moder.livre') }}" type="button" class="btn btn-secondary">Cancel</a>
                        <form action="{{ route('moder.livre.delete' , $livre->id) }}" method="post">
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
