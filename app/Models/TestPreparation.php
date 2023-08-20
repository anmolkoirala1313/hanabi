<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TestPreparation extends Model
{
    use HasFactory;
    protected $table ='test_preparations';
    protected $fillable =['id','title','slug','image','summary','description','status','meta_title','meta_tags','meta_description','status','created_by','updated_by'];


    public function changeToSlug($name){
        return Str::slug(base64_encode($name), '-');
    }
}
