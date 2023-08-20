<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;
    protected $table ='courses';
    protected $fillable =['id','title','slug','code','description','living','entry_requirement','visa_requirement','education_cost','after_graduation','useful_links','image','meta_title','meta_tags','meta_description','status','created_by','updated_by'];


    public function changeToSlug($name){
        return Str::slug(base64_encode($name), '-');
    }

    public function courseDescription(){
        return $this->hasMany(CourseDescription::class,'course_id','id');
    }

}
