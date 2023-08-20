<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $service_path;
    private $service_thumb_path;

    public function __construct()
    {
        $this->middleware('auth');
        $this->service_path         = public_path('/images/service_categories');
        $this->service_thumb_path   = public_path('/images/service_categories/thumb');

    }

    public function index()
    {
        $categories = ServiceCategory::all();
        return view('backend.service_category.index',compact('categories'));
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
            'name'                => $request->input('name'),
            'slug'                => $request->input('slug'),
            'short_description'   => $request->input('short_description'),
            'list'                => $request->input('list'),
            'created_by'          => Auth::user()->id,
        ];
        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $name         = uniqid().'_service_category_'.$image->getClientOriginalName();
            $thumb        = 'thumb_'.$name;
            if (!is_dir($this->service_path)) {
                mkdir($this->service_path, 0777);
            }
            if (!is_dir($this->service_thumb_path)) {
                mkdir($this->service_thumb_path, 0777);
            }
            $path         = base_path().'/public/images/service_categories/';
            $thumb_path   = base_path().'/public/images/service_categories/thumb/';
            $moved        = Image::make($image->getRealPath())->fit(850, 420)->orientate()->save($path.$name);
            $thumb        = Image::make($image->getRealPath())->fit(573, 380)->orientate()->save($thumb_path.$thumb);
            if ($moved && $thumb){
                $data['image']= $name;
            }
        }

        $cat = ServiceCategory::create($data);
        if($cat){
            Session::flash('success','Service Category Created Successfully');
        }
        else{
            Session::flash('error','Something went wrong. Service Category cannot be created');
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
        $edit   = ServiceCategory::find($id);
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
        $cat                      =  ServiceCategory::find($id);
        $cat->name                =  $request->input('name');
        $cat->slug                =  $request->input('slug');
        $cat->short_description   =  $request->input('short_description');
        $cat->list                =  $request->input('list');
        $oldimage                 = $cat->image;
        $thumbimage               = 'thumb_'.$cat->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_service_category_'.$image->getClientOriginalName();
            $thumb                = 'thumb_'.$name;
            $path                 = base_path().'/public/images/service_categories/';
            $thumb_path           = base_path().'/public/images/service_categories/thumb/';
            $moved                = Image::make($image->getRealPath())->fit(850, 420)->orientate()->save($path.$name);
            $thumb                = Image::make($image->getRealPath())->fit(573, 380)->orientate()->save($thumb_path.$thumb);

            if ($moved && $thumb){
                $cat->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/service_categories/'.$oldimage)){
                    @unlink(public_path().'/images/service_categories/'.$oldimage);
                }
                if (!empty($thumbimage) && file_exists(public_path().'/images/service_categories/thumb/'.$thumbimage)){
                    @unlink(public_path().'/images/service_categories/thumb/'.$thumbimage);
                }
            }
        }
        $status = $cat->update();
        if($status){
            Session::flash('success','Service Category was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Service Category could not be Updated');
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
        $delete             = ServiceCategory::find($id);
        $rid                = $delete->id;
        $thumbimage         = "thumb_".$delete->image;

        if (!empty($delete->image) && file_exists(public_path().'/images/service_categories/'.$delete->image)){
            @unlink(public_path().'/images/service_categories/'.$delete->image);
        }
        if (!empty($thumbimage) && file_exists(public_path().'/images/service_categories/thumb/'.$thumbimage)){
            @unlink(public_path().'/images/service_categories/thumb/'.$thumbimage);
        }
        $remove          =$delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Service Category has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Service Category could not be removed. Try Again later !']);
        };
    }
}
