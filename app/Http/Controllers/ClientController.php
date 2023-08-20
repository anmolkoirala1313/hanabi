<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use CountryState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path;

    public function __construct()
    {
        $this->path   = public_path('/images/clients');
        $this->middleware('auth');
    }

    public function index()
    {
        $clients        = Client::all();
        $countries      = CountryState::getCountries();
        return view('backend.clients.index',compact('clients','countries'));
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
            'country'             => $request->input('country'),
            'link'                => $request->input('link'),
            'created_by'          => Auth::user()->id,
        ];
        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            if (!is_dir($this->path)) {
                mkdir($this->path, 0777);
            }
            $name         = uniqid().'_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/clients/';
            $moved        = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }
        $clients = Client::create($data);
        if($clients){
            Session::flash('success','Client Created Successfully');
        }
        else{
            Session::flash('error','Something went wrong. Client cannot be created');
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
        $edit           = Client::find($id);
        $countries      = CountryState::getCountries();
        return response()->json(["edit"=>$edit,"countries"=>$countries]);
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
        $clients                     =  Client::find($id);
        $clients->name               =  $request->input('name');
        $clients->country            =  $request->input('country');
        $clients->link               =  $request->input('link');
        $oldimage                    = $clients->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/clients/';
            $moved                = Image::make($image->getRealPath())->orientate()->save($path.$name);
            if ($moved){
                $clients->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/clients/'.$oldimage)){
                    @unlink(public_path().'/images/clients/'.$oldimage);
                }
            }
        }
        $status = $clients->update();
        if($status){
            Session::flash('success','Client was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Client could not be Updated');
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
        $delete       = Client::find($id);
        if (!empty($delete->image) && file_exists(public_path().'/images/clients/'.$delete->image)){
            @unlink(public_path().'/images/clients/'.$delete->image);
        }

        $remove          =$delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Client has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Client could not be removed. Try Again later !']);
        }
    }
}
