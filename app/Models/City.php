<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table ='cities';
    protected $fillable =['id','title','country','image','created_by','updated_by'];

}
