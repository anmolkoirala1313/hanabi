<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionElement extends Model
{
    use HasFactory;
    protected $table ='section_elements';
    protected $fillable =['id','heading','subheading','image','description','list_header','list_image','list_description','extra_description','button','button_link','page_section_id','created_by','updated_by'];

    public function section()
    {
        return $this->belongsTo('App\Models\PageSection','page_section_id', 'id')->with('page');
    }
}
