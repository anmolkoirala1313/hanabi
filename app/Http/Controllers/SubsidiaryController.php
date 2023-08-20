<?php

namespace App\Http\Controllers;

use App\Models\Subsidiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class SubsidiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path;

    public function __construct()
    {
        $this->path   = public_path('/images/subsidiary');
        $this->middleware('auth');
    }

    public function index()
    {
        $subsidairies        = Subsidiary::all();
        return view('backend.subsidiary.index',compact('subsidairies'));
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
            'link'                => $request->input('link'),
            'created_by'          => Auth::user()->id,
        ];
        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            if (!is_dir($this->path)) {
                mkdir($this->path, 0777);
            }
            $name         = uniqid().'_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/subsidiary/';
            $moved        = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }
        $clients = Subsidiary::create($data);
        if($clients){
            Session::flash('success','Subsidiary Created Successfully');
        }
        else{
            Session::flash('error','Something went wrong. Subsidiary cannot be created');
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
        $edit           = Subsidiary::find($id);
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
        $subsidiary                  =  Subsidiary::find($id);
        $subsidiary->name            =  $request->input('name');
        $subsidiary->link            =  $request->input('link');
        $oldimage                    = $subsidiary->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/subsidiary/';
            $moved                = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $subsidiary->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/subsidiary/'.$oldimage)){
                    @unlink(public_path().'/images/subsidiary/'.$oldimage);
                }
            }
        }
        $status = $subsidiary->update();
        if($status){
            Session::flash('success','Subsidiary was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Subsidiary could not be Updated');
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
        $delete       = Subsidiary::find($id);
        if (!empty($delete->image) && file_exists(public_path().'/images/subsidiary/'.$delete->image)){
            @unlink(public_path().'/images/subsidiary/'.$delete->image);
        }

        $remove          =$delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Subsidiary has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Subsidiary could not be removed. Try Again later !']);
        }
    }
}
