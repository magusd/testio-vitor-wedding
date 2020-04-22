@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header"><a href="{{route('albums.show',$photo->album->id)}}">Album {{$photo->album->name}}</a></div>

                    <div class="card-body">

                        <img class="img-fluid" src="data:image/png;base64, {{$photo->base64}}" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
