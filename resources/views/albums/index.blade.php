@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your albums</div>

                    <div class="card-body">
                        <div class="list-group">
                        @forelse($albums as $album)
                                <a href="{{route('albums.show',$album->id)}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{$album->name}}
                                    @if($album->private)
                                        <i class="fas fa-eye-slash text-danger"></i>
                                    @else
                                        <i class="fas fa-eye text-success"></i>
                                    @endif
                                    <span class="badge badge-primary badge-pill">{{$album->photos_count}}</span>
                                </a>
                        @empty
                            <span>You have no albums! Create your first by cliking the button bellow!</span>
                        @endforelse
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-success" href="{{route('albums.create')}}">Create Album</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
