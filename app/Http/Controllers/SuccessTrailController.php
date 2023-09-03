<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\SuccessTrail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use CountryState;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class SuccessTrailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $path;

    public function __construct()
    {
        $this->path   = public_path('/images/success_trail');
        $this->middleware('auth');
    }

    public function index()
    {
        $success        = SuccessTrail::all();
        $countries      = CountryState::getCountries();

        return view('backend.success_trail.index',compact('success','countries'));
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
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data=[
            'title'               => $request->input('title'),
            'country'             => $request->input('country'),
            'created_by'          => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            if (!is_dir($this->path)) {
                mkdir($this->path, 0777);
            }
            $name         = uniqid().'_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/success_trail/';
            $moved        = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }
        $clients = SuccessTrail::create($data);
        if($clients){
            Session::flash('success','Success Trail Created Successfully');
        }
        else{
            Session::flash('error','Something went wrong. Success Trail cannot be created');
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $edit           = SuccessTrail::find($id);
        $countries      = CountryState::getCountries();

        return response()->json(["edit"=>$edit,"countries"=>$countries]);
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
        $success                     =  SuccessTrail::find($id);
        $success->title              =  $request->input('title');
        $success->country            =  $request->input('country');
        $oldimage                    =  $success->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/success_trail/';
            $moved                = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $success->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/success_trail/'.$oldimage)){
                    @unlink(public_path().'/images/success_trail/'.$oldimage);
                }
            }
        }
        $status = $success->update();
        if($status){
            Session::flash('success','Success Trail was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Success Trail could not be Updated');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete       = SuccessTrail::find($id);

        if (!empty($delete->image) && file_exists(public_path().'/images/success_trail/'.$delete->image)){
            @unlink(public_path().'/images/success_trail/'.$delete->image);
        }

        $remove          =$delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Success Trail has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Success Trail could not be removed. Try Again later !']);
        }
    }
}
