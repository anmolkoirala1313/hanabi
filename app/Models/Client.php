<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table ='clients';
    protected $fillable =['id','name','image','country','link','created_by','updated_by'];

}
