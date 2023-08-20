<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table ='menus';
    protected $fillable =['name','title','slug','location','content','created_by','updated_by'];

    public function menuitems()
    {
        return $this->hasMany('App\Models\MenuItem');
    }
}

