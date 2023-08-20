<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;



class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $sliders = Slider::orderby('created_at','desc')->get();
        return view('backend.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'heading'           => $request->input('heading'),
            'subheading'        => $request->input('subheading'),
            'button'            => $request->input('button'),
            'link'              => $request->input('link'),
            'status'            => $request->input('status'),
            'slider_link'       => $request->input('slider_link'),
            'caption1'          => $request->input('caption1'),
            'caption2'          => $request->input('caption2'),
            'link2'             => $request->input('link2'),
            'button2'           => $request->input('button2'),
            'created_by'        => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $name         = uniqid().'_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/sliders/';
            $moved        = Image::make($image->getRealPath())->fit(1920, 800)->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }

        $slider = Slider::create($data);
        if($slider){
            Session::flash('success','Slider Created Successfully');
        }
        else{
            Session::flash('error','Something went wrong. Slider cannot be created');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit   = Slider::find($id);
        return response()->json($edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slider                   =  Slider::find($id);
        $slider->heading          =  $request->input('heading');
        $slider->subheading       =  $request->input('subheading');
        $slider->button           =  $request->input('button');
        $slider->link             =  $request->input('link');
        $slider->status           =  $request->input('status');
        $slider->slider_link      =  $request->input('slider_link');
        $slider->caption1         =  $request->input('caption1');
        $slider->caption2         =  $request->input('caption2');
        $slider->link2            =  $request->input('link2');
        $slider->button2          =  $request->input('button2');
        $oldimage                 =  $slider->image;

        if (!empty($request->file('image'))){
            $image               =  $request->file('image');
            $name1               = uniqid().'_'.$image->getClientOriginalName();
            $path                = base_path().'/public/images/sliders/';
            $moved               = Image::make($image->getRealPath())->fit(1920, 800)->orientate()->save($path.$name1);
            if ($moved){
                $slider->image = $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/sliders/'.$oldimage)){
                    @unlink(public_path().'/images/sliders/'.$oldimage);
                }
            }
        }
        $status = $slider->update();
        if($status){
            Session::flash('success','Slider was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Slider could not be Updated');
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteslider       = Slider::find($id);
        $rid                = $deleteslider->id;
        $image              = $deleteslider->image;
        if (!empty($image) && file_exists(public_path().'/images/sliders/'.$image)){
            @unlink(public_path().'/images/sliders/'.$image);
        }
        $remove          = $deleteslider->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Slider has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Slider could not be removed. Try Again later !']);
        }
    }

    public function updateStatus(Request $request, $id){
        $slider          = Slider::find($id);
        $slider->status  = $request->status;
        $status          = $slider->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
