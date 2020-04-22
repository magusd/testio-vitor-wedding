<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\CreateAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums = auth()->user()->albums()->get();
        return view('albums.index',compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(CreateAlbumRequest $request)
    {
        $input = $request->all();
        if(!isset($input['private'])){
            $input['private'] = false;
        }
        $album = auth()->user()->albums()->create($input);
        if($album){
            $request->session()->flash('status', 'Your album was created!');
        }
        return redirect(route('albums.show',$album->id));

    }

    public function show($id)
    {
        $album = auth()->user()->albums()->with('photos')->find($id);
        $this->authorize('view',$album);
        if(!$album)
            abort(404);
        return view('albums.show',compact('album'));
    }

    public function edit($id)
    {
        $album = auth()->user()->albums()->with('photos')->find($id);
        $this->authorize('view',$album);
        if(!$album)
            abort(404);
        return view('albums.edit',compact('album'));
    }

    public function update(UpdateAlbumRequest $request,$id)
    {
        $album = auth()->user()->albums()->with('photos')->find($id);
        $this->authorize('update',$album);
        if(!$album)
            abort(404);
        $album->fill($request->all());
        $album->save();
        return redirect(route('albums.show',$id));
    }

    public function deleteWarning($id)
    {
        $album = auth()->user()->albums()->with('photos')->find($id);
        $this->authorize('delete',$album);
        if(!$album)
            abort(404);
        return view('albums.delete-warning',compact('album'));
    }

    public function delete(Request $request,$id)
    {
        $confirmation = $request->input('delete_confirmation','');

        if($confirmation !== 'delete album'){
            $request->session()->flash('alert-warning', "You must type 'delete album' in the confirmation box in order to delete this album");
            return redirect()->back();
        }

        $album = auth()->user()->albums()->with('photos')->find($id);
        $this->authorize('delete',$album);
        if(!$album)
            abort(404);

        $name = $album->name;
        $paths = array_map(function($photo){
            return $photo['path'];
        },$album->photos->toArray());
        $album->photos()->delete();
        #delete photos disk $paths
        $album->delete();

        $request->session()->flash('alert-success', "Album $name was deleted!");
        return redirect(route('albums'));
    }
}
