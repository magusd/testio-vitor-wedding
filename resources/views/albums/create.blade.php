@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <form action="{{route('albums.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Album name</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="Enter your album name">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" checked="checked" name="private" class="form-check-input" id="privacy">
                                <label class="form-check-label" for="privacy">This album is private</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Album</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
