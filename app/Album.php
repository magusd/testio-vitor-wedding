<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['name','private'];
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function photos_path()
    {
        return $this->owner->photos_path().'/'.$this->id;
    }

}
