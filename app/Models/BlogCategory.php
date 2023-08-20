<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table ='blog_categories';
    protected $fillable =['id','name','slug','created_by','updated_by'];

    public function blogs(){
        return $this->hasMany('App\Models\Blog');
    }

}
