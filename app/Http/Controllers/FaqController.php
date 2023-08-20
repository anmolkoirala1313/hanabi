<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $data=[
            'name'              => $request->input('name'),
            'description'       => $request->input('description'),
            'created_by'        => Auth::user()->id,
        ];
        $service = Faq::create($data);
        if($service){
            Session::flash('success','FAQ was created successfully !');
        }
        else{
            Session::flash('error','FAQ could not be created at the moment !');
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
        $edit      = Faq::find($id);
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
        $faq                        = Faq::find($id);
        $faq->name                  = $request->input('name');
        $faq->description           = $request->input('description');
        $faq->updated_by            = Auth::user()->id;
        $status                     = $faq->update();
        if($status){
            Session::flash('success','FAQ was updated successfully !');
        }
        else{
            Session::flash('error','Something Went Wrong. FAQ could not be updated at the moment !');
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
        $delete          = Faq::find($id);
        $rid             = $delete->id;
        $delete->delete();
        $status ='success';
        return response()->json(['status'=>$status,'id'=>$rid,'message'=>'FAQ was removed!']);
    }
}
