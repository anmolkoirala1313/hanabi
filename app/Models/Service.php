<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table ='services';
    protected $fillable = ['id','title','slug','description','sub_description','banner_image','feature_image','meta_title','meta_tags','meta_description','created_by','updated_by'];
}
