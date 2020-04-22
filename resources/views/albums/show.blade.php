@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('albums.photos.create',$album->id)}}">
                                    <i class="fas fa-plus"></i>
                                    Add Photos
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('albums.edit',$album->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('albums.delete.warning',$album->id)}}">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Album {{$album->name}}
                            @if($album->private)
                                <i class="fas fa-eye-slash text-danger"></i>
                            @else
                                <i class="fas fa-eye text-success"></i>
                            @endif
                        </h5>
                        @forelse($album->photos as $photo)
                            <a href="{{route('album.photo.show',['id'=>$album->id,'photo_id'=>$photo->id])}}">
                                <img class="img-thumbnail" src="data:image/png;base64, {{$photo->base64}}" alt="">
                            </a>
                        @empty
                            <span>This album has no photos. To add photos go <a href="{{route('albums.photos.create',$album->id)}}">here</a></span>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
