<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table ='pages';
    protected $fillable =['id','name','slug','image','status','created_by','updated_by'];

    public function sections()
    {
        return $this->hasMany('App\Models\PageSection')->with('elements')->orderBy('position', 'ASC');
    }
}
