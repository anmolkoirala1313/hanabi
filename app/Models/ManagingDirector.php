<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagingDirector extends Model
{
    use HasFactory;
    protected $table ='managing_director';
    protected $fillable =['id','heading','designation','description','order','link','button','image','created_by','updated_by'];

}
