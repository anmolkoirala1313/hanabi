<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobCategory extends Model
{
    use HasFactory;
    protected $table ='job_categories';
    protected $fillable =['id','name','slug','image','created_by','updated_by'];

    public function jobs(){
        return $this->hasMany('App\Models\Job');
    }
    public function changeToSlug($name){
        return Str::slug($name,'-');
    }
}
