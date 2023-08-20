<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $testimonial_path;

    public function __construct()
    {
        $this->middleware('auth');
        $this->testimonial_path   = public_path('/images/testimonial');

    }

    public function index()
    {
        $testimonials           = Testimonial::all();
        return view('backend.testimonial.index',compact('testimonials'));
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
            'name'              => $request->input('name'),
            'position'          => $request->input('position'),
            'description'       => $request->input('description'),
            'created_by'        => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image          = $request->file('image');
            $name           = uniqid().'_testimonial_'.$image->getClientOriginalName();

            if (!is_dir($this->testimonial_path)) {
                mkdir($this->testimonial_path, 0777);
            }
            $path           = base_path().'/public/images/testimonial/';
            $moved          = Image::make($image->getRealPath())->fit(80,80)->orientate()->save($path.$name);

            if ($moved){
                $data['image']=$name;
            }
        }
        $testimonial = Testimonial::create($data);
        if($testimonial){
            Session::flash('success','Testimonial was created successfully !');
        }
        else{
            Session::flash('error','Testimonial could not be created at the moment !');
        }

        return redirect()->route('testimonials.index');
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
        $edit    = Testimonial::find($id);
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
        $testimonial                      =  Testimonial::find($id);
        $testimonial->name                =  $request->input('name');
        $testimonial->position            =  $request->input('position');
        $testimonial->description         =  $request->input('description');
        $oldimage                         =  $testimonial->image;

        if (!empty($request->file('image'))){
            $image       = $request->file('image');
            $path        = base_path().'/public/images/testimonial/';
            $name1       = uniqid().'_testimonial_'.$image->getClientOriginalName();
            $moved       = Image::make($image->getRealPath())->fit(80,80)->orientate()->save($path.$name1);

            if ($moved){
                $testimonial->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/testimonial/'.$oldimage)){
                    @unlink(public_path().'/images/testimonial/'.$oldimage);
                }
            }
        }
        $status = $testimonial->update();
        if($status){
            Session::flash('success','Testimonial was updated successfully !');
        }
        else{
            Session::flash('error','Something Went Wrong. Testimonial could not be updated at the moment !');
        }
        return redirect()->route('testimonials.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete          = Testimonial::find($id);
        $blogid          = $delete->id;
        $feature         = $delete->image;
        if (!empty($feature) && file_exists(public_path().'/images/testimonial/'.$feature)){
            @unlink(public_path().'/images/testimonial/'.$feature);
        }
        $remove          = $delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Testimonial has been removed succesfully! ','id'=>$blogid]);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Testimonial could not be removed. Try Again later !']);
        }
    }
}
