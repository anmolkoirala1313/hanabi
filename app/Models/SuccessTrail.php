<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessTrail extends Model
{
    use HasFactory;
    protected $table ='success_trails';
    protected $fillable =['id','title','country','image','created_by','updated_by'];

}
