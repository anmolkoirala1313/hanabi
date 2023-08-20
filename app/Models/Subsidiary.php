<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    use HasFactory;
    protected $table ='subsidiaries';
    protected $fillable =['id','name','image','link','created_by','updated_by'];
}
