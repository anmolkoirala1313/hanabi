<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table ='blogs';
    protected $fillable =['id','title','slug','description','status','image','blog_category_id','meta_title','meta_tags','meta_description','created_by','updated_by'];

    public function category(){
        return $this->belongsTo('App\Models\BlogCategory','blog_category_id','id');
    }
}
