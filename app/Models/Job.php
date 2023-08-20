<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory;
    protected $table ='jobs';
    protected $fillable =['id','category_ids','name','title','code','slug','lt_number','required_number','formlink','min_qualification','image','salary','description','end_date','start_date','status','extra_company','meta_title','meta_tags','meta_description','created_by','updated_by'];

//    public function category(){
//        return $this->belongsTo('App\Models\JobCategory','job_category_id','id');
//    }
//
//    public function client(){
//        return $this->belongsTo('App\Models\Client','client_id','id');
//    }


    public function jobs(){
        return $this->hasMany('App\Models\JobApplication');
    }

    public function changeToSlug($name){
        return Str::slug(base64_encode($name), '-');
    }


    public function getJobCategories($ids){
        $category_id = explode(",", $ids);
        return implode (", ", array_map(function ($item) {
            return JobCategory::find($item)->name ?? "N/A";
        }, $category_id));
    }

}
