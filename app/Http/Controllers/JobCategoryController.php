<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class JobCategoryController extends Controller
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
        $categories = JobCategory::all();
        return view('backend.job.category.index',compact('categories'));
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
            'name'                  => $request->input('name'),
            'slug'                  => $request->input('slug'),
            'created_by'             => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $name         = uniqid().'_category_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/job/';
            $moved        = Image::make($image->getRealPath())->fit(500, 500)->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }
        $status = JobCategory::create($data);
        if($status){
            Session::flash('success','Job Category Created Successfully');
        }
        else{
            Session::flash('error','Job Category Creation Failed');
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
        $edit           = JobCategory::find($id);
        return response()->json(["edit"=>$edit]);
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
        $category                       = JobCategory::find($id);
        $category->name                 = $request->input('name');
        $category->slug                 = $request->input('slug');
        $category->updated_by           = Auth::user()->id;
        $oldimage                       = $category->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_category_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/job/';
            $moved                = Image::make($image->getRealPath())->fit(500, 500)->orientate()->save($path.$name);
            if ($moved){
                $category->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/job/'.$oldimage)){
                    @unlink(public_path().'/images/job/'.$oldimage);
                }
            }
        }
        $status = $category->update();
        if($status){
            Session::flash('success','Job Category was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Job Category could not be Updated');
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
        $delete       = JobCategory::find($id);
        $rid          = $delete->id;
//        if (!empty($delete->image) && file_exists(public_path().'/images/job/'.$delete->image)){
//            @unlink(public_path().'/images/job/'.$delete->image);
//        }
        $remove          =$delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Job category has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Job category could not be removed. Try Again later !']);
        }
    }
}
