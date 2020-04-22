<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoUploadRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumsPhotosController extends Controller
{
    public function upload($id)
    {
        $album = auth()->user()->albums()->with('photos')->find($id);
        $this->authorize('view',$album);
        if(!$album)
            abort(404);
        return view('photos.upload',compact('album'));
    }

    public function store(PhotoUploadRequest $request,$id)
    {
        $album = auth()->user()->albums()->with('photos')->find($id);
        $this->authorize('create',Photo::class);
        if(!$album)
            abort(404);

        $destinationPath = auth()->user()->photos_path();
        Storage::makeDirectory($destinationPath);
        $allowedfileExtension = array("jpeg","jpg","png");
        $files = $request->file('files');
        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();

            if(!in_array($extension,$allowedfileExtension)){
                $request->session()->flash('alert-danger', "You can only upload image files!");
                continue;
            }
            $stored = $file->store($album->photos_path());
            #here i'd also resize images and store them on $destinationPath.'/'.$album->id.'/thumnails'
            $album->photos()->create([
                'path' => $stored
            ]);
        }
        return redirect(route('albums.show',$album->id));
    }
}
