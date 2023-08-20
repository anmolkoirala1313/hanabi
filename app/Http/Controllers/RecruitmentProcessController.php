<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class RecruitmentProcessController extends Controller
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
        $listnum   = count($request->input('title'));
        for ($i=0;$i<$listnum;$i++){
            $heading      =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
            $description  =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);
            $data=[
                'heading'               => $heading,
                'description'           => $description,
                'title'                 =>  $request->input('title')[$i] ?? null,
                'icon_description'      =>  $request->input('icon_description')[$i] ?? null,
                'created_by'            => Auth::user()->id,
            ];
            $status = RecruitmentProcess::create($data);
        }
        if($status){
            Session::flash('success','Recruitment Process details created successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Recruitment Process details could not be created.');
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
        //
    }

    public function listUpdate(Request $request)
    {
        $listnum   = count($request->input('title'));
        $db_elements     = json_decode($request->input('recruitment_elements'),true);
        $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);
        for ($i=0;$i<$listnum;$i++){
            $heading      =  (array_key_exists($i, $request->input('heading')) ?  $request->input('heading')[$i]: Null);
            $description  =  (array_key_exists($i, $request->input('description')) ?  $request->input('description')[$i]: Null);

            if($request->input('id')[$i] == null){
                $data=[
                    'heading'               => $heading,
                    'description'           => $description,
                    'title'                 => $request->input('title')[$i] ?? null,
                    'icon_description'      => $request->input('icon_description')[$i] ?? null,
                    'created_by'            => Auth::user()->id,
                ];
                $status = RecruitmentProcess::create($data);
            }
            else{
                $process                      = RecruitmentProcess::find($request->input('id')[$i]);
                $process->heading             = $heading;
                $process->description         = $description;
                $process->title               = $request->input('title')[$i] ?? null;
                $process->icon_description    = $request->input('icon_description')[$i] ?? null;
                $process->updated_by          = Auth::user()->id;
                $status                       = $process->update();
            }
        }
        foreach ($db_elements_id as $key=>$value){
            if(!in_array($value,$request->input('id'))){
                $delete_element = RecruitmentProcess::find($value);
                $status         = $delete_element->delete();
            }
        }

        if($status){
            Session::flash('success','Recruitment Process details updated successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Recruitment Process details could not be updated.');
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
        //
    }
}
