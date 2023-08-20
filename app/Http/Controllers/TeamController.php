<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $teampath;

    public function __construct()
    {
        $this->teampath   = public_path('/images/teams');

        $this->middleware('auth');
    }

    public function index()
    {
        $teams    = Team::orderBy('order','ASC')->get();
        $settings = Setting::first();
        return view('backend.team.index',compact('teams','settings'));
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
            'post'                => $request->input('post'),
            'fb'                  => $request->input('fb'),
            'twitter'             => $request->input('twitter'),
            'insta'               => $request->input('insta'),
            'linkedin'            => $request->input('linkedin'),
            'created_by'          => Auth::user()->id,
        ];

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $name         = uniqid().'_teams_'.$image->getClientOriginalName();
            if (!is_dir($this->teampath)) {
                mkdir($this->teampath, 0777);
            }
            $path         = base_path().'/public/images/teams/';
            $moved        = Image::make($image->getRealPath())->fit(220, 220)->orientate()->save($path.$name);
            if ($moved){
                $data['image']= $name;
            }
        }
        $team = Team::create($data);
        if($team){
            Session::flash('success','Team details Created Successfully');
        }
        else{
            Session::flash('error','Something went wrong. Team details cannot be created');
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
        $edit   = Team::find($id);
        return response()->json($edit);
    }

    public function orderUpdate(Request $request)
    {
        $teams = Team::all();
        foreach ($teams as $team) {
            foreach ($request->order as $order) {
                if ($order['id'] == $team->id) {
                    $team->update(['order' => $order['position']]);
                }
            }
        }


        return response()->json(['message' =>'Team order updated Successfully.','status' => '200']);
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
        $team                      =  Team::find($id);
        $team->name                =  $request->input('name');
        $team->post                =  $request->input('post');
        $team->fb                  =  $request->input('fb');
        $team->twitter             =  $request->input('twitter');
        $team->insta               =  $request->input('insta');
        $team->linkedin            =  $request->input('linkedin');
        $oldimage                  = $team->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_teams_'.$image->getClientOriginalName();
            $path                 = base_path().'/public/images/teams/';
            $moved                = Image::make($image->getRealPath())->fit(220, 220)->orientate()->save($path.$name);
            if ($moved){
                $team->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/teams/'.$oldimage)){
                    @unlink(public_path().'/images/teams/'.$oldimage);
                }
            }
        }

        $status = $team->update();
        if($status){
            Session::flash('success','Team details was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Team details could not be Updated');
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
        $delete             = Team::find($id);
        $rid                = $delete->id;
        if (!empty($delete->image) && file_exists(public_path().'/images/teams/'.$delete->image)){
            @unlink(public_path().'/images/teams/'.$delete->image);
        }
        $remove = $delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Team details has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Team details could not be removed. Try Again later !']);
        }
    }
}
