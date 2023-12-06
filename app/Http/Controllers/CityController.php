<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use CountryState;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $path;

    public function __construct()
    {
        $this->path   = public_path('/images/city');
        $this->middleware('auth');
    }

    public function index()
    {
        $cities        = City::all();
        $countries     = CountryState::getCountries();

        return view('backend.city.index',compact('cities','countries'));
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
            $path         = base_path().'/public/images/city/';
            $moved        = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }
        $clients = City::create($data);
        if($clients){
            Session::flash('success','City Created Successfully');
        }
        else{
            Session::flash('error','Something went wrong. City cannot be created');
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
        $edit           = City::find($id);
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
        $success                     =  City::find($id);
        $success->title              =  $request->input('title');
        $success->country            =  $request->input('country');
        $oldimage                    =  $success->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/city/';
            $moved                = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $success->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/city/'.$oldimage)){
                    @unlink(public_path().'/images/city/'.$oldimage);
                }
            }
        }
        $status = $success->update();
        if($status){
            Session::flash('success','City was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. City could not be Updated');
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
        $delete       = City::find($id);

        if (!empty($delete->image) && file_exists(public_path().'/images/city/'.$delete->image)){
            @unlink(public_path().'/images/city/'.$delete->image);
        }

        $remove          =$delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'City has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'City could not be removed. Try Again later !']);
        }
    }
}
