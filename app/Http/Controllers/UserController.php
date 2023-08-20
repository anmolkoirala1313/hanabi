<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
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
        //
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
    public function store(Request $request){

        $user_slug = strtolower(str_replace(' ','-',$request->input('name')));
        $slug  = User::where('slug',$user_slug)->first();
        $email = User::where('email',$request->input('email'))->first();
        if ($slug !== null) {
            $status ='slug duplicate';
            return response()->json(['status'=>$status,'message'=>'This username is already in use. Try something different.']);
        }
        elseif ($email !== null){
            $status ='email duplicate';
            return response()->json(['status'=>$status,'message'=>'This email is already in use. Try something different.']);
        }
        else {
            $data = [
                'name'      => $request->input('name'),
                'slug'      => $user_slug,
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password')),
                'contact'   => $request->input('contact'),
                'address'   => $request->input('address'),
                'gender'    => $request->input('gender'),
                'status'    => $request->input('status'),
                'user_type' => $request->input('user_type'),
            ];

            if (!empty($request->file('image'))) {
                $image = $request->file('image');
                $name1 = uniqid() . '_user_' . $image->getClientOriginalName();
                $path = base_path() . '/public/images/user/';
                if (!is_dir($path)) {
                    mkdir($path, 0777);
                }
                $moved = Image::make($image->getRealPath())->fit(200, 200)->orientate()->save($path . $name1);
                if ($moved) {
                    $data['image'] = $name1;
                }
            }

            if (!empty($request->file('cover'))) {
                $image = $request->file('cover');
                $name1 = uniqid() . '_cover_' . $image->getClientOriginalName();
                $path = base_path() . '/public/images/user/cover/';
                if (!is_dir($path)) {
                    mkdir($path, 0777);
                }
                $moved1 = Image::make($image->getRealPath())->fit(2000, 850)->orientate()->save($path . $name1);
                if ($moved1) {
                    $data['cover'] = $name1;
                }
            }
            $status = User::create($data);
            if ($status) {
                $user = User::latest()->first();
                $status = 'success';
                return response()->json(['status' => $status, 'message' => 'New user added to the list', 'user' => $user]);

            } else {
                $status = 'error';
                return response()->json(['status' => $status, 'message' => 'Could not create new user at the moment. Try again later.']);
            }
        }

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
        //
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
        $user                 =  User::find($id);
        $user->name           =  $request->input('name');
        $user->slug           =  strtolower(str_replace(' ','-',$request->input('name')));
        $user->email          =  $request->input('email');
        $user->gender         =  $request->input('gender');
        $user->contact        =  $request->input('contact');
        $user->user_type      =  $request->input('user_type');
        $user->address        =  $request->input('address');
        $user->about          =  $request->input('about');
        $oldimage             = $user->image;
        $oldcover             = $user->cover;

        $status = $user->update();
        if($status){
            Session::flash('success','Changes were applied successfully');

        }
        else{
            Session::flash('error','Something Went Wrong. Changes could not be applied.');
        }
        return redirect()->route('profile',$user->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete          = User::find($id);
        $id              = $delete->id;
        if (!empty($delete->image) && file_exists(public_path().'/images/user/'.$delete->image)){
            @unlink(public_path().'/images/user/'.$delete->image);
        }
        if (!empty($delete->cover) && file_exists(public_path().'/images/user/cover/'.$delete->cover)){
            @unlink(public_path().'/images/user/cover/'.$delete->cover);
        }
        $status = $delete->delete();
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'id'=>$id,'message'=>'User and its data was removed!']);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'id'=>$id,'message'=>'User could not be removed at the moment. Try Again later !']);
        }
    }

    public function profile($slug){
        $user           = User::where('slug',$slug)->first();
        $services       = Service::all();
        $blogs          = Blog::all()->take(5);
        $alluser        = User::all()->take(5)->except(Auth::user()->id);
        return view('backend.user.profile',compact('user','services','blogs','alluser'));
    }

    public function alluser(){
        $users          = User::orderBy('id','desc')->get();
        return view('backend.user.alluser',compact('users'));
    }

    public function profileEdit($slug){
        $user           =  User::where('slug',$slug)->first();
        return view('backend.user.profile-edit',compact('user'));
    }

    public function imageupdate(Request $request)
    {
        $user      = User::find($request->input('userid'));
        $name      = $request->input('name');
        if (!empty($request->file('image')) && $name =='image' ){
            $oldimage  = $user->image;
            $image       = $request->file('image');
            $name1       = uniqid().'_user_'.$image->getClientOriginalName();
            $path        = base_path().'/public/images/user/';

            if (!is_dir($path)) {
                mkdir($path, 0777);
            }
            $moved       = Image::make($image->getRealPath())->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
                $constraint->upsize();
            })->orientate()->save($path.$name1);

            if ($moved){
                $user->image = $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/user/'.$oldimage)){
                    @unlink(public_path().'/images/user/'.$oldimage);
                }
            }
        }

        if (!empty($request->file('image')) && $name =='cover'){
            $oldimage  = $user->cover;
            $image       = $request->file('image');
            $name1       = uniqid().'_cover_'.$image->getClientOriginalName();
            $path        = base_path().'/public/images/user/cover/';
            if (!is_dir($path)) {
                mkdir($path, 0777);
            }
            $moved       = Image::make($image->getRealPath())->fit(2000, 850)->orientate()->save($path.$name1);

            if ($moved){
                $user->cover= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/user/cover/'.$oldimage)){
                    @unlink(public_path().'/images/user/cover/'.$oldimage);
                }
            }
        }

        $status = $user->update();
        if($status){
            $status = 'success';
        }else{
            $status = 'failed';
        }
         return response()->json(['status'=>$status,'image'=>$name1]);
    }

    public function checkoldpassword(Request $request){
        $user          = User::find($request->input('userid'));
        $incoming_pass = $request->input('oldpassword');
        if($incoming_pass == null){
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Please enter old password for verification first !']);
        }
        if (!Hash::check($incoming_pass, $user->password)) {
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'The old password does not match our records.']);
        }else{
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Password check completed. Its a match !']);
        }
    }

    public function socialsUpdate(Request $request)
    {
        $user                 =  User::find( $request->input('userid'));
        $user->fb             =  $request->input('fb');
        $user->insta          =  $request->input('insta');
        $user->linkedin       =  $request->input('linkedin');
        $user->twitter        =  $request->input('twitter');
        $status               = $user->update();
        if ($status) {
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Your socials are updated.']);

        }else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Social information could not updated']);
        }
    }

    public function profilepassword(Request $request){
        $id                 = $request->input('userid');
        $user               = User::find($id);
        $password           = Hash::make($request->input('password'));
        $user->password     = $password;
        $status             = User::where('id', $id)->update(array('password' => $password));
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Password has been changed !']);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Your password could not be updated. Try Again later !']);
        }
    }

    public function removeAccount(Request $request){
        $id               = $request->input('userid');
        $user             = User::find($id);
        $cover            = $user->cover;
        $image            = $user->image;
        if (!empty($image) && file_exists(public_path().'/images/user/'.$image)){
            @unlink(public_path().'/images/user/'.$image);
        }
        if (!empty($cover) && file_exists(public_path().'/images/user/cover/'.$cover)){
            @unlink(public_path().'/images/user/cover/'.$cover);
        }
        $removeacc          = $user->delete();
        if($removeacc){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Your account information has been removed! You will be logged out now.']);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Account could not be removed. Try Again later !']);
        }
    }

    public function statusupdate(Request $request, $id){
        $user          = User::find($id);
        $user->status  = $request->status;
        $status        = $user->update();
        $new_status  = ($user->status == 0) ? "Inactive":"Active";
        $value  = ($user->status == 0) ? 1:0;
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'new_status'=>$new_status,'id'=>$id,'value'=>$value]);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'new_status'=>$new_status,'id'=>$id,'value'=>$value]);
        }
        return response()->json($confirmed);
    }

    public function roleupdate(Request $request, $id){
        $user             = User::find($id);
        $user->user_type  = $request->user_type;
        $status           = $user->update();
        $new_role         = $user->user_type;
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'User role has been changed','role'=>$new_role]);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'User role could not be changed','role'=>$new_role]);
        }

    }




}
