@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="text-danger">Warning!</span>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Album {{$album->name}}</h5>

                        <p>You are about to delete the album and all of its contents!</p>

                        <p class="text-lg-center text-danger">This action is irreversible!</p>

                        <p>To proceed with this action we require confirmation, please type "delete album" in the box below</p>

                        <form action="{{route('albums.delete',$album->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <div class="form-group">
                                <label for="deleteConfirmation">Confirmation</label>
                                <input type="text" class="form-control" name="delete_confirmation" id="deleteConfirmation" aria-describedby="deleteConfirmation" placeholder="delete album">
                            </div>
                            <button type="submit" class="btn btn-danger">Delete Album</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
