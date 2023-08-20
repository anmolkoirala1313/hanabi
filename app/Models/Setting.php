<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table ='settings';
    protected $fillable =['id','website_name','linkedin','favicon','ticktock','theme_mode','website_description','logo_white','phone','mobile','whatsapp','viber','facebook','youtube','instagram','address','email','meta_title','meta_tags','meta_description','google_analytics','intro_heading','intro_subheading','intro_description','intro_image','intro_button','intro_button_link','customer_served','visa_approved','success_stories','happy_customers','google_map','meta_pixel','callaction1_heading','callaction1_button','callaction1_button_link','callaction1_image','callaction2_heading','callaction2_subheading','callaction2_button','callaction2_button_link','privacy_policy','terms_conditions','professionals','projects','clients','online','grievance_link','grievance_button','grievance_description','grievance_heading','created_by','updated_by'];
}
