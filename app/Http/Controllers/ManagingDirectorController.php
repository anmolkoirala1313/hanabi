<?php

namespace App\Http\Controllers;

use App\Models\ManagingDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ManagingDirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path;

    public function __construct()
    {
        $this->middleware('auth');
        $this->path   = public_path('/images/director');

    }

    public function index()
    {
        $director        = ManagingDirector::all();
        return view('backend.director.index',compact('director'));
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
            'heading'             => $request->input('heading'),
            'designation'         => $request->input('designation'),
            'description'         => $request->input('description'),
            'link'                => $request->input('link'),
            'button'              => $request->input('button'),
            'created_by'          => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $name         = uniqid().'_director_'.trim(preg_replace('/\s*\([^)]*\)/', '', $image->getClientOriginalName()));
            if (!is_dir($this->path)) {
                mkdir($this->path, 0777);
            }
            $path         = base_path().'/public/images/director/';
            $moved        = Image::make($image->getRealPath())->fit('550','550')->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }
        $director = ManagingDirector::create($data);
        if($director){
            Session::flash('success','Managing Director details created successfully');
        }
        else{
            Session::flash('error','Something went wrong. Managing Director details cannot be created');
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
        $edit   = ManagingDirector::find($id);
        return response()->json($edit);
    }

    public function orderUpdateDirector(Request $request)
    {
        $director = ManagingDirector::all();
        foreach ($director as $direct) {
            foreach ($request->order as $order) {
                if ($order['id'] == $direct->id) {
                    $direct->order =  $order['position'];
                    $direct->update();
                }
            }
        }
        return response()->json(['message' =>'Managing Director order updated Successfully.','status' => '200']);
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
        $director                      =  ManagingDirector::find($id);
        $director->heading             =  $request->input('heading');
        $director->designation         =  $request->input('designation');
        $director->description         =  $request->input('description');
        $director->link                =  $request->input('link');
        $director->button              =  $request->input('button');
        $oldimage                      =  $director->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_director_'.trim(preg_replace('/\s*\([^)]*\)/', '', $image->getClientOriginalName()));
            $path                 = base_path().'/public/images/director/';
            $moved                = Image::make($image->getRealPath())->fit('550','550')->orientate()->save($path.$name);
            if ($moved){
                $director->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/director/'.$oldimage)){
                    @unlink(public_path().'/images/director/'.$oldimage);
                }
            }
        }

        $status = $director->update();
        if($status){
            Session::flash('success','Managing Director details was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Managing Director details could not be Updated');
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
        $delete             = ManagingDirector::find($id);
        $rid                = $delete->id;
        if (!empty($delete->image) && file_exists(public_path().'/images/director/'.$delete->image)){
            @unlink(public_path().'/images/director/'.$delete->image);
        }
        $remove = $delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Managing Director has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Managing Director could not be removed. Try Again later !']);
        }
    }
}
