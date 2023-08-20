<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionGallery extends Model
{
    use HasFactory;
    protected $table ='section_gallery';
    protected $fillable =['id','filename','resized_name','original_name','page_section_id','upload_by'];

    public function section()
    {
        return $this->belongsTo('App\Models\PageSection','page_section_id', 'id');
    }
}
