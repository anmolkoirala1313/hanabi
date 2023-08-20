<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table ='albums';
    protected $fillable =['id','name','slug','cover_image','created_by','updated_by'];


    public function gallery()
    {
        return $this->hasMany('App\Models\AlbumGallery');
    }
}
