<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInquiry extends Model
{
    use HasFactory;
    protected $table ='customer_inquiries';
    protected $fillable =['id','name','email','phone','subject','qualification','preparation_class','preferred_location','interested_country','message','status','created_by','updated_by'];

}
