<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['path'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function getBase64Attribute($value)
    {
        try{
            $contents = \Illuminate\Support\Facades\Storage::get($this->path);
            return base64_encode($contents);
        }catch (\Exception $e){
            return "";
        }
    }
}
