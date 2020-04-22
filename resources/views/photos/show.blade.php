@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                <div class="card">
                    <div class="card-header"><a href="{{route('albums.show',$photo->album->id)}}">Album {{$photo->album->name}}</a></div>

                    <div class="card-body">

                        <img class="img-fluid" src="data:image/png;base64, {{base64_encode(\Illuminate\Support\Facades\Storage::get($photo->path))}}" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
