<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
use App\Models\RecruitmentProcess;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $home_path;
    private $welcome_path;
    private $direction_path;
    private $background_path;

    public function __construct()
    {
        $this->middleware('auth');
        $this->home_path   = public_path('/images/home');
        $this->welcome_path   = public_path('/images/home/welcome');
        $this->direction_path   = public_path('/images/home/direction');
        $this->background_path   = public_path('/images/home/background');

    }



    public function index()
    {
        $homesettings    = HomePage::first();
        $recruitment     = RecruitmentProcess::all();
        $settings        = Setting::first();

        return view('backend.home.index',compact('settings','homesettings','recruitment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data=[
            'welcome_heading'          => $request->input('welcome_heading'),
            'welcome_subheading'       => $request->input('welcome_subheading'),
            'welcome_description'      => $request->input('welcome_description'),
            'welcome_side_image'       => $request->input('welcome_side_image'),
            'welcome_video_link'       => $request->input('welcome_video_link'),
            'welcome_button'           => $request->input('welcome_button'),
            'welcome_link'             => $request->input('welcome_link'),
            'created_by'                => Auth::user()->id,
        ];

        if (!empty($request->file('welcome_image'))){

            if (!is_dir($this->home_path)) {
                mkdir($this->home_path, 0777);
            }
            if (!is_dir($this->welcome_path)) {
                mkdir($this->welcome_path, 0777);
            }

            $path    = base_path().'/public/images/home/welcome/';
            $image   = $request->file('welcome_image');
            $name1   = uniqid().'_welcome_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->fit(550, 556)->orientate()->save($path.$name1);
            if ($moved){
                $data['welcome_image']= $name1;
            }
        }


        $theme = HomePage::create($data);
        if($theme){
            Session::flash('success','Welcome section info saved!');
        }
        else{
            Session::flash('error','Could not be saved at the moment !');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */

    public function update(Request $request, $id)
    {
        $update_theme                           =  HomePage::find($id);
        $update_theme->welcome_heading          =  $request->input('welcome_heading');
        $update_theme->welcome_subheading       =  $request->input('welcome_subheading');
        $update_theme->welcome_description      =  $request->input('welcome_description');
        $update_theme->welcome_side_image       =  $request->input('welcome_side_image');
        $update_theme->welcome_video_link       =  $request->input('welcome_video_link');
        $update_theme->welcome_button           =  $request->input('welcome_button');
        $update_theme->welcome_link             =  $request->input('welcome_link');
        $update_theme->updated_by               =  Auth::user()->id;

        $oldimage                       = $update_theme->welcome_image;

        if (!empty($request->file('welcome_image'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('welcome_image');
            $name1 = uniqid().'_welcome_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->fit(550, 556)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->welcome_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/home/welcome/'.$oldimage)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage);
                }
            }

        }

        $status=$update_theme->update();

        if($status){
            Session::flash('success','Welcome Section Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Welcome Section could not be Updated');
        }


        return redirect()->back();
    }

    public function callactionhome(Request $request, $id)
    {
        $update_theme                        =  HomePage::find($id);
        $update_theme->action_heading        =  $request->input('action_heading');
        $update_theme->action_link           =  $request->input('action_link');
        $update_theme->action_link2          =  $request->input('action_link2');
        $update_theme->updated_by            =  Auth::user()->id;

        $status=$update_theme->update();
        if($status){
            Session::flash('success','Call Action Section Updated Successfully');
        } else{
            Session::flash('error','Something Went Wrong. Call Action could not be Updated');
        }
        return redirect()->back();
    }

    public function corevalues(Request $request, $id)
    {
        $update_theme                           =  HomePage::find($id);
        $update_theme->core_main_heading        =  $request->input('core_main_heading');
        $update_theme->core_main_description    =  $request->input('core_main_description');
        $update_theme->core_heading1            =  $request->input('core_heading1');
        $update_theme->core_description1        =  $request->input('core_description1');
        $update_theme->core_heading2            =  $request->input('core_heading2');
        $update_theme->core_description2        =  $request->input('core_description2');
        $update_theme->core_heading3            =  $request->input('core_heading3');
        $update_theme->core_description3        =  $request->input('core_description3');
        $update_theme->core_heading4            =  $request->input('core_heading4');
        $update_theme->core_description4        =  $request->input('core_description4');
        $update_theme->core_heading5            =  $request->input('core_heading5');
        $update_theme->core_description5        =  $request->input('core_description5');
        $update_theme->core_heading6            =  $request->input('core_heading6');
        $update_theme->core_description6        =  $request->input('core_description6');
        $update_theme->updated_by               =  Auth::user()->id;

        $status=$update_theme->update();
        if($status){
            Session::flash('success','Core Value Section Updated Successfully');
        } else{
            Session::flash('error','Something Went Wrong. Core Value Section could not be Updated');
        }
        return redirect()->back();
    }

    public function missionvalues(Request $request, $id)
    {
        $update_theme                       =  HomePage::find($id);
        $update_theme->mv_heading           =  $request->input('mv_heading');
        $update_theme->mv_subheading        =  $request->input('mv_subheading');
        $update_theme->mission              =  $request->input('mission');
        $update_theme->vision               =  $request->input('vision');
        $update_theme->value                =  $request->input('value');
        $update_theme->updated_by           =  Auth::user()->id;
        $oldimage                           = $update_theme->mv_image;

        if (!empty($request->file('mv_image'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('mv_image');
            $name1 = uniqid().'_mv_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->fit(450, 595)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->mv_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/home/welcome/'.$oldimage)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage);
                }
            }
        }

        $status=$update_theme->update();
        if($status){
            Session::flash('success','Mission vision section Updated Successfully');
        } else{
            Session::flash('error','Something Went Wrong. Mission vision section could not be Updated');
        }
        return redirect()->back();
    }

    public function makesdifferent(Request $request, $id)
    {
//        dd($request->all());
        $update_theme                    = HomePage::find($id);
        $update_theme->what_heading1     = $request->input('what_heading1');
        $update_theme->what_heading2     = $request->input('what_heading2');
        $update_theme->what_heading3     = $request->input('what_heading3');
        $update_theme->what_heading4     = $request->input('what_heading4');
        $update_theme->what_heading5     = $request->input('what_heading5');
        $update_theme->updated_by        = Auth::user()->id;
        $oldimage1                       = $update_theme->what_image1;
        $oldimage2                       = $update_theme->what_image2;
        $oldimage3                       = $update_theme->what_image3;
        $oldimage4                       = $update_theme->what_image4;
        $oldimage5                       = $update_theme->what_image5;

        if (!empty($request->file('what_image1'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('what_image1');
            $name1 = uniqid().'_what_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->resize(60, 60)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->what_image1= $name1;
                if (!empty($oldimage1) && file_exists(public_path().'/images/home/welcome/'.$oldimage1)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage1);
                }
            }
        }
        if (!empty($request->file('what_image2'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('what_image2');
            $name1 = uniqid().'_what_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->resize(60, 60)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->what_image2= $name1;
                if (!empty($oldimage1) && file_exists(public_path().'/images/home/welcome/'.$oldimage1)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage1);
                }
            }
        }
        if (!empty($request->file('what_image3'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('what_image3');
            $name1 = uniqid().'_what_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->resize(60, 60)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->what_image3= $name1;
                if (!empty($oldimage1) && file_exists(public_path().'/images/home/welcome/'.$oldimage1)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage1);
                }
            }
        }
        if (!empty($request->file('what_image4'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('what_image4');
            $name1 = uniqid().'_what_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->resize(60, 60)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->what_image4 = $name1;
                if (!empty($oldimage1) && file_exists(public_path().'/images/home/welcome/'.$oldimage1)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage1);
                }
            }
        }
        if (!empty($request->file('what_image5'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('what_image5');
            $name1 = uniqid().'_what_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->resize(60, 60)->orientate()->save($path.$name1);

            if ($moved){
                $update_theme->what_image5 = $name1;
                if (!empty($oldimage1) && file_exists(public_path().'/images/home/welcome/'.$oldimage1)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage1);
                }
            }
        }

        $status = $update_theme->update();
        if($status){
            Session::flash('success','What makes us different section Updated Successfully');
        } else{
            Session::flash('error','Something Went Wrong. What makes us different section could not be Updated');
        }
        return redirect()->back();
    }

    public function whyus(Request $request, $id)
    {
        $update_theme                       =  HomePage::find($id);
        $update_theme->project_completed    =  $request->input('project_completed');
        $update_theme->happy_clients        =  $request->input('happy_clients');
        $update_theme->visa_approved        =  $request->input('visa_approved');
        $update_theme->success_stories      =  $request->input('success_stories');
        $update_theme->why_heading          =  $request->input('why_heading');
        $update_theme->why_subheading       =  $request->input('why_subheading');
        $update_theme->why_description      =  $request->input('why_description');
        $update_theme->why_button           =  $request->input('why_button');
        $update_theme->why_link             =  $request->input('why_link');
        $update_theme->updated_by           =  Auth::user()->id;
        $oldimage5                          = $update_theme->what_image5;

        if (!empty($request->file('what_image5'))){
            $path    = base_path().'/public/images/home/welcome/';
            $image = $request->file('what_image5');
            $name1 = uniqid().'_why_us_'.$image->getClientOriginalName();
            $moved          = Image::make($image->getRealPath())->fit(855, 680)->orientate()->save($path.$name1);
            if ($moved){
                $update_theme->what_image5 = $name1;
                if (!empty($oldimage1) && file_exists(public_path().'/images/home/welcome/'.$oldimage1)){
                    @unlink(public_path().'/images/home/welcome/'.$oldimage1);
                }
            }
        }


        $status=$update_theme->update();
        if($status){
            Session::flash('success','Why us section Updated Successfully');
        } else{
            Session::flash('error','Something Went Wrong. Why us section could not be Updated');
        }
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function grievance(Request $request, $id)
    {
        $update_theme                           =  Setting::find($id);
        $update_theme->grievance_heading        =  $request->input('grievance_heading');
        $update_theme->grievance_description    =  $request->input('grievance_description');
        $update_theme->grievance_button         =  $request->input('grievance_button');
        $update_theme->grievance_link           =  $request->input('grievance_link');
        $update_theme->updated_by               =  Auth::user()->id;

        $status=$update_theme->update();

        if($status){
            Session::flash('success','General Grievance Updated Successfully');
        } else{
            Session::flash('error','Something Went Wrong. General Grievance could not be Updated');
        }
        return redirect()->back();
    }
}
