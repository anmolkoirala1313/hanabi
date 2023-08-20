<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentProcess extends Model
{
    use HasFactory;
    protected $table ='recruitment_process';
    protected $fillable =['id','heading','description','link','icon','icon_description','title','created_by','updated_by'];
}
