<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumGallery extends Model
{
    use HasFactory;
    protected $table ='album_gallery';
    protected $fillable =['id','filename','resized_name','original_name','album_id','upload_by'];

    public function album()
    {
        return $this->belongsTo('App\Models\Album','album_id', 'id');
    }
}
