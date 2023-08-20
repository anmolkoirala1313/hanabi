<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDescription extends Model
{
    use HasFactory;
    protected $table ='course_description';
    protected $fillable = ['id','course_id','title','description'];

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }

}
