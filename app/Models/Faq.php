<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Faq extends Model
{
    use HasFactory;

    protected $table ='faq';
    protected $fillable =['id','name','description','created_by','updated_by'];

}
